<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesVisitRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'email',
        'mobile_number',
        'address',
        'preferred_dates',
        'message',
        'is_read',
    ];

    protected $casts = [
        'preferred_dates' => 'array',
        'is_read' => 'boolean',
    ];
}
