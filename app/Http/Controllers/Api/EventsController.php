<?php

namespace App\Http\Controllers\Api;

use App\Models\Event;
use App\Http\Requests\EventRequest;
use App\Http\Resources\EventResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventsController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Event::with('author');

        if ($request->has('published')) {
            $query->where('published', $request->published === 'true');
        }

        $events = $query->orderBy('updated_at', 'desc')->get();

        return $this->success(EventResource::collection($events));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EventRequest $request)
    {
        $user = Auth::user();

        if (!$user || !$user->isAdmin()) {
            return $this->error('Unauthorized', 401);
        }

        // Check if slug already exists
        if (Event::where('slug', $request->slug)->exists()) {
            return $this->error('Event with this slug already exists', 400);
        }

        $event = Event::create([
            'title' => $request->title,
            'slug' => $request->slug,
            'description' => $request->description,
            'event_date' => $request->event_date,
            'location' => $request->location,
            'featured_image' => $request->featured_image,
            'published' => $request->published ?? false,
            'speakers' => $request->speakers,
            'agenda' => $request->agenda,
            'author_id' => $user->id,
        ]);

        return $this->success(new EventResource($event), 'Event created successfully', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $event = Event::with('author')->find($id);

        if (!$event) {
            return $this->error('Event not found', 404);
        }

        return $this->success(new EventResource($event));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EventRequest $request, $id)
    {
        $user = Auth::user();

        if (!$user || !$user->isAdmin()) {
            return $this->error('Unauthorized', 401);
        }

        $event = Event::find($id);

        if (!$event) {
            return $this->error('Event not found', 404);
        }

        // Check if slug already exists (excluding current event)
        if ($request->slug !== $event->slug && Event::where('slug', $request->slug)->exists()) {
            return $this->error('Event with this slug already exists', 400);
        }

        $event->update([
            'title' => $request->title,
            'slug' => $request->slug,
            'description' => $request->description,
            'event_date' => $request->event_date,
            'location' => $request->location,
            'featured_image' => $request->featured_image,
            'published' => $request->published,
            'speakers' => $request->speakers,
            'agenda' => $request->agenda,
        ]);

        return $this->success(new EventResource($event), 'Event updated successfully');
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

        $event = Event::find($id);

        if (!$event) {
            return $this->error('Event not found', 404);
        }

        $event->delete();

        return $this->success(null, 'Event deleted successfully');
    }
}
