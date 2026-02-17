<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'meta_title',
        'meta_description',
        'featured_image',
        'published',
        'page_type',
        'template',
        'slides',
        'sections',
        'author_id',
    ];

    protected $casts = [
        'slides' => 'array',
        'sections' => 'array',
        'published' => 'boolean',
    ];

    /**
     * Relationship: Page belongs to Author (User)
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
