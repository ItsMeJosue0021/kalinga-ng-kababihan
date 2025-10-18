<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Services\DonationService;
use App\Http\Controllers\Controller;
use App\Http\Requests\SaveGCashDonationRequest;

class GCashDonationController extends Controller
{
    protected $donationService;

    public function __construct(DonationService $donationService)
    {
        $this->donationService = $donationService;
    }

    public function store(SaveGCashDonationRequest $request)
    {
        try {
            $validated = $request->validated();

            $payment = $this->donationService->processGCashDonation($validated);

            return response()->json($payment, 200);

        } catch (Exception $e) {
            return response()->json([
                'message' => 'GCash donation was unsuccessfully. Please try again.',
            ], 500);
        }
    }

}
