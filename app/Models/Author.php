<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $fillable = [
        'name_en',
        'name_ar',
        'slug',
        'bio_en',
        'bio_ar',
        'image',
        'status',
    ];

    public function books()
    {
        return $this->hasMany(Book::class);
    }

    public function getNameAttribute()
    {
        return app()->getLocale() === 'ar' && $this->name_ar ? $this->name_ar : $this->name_en;
    }

    public function getBioAttribute()
    {
        return app()->getLocale() === 'ar' && $this->bio_ar ? $this->bio_ar : $this->bio_en;
    }
}
