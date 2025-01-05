@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Search Results</h1>

    @if(empty($results))
        <p>No results found. Please refine your search and try again.</p>
    @else
        <div class="results">
            @foreach($results as $result)
                <div class="result-card">
                    <h3>{{ $result['type'] === 'flight' ? 'Flight' : 'Hotel' }}</h3>
                    <p><strong>{{ $result['type'] === 'flight' ? 'Airline' : 'Name' }}:</strong> {{ $result['airline'] ?? $result['name'] }}</p>
                    <p><strong>Price:</strong> {{ $result['price'] }}</p>
                    <p><strong>{{ $result['type'] === 'flight' ? 'Duration' : 'Location' }}:</strong> {{ $result['duration'] ?? $result['location'] }}</p>
                    @if($result['type'] === 'hotel')
                        <p><strong>Rating:</strong> {{ $result['rating'] }}</p>
                    @endif
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
