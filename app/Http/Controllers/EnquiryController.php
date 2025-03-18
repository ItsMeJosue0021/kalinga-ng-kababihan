<?php

namespace App\Http\Controllers;

use App\Models\Enquiry;
use Illuminate\Http\Request;

class EnquiryController extends Controller
{
    // Get all enquiries
    public function index()
    {
        return response()->json(Enquiry::all(), 200);
    }

    // Store a new enquiry
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        $enquiry = Enquiry::create($request->all());

        return response()->json($enquiry, 201);
    }

    // Update an enquiry
    public function update(Request $request, $id)
    {
        $enquiry = Enquiry::findOrFail($id);

        $request->validate([
            'name' => 'string|max:255',
            'email' => 'email|max:255',
            'message' => 'string',
        ]);

        $enquiry->update($request->all());

        return response()->json($enquiry, 200);
    }

    // Delete an enquiry
    public function destroy($id)
    {
        $enquiry = Enquiry::findOrFail($id);
        $enquiry->delete();

        return response()->json(['message' => 'Enquiry deleted successfully'], 200);
    }

    public function search(Request $request)
    {
        $query = $request->input('search');

        $enquiries = Enquiry::where('name', 'LIKE', "%{$query}%")
            ->orWhere('email', 'LIKE', "%{$query}%")
            ->orWhere('message', 'LIKE', "%{$query}%")
            ->get();

        return response()->json($enquiries);
    }

}
