<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovementMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'gender',
        'email',
        'phone_number',
        'state_of_origin',
        'lga',
        'modes_of_transport',
        'approved',
        'approved_at',
    ];

    protected $casts = [
        'modes_of_transport' => 'array',
        'approved' => 'boolean',
        'approved_at' => 'datetime',
    ];
}
