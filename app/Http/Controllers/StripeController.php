<?php

namespace App\Http\Controllers;

use Stripe\StripeClient;
use Stripe\PaymentIntent;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Stripe\Stripe as StripeGateway;

class StripeController extends Controller
{
    public function initiatePayment(Request $request) {
        $secrect_key = env('STRIPE_SECRET_KEY', null);

        StripeGateway::setApiKey($secrect_key);

        try {
            $paymentIntent = PaymentIntent::create([
                'amount' => $request->total * 100, // Multiply as & when required
                'currency' => 'USD',
                'automatic_payment_methods' => [
                    'enabled' => false,
                ],
            ]);

            return response()->json([
                'code' => 'SUCCESS',
                'data' => [
                    'token' => (string) Str::uuid(),
                    'client_secret' => $paymentIntent->client_secret
                ]
            ]);

            // Save the $paymentIntent->id to identify this payment later
        } catch (\Exception $e) {
            return response()->json([
                'code' => 'SERVER_ERROR',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function completePayment() {

    }

    public function failPayment() {

    }
}
