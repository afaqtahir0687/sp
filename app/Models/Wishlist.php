<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    protected $fillable = ['user_id', 'product_id', 'blank_product_id', 'type'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function blankProduct()
    {
        return $this->belongsTo(BlankProduct::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
