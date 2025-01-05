<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenAI\Client as OpenAI;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class SearchController extends Controller
{
    public function handleSearch(Request $request)
    {
        $user = auth()->user();

        // Check user's search limit
        if ($user->search_limit <= 0) {
            return back()->with('error', 'Upgrade your subscription to continue.');
        }

        // Input from user
        $query = $request->input('prompt');
        if (!$query) {
            return back()->with('error', 'Please enter a valid query.');
        }

        try {
            // Initialize OpenAI Client
            $openAI = \OpenAI::client(config('services.openai.key'));

            // Log the user query
            Log::info('User Query:', ['query' => $query]);

            // Prompt to extract structured information
            $aiResponse = $openAI->chat()->create([
                'model' => 'gpt-4',
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => "You are a travel assistant that extracts structured information for Duffel API, FlightsAPI.io, and Booking.com API. Ensure the output follows the required format.",
                    ],
                    [
                        'role' => 'user',
                        'content' => $this->generatePrompt($query),
                    ],
                ],
                'max_tokens' => 400,
            ]);

            // Extract JSON from the response
            $responseContent = $aiResponse['choices'][0]['message']['content'] ?? null;
            Log::info('Raw Response from OpenAI:', ['response' => $responseContent]);

            // Parse responses for each API
            $parsedResponses = $this->parseAPIResponses($responseContent);

            // Log parsed responses
            Log::info('Parsed Responses for APIs:', ['responses' => $parsedResponses]);

            // Validate responses
            if (!$this->validateResponses($parsedResponses)) {
                return back()->with('error', 'AI failed to process your query. Please refine your input and try again.');
            }

            // Query APIs and collect results
            $flightResultsDuffel = $this->queryDuffelAPI($parsedResponses['Duffel API']);
            $flightResultsFlightsAPI = $this->queryFlightsAPI($parsedResponses['FlightAPI.io']);
            $hotelResults = $this->queryBookingAPI($parsedResponses['Booking.com API']);

            // Log API results
            Log::info('Flight Results (Duffel):', ['flights' => $flightResultsDuffel]);
            Log::info('Flight Results (FlightAPI.io):', ['flights' => $flightResultsFlightsAPI]);
            Log::info('Hotel Results:', ['hotels' => $hotelResults]);

            // Combine and normalize results
            $finalResults = $this->normalizeResults(
                array_merge($flightResultsDuffel, $flightResultsFlightsAPI),
                $hotelResults
            );

            // Handle case with no results
            if (empty($finalResults)) {
                Log::info('No results found for user query:', ['query' => $query]);
                return back()->with('error', 'No results found. Please refine your query and try again.');
            }

            // Decrement user's search limit
            $user->decrement('search_limit');

            // Return results to the view
            return view('home', [
                'results' => $finalResults,
            ]);
        } catch (\Exception $e) {
            // Log exception details
            Log::error('Error in SearchController:', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return back()->with('error', 'An error occurred while processing your request. Please try again later.');
        }
    }

    /**
     * Generate the AI prompt for extracting structured data.
     */
    private function generatePrompt($query)
    {
        return <<<PROMPT
Given the query: "$query", extract structured data for the following APIs:

### Duffel API
- Origin: IATA code of the departure location.
- Destination: IATA code of the arrival location.
- Non-stop preference: Boolean.
- Sort type: "duration" or "price".

### FlightAPI.io
- OriginLocationCode: IATA code of the departure location.
- DestinationLocationCode: IATA code of the arrival location.
- DepartureDate: YYYY-MM-DD format.
- Non-stop preference: Boolean.
- Sort type: "duration" or "price".

### Booking.com API
- Destination: City name or location ID.
- Check-in date: YYYY-MM-DD format.
- Check-out date: YYYY-MM-DD format.
- Guest count: Integer (default to 1 if unspecified).
PROMPT;
    }

    /**
     * Parse API-specific responses from OpenAI output.
     */
    private function parseAPIResponses($responseContent)
    {
        $parsed = [
            'Duffel API' => [],
            'FlightAPI.io' => [],
            'Booking.com API' => []
        ];

        $sections = preg_split('/### /', $responseContent);
        foreach ($sections as $section) {
            if (str_contains($section, 'Duffel API')) {
                $parsed['Duffel API'] = $this->extractAPIParams($section);
            } elseif (str_contains($section, 'FlightAPI.io')) {
                $parsed['FlightAPI.io'] = $this->extractAPIParams($section);
            } elseif (str_contains($section, 'Booking.com API')) {
                $parsed['Booking.com API'] = $this->extractAPIParams($section);
            }
        }

        return $parsed;
    }

    /**
     * Extracts parameters from a specific API section.
     */
    private function extractAPIParams($section)
    {
        $params = [];
        $lines = explode("\n", $section);

        foreach ($lines as $line) {
            if (str_contains($line, ':')) {
                [$key, $value] = explode(':', $line, 2);
                $params[trim($key)] = trim($value);
            }
        }

        return $params;
    }

    /**
     * Validate parsed responses.
     */
    private function validateResponses($responses)
    {
        foreach ($responses as $api => $params) {
            if (empty($params)) {
                Log::warning("Missing key in parsed response: {$api}");
                return false;
            }
        }
        return true;
    }

    /**
     * Query Duffel API.
     */
    private function queryDuffelAPI(array $params)
    {
        try {
            $http = new Client();
            $response = $http->get('https://api.duffel.com/v1/airlines', [
                'headers' => ['Authorization' => 'Bearer ' . config('services.duffel.api_key')],
                'query' => [
                    'origin' => $params['Origin'] ?? '',
                    'destination' => $params['Destination'] ?? '',
                    'nonStop' => $params['Non-stop preference'] ?? false,
                    'sort' => $params['Sort type'] ?? 'price',
                ],
            ]);
            return json_decode($response->getBody(), true)['data'] ?? [];
        } catch (\Exception $e) {
            Log::error('Error querying Duffel API:', ['error' => $e->getMessage()]);
            return [];
        }
    }

    /**
     * Query FlightsAPI.io.
     */
    private function queryFlightsAPI(array $params)
    {
        try {
            $http = new Client();
            $response = $http->get('https://api.flightsapi.io/v1/flights', [
                'headers' => ['Authorization' => 'Bearer ' . config('services.flightsapi.api_key')],
                'query' => [
                    'originLocationCode' => $params['OriginLocationCode'] ?? '',
                    'destinationLocationCode' => $params['DestinationLocationCode'] ?? '',
                    'departureDate' => $params['DepartureDate'] ?? '',
                    'nonStop' => $params['Non-stop preference'] ?? false,
                    'sort' => $params['Sort type'] ?? 'price',
                ],
            ]);
            return json_decode($response->getBody(), true)['data'] ?? [];
        } catch (\Exception $e) {
            Log::error('Error querying FlightsAPI.io:', ['error' => $e->getMessage()]);
            return [];
        }
    }

    /**
     * Query Booking.com API.
     */
    private function queryBookingAPI(array $params)
    {
        try {
            $http = new Client();
            $response = $http->get('https://api.booking.com/v1/hotels', [
                'headers' => ['Authorization' => 'Bearer ' . config('services.booking.api_key')],
                'query' => [
                    'destination' => $params['Destination'] ?? '',
                    'checkin_date' => $params['Check-in date'] ?? '',
                    'checkout_date' => $params['Check-out date'] ?? '',
                    'guest_count' => $params['Guest count'] ?? 1,
                ],
            ]);
            return json_decode($response->getBody(), true)['results'] ?? [];
        } catch (\Exception $e) {
            Log::error('Error querying Booking.com API:', ['error' => $e->getMessage()]);
            return [];
        }
    }

    /**
     * Normalize results for final output.
     */
    private function normalizeResults(array $flightResults, array $hotelResults)
    {
        $normalizedFlights = array_map(function ($flight) {
            return [
                'type' => 'flight',
                'airline' => $flight['airline_name'] ?? 'Unknown Airline',
                'price' => $flight['price'] ?? 'N/A',
                'duration' => $flight['duration'] ?? 'N/A',
                'stops' => $flight['stops'] ?? 'Unknown',
            ];
        }, $flightResults);

        $normalizedHotels = array_map(function ($hotel) {
            return [
                'type' => 'hotel',
                'name' => $hotel['name'] ?? 'Unknown Hotel',
                'price' => $hotel['price'] ?? 'N/A',
                'location' => $hotel['location'] ?? 'Unknown',
                'rating' => $hotel['rating'] ?? 'N/A',
            ];
        }, $hotelResults);

        return array_merge($normalizedFlights, $normalizedHotels);
    }
}
