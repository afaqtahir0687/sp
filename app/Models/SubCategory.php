<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name_en',
        'name_ar',
        'slug',
        'image',
        'banner_image',
        'status',
        'banner_title_en',
        'banner_title_ar',
        'banner_button_text_en',
        'banner_button_text_ar',
        'banner_button_link',
        'banner_text_color',
    ];

    protected $appends = ['name', 'banner_title', 'banner_button_text'];

    public function getNameAttribute()
    {
        return app()->getLocale() === 'ar' && $this->name_ar ? $this->name_ar : $this->name_en;
    }

    public function getBannerTitleAttribute()
    {
        return app()->getLocale() === 'ar' && $this->banner_title_ar ? $this->banner_title_ar : $this->banner_title_en;
    }

    public function getBannerButtonTextAttribute()
    {
        return app()->getLocale() === 'ar' && $this->banner_button_text_ar ? $this->banner_button_text_ar : $this->banner_button_text_en;
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'subcategory_id');
    }

    public function subcategories()
    {
        return $this->hasMany(SubCategory::class, 'category_id')->where('id', null);
    }

    public function getAllProducts()
    {
        return $this->products()->where('status', 'active');
    }

    public function getFullPath()
    {
        return collect([$this->category, $this]);
    }
}