<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class GoCardlessWebhookController extends Controller
{
    public function handle(Request $request)
    {
        // Validate the webhook signature
        $signature = $request->header('Webhook-Signature');
        $secret = env('GOCARDLESS_WEBHOOK_SECRET');
        $computedSignature = hash_hmac('sha256', $request->getContent(), $secret);

        if (!hash_equals($signature, $computedSignature)) {
            return response()->json(['message' => 'Invalid signature'], 400);
        }

        // Handle the webhook event
        $events = $request->input('events', []);
        foreach ($events as $event) {
            $eventAction = $event['action'];
            $eventResourceType = $event['resource_type'];
            $eventDetails = $event['details'];

            // Log the event (or handle it accordingly)
            Log::info('GoCardless Webhook Event', compact('eventAction', 'eventResourceType', 'eventDetails'));
        }

        return response()->json(['message' => 'Webhook received']);
    }
}
