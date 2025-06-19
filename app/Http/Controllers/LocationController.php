<?php

namespace App\Http\Controllers;

use App\Models\Provinces;
use App\Models\Amphures;
use App\Models\Districts;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function getAmphures($province_id)
    {
        $amphures = Amphures::where('province_id', $province_id)->orderBy('name_th')->get();
        return response()->json($amphures);
    }

    public function getDistricts($amphure_id)
    {
        $districts = Districts::where('amphure_id', $amphure_id)->orderBy('name_th')->get();
        return response()->json($districts);
    }

    public function getZipcode($district_id)
    {
        $district = Districts::find($district_id);
        return response()->json(['zip_code' => $district->zip_code ?? '']);
    }
}
