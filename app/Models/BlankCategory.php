<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlankCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_en',
        'name_ar',
        'slug',
        'image',
        'status',
    ];

    protected $appends = ['name'];

    public function getNameAttribute()
    {
        return app()->getLocale() === 'ar' && $this->name_ar ? $this->name_ar : $this->name_en;
    }

    public function blankProducts()
    {
        return $this->hasMany(BlankProduct::class, 'blank_category_id');
    }

    public function blankSubcategories()
    {
        return $this->hasMany(BlankSubCategory::class, 'blank_category_id');
    }
}
