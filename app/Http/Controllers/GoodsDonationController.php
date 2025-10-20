<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GoodsDonation;
use Illuminate\Support\Facades\DB;
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


    /**
     * Retrieve all approved goods donations.
     */
    public function all()
    {
        $donations = GoodsDonation::orderBy('created_at', 'desc')
            ->get();

        return response()->json($donations);
    }

    /**
     * Filter goods donations by year, month, or both.
     * Example: /api/goods-donations/filter?year=2025&month=October
     */
    public function filter(Request $request)
    {
        $year = $request->input('year');
        $month = $request->input('month');

        $query = GoodsDonation::query();

        if ($year) {
            $query->where('year', $year);
        }

        if ($month) {
            $query->where('month', $month);
        }

        $donations = $query->orderBy('created_at', 'desc')->get();

        return response()->json($donations);
    }

    /**
     * Search goods donations by name, email, description, address, month, or year.
     * Example: /api/goods-donations/search?q=bag
     */
    public function search(Request $request)
    {
        $search = $request->input('q');

        if (!$search) {
            return response()->json([], 200);
        }

        $donations = GoodsDonation::where(function ($query) use ($search) {
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%")
                ->orWhere('address', 'like', "%{$search}%")
                ->orWhere('month', 'like', "%{$search}%")
                ->orWhere('year', 'like', "%{$search}%");
        })
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($donations);
    }

    /**
     * Get the number of goods donations per month for a given year.
     * Example: /api/goods-donations/stats?year=2025
     */
    public function stats(Request $request)
    {
        $year = $request->input('year', now()->year); // Default to current year

        $data = GoodsDonation::select('month', DB::raw('COUNT(*) as total'))
            ->where('year', $year)
            ->where('status', 'approved')
            ->groupBy('month')
            ->orderByRaw("STR_TO_DATE(CONCAT('01 ', month, ' {$year}'), '%d %M %Y')")
            ->get();

        // Ensure months appear in order
        $months = [
            'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December'
        ];

        $formatted = collect($months)->map(function ($m) use ($data) {
            $record = $data->firstWhere('month', $m);
            return [
                'month' => $m,
                'total' => $record ? $record->total : 0
            ];
        });

        return response()->json([
            'year' => $year,
            'data' => $formatted
        ]);
    }

    /**
     * Get total count of all approved goods donations.
     */
    public function counts()
    {
        $count = GoodsDonation::where('status', 'approved')->count();

        return response()->json([
            'status' => 'success',
            'total_approved_goods_donations' => $count,
        ]);
    }
}
