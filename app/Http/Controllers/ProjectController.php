<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\User;
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
        $project = Project::with('participants')->findOrFail($id);
        $assignedUserIds = $project->participants->pluck('id');
        $users = User::whereNotIn('id', $assignedUserIds)->get();

        return view('projects.show', compact('project', 'users'));
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

        if ($project->participants()->count() > 0) {
            return redirect()->route('projects.index')->with('error', 'No se puede eliminar el proyecto porque tiene usuarios asociados');
        }

        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Proyecto eliminado correctamente');
    }

    public function addParticipant(Request $request, string $id)
    {
        $project = Project::findOrFail($id);

        $project->participants()->attach(
            $request->input('user_id'),
            [
                'role' => $request->input('role'),
                'contribution_hours' => $request->input('contribution_hours')
            ]
        );

        return redirect()->route('projects.show', $id);
    }

    public function updateParticipant(Request $request, string $id, string $userId)
    {
        $project = Project::findOrFail($id);

        $project->participants()->sync([
            $userId => [
                'role' => $request->input('role'),
                'contribution_hours' => $request->input('contribution_hours')
            ]
        ], false);

        return redirect()->route('projects.show', $id);
    }

    public function removeParticipant(string $id, string $userId)
    {
        $project = Project::findOrFail($id);

        $project->participants()->detach($userId);

        return redirect()->route('projects.show', $id);
    }
}