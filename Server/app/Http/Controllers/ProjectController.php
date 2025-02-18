<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();
        return response()->json($projects);
    }


    public function getAllOngoingProjects()
    {
        $projects = Project::where('completed', false)->with('student', 'advisor')->get();
        return response()->json($projects);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $validatedData = $request->validate([
            'project_title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'student_id' => 'required|exists:users,student_id',
            'department' => 'required|string|max:255',
            'document' => 'nullable|string|max:255',
            'due_date' => 'nullable|date',
            'approved' => 'boolean',
        ]);
        $project = Project::create($validatedData);

        return response()->json($project, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return response()->json($project);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $validatedData = $request->validate([
            'project_title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'student_id' => 'required|exists:users,student_id',
            'advisor_id' => 'required|exists:users,id',
            'department' => 'required|string|max:255',
            'document' => 'nullable|string|max:255',
            'due_date' => 'nullable|date',
            'approved' => 'boolean',
        ]);

        $project->update($validatedData);

        return response()->json($project);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return response()->json(['message' => 'Project deleted successfully']);
    }
}
