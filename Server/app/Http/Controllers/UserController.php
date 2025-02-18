<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function getRegisterRequests()
    {
        $registerRequests = User::where('approved', false)->get();

        return response()->json($registerRequests);
    }

    public function approveStudentRegistration(User $user)
    {
        if ($user->role !== 'student') {
            return response()->json(['message' => 'User is not a student'], 400);
        }

        $user->approved = true;
        $user->save();

        return response()->json(['message' => 'Student registration approved successfully']);
    }

    public function getAdvisors()
    {
        $advisors = User::where('role', 'advisor')->get();
        return response()->json($advisors);
    }

}
