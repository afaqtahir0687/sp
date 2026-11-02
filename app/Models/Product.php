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
        'lamination_price',
        'die_cutting_options',
        'orientations',
        'orientations_ar',
        'folding_options',
        'folding_options_ar',
        'binding_options',
        'binding_options_ar',
        'material_prices',
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

    public function getLocalizedOrientations()
    {
        return app()->getLocale() === 'ar' && $this->orientations_ar ? $this->orientations_ar : $this->orientations;
    }

    public function getLocalizedFoldingOptions()
    {
        return app()->getLocale() === 'ar' && $this->folding_options_ar ? $this->folding_options_ar : $this->folding_options;
    }

    public function getLocalizedBindingOptions()
    {
        return app()->getLocale() === 'ar' && $this->binding_options_ar ? $this->binding_options_ar : $this->binding_options;
    }

    /**
     * Get unit price for a given material.
     * Uses explicit material price if defined in material_prices,
     * otherwise computes realistic weight-based multiplier.
     */
    public function getMaterialRate($materialName)
    {
        $base = (float) $this->price;
        if (empty($materialName)) {
            return $base;
        }

        // Check if custom price configured in material_prices
        if (!empty($this->material_prices) && is_array($this->material_prices)) {
            if (isset($this->material_prices[$materialName]) && is_numeric($this->material_prices[$materialName])) {
                return (float) $this->material_prices[$materialName];
            }
            // Also try trimmed key match
            $trimmedName = trim($materialName);
            foreach ($this->material_prices as $key => $val) {
                if (trim($key) === $trimmedName && is_numeric($val)) {
                    return (float) $val;
                }
            }
        }

        // Automatic fallback scaling by weight/type matching Zeejprint patterns
        $multiplier = 1.0;
        if (preg_match('/(\d+)\s*(gsm|coated|matt|gloss)?/i', $materialName, $matches)) {
            $weight = (int) $matches[1];
            if ($weight <= 200) {
                $multiplier = 0.85;
            } elseif ($weight <= 250) {
                $multiplier = 0.90;
            } elseif ($weight <= 300) {
                $multiplier = 0.95;
            } elseif ($weight <= 350) {
                $multiplier = 1.00; // standard base
            } elseif ($weight >= 400) {
                $multiplier = 1.25;
            }
        } elseif (stripos($materialName, 'invercote') !== false || stripos($materialName, 'ivory') !== false) {
            $multiplier = 1.25;
        } elseif (stripos($materialName, 'conqueror') !== false || stripos($materialName, 'textured') !== false) {
            $multiplier = 1.30;
        }

        return round($base * $multiplier, 2);
    }

    public function getLaminationUnitRate($sides = 2)
    {
        $baseLamination = 0.0;
        if (!empty($this->lamination_price) && $this->lamination_price > 0) {
            $baseLamination = (float) $this->lamination_price;
        } else {
            $baseLamination = round(((float) $this->price) * 0.20, 2);
            if ($baseLamination <= 0) {
                $baseLamination = 0.50;
            }
        }

        if ((int) $sides === 1) {
            return round($baseLamination / 2, 2);
        }

        return $baseLamination;
    }

    public function getAllMaterialRates()
    {
        $rates = [];
        $materials = $this->materials ?? [];
        if (is_array($materials)) {
            foreach ($materials as $mat) {
                $rates[trim($mat)] = $this->getMaterialRate($mat);
            }
        }
        $materialsAr = $this->materials_ar ?? [];
        if (is_array($materialsAr)) {
            foreach ($materialsAr as $idx => $matAr) {
                $enMat = $materials[$idx] ?? $matAr;
                $rates[trim($matAr)] = $this->getMaterialRate($enMat);
            }
        }
        return $rates;
    }


    protected $casts = [
        'images' => 'array',
        'quantities' => 'array',
        'materials' => 'array',
        'materials_ar' => 'array',
        'material_prices' => 'array',
        'sizes' => 'array',
        'sizes_ar' => 'array',
        'side_1_colors' => 'array',
        'side_1_colors_ar' => 'array',
        'sides_options' => 'array',
        'sides_options_ar' => 'array',
        'lamination_types' => 'array',
        'lamination_types_ar' => 'array',
        'lamination_price' => 'decimal:2',
        'die_cutting_options' => 'array',
        'die_cutting_options_ar' => 'array',
        'orientations' => 'array',
        'orientations_ar' => 'array',
        'folding_options' => 'array',
        'folding_options_ar' => 'array',
        'binding_options' => 'array',
        'binding_options_ar' => 'array',
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

    public function hasActiveDiscount()
    {
        if ($this->discount_price > 0) {
            if (is_null($this->discount_end_date)) {
                return true;
            }
            $endDate = \Carbon\Carbon::parse($this->discount_end_date)->endOfDay();
            return $endDate->isFuture() || $endDate->isToday();
        }
        return false;
    }

    public function getOriginalPriceWithTax()
    {
        return (float) ($this->price * 1.15);
    }

    public function getSellingPrice()
    {
        return $this->hasActiveDiscount() ? max(0, $this->price - $this->discount_price) : (float) $this->price;
    }

    public function getFinalPriceWithTax()
    {
        return (float) ($this->getSellingPrice() * 1.15);
    }

    public function getDiscountAmount()
    {
        return $this->hasActiveDiscount() ? (float) $this->discount_price : 0.0;
    }
}
