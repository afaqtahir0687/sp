<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $table = 'testimonials';

    protected $fillable = [
        'client_name_en',
        'client_name_ar',
        'client_position_en',
        'client_position_ar',
        'client_company',
        'client_image',
        'review_en',
        'review_ar',
        'rating',
        'status',
        'sort_order',
    ];

    protected $appends = ['client_name', 'client_position', 'review'];

    public function getClientNameAttribute()
    {
        return app()->getLocale() === 'ar' && $this->client_name_ar ? $this->client_name_ar : $this->client_name_en;
    }

    public function getClientPositionAttribute()
    {
        return app()->getLocale() === 'ar' && $this->client_position_ar ? $this->client_position_ar : $this->client_position_en;
    }

    public function getReviewAttribute()
    {
        return app()->getLocale() === 'ar' && $this->review_ar ? $this->review_ar : $this->review_en;
    }
}
