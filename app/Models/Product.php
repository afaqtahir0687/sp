<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'subcategory_id',
        'name_en',
        'name_ar',
        'slug',
        'sku',
        'short_description_en',
        'short_description_ar',
        'description_en',
        'description_ar',
        'size_guide_en',
        'size_guide_ar',
        'additional_info_en',
        'additional_info_ar',
        'price',
        'discount_price',
        'quantities',
        'allow_custom_quantity',
        'flexible_rate',
        'urgent_rate',
        'delivery_days',
        'production_days',
        'flexible_production_days',
        'urgent_production_days',
        'image',
        'images',
        'materials',
        'sizes',
        'side_1_colors',
        'sides_options',
        'lamination_types',
        'die_cutting_options',
        'is_featured',
        'is_new_arrival',
        'is_wishlist',
        'allow_round_corners',
        'status',
        'discount_end_date',
    ];

    protected $appends = ['name', 'short_description', 'description', 'size_guide', 'additional_info'];

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

    public function getSizeGuideAttribute()
    {
        return app()->getLocale() === 'ar' && $this->size_guide_ar ? $this->size_guide_ar : $this->size_guide_en;
    }

    public function getAdditionalInfoAttribute()
    {
        return app()->getLocale() === 'ar' && $this->additional_info_ar ? $this->additional_info_ar : $this->additional_info_en;
    }

    // Helper methods for localized JSON fields - call these explicitly in frontend
    public function getLocalizedMaterials()
    {
        return app()->getLocale() === 'ar' && $this->materials_ar ? $this->materials_ar : $this->materials;
    }

    public function getLocalizedSizes()
    {
        return app()->getLocale() === 'ar' && $this->sizes_ar ? $this->sizes_ar : $this->sizes;
    }

    public function getLocalizedSide1Colors()
    {
        return app()->getLocale() === 'ar' && $this->side_1_colors_ar ? $this->side_1_colors_ar : $this->side_1_colors;
    }

    public function getLocalizedSidesOptions()
    {
        return app()->getLocale() === 'ar' && $this->sides_options_ar ? $this->sides_options_ar : $this->sides_options;
    }

    public function getLocalizedLaminationTypes()
    {
        return app()->getLocale() === 'ar' && $this->lamination_types_ar ? $this->lamination_types_ar : $this->lamination_types;
    }

    public function getLocalizedDieCuttingOptions()
    {
        return app()->getLocale() === 'ar' && $this->die_cutting_options_ar ? $this->die_cutting_options_ar : $this->die_cutting_options;
    }

    protected $casts = [
        'images' => 'array',
        'quantities' => 'array',
        'materials' => 'array',
        'materials_ar' => 'array',
        'sizes' => 'array',
        'sizes_ar' => 'array',
        'side_1_colors' => 'array',
        'side_1_colors_ar' => 'array',
        'sides_options' => 'array',
        'sides_options_ar' => 'array',
        'lamination_types' => 'array',
        'lamination_types_ar' => 'array',
        'die_cutting_options' => 'array',
        'die_cutting_options_ar' => 'array',
        'is_featured' => 'boolean',
        'is_new_arrival' => 'boolean',
        'allow_custom_quantity' => 'boolean',
        'allow_round_corners' => 'boolean',
        'discount_end_date' => 'date',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class, 'subcategory_id');
    }

    public function getSellingPrice()
    {
        $hasActiveDiscount = false;
        if ($this->discount_price > 0) {
            if (is_null($this->discount_end_date) || \Carbon\Carbon::parse($this->discount_end_date)->isFuture() || \Carbon\Carbon::parse($this->discount_end_date)->isToday()) {
                $hasActiveDiscount = true;
            }
        }
        return $hasActiveDiscount ? ($this->price - $this->discount_price) : $this->price;
    }

    public function getDiscountAmount()
    {
        $hasActiveDiscount = false;
        if ($this->discount_price > 0) {
            if (is_null($this->discount_end_date) || \Carbon\Carbon::parse($this->discount_end_date)->isFuture() || \Carbon\Carbon::parse($this->discount_end_date)->isToday()) {
                $hasActiveDiscount = true;
            }
        }
        return $hasActiveDiscount ? $this->discount_price : 0;
    }
}
