<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GoodsDonation;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class GoodsDonationController extends Controller
{
    // public function index()
    // {
    //     $donations = GoodsDonation::all();
    //     return response()->json($donations);
    // }

    public function index(Request $request)
    {
        $query = GoodsDonation::query();

        // if ($request->has('name')) {
        //     $query->where('name', 'like', '%' . $request->input('name') . '%');
        // }

        if ($request->has('name')) {
            $search = $request->input('name');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('type', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('address', 'like', '%' . $search . '%');
            });
        }

        if ($request->has('month')) {
            $query->where('month', $request->input('month'));
        }

        if ($request->has('year')) {
            $query->where('year', $request->input('year'));
        }

        $donations = $query->latest()->get();

        return response()->json($donations);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|array',
            'description' => 'required|string',
            'address' => 'required|string',
            'name' => 'nullable|string',
            'email' => 'nullable|email',
        ]);

        $validated['year'] = now()->year;
        $validated['month'] = now()->format('F');

        $donation = GoodsDonation::create($validated);

        $types = implode(', ', $donation->type);

        $email = 'margeiremulta@gmail.com';
        // $email = 'joshuasalceda0021@gmail.com';

        // Email to admin
        $donorName = $donation->name ?? 'Someone';
        Mail::raw(
            "{$donorName} will be donating {$types} at your {$donation->address}.",
            function ($message) use ($email) {
                $message->to($email)->subject('New Goods Donation');
            }
        );

        // Email to donor
        if ($donation->email) {
            Mail::raw(
                'Please proceed to the chosen address to hand in your donations. Thank you so much, and may God bless you!',
                function ($message) use ($donation) {
                    $message->to($donation->email)->subject('Thank you for your donation!');
                }
            );
        }

        return response()->json([
            'message' => 'Donation successfully recorded.',
            'data' => $donation
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $donation = GoodsDonation::findOrFail($id);

        $validated = $request->validate([
            'type' => 'required|array',
            'description' => 'required|string',
            'name' => 'nullable|string',
            'email' => 'nullable|email',
        ]);

        $donation->update($validated);

        return response()->json([
            'message' => 'Donation updated successfully.',
            'data' => $donation
        ]);

    }

    public function show($id)
    {
        $donation = GoodsDonation::findOrFail($id);
        return response()->json($donation);
    }

    public function destroy($id)
    {
        $donation = GoodsDonation::findOrFail($id);
        $donation->delete();
        return response()->json(['message' => 'Donation deleted successfully.']);
    }
}
