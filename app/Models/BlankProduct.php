<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlankProduct extends Model
{
    protected $fillable = [
        'name_en',
        'name_ar',
        'slug',
        'sku',
        'short_description_en',
        'short_description_ar',
        'description_en',
        'description_ar',
        'price',
        'discount_price',
        'sizes',
        'size_prices',
        'colors',
        'image',
        'images',
        'stock',
        'is_featured',
        'is_new_arrival',
        'status',
        'blank_category_id',
        'blank_subcategory_id',
    ];

    public function blankCategory()
    {
        return $this->belongsTo(BlankCategory::class, 'blank_category_id');
    }

    public function blankSubcategory()
    {
        return $this->belongsTo(BlankSubCategory::class, 'blank_subcategory_id');
    }

    protected $appends = ['name', 'short_description', 'description'];

    public function getNameAttribute()
    {
        return app()->getLocale() === 'ar' && $this->name_ar ? $this->name_ar : $this->name_en;
    }

    public function getShortDescriptionAttribute()
    {
        return app()->getLocale() === 'ar' && $this->short_description_ar ? $this->short_description_ar : $this->short_description_en;
    }

    public function getDescriptionAttribute()
    {
        return app()->getLocale() === 'ar' && $this->description_ar ? $this->description_ar : $this->description_en;
    }

    protected $casts = [
        'sizes' => 'array',
        'size_prices' => 'array',
        'colors' => 'array',
        'images' => 'array',
        'is_featured' => 'boolean',
        'is_new_arrival' => 'boolean',
    ];
}
