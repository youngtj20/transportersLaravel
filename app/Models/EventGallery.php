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
    ];

    protected $casts = [
        'images' => 'array',
        'event_date' => 'date',
        'published' => 'boolean',
    ];

    /**
     * Relationship: Gallery belongs to creator (User)
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
