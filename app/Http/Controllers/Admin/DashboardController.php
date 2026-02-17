<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Post;
use App\Models\Event;
use App\Models\TeamMember;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard
     */
    public function index()
    {
        $stats = [
            'pages' => Page::count(),
            'posts' => Post::count(),
            'events' => Event::count(),
            'team_members' => TeamMember::count(),
            'users' => User::count(),
        ];

        $recentPages = Page::with('author')->latest()->take(5)->get();
        $recentPosts = Post::with('author')->latest()->take(5)->get();
        $recentEvents = Event::with('author')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentPages', 'recentPosts', 'recentEvents'));
    }
}
