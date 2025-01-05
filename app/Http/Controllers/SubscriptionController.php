<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Auth;

class SubscriptionController extends Controller
{
    public function pricing()
    {
        return view('pricing');
    }

    public function subscribe(Request $request)
    {
        $user = Auth::user();
        $plan = $request->input('plan');
        $price = match ($plan) {
            'basic' => 1000, // 10 USD in cents
            'premium' => 2000, // 20 USD in cents
            'pro' => 3000, // 30 USD in cents
        };

        Stripe::setApiKey(config('stripe.secret'));

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => ucfirst($plan) . ' Plan Subscription',
                    ],
                    'unit_amount' => $price,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('home'),
            'cancel_url' => route('pricing'),
        ]);

        $user->update([
            'is_premium' => true,
            'subscription_plan' => $plan,
            'search_limit' => $plan === 'basic' ? 10 : ($plan === 'premium' ? 20 : 30),
        ]);

        return redirect($session->url);
    }
}
