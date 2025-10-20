<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\GCashDonation;

class PaymentWebhookController extends Controller
{

    public function handle(Request $request)
    {
        Log::info('PayMongo webhook received', $request->all());

        $signatureHeader = $request->header('Paymongo-Signature');
        $payload = $request->getContent();
        $secret = env('PAYMONGO_WEBHOOK_SECRET');

        // Extract the actual signature from the header (after "te=")
        preg_match('/te=([a-f0-9]+)/', $signatureHeader, $matches);
        $receivedSignature = $matches[1] ?? null;

        // Compute our own version
        $computedSignature = hash_hmac('sha256', $payload, $secret);

        Log::debug('Signature Debug', [
            'header' => $signatureHeader,
            'received' => $receivedSignature,
            'computed' => $computedSignature,
            'secret_used' => $secret,
        ]);

        // Compare safely
        if (!$receivedSignature || !hash_equals($receivedSignature, $computedSignature)) {
            Log::warning('Invalid PayMongo signature.');
            abort(403, 'Invalid signature');
        }

        $eventType = $request->input('data.attributes.type');
        $data = $request->input('data.attributes.data');

        if ($eventType === 'source.chargeable') {
            $sourceId = $data['id'];
            $payment = GCashDonation::where('paymongo_id', $sourceId)->first();

            if ($payment) {
                $payment->status = 'paid';
                $payment->save();
                Log::info("Payment {$payment->id} marked as PAID.");
            } else {
                Log::warning("Payment not found for ID: $sourceId");
            }
        }

        return response()->json(['status' => 'ok']);
    }

}
