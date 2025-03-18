<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Knowledgebase;

class KnowledgebaseController extends Controller
{
    public function store(Request $request)
    {
        // Validate request data
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        // Save data
        $knowledgebase = Knowledgebase::create([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        // Return response
        return response()->json([
            'message' => 'Knowledgebase entry created successfully',
            'data' => $knowledgebase
        ], 201);
    }

    public function getAll()
    {
        // Fetch all knowledge base entries
        $knowledgebase = Knowledgebase::all();

        // Return the data as JSON response
        return response()->json($knowledgebase);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $knowledgebase = Knowledgebase::find($id);

        if (!$knowledgebase) {
            return response()->json(['error' => 'Knowledgebase entry not found'], 404);
        }

        $knowledgebase->update([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
        ]);

        return response()->json(['message' => 'Knowledgebase updated successfully', 'data' => $knowledgebase]);
    }

    public function destroy($id)
    {
        $knowledgebase = Knowledgebase::find($id);

        if (!$knowledgebase) {
            return response()->json(['error' => 'Knowledgebase entry not found'], 404);
        }

        $knowledgebase->delete();

        return response()->json(['message' => 'Knowledgebase deleted successfully']);
    }

    public function search(Request $request)
    {
        $query = $request->input('search');

        $knowledgebase = Knowledgebase::where('title', 'like', "%{$query}%")
            ->orWhere('content', 'like', "%{$query}%")
            ->get();

        return response()->json($knowledgebase, 200);
    }



}
