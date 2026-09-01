<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function getStates($countryId)
    {
        $states = \App\Models\State::where('country_id', $countryId)->get();
        return response()->json($states);
    }

    public function getCities($stateId)
    {
        $cities = \App\Models\City::where('state_id', $stateId)->get();
        return response()->json($cities);
    }
}
