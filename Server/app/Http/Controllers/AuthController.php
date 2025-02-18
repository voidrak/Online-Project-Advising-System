<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
            'department' => 'required|string',
            'student_id' => ['nullable', 'string', 'regex:/^wour\/\d{4}\/\d{2}$/', 'unique:users'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $fields = $request->all();
        $fields['password'] = Hash::make($request->password);
        $fields['role'] = 'student';

        // Convert student_id to lowercase
        if (isset($fields['student_id'])) {
            $fields['student_id'] = strtolower($fields['student_id']);
        }

        $user = User::create($fields);
        $token = $user->createToken($request->name);

        return response()->json(['user' => $user, 'token' => $token->plainTextToken], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return [
                'errors' => [
                    'email' => 'Invalid credentials',
                ]
            ];
        }

        $token = $user->createToken($user->name);
        return ['user' => $user, 'token' => $token->plainTextToken];
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return ['message' => 'You are logged out'];
    }
}
