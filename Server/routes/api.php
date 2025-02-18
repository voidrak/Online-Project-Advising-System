<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
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
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/advisors', [UserController::class, 'getAdvisors']);
    Route::get('/projects', [ProjectController::class, 'index']);
    Route::get('/admin/ongoing-projects', [ProjectController::class, 'getAllOngoingProjects']);
    Route::post('/projects', [ProjectController::class, 'store']);
    Route::get('/projects/{project}', [ProjectController::class, 'show']);
    Route::put('/projects/{project}', [ProjectController::class, 'update']);
    Route::delete('admin/projects/{project}', [ProjectController::class, 'destroy'])->middleware(AdminMiddleware::class);
});








Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
