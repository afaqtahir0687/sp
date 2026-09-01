<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_en',
        'name_ar',
        'slug',
        'image',
        'home_image',
        'status',
        'banner_image',
        'banner_top_text_en',
        'banner_top_text_ar',
        'banner_discount_text_en',
        'banner_discount_text_ar',
        'banner_bottom_text_en',
        'banner_bottom_text_ar',
        'banner_button_text_en',
        'banner_button_text_ar',
        'banner_button_link',
    ];

    protected $appends = ['name'];

    public function getNameAttribute()
    {
        return app()->getLocale() === 'ar' && $this->name_ar ? $this->name_ar : $this->name_en;
    }

    public function getBannerTopTextAttribute()
    {
        return app()->getLocale() === 'ar' && $this->banner_top_text_ar ? $this->banner_top_text_ar : $this->banner_top_text_en;
    }

    public function getBannerDiscountTextAttribute()
    {
        return app()->getLocale() === 'ar' && $this->banner_discount_text_ar ? $this->banner_discount_text_ar : $this->banner_discount_text_en;
    }

    public function getBannerBottomTextAttribute()
    {
        return app()->getLocale() === 'ar' && $this->banner_bottom_text_ar ? $this->banner_bottom_text_ar : $this->banner_bottom_text_en;
    }

    public function getBannerButtonTextAttribute()
    {
        return app()->getLocale() === 'ar' && $this->banner_button_text_ar ? $this->banner_button_text_ar : $this->banner_button_text_en;
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function subcategories()
    {
        return $this->hasMany(SubCategory::class);
    }

    // Helper method to get all products including from subcategories
    public function getAllProducts()
    {
        $productIds = $this->products()->pluck('id');
        
        // Get products from all subcategories
        foreach ($this->subcategories as $subcategory) {
            $productIds = $productIds->merge($subcategory->products()->pluck('id'));
        }
        
        return Product::whereIn('id', $productIds)->where('status', 'active');
    }

    // Get full category path for breadcrumbs (simply returns itself now as it's top level)
    public function getFullPath()
    {
        return collect([$this]);
    }
}
