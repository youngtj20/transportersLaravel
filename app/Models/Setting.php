<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
        'type',
        'group',
    ];

    protected $casts = [
        'value' => 'json', // Allow flexible value storage
        'type' => 'string',
        'group' => 'string',
    ];

    /**
     * Scope to get setting by key
     */
    public function scopeByKey($query, $key)
    {
        return $query->where('key', $key);
    }
}
