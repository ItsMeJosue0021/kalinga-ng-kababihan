<?php

namespace App\Services;

use App\Models\CashDonation;
use App\Models\GCashDonation;
use Illuminate\Support\Facades\Mail;

class DonationService
{
    public function processCashDonation(array $data)
    {
        $adminEmail = 'margeiremulta@gmail.com';
        $donation = CashDonation::create($data);

        if ($donation) {
            $address = $donation->drop_off_address ?? 'office.';
            $name = $donation->name ?? 'Someone';
            $amount = number_format($donation->amount, 2);

            Mail::raw(
                "$name will be donating ₱$amount in cash at your $address on $donation->drop_off_date at $donation->drop_off_time.",
                function ($msg) use ($adminEmail) {
                    $msg->to($adminEmail)->subject('Upcoming Cash Donation');
                }
            );

            $address = '';
            switch ($donation->drop_off_address) {
                case "Main Address":
                    $address = "B4 Lot 6-6 Fantasy Road 3, Teresa Park Subd., Pilar, Las Piñas City";
                    break;
                case "Satellite Address":
                    $address = "Block 20 Lot 15-A Mines View, Teresa Park Subd., Pilar, Las Piñas City";
                    break;
                default:
                    $address = $donation->drop_off_address ?? 'office.';
                    break;
            }

            if ($donation->email) {
                Mail::raw(
                    "Please proceed to $address to hand in your cash donation on $donation->drop_off_date at $donation->drop_off_time. Thank you so much.",
                    function ($msg) use ($donation) {
                        $msg->to($donation->email)->subject('Donation Instructions');
                    }
                );
            }
        }

        return $donation;
    }

    public function processGCashDonation(array $data)
    {
        $adminEmail = 'margeiremulta@gmail.com';

        $donation = GCashDonation::create($data);

        $name = $donation->name ?? 'Someone';
        $amount = number_format($donation->amount, 2);

        if ($donation) {
            Mail::raw(
                "$name has donated ₱$amount through GCash with donation tracking number $donation->donation_tracking_number.",
                function ($msg) use ($adminEmail) {
                    $msg->to($adminEmail)->subject('New GCash Donation');
                }
            );

            if ($donation->email) {
                Mail::raw(
                    "We have received your GCash donation. Thank you and may God bless you! ",
                    function ($msg) use ($donation) {
                        $msg->to($donation->email)->subject('GCash Donation Received');
                    }
                );
            }
        }

        return $donation;
    }

    public function confirmCashDonation($id)
    {
        try {
            $donation = CashDonation::findOrFail($id);
            if (!$donation) {
                return null;
            }

            $donation->status = 'confirmed';
            $donation->save();

            $adminEmail = 'margeiremulta@gmail.com';
            Mail::raw(
                "The cash donation with tracking number $donation->donation_tracking_number has been received.",
                function ($msg) use ($adminEmail) {
                    $msg->to($adminEmail)->subject('Cash Donation Received');
                }
            );

            if ($donation->email) {
                Mail::raw(
                    "We have received your cash donation. Thank you and may God bless you!",
                    function ($msg) use ($donation) {
                        $msg->to($donation->email)->subject('Donation Received');
                    }
                );
            }

            return true;
        } catch (\Exception $e) {
            return false;
        }


    }
}

