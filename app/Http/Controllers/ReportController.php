<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Donation;
use Illuminate\Http\Request;
use App\Models\GoodsDonation;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    public function CashDonations (Request $request) {
       $query = Donation::query();

        if ($request->has(['dateFrom', 'dateTo'])) {
            $from = $request->input('dateFrom');
            $to = $request->input('dateTo');

            $query->whereBetween(DB::raw('DATE(created_at)'), [$from, $to]);
        }

        $donations = $query->get();

        return response()->json($donations);
    }

    public function GoodsDonations (Request $request) {
       $query = GoodsDonation::query();

        if ($request->has(['dateFrom', 'dateTo'])) {
            $from = $request->input('dateFrom');
            $to = $request->input('dateTo');

            $query->whereBetween(DB::raw('DATE(created_at)'), [$from, $to]);
        }

        $donations = $query->latest()->get();

        return response()->json($donations);
    }
}
