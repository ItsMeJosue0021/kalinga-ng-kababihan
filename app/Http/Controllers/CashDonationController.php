<?php

namespace App\Http\Controllers;

use App\Services\DonationService;
use App\Http\Controllers\Controller;
use App\Http\Requests\SaveCashDonationRequest;
use Exception;

class CashDonationController extends Controller
{
    protected $donationService;

    public function __construct(DonationService $donationService)
    {
        $this->donationService = $donationService;
    }

    public function store(SaveCashDonationRequest $request)
    {
        try {
            $validated = $request->validated();

            $donation = $this->donationService->processCashDonation($validated);

            return response()->json([
                'donation' => $donation,
                'message' => 'Cash donation recorded successfully',
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Cash donation was unuccessfully. Please try again.',
            ], 500);
        }
    }

    public function confirmCashDonation($id)
    {
        $success = $this->donationService->confirmCashDonation($id);

        if ($success) {
            return response()->json([
                'message' => 'Cash donation status updated successfully',
            ], 200);
        } else {
                return response()->json([
                'message' => 'Failed to update cash donation status. Please try again.',
            ], 500);
        }
    }
}
