<?php

namespace App\Http\Controllers;

use GoCardlessPro\Client;
use Illuminate\Http\Request;

class GoCardlessController extends Controller
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function createCustomer(Request $request)
    {
        try {
            $customer = $this->client->customers()->create([
                'params' => [
                    'given_name' => $request->input('given_name'),
                    'family_name' => $request->input('family_name'),
                    'email' => $request->input('email'),
                    'address_line1' => $request->input('address_line1'),
                    'city' => $request->input('city'),
                    'postal_code' => $request->input('postal_code'),
                    'country_code' => $request->input('country_code'),
                ],
            ]);

            return redirect('/payment/create')->with('status', 'Customer created successfully!');
        } catch (\GoCardlessPro\Core\Exception\ApiException $e) {
            // Capture et afficher les détails de l'erreur
           
            return  $e->getMessage();
        }
    }

    public function createPayment(Request $request)
    {
        $payment = $this->client->payments()->create([
            'params' => [
                'amount' => $request->input('amount'),
                // Amount in pence/cents
                'currency' => 'GBP',
                'links' => [
                    'mandate' => $request->input('mandate_id'),
                ],
                'description' => $request->input('description'),
            ],
        ]);

        return redirect('/payment/create')->with('status', 'Payment created successfully!');
    }

    public function createMandate(Request $request)
    {
        $redirectFlow = $this->client->redirectFlows()->create([
            'params' => [
                'description' => 'Your Company - Subscription',
                'session_token' => session()->getId(),
                'success_redirect_url' => url('/gocardless/mandate-success'),
                'prefilled_customer' => [
                    'given_name' => $request->input('given_name'),
                    'family_name' => $request->input('family_name'),
                    'email' => $request->input('email'),
                    'address_line1' => $request->input('address_line1'),
                    'city' => $request->input('city'),
                    'postal_code' => $request->input('postal_code'),
                    'country_code' => $request->input('country_code'),
                ],
            ],
        ]);

        return redirect($redirectFlow->redirect_url);
    }

    public function mandateSuccess(Request $request)
    {
        $redirectFlowId = $request->query('redirect_flow_id');
        $redirectFlow = $this->client->redirectFlows()->complete($redirectFlowId, [
            'params' => [
                'session_token' => session()->getId(),
            ],
        ]);

        // Save the mandate ID for future payments
        $mandateId = $redirectFlow->links->mandate;

        return response()->json(['mandate_id' => $mandateId]);
    }
}
