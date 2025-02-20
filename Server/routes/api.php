<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/admin/users', [UserController::class, 'getAllUsers'])->middleware(AdminMiddleware::class);
    Route::get('/admin/register-requests', [UserController::class, 'getRegisterRequests'])->middleware(AdminMiddleware::class);
    Route::put('/admin/approve-register/{user}', [UserController::class, 'approveStudentRegistration'])->middleware(AdminMiddleware::class);
    Route::post('/admin/register-coordinator', [UserController::class, 'registerCoordinator'])->middleware(AdminMiddleware::class);
    Route::post('/admin/register-Advisor', [UserController::class, 'registerAdvisor'])->middleware(AdminMiddleware::class);
    Route::delete('/admin/users/{user}', [UserController::class, 'destroy']);
    Route::get('/advisors', [UserController::class, 'getAdvisors']);
});

Route::get('/projects', [ProjectController::class, 'index']);
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/coordinator/projects', [ProjectController::class, 'getProjectCoordinator']);
    Route::get('/coordinator/project-requests', [ProjectController::class, 'getUnassignedProject']);
    Route::get('/coordinator/ongoing-projects', [ProjectController::class, 'getAllOngoingProjects']);
    Route::put('/assign-advisor/{project}', [ProjectController::class, 'assignAdvisor']);
    Route::post('/projects', [ProjectController::class, 'store']);
    Route::put('/projects/{project}', [ProjectController::class, 'update']);

    Route::get('/projects/advisor/{advisor_id}', [ProjectController::class, 'getProjectsByAdvisor']);
    Route::get('/projects/advisor/{advisor_id}/approved', [ProjectController::class, 'getApprovedProjectsbyAdvisor']);
    Route::put('/projects/{project}/approval-status', [ProjectController::class, 'updateApprovalStatus']);
    Route::delete('admin/projects/{project}', [ProjectController::class, 'destroy']);
    Route::post('/projects/{project}/notify-deadline', [ProjectController::class, 'notifyDeadline']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/projects/{project}/comments', [CommentController::class, 'getCommentsByProject']);
    Route::post('/projects/{project}/comments', [CommentController::class, 'addComment']);
});
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
