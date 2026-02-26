<?php

namespace App\Http\Controllers\Api;

use App\Models\EventGallery;
use App\Http\Requests\EventGalleryRequest;
use App\Http\Resources\EventGalleryResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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
        try {
            // Process images - convert data URLs to actual files
            $processedImages = $this->processImages($request->images);
            
            // For now, allow public creation - in production, you might want to add authentication
            $eventGallery = EventGallery::create([
                'title' => $request->title,
                'event_name' => $request->event_name,
                'event_date' => $request->event_date,
                'description' => $request->description,
                'images' => $processedImages,
                'published' => $request->published ?? false,
                'created_by' => 1, // Default to admin user ID
            ]);

            return $this->success(new EventGalleryResource($eventGallery), 'Event gallery created successfully', 201);
        } catch (\Exception $e) {
            // Handle "MySQL server has gone away" error
            if (strpos($e->getMessage(), 'MySQL server has gone away') !== false) {
                // Reconnect and try again
                \DB::reconnect();
                $processedImages = $this->processImages($request->images);
                $eventGallery = EventGallery::create([
                    'title' => $request->title,
                    'event_name' => $request->event_name,
                    'event_date' => $request->event_date,
                    'description' => $request->description,
                    'images' => $processedImages,
                    'published' => $request->published ?? false,
                    'created_by' => 1,
                ]);
                return $this->success(new EventGalleryResource($eventGallery), 'Event gallery created successfully', 201);
            }
            
            // Re-throw other exceptions
            throw $e;
        }
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
        try {
            // For now, allow public updates - in production, you might want to add authentication
            $eventGallery = EventGallery::find($id);

            if (!$eventGallery) {
                return $this->error('Event gallery not found', 404);
            }

            $eventGallery->update([
                'title' => $request->title,
                'event_name' => $request->event_name,
                'event_date' => $request->event_date,
                'description' => $request->description,
                'images' => $request->images,
                'published' => $request->published,
            ]);

            return $this->success(new EventGalleryResource($eventGallery), 'Event gallery updated successfully');
        } catch (\Exception $e) {
            // Handle "MySQL server has gone away" error
            if (strpos($e->getMessage(), 'MySQL server has gone away') !== false) {
                // Reconnect and try again
                \DB::reconnect();
                $eventGallery = EventGallery::find($id);
                if (!$eventGallery) {
                    return $this->error('Event gallery not found', 404);
                }
                $eventGallery->update([
                    'title' => $request->title,
                    'event_name' => $request->event_name,
                    'event_date' => $request->event_date,
                    'description' => $request->description,
                    'images' => $request->images,
                    'published' => $request->published,
                ]);
                return $this->success(new EventGalleryResource($eventGallery), 'Event gallery updated successfully');
            }
            
            // Re-throw other exceptions
            throw $e;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // For now, allow public deletion - in production, you might want to add authentication
        $eventGallery = EventGallery::find($id);

        if (!$eventGallery) {
            return $this->error('Event gallery not found', 404);
        }

        $eventGallery->delete();

        return $this->success(null, 'Event gallery deleted successfully');
    }

    /**
     * Process images - convert data URLs to actual files
     */
    private function processImages($images)
    {
        if (!is_array($images)) {
            return [];
        }

        $processedImages = [];
        
        foreach ($images as $image) {
            // If it's a data URL, convert it to a file
            if (str_starts_with($image, 'data:image')) {
                $processedImages[] = $this->saveDataUrlImage($image);
            } else {
                // If it's already a path or URL, keep it as is
                $processedImages[] = $image;
            }
        }
        
        return $processedImages;
    }

    /**
     * Save data URL image to file
     */
    private function saveDataUrlImage($dataUrl)
    {
        // Extract the image data
        list($type, $data) = explode(';', $dataUrl);
        list(, $data)      = explode(',', $data);
        $data = base64_decode($data);
        
        // Generate a unique filename
        $extension = str_replace('data:image/', '', $type);
        $filename = 'gallery_' . Str::random(20) . '.' . $extension;
        
        // Save the file
        $path = 'images/' . $filename;
        $fullPath = public_path($path);
        
        // Ensure the images directory exists
        if (!file_exists(dirname($fullPath))) {
            mkdir(dirname($fullPath), 0755, true);
        }
        
        file_put_contents($fullPath, $data);
        
        return $path;
    }
}