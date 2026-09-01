<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'title_en',
        'title_ar',
        'subtitle_en',
        'subtitle_ar',
        'description_en',
        'description_ar',
        'link',
        'button_text_en',
        'button_text_ar',
        'status',
        'type',
        'discount_amount',
        'discount_text',
    ];

    protected $appends = ['title', 'button_text', 'subtitle', 'description'];

    public function getTitleAttribute()
    {
        return app()->getLocale() === 'ar' && $this->title_ar ? $this->title_ar : $this->title_en;
    }

    public function getButtonTextAttribute()
    {
        return app()->getLocale() === 'ar' && $this->button_text_ar ? $this->button_text_ar : $this->button_text_en;
    }

    public function getSubtitleAttribute()
    {
        return app()->getLocale() === 'ar' && $this->subtitle_ar ? $this->subtitle_ar : $this->subtitle_en;
    }

    public function getDescriptionAttribute()
    {
        return app()->getLocale() === 'ar' && $this->description_ar ? $this->description_ar : $this->description_en;
    }
}
