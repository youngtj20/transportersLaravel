<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'url',
        'type',
        'parent_id',
        'order',
        'classes',
        'enabled',
    ];

    protected $casts = [
        'classes' => 'array',
        'enabled' => 'boolean',
    ];

    /**
     * Relationship: Menu item belongs to parent
     */
    public function parent()
    {
        return $this->belongsTo(MenuItem::class, 'parent_id');
    }

    /**
     * Relationship: Menu item has children
     */
    public function children()
    {
        return $this->hasMany(MenuItem::class, 'parent_id')->orderBy('order');
    }

    /**
     * Relationship: Self-referencing for building tree
     */
    public function allChildren()
    {
        return $this->children()->with('allChildren');
    }
}
