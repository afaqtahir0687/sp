<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    public function switch($currency)
    {
        $validCurrencies = ['USD', 'SAR', 'PKR'];
        
        if (in_array(strtoupper($currency), $validCurrencies)) {
            session()->put('currency', strtoupper($currency));
        }

        return redirect()->back();
    }
}
