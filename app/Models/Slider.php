<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'title_en',
        'title_ar',
        'subtitle_en',
        'subtitle_ar',
        'offer_text',
        'offer_text_en',
        'offer_text_ar',
        'link',
        'status',
        'text_color',
    ];

    protected $appends = ['title', 'subtitle', 'offer_text'];

    public function getTitleAttribute()
    {
        return app()->getLocale() === 'ar' && $this->title_ar ? $this->title_ar : $this->title_en;
    }

    public function getSubtitleAttribute()
    {
        return app()->getLocale() === 'ar' && $this->subtitle_ar ? $this->subtitle_ar : $this->subtitle_en;
    }

    public function getOfferTextAttribute()
    {
        if (app()->getLocale() === 'ar') {
            return $this->offer_text_ar ?: $this->offer_text_en;
        }
        return $this->offer_text_en;
    }
}
