<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'event_date',
        'location',
        'featured_image',
        'published',
        'speakers',
        'agenda',
        'author_id',
    ];

    protected $casts = [
        'speakers' => 'array',
        'agenda' => 'array',
        'event_date' => 'datetime',
        'published' => 'boolean',
    ];

    /**
     * Relationship: Event belongs to Author (User)
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
