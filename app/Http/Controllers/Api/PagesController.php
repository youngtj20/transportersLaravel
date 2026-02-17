<?php

namespace App\Http\Controllers\Api;

use App\Models\Page;
use App\Http\Requests\PageRequest;
use App\Http\Resources\PageResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PagesController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Page::with('author');

        if ($request->has('published')) {
            $query->where('published', $request->published === 'true');
        }

        $pages = $query->orderBy('updated_at', 'desc')->get();

        return $this->success(PageResource::collection($pages));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PageRequest $request)
    {
        $user = Auth::user();

        if (!$user || !$user->isAdmin()) {
            return $this->error('Unauthorized', 401);
        }

        // Check if slug already exists
        if (Page::where('slug', $request->slug)->exists()) {
            return $this->error('Page with this slug already exists', 400);
        }

        $page = Page::create([
            'title' => $request->title,
            'slug' => $request->slug,
            'content' => $request->content,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'featured_image' => $request->featured_image,
            'published' => $request->published ?? false,
            'page_type' => $request->page_type ?? 'static',
            'template' => $request->template ?? 'default',
            'slides' => $request->slides,
            'sections' => $request->sections,
            'author_id' => $user->id,
        ]);

        return $this->success(new PageResource($page), 'Page created successfully', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $page = Page::with('author')->find($id);

        if (!$page) {
            return $this->error('Page not found', 404);
        }

        return $this->success(new PageResource($page));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PageRequest $request, $id)
    {
        $user = Auth::user();

        if (!$user || !$user->isAdmin()) {
            return $this->error('Unauthorized', 401);
        }

        $page = Page::find($id);

        if (!$page) {
            return $this->error('Page not found', 404);
        }

        // Check if slug already exists (excluding current page)
        if ($request->slug !== $page->slug && Page::where('slug', $request->slug)->exists()) {
            return $this->error('Page with this slug already exists', 400);
        }

        $page->update([
            'title' => $request->title,
            'slug' => $request->slug,
            'content' => $request->content,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'featured_image' => $request->featured_image,
            'published' => $request->published,
            'page_type' => $request->page_type,
            'template' => $request->template,
            'slides' => $request->slides,
            'sections' => $request->sections,
        ]);

        return $this->success(new PageResource($page), 'Page updated successfully');
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

        $page = Page::find($id);

        if (!$page) {
            return $this->error('Page not found', 404);
        }

        $page->delete();

        return $this->success(null, 'Page deleted successfully');
    }
}
