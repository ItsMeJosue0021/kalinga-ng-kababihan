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

        $signature = $request->header('Paymongo-Signature');
        $payload = $request->getContent();
        $computedSignature = hash_hmac('sha256', $payload, env('PAYMONGO_WEBHOOK_SECRET'));

        if (!hash_equals($signature, $computedSignature)) {
            Log::warning('Invalid PayMongo signature.');
            abort(403, 'Invalid signature');
        }

        $eventType = $request->input('data.attributes.type');
        $paymentId = $request->input('data.attributes.data.id');

        Log::info("Webhook event: $eventType for payment ID: $paymentId");

        if ($eventType === 'payment.paid') {
            $payment = GCashDonation::where('paymongo_id', $paymentId)->first();

            if ($payment) {
                $payment->status = 'paid';
                $payment->save();
                Log::info("Payment {$payment->id} marked as PAID.");
            } else {
                Log::warning("Payment not found for ID: $paymentId");
            }
        }

        return response()->json(['status' => 'ok']);
    }
}
