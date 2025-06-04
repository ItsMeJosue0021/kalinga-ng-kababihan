<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class DonationController extends Controller
{
    public function index()
    {
        $donations = Donation::all();
        return response()->json($donations);
    }

    public function store(Request $request)
    {
        $type = $request->input('type');

        $rules = [
            'type' => 'required|string',
            'name' => 'nullable|string',
            'email' => 'nullable|email',
            'amount' => 'required|numeric',
            'address' => 'required', // for cash donations
        ];

        if ($type === 'gcash') {
            $rules['reference'] = 'required|string';
            $rules['proof'] = 'required|image|max:2048';
        }

        $validated = $request->validate($rules);

        if ($request->hasFile('proof')) {
            $validated['proof'] = $request->file('proof')->store('donations', 'public');
        }

        $rules['year'] = now()->year;
        $rules['month'] = now()->month;

        $donation = Donation::create($validated);

        $adminEmail = 'margeiremulta@gmail.com';
        // $adminEmail = 'joshuasalceda0021@gmail.com';

        // Format values
        $name = $donation->name ?? 'Someone';
        $amount = number_format($donation->amount, 2);

        if ($type === 'gcash') {
            // Email to admin
            Mail::raw("$name has donated ₱$amount through GCash.", function ($msg) use ($adminEmail) {
                $msg->to($adminEmail)->subject('New GCash Donation');
            });

            // Email to donor
            if ($donation->email) {
                Mail::raw("We have received your donation. Thank you and may God bless you.", function ($msg) use ($donation) {
                    $msg->to($donation->email)->subject('Donation Received');
                });
            }

        } elseif ($type === 'cash') {
            // Email to admin
            $address = $donation->address ?? 'office.'; // you can also make this dynamic
            Mail::raw("$name will be donating ₱$amount in cash at your $address.", function ($msg) use ($adminEmail) {
                $msg->to($adminEmail)->subject('Upcoming Cash Donation');
            });

            // Email to donor
            if ($donation->email) {
                Mail::raw("Please proceed to the chosen address to hand in your cash donation. Thank you so much.", function ($msg) use ($donation) {
                    $msg->to($donation->email)->subject('Donation Instructions');
                });
            }
        }

        return response()->json(['message' => 'Donation saved successfully.'], 201);
    }

    public function show($id)
    {
        $donation = Donation::findOrFail($id);
        return response()->json($donation);
    }

    public function destroy($id)
    {
        $donation = Donation::findOrFail($id);
        $donation->delete();
        return response()->json(['message' => 'Donation deleted successfully.']);
    }
}
