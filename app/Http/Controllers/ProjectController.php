<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all()->map(function ($project) {
            return [
                'id' => $project->id,
                'title' => $project->title,
                'date' => $project->date,
                'location' => $project->location,
                'description' => $project->description,
                'tags' => $project->tags ? explode(',', $project->tags) : [],
                'image' => $project->image,
            ];
        });

        return response()->json($projects);
    }

    public function store(Request $request)
    {
        $project = $request->all();

        try {
            $saved = Project::create([
                'title' => $project['title'],
                'date' => $project['date'],
                'location' => $project['location'],
                'description' => $project['description'],
                'tags' => implode(',', $project['tags']),
                'image' => $project['image'],
            ]);

            foreach ($project['tags'] as $tagText) {
                Tag::create([
                    'text' => $tagText,
                    'project_id' => $saved->id,
                ]);
            }

            return response()->json(['message' => 'Projects and tags saved successfully.'], 201);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to save projects.',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function update(Request $request, Project $project)
    {
        $data = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'date' => 'sometimes|required|date',
            'location' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'tags' => 'array',
            'tags.*' => 'string',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('projects', 'public');
        }

        $project->update($data);

        if (isset($data['tags'])) {
            $tagIds = collect($data['tags'])->map(function ($tagText) {
                return Tag::firstOrCreate(['text' => $tagText])->id;
            });
            $project->tags()->sync($tagIds);
        }

        return response()->json($project->load('tags'));
    }

}
