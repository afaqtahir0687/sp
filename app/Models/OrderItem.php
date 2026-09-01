<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id', 'product_id', 'blank_product_id', 'book_id', 'type', 'product_name', 'quantity', 'price', 'total', 'production_days', 'delivery_days', 'options'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function blankProduct()
    {
        return $this->belongsTo(BlankProduct::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
