<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'excerpt',
        'featured_image',
        'published',
        'category',
        'tags',
        'gallery_images',
        'author_id',
    ];

    protected $casts = [
        'tags' => 'array',
        'gallery_images' => 'array',
        'published' => 'boolean',
    ];

    /**
     * Relationship: Post belongs to Author (User)
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
    
    /**
     * Relationship: Post has many likes
     */
    public function likes()
    {
        return $this->hasMany(PostLike::class);
    }
    
    /**
     * Get the total number of likes for this post
     */
    public function getLikesCountAttribute()
    {
        return $this->likes()->where('type', 'like')->count();
    }
    
    /**
     * Get the total number of dislikes for this post
     */
    public function getDislikesCountAttribute()
    {
        return $this->likes()->where('type', 'dislike')->count();
    }
    
    /**
     * Get the net likes (likes minus dislikes) for this post
     */
    public function getNetLikesAttribute()
    {
        return $this->getLikesCountAttribute() - $this->getDislikesCountAttribute();
    }
}
