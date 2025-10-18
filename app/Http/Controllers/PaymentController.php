<?php

namespace App\Http\Controllers;

use App\Services\PayMongoService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    protected $paymongo;

    public function __construct(PayMongoService $paymongo)
    {
        $this->paymongo = $paymongo;
    }

    public function createGCashPayment(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
        ]);

        $payment = $this->paymongo->createGCashSource(
            $request->amount,
            url('http://localhost:5173/donate/success'),
            url('http://localhost:5173/donate/failed')
        );

        return response()->json($payment);
    }
}
