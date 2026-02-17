<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\WebsiteController;

// Admin Authentication Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Admin Protected Routes
Route::prefix('admin')->middleware(['auth', \App\Http\Middleware\AdminAuth::class])->name('admin.')->group(function () {
    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    })->name('index');
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Pages Management
    Route::get('/pages', function () {
        return view('admin.pages.index');
    })->name('pages.index');
    
    Route::get('/pages/create', function () {
        return view('admin.pages.create');
    })->name('pages.create');
    
    Route::get('/pages/{id}/edit', function ($id) {
        return view('admin.pages.edit', compact('id'));
    })->name('pages.edit');
    
    // Posts Management
    Route::get('/posts', function () {
        return view('admin.posts.index');
    })->name('posts.index');
    
    Route::get('/posts/create', function () {
        return view('admin.posts.create');
    })->name('posts.create');
    
    Route::get('/posts/{id}/edit', function ($id) {
        return view('admin.posts.edit', compact('id'));
    })->name('posts.edit');
    
    // Events Management
    Route::get('/events', function () {
        return view('admin.events.index');
    })->name('events.index');
    
    Route::get('/events/create', function () {
        return view('admin.events.create');
    })->name('events.create');
    
    Route::get('/events/{id}/edit', function ($id) {
        return view('admin.events.edit', compact('id'));
    })->name('events.edit');
    
    // Team Members Management
    Route::get('/team-members', function () {
        return view('admin.team-members.index');
    })->name('team-members.index');
    
    Route::get('/team-members/create', function () {
        return view('admin.team-members.create');
    })->name('team-members.create');
    
    Route::get('/team-members/{id}/edit', function ($id) {
        return view('admin.team-members.edit', compact('id'));
    })->name('team-members.edit');
    
    // Menu Items Management
    Route::get('/menu-items', function () {
        return view('admin.menu-items.index');
    })->name('menu-items.index');
    
    Route::get('/menu-items/create', function () {
        return view('admin.menu-items.create');
    })->name('menu-items.create');
    
    Route::get('/menu-items/{id}/edit', function ($id) {
        return view('admin.menu-items.edit', compact('id'));
    })->name('menu-items.edit');
    
    // Settings Management
    Route::get('/settings', function () {
        return view('admin.settings.index');
    })->name('settings.index');
    
    // Gallery Management
    Route::get('/gallery', function () {
        return view('admin.gallery.index');
    })->name('gallery.index');
    
    Route::get('/gallery/create', function () {
        return view('admin.gallery.create');
    })->name('gallery.create');
    
    Route::get('/gallery/{id}/edit', function ($id) {
        return view('admin.gallery.edit', compact('id'));
    })->name('gallery.edit');
});

// Public routes
Route::get('/', [WebsiteController::class, 'home'])->name('home');
Route::get('/about', [WebsiteController::class, 'about'])->name('about');
Route::get('/vision', [WebsiteController::class, 'vision'])->name('vision');
Route::get('/mission', [WebsiteController::class, 'mission'])->name('mission');
Route::get('/events', [WebsiteController::class, 'events'])->name('events');
Route::get('/blog', [WebsiteController::class, 'blog'])->name('blog');
Route::get('/blog/{slug}', [WebsiteController::class, 'showPost'])->name('blog.show');
Route::get('/gallery', [WebsiteController::class, 'gallery'])->name('gallery');
Route::get('/contact', [WebsiteController::class, 'contact'])->name('contact');

// Global login route that redirects to admin login
Route::get('/login', function () {
    return redirect()->route('admin.login');
})->name('login');

// Temporary test route
Route::get('/test-admin', function () {
    return response()->json([
        'message' => 'Admin routes test',
        'routes' => [
            'admin.login' => route('admin.login'),
            'admin.dashboard' => route('admin.dashboard'),
            'admin.index' => route('admin.index'),
        ],
        'auth' => auth()->check() ? 'logged in' : 'not logged in',
        'user' => auth()->check() ? auth()->user()->toArray() : null
    ]);
});