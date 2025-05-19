<?php

namespace App\Http\Controllers;

use App\Models\Advocacy;
use Illuminate\Http\Request;

class AdvocacyController extends Controller
{
    public function index() {
        $advocacies = Advocacy::all();
        return response()->json($advocacies);
    }
}
