<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventGallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'event_name',
        'event_date',
        'images',
        'published',
        'created_by',
        'description',
    ];

    protected $casts = [
        'images' => 'array',
        'event_date' => 'date',
        'published' => 'boolean',
    ];

    /**
     * Get properly formatted images with full URLs
     */
    public function getFormattedImagesAttribute()
    {
        $images = $this->images;
        
        if (!is_array($images)) {
            return [];
        }

        return array_map(function ($image) {
            // If it's already a full URL, return as-is
            if (filter_var($image, FILTER_VALIDATE_URL)) {
                return $image;
            }
            
            // If it's a data URL, return as-is
            if (str_starts_with($image, 'data:')) {
                return $image;
            }
            
            // For relative paths, make sure they're properly formatted
            $cleanPath = ltrim(str_replace(['\\', '/'], '/', $image), '/');
            
            // Ensure it starts with 'images/' for consistency
            if (!str_starts_with($cleanPath, 'images/')) {
                $cleanPath = 'images/' . $cleanPath;
            }
            
            // Return the full asset URL
            return asset($cleanPath);
        }, $images);
    }

    /**
     * Relationship: Gallery belongs to creator (User)
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
