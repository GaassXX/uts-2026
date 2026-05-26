<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::latest()->get();

        return view('projects.index', compact('projects'));
    }

    public function show(Project $project)
    {
        return view('projects.show', compact('project'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'            => 'required|string|max:255',
            'description'      => 'required|string',
            'status'           => 'required|in:planning,in_progress,completed',
            'progress'         => 'required|integer|min:0|max:100',
            'tech_stack'       => 'nullable|array',
            'github_url'       => 'nullable|url',
            'demo_url'         => 'nullable|url',
            'is_final_project' => 'boolean',
        ]);

        Project::create($validated);

        return redirect()->route('projects')->with('success', 'Project berhasil ditambahkan.');
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('projects')->with('success', 'Project berhasil dihapus.');
    }
}
