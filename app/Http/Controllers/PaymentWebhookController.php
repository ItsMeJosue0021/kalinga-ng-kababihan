<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GCashDonation;

class PaymentWebhookController extends Controller
{
    public function handle(Request $request)
    {
        $signature = $request->header('Paymongo-Signature');
        $payload = $request->getContent();
        $computedSignature = hash_hmac('sha256', $payload, env('PAYMONGO_WEBHOOK_SECRET'));

        if (!hash_equals($signature, $computedSignature)) {
            abort(403, 'Invalid signature');
        }

        $event = $request->input('data.attributes');

        $type = $request->input('type');

        if ($type === 'payment.paid') {
            $paymentId = $request->input('data.id');

            $payment = GCashDonation::where('paymongo_id', $paymentId)->first();
            if ($payment) {
                $payment->status = 'paid';
                $payment->save();
            }
        }

        return response()->json(['status' => 'ok']);
    }
}
