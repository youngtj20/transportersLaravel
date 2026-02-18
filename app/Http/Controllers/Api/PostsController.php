<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostsController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Post::with('author');

        // Handle search
        if ($request->has('search') && $request->search) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('title', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('content', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('excerpt', 'LIKE', "%{$searchTerm}%");
            });
        }

        // Handle status filter
        if ($request->has('status')) {
            if ($request->status === 'published') {
                $query->where('published', true);
            } elseif ($request->status === 'draft') {
                $query->where('published', false);
            }
        }
        
        // Handle category filter
        if ($request->has('category') && $request->category) {
            $query->where('category', $request->category);
        }
        
        if ($request->has('slug')) {
            $query->where('slug', $request->slug);
        }

        // Paginate results (10 per page)
        $posts = $query->orderBy('created_at', 'desc')->paginate(10);

        // Transform to resource collection
        $postsCollection = PostResource::collection($posts);

        // Return with pagination metadata
        return $this->success([
            'data' => $postsCollection->resolve(),
            'current_page' => $posts->currentPage(),
            'last_page' => $posts->lastPage(),
            'per_page' => $posts->perPage(),
            'total' => $posts->total(),
            'from' => $posts->firstItem(),
            'to' => $posts->lastItem(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        $user = Auth::user();

        if (!$user || !$user->isAdmin()) {
            return $this->error('Unauthorized', 401);
        }

        // Check if slug already exists
        if (Post::where('slug', $request->slug)->exists()) {
            return $this->error('Post with this slug already exists', 400);
        }

        $post = Post::create([
            'title' => $request->title,
            'slug' => $request->slug,
            'content' => $request->content,
            'excerpt' => $request->excerpt,
            'featured_image' => $request->featured_image,
            'published' => $request->published ?? false,
            'category' => $request->category,
            'tags' => $request->tags,
            'gallery_images' => $request->gallery_images,
            'author_id' => $user->id,
        ]);

        return $this->success(new PostResource($post), 'Post created successfully', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $post = Post::with('author')->find($id);

        if (!$post) {
            return $this->error('Post not found', 404);
        }

        return $this->success(new PostResource($post));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, $id)
    {
        $user = Auth::user();

        if (!$user || !$user->isAdmin()) {
            return $this->error('Unauthorized', 401);
        }

        $post = Post::find($id);

        if (!$post) {
            return $this->error('Post not found', 404);
        }

        // Check if slug already exists (excluding current post)
        if ($request->slug !== $post->slug && Post::where('slug', $request->slug)->exists()) {
            return $this->error('Post with this slug already exists', 400);
        }

        $post->update([
            'title' => $request->title,
            'slug' => $request->slug,
            'content' => $request->content,
            'excerpt' => $request->excerpt,
            'featured_image' => $request->featured_image,
            'published' => $request->published,
            'category' => $request->category,
            'tags' => $request->tags,
            'gallery_images' => $request->gallery_images,
        ]);

        return $this->success(new PostResource($post), 'Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = Auth::user();

        if (!$user || !$user->isAdmin()) {
            return $this->error('Unauthorized', 401);
        }

        $post = Post::find($id);

        if (!$post) {
            return $this->error('Post not found', 404);
        }

        $post->delete();

        return $this->success(null, 'Post deleted successfully');
    }
}
