<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\DeadlineNotification; // Create this Mailable
use Carbon\Carbon; // Import Carbon
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $projects = Project::where('completed', true)->with('student', 'advisor')->get();
        return response()->json($projects);
    }

    public function getProjectCoordinator()
    {
        $user = Auth::user();
        $projects = Project::where('department', $user->department)->with('student', 'advisor')->get();
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

    public function getUnassignedProject()
    {
        $projects = Project::where('advisor_id', null)->with('student')->get();
        return response()->json($projects);
    }


    public function getAllOngoingProjects()
    {
        $projects = Project::where('completed', false)
            ->whereNotNull('advisor_id')
            ->with('student', 'advisor')
            ->orderBy('due_date', 'asc')
            ->get();
        return response()->json($projects);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'project_title' => 'required|string|max:255',
            'description' => 'nullable|string',
            // 'student_id' => 'required|exists:users,student_id',
            'department' => 'required|string|max:255',
            'document' => 'nullable|file|mimes:pdf,doc,docx,jpeg,png',
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
        return response()->json($project->load('student', 'advisor'));
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
            'document' => 'nullable|file|mimes:pdf,doc,docx,jpeg,png',
        ]);


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


    public function updateApprovalStatus(Request $request, Project $project)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'approved' => 'required|boolean',
        ]);

        $project->approved = $validatedData['approved'];
        $project->save();

        $message = $project->approved ? 'Project approved successfully' : 'Project declined successfully';
        return response()->json(['message' => $message]);
    }

    /**
     * Get projects assigned to a specific advisor.
     */
    public function getProjectsByAdvisor($advisor_id)
    {
        $projects = Project::where('advisor_id', $advisor_id)->where('approved', false)->with('student')->get();
        return response()->json($projects);
    }
    function getApprovedProjectsbyAdvisor($advisor_id)
    {
        $projects = Project::where('approved', true)->where('advisor_id', $advisor_id)->with('student')->get();
        return response()->json($projects);
    }
    public function assignAdvisor(Request $request, Project $project)
    {
        $validatedData = $request->validate([
            'advisor_id' => 'required|exists:users,id',
            'due_date' => 'required|date',
        ]);

        $project->advisor_id = $validatedData['advisor_id'];
        $project->due_date = $validatedData['due_date'];
        // $project->approved = true;
        $project->save();

        return response()->json(['message' => 'Advisor assigned successfully']);
    }

    public function notifyDeadline(Project $project)
    {
        // Validate that the project exists and the user has permission

        // Get student and advisor emails
        $studentEmail = $project->student->email;
        $advisorEmail = $project->advisor->email;

        // Calculate days left
        $dueDate = Carbon::parse($project->due_date);
        $daysLeft = ceil(now()->diffInDays($dueDate, false));

        // Send email to student
        Mail::to($studentEmail)->send(new DeadlineNotification($project, $daysLeft));

        // Send email to advisor
        Mail::to($advisorEmail)->send(new DeadlineNotification($project, $daysLeft));

        return response()->json(['message' => 'Deadline notification sent successfully']);
    }


    public function getApprovedProjectsByStudent($student_id)
    {
        $projects = Project::where('student_id', $student_id)
            ->with('advisor')
            ->get();
        return response()->json($projects);
    }


    public function updateDocument(Request $request, Project $project)
    {
        // return $request;
        $validatedData = $request->validate([
            'document' => 'required|file|mimes:pdf,doc,docx,jpeg,png,txt,csv,xls,xlsx,ppt,pptx',
        ]);

        if ($request->hasFile('document')) {
            $file = $request->file('document');

            $fileName = Str::slug($project->project_title) . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('documents', $fileName, 'public');
            $validatedData['document'] = $filePath;
        }

        $project->update($validatedData);
        return response()->json(['message' => 'Document updated successfully', 'document' => $filePath]);
    }
}
