<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'position',
        'bio',
        'image',
        'email',
        'phone',
        'social_links',
        'order',
        'published',
    ];

    protected $casts = [
        'social_links' => 'array',
        'published' => 'boolean',
    ];
}
