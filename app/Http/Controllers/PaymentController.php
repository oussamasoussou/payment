<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;

class PaymentController extends Controller
{
    public function showPaymentForm()
    {
        return view('payment');
    }

    public function processPayment(Request $request)
    {

        $apiKey = config('services.stripe.secret');
        Stripe::setApiKey($apiKey);

        try {
            // Créer la charge avec le token de carte provenant du formulaire
            Charge::create([
                'amount' => 4000,
                // Montant en cents ($10.00)
                'currency' => 'eur',
                'source' => $request->stripeToken,
                // Utiliser le token de carte
                'description' => 'hatem diwani',
            ]);

            // Paiement réussi ; stocker un message de succès dans la session
            $request->session()->flash('success', 'Paiement réussi!');

            return redirect()->route('payment.success');
        } catch (\Exception $e) {
            // Échec du paiement ; stocker un message d'erreur dans la session
            $request->session()->flash('error', $e->getMessage());

            return redirect()->route('payment.failure');
        }
    }
}
