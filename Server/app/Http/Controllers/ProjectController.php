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

    /**
     * Get project requests (projects with approved = false).
     */
    public function getProjectRequests()
    {
        $projects = Project::where('approved', false)->with('student')->get();
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
            // 'student_id' => 'required|exists:users,student_id',
            'department' => 'required|string|max:255',
            'document' => 'nullable|file|mimes:pdf,doc,docx,jpeg,png|max:6048',
        ]);

        if ($request->hasFile('document')) {
            $path = $request->file('document')->store('documents', 'public');
            $validatedData['document'] = $path;
        }


        return $request->user()->projects()->create($validatedData);
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
            'document' => 'nullable|file|mimes:pdf,doc,docx,jpeg,png|max:2048',
            'due_date' => 'nullable|date',
            'approved' => 'boolean',
            'completed' => 'boolean',
        ]);

        $validatedData['approved'] = filter_var($validatedData['approved'], FILTER_VALIDATE_BOOLEAN);
        $validatedData['completed'] = filter_var($validatedData['completed'], FILTER_VALIDATE_BOOLEAN);

        if ($request->hasFile('document')) {
            $path = $request->file('document')->store('documents', 'public');
            $validatedData['document'] = $path;
        }

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

    public function approveProject(Request $request, Project $project)
    {
        $validatedData = $request->validate([
            'advisor_id' => 'required|exists:users,id',
            'due_date' => 'required|date',
        ]);

        $project->advisor_id = $validatedData['advisor_id'];
        $project->due_date = $validatedData['due_date'];
        $project->approved = true;
        $project->save();

        return response()->json(['message' => 'Project approved successfully']);
    }
}
