<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\TicketCommentController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\UserResource;

Route::get('/user', function (Request $request) {
    return new UserResource($request->user());
})->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:6,1');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('/reset-password', [AuthController::class, 'resetPassword']);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('tickets', TicketController::class);

    Route::get('users/admin', [UserController::class, 'indexAdmin']);
    Route::apiResource('users', UserController::class)->only(['index', 'show', 'update', 'destroy']);

    Route::apiResource('categories', CategoryController::class)->except(['create', 'edit']);

    Route::apiResource('tickets.comments', TicketCommentController::class)->shallow()->only(['store', 'update']);
    Route::apiResource('tickets.notes', NoteController::class)->shallow()->only(['store', 'update', 'destroy']);
});