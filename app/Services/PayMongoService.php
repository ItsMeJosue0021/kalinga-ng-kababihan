<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class PayMongoService
{
    protected $secretKey;

    public function __construct()
    {
        $this->secretKey = config('services.paymongo.secret');
    }

    public function createGCashSource($amount, $successUrl, $failedUrl)
    {
        $response = Http::withBasicAuth($this->secretKey, '')
            ->post('https://api.paymongo.com/v1/sources', [
                'data' => [
                    'attributes' => [
                        'amount' => $amount * 100, // PayMongo expects cents
                        'currency' => 'PHP',
                        'type' => 'gcash',
                        'redirect' => [
                            'success' => $successUrl,
                            'failed' => $failedUrl,
                        ],
                    ],
                ],
            ]);

        return $response->json();
    }
}
