<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with('user')->get();
        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $project = new Project();

        $project->user_id = Auth::id();
        $project->title = $request->input('title');
        $project->description = $request->input('description');
        $project->due_date = $request->input('due_date');
        $project->status = $request->input('status');

        $project->save();

        return redirect()->route('projects.index');
    }

    public function show(string $id)
    {
        $project = Project::findOrFail($id);
        return view('projects.show', compact('project'));
    }

    public function edit(string $id)
    {
        $project = Project::findOrFail($id);
        return view('projects.edit', compact('project'));
    }

    public function update(Request $request, string $id)
    {
        $project = Project::findOrFail($id);

        $project->title = $request->input('title');
        $project->description = $request->input('description');
        $project->due_date = $request->input('due_date');
        $project->status = $request->input('status');

        $project->save();

        return redirect()->route('projects.show', $project->id);
    }

    public function destroy(string $id)
    {
        $project = Project::findOrFail($id);
        $project->delete();
        return redirect()->route('projects.index');
    }
}