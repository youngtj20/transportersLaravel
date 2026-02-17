<?php

namespace App\Http\Controllers\Api;

use App\Models\EventGallery;
use App\Http\Requests\EventGalleryRequest;
use App\Http\Resources\EventGalleryResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventGalleriesController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = EventGallery::with('creator');

        if ($request->has('published')) {
            $query->where('published', $request->published === 'true');
        }

        if ($request->has('event_name')) {
            $query->where('event_name', $request->event_name);
        }

        $eventGalleries = $query->orderBy('updated_at', 'desc')->get();

        return $this->success(EventGalleryResource::collection($eventGalleries));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EventGalleryRequest $request)
    {
        $user = Auth::user();

        if (!$user || !$user->isAdmin()) {
            return $this->error('Unauthorized', 401);
        }

        $eventGallery = EventGallery::create([
            'title' => $request->title,
            'event_name' => $request->event_name,
            'event_date' => $request->event_date,
            'images' => $request->images,
            'published' => $request->published ?? false,
            'created_by' => $user->id,
        ]);

        return $this->success(new EventGalleryResource($eventGallery), 'Event gallery created successfully', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $eventGallery = EventGallery::with('creator')->find($id);

        if (!$eventGallery) {
            return $this->error('Event gallery not found', 404);
        }

        return $this->success(new EventGalleryResource($eventGallery));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EventGalleryRequest $request, $id)
    {
        $user = Auth::user();

        if (!$user || !$user->isAdmin()) {
            return $this->error('Unauthorized', 401);
        }

        $eventGallery = EventGallery::find($id);

        if (!$eventGallery) {
            return $this->error('Event gallery not found', 404);
        }

        $eventGallery->update([
            'title' => $request->title,
            'event_name' => $request->event_name,
            'event_date' => $request->event_date,
            'images' => $request->images,
            'published' => $request->published,
        ]);

        return $this->success(new EventGalleryResource($eventGallery), 'Event gallery updated successfully');
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

        $eventGallery = EventGallery::find($id);

        if (!$eventGallery) {
            return $this->error('Event gallery not found', 404);
        }

        $eventGallery->delete();

        return $this->success(null, 'Event gallery deleted successfully');
    }
}
