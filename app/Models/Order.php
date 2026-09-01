<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'order_number', 'first_name', 'last_name', 'company_name',
        'country_id', 'state_id', 'city_id', 'address', 'zip_code', 'phone',
        'email', 'notes', 'subtotal', 'discount', 'tax', 'shipping', 'grand_total',
        'payment_method', 'payment_status', 'order_status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
