<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\MenuItem;
use App\Models\Page;

class WebsiteController extends Controller
{
    public function home()
    {
        // Get latest published posts (limit to 3 for homepage main section)
        $latestPosts = Post::where('published', true)
            ->with(['author', 'likes'])
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();
            
        // Get more posts for the sticky sidebar
        $sidebarPosts = Post::where('published', true)
            ->with(['author', 'likes'])
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();
            
        // Get menu items for navigation
        $menuItems = MenuItem::where('enabled', true)
            ->orderBy('order')
            ->get();
            
        return view('website.home', compact('latestPosts', 'sidebarPosts', 'menuItems'));
    }
    
    public function about()
    {
        $page = Page::where('slug', 'about')->where('published', true)->first();
        $menuItems = MenuItem::where('enabled', true)->orderBy('order')->get();
        return view('website.about', compact('page', 'menuItems'));
    }
    
    public function vision()
    {
        $page = Page::where('slug', 'vision')->where('published', true)->first();
        $menuItems = MenuItem::where('enabled', true)->orderBy('order')->get();
        return view('website.vision', compact('page', 'menuItems'));
    }
    
    public function mission()
    {
        $page = Page::where('slug', 'mission')->where('published', true)->first();
        $menuItems = MenuItem::where('enabled', true)->orderBy('order')->get();
        return view('website.mission', compact('page', 'menuItems'));
    }
    
    public function events()
    {
        $menuItems = MenuItem::where('enabled', true)->orderBy('order')->get();
        return view('website.events', compact('menuItems'));
    }
    
    public function blog(Request $request)
    {
        $query = Post::where('published', true)->with(['author', 'likes']);
        
        // Filter by category if provided
        if ($request->filled('category')) {
            $query->where('category', $request->input('category'));
        }
        
        // Search functionality
        if ($request->filled('search')) {
            $searchTerm = $request->input('search');
            $query->where(function($q) use ($searchTerm) {
                $q->where('title', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('content', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('excerpt', 'LIKE', "%{$searchTerm}%");
            });
        }
        
        $posts = $query->orderBy('created_at', 'desc')->paginate(6);
        
        $menuItems = MenuItem::where('enabled', true)->orderBy('order')->get();
        return view('website.blog', compact('posts', 'menuItems'));
    }
    
    public function gallery(Request $request)
    {
        $menuItems = MenuItem::where('enabled', true)->orderBy('order')->get();
        
        // Get published event galleries with images
        $query = \App\Models\EventGallery::where('published', true);
        
        // Filter by event name if provided
        if ($request->has('event') && $request->event !== 'all') {
            $query->where('event_name', $request->event);
        }
        
        $eventGalleries = $query->orderBy('event_date', 'desc')->get();
        
        // Get unique event names for filter
        $uniqueEvents = \App\Models\EventGallery::where('published', true)
            ->pluck('event_name')
            ->unique()
            ->filter()
            ->values();
        
        return view('website.gallery', compact('menuItems', 'eventGalleries', 'uniqueEvents'));
    }
    
    public function contact()
    {
        $menuItems = MenuItem::where('enabled', true)->orderBy('order')->get();
        return view('website.contact', compact('menuItems'));
    }
    
    public function showPost($slug)
    {
        $post = Post::where('slug', $slug)
            ->where('published', true)
            ->with(['author', 'likes'])
            ->firstOrFail();
            
        $menuItems = MenuItem::where('enabled', true)->orderBy('order')->get();
        return view('website.post', compact('post', 'menuItems'));
    }
}
