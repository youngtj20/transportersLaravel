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

        if ($request->has('published')) {
            $query->where('published', $request->published === 'true');
        }
        
        if ($request->has('category')) {
            $query->where('category', $request->category);
        }
        
        if ($request->has('slug')) {
            $query->where('slug', $request->slug);
        }

        $posts = $query->orderBy('updated_at', 'desc')->get();

        return $this->success(PostResource::collection($posts));
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
