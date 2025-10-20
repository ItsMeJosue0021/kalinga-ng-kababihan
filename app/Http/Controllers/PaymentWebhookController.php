<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\GCashDonation;

class PaymentWebhookController extends Controller
{

    public function handle(Request $request)
    {
        $payload = $request->getContent();
        $signatureHeader = $request->header('Paymongo-Signature');

        Log::info('PayMongo webhook received', json_decode($payload, true));

        // ✅ Extract the actual signature hash
        preg_match('/v1=([a-f0-9]+)/', $signatureHeader, $matches);
        $receivedSignature = $matches[1] ?? '';

        // ✅ Compute the signature using your webhook secret
        $computedSignature = hash_hmac('sha256', $payload, env('PAYMONGO_WEBHOOK_SECRET'));

        // ✅ Validate
        if (!hash_equals($computedSignature, $receivedSignature)) {
            Log::warning('Invalid PayMongo signature.');
            abort(403, 'Invalid signature');
        }

        // ✅ Continue if signature is valid
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

//     public function handle(Request $request)
//     {
//         Log::info('PayMongo webhook received', $request->all());

//         $signature = $request->header('Paymongo-Signature');
//         $payload = $request->getContent();
//         $computedSignature = hash_hmac('sha256', $payload, env('PAYMONGO_WEBHOOK_SECRET'));

//         if (!hash_equals($signature, $computedSignature)) {
//             Log::warning('Invalid PayMongo signature.');
//             abort(403, 'Invalid signature');
//         }

//         $eventType = $request->input('data.attributes.type');
//         $data = $request->input('data.attributes.data');

//         if ($eventType === 'source.chargeable') {

//             $sourceId = $data['id'];

//             $payment = GCashDonation::where('paymongo_id', $sourceId)->first();

//             if ($payment) {
//                 $payment->status = 'paid';
//                 $payment->save();
//                 Log::info("Payment {$payment->id} marked as PAID.");
//             } else {
//                 Log::warning("Payment not found for ID: $sourceId");
//             }
//         }

//         return response()->json(['status' => 'ok']);
//     }
}
