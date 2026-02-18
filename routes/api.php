<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PagesController;
use App\Http\Controllers\Api\PostsController;
use App\Http\Controllers\Api\EventsController;
use App\Http\Controllers\Api\TeamMembersController;
use App\Http\Controllers\Api\MenuItemsController;
use App\Http\Controllers\Api\SettingsController;
use App\Http\Controllers\Api\MovementMembersController;
use App\Http\Controllers\Api\EventGalleriesController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PostInteractionController;

// Authentication routes
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
Route::middleware('auth:sanctum')->get('/me', [AuthController::class, 'me']);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('pages', PagesController::class);
    Route::apiResource('posts', PostsController::class);
    Route::apiResource('events', EventsController::class);
    Route::apiResource('team-members', TeamMembersController::class);
    Route::apiResource('menu-items', MenuItemsController::class);
    Route::apiResource('settings', SettingsController::class);
    Route::apiResource('movement-members', MovementMembersController::class);
    Route::apiResource('event-galleries', EventGalleriesController::class);
});

// Public routes
Route::get('/pages', [PagesController::class, 'index']);
Route::get('/pages/{id}', [PagesController::class, 'show']);
Route::get('/posts', [PostsController::class, 'index']);
Route::get('/posts/{id}', [PostsController::class, 'show']);

// Test route for debugging
Route::get('/test-posts', function() {
    $posts = \App\Models\Post::with('author')->get();
    return response()->json([
        'total_posts' => $posts->count(),
        'posts' => $posts->toArray(),
        'message' => 'Debug info'
    ]);
});

// Post interaction routes
Route::post('/posts/{id}/like', [PostInteractionController::class, 'toggleLike']);
Route::get('/posts/{id}/like-counts', [PostInteractionController::class, 'getLikeCounts']);
Route::get('/events', [EventsController::class, 'index']);
Route::get('/events/{id}', [EventsController::class, 'show']);
Route::get('/team-members', [TeamMembersController::class, 'index']);
Route::get('/team-members/{id}', [TeamMembersController::class, 'show']);
Route::get('/menu-items', [MenuItemsController::class, 'index']);
Route::get('/menu-items/{id}', [MenuItemsController::class, 'show']);
Route::get('/settings', [SettingsController::class, 'index']);
Route::get('/settings/{id}', [SettingsController::class, 'show']);
Route::get('/movement-members', [MovementMembersController::class, 'index']);
Route::get('/movement-members/{id}', [MovementMembersController::class, 'show']);
Route::get('/event-galleries', [EventGalleriesController::class, 'index']);
Route::get('/event-galleries/{id}', [EventGalleriesController::class, 'show']);