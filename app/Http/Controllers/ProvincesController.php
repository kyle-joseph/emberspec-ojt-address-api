<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Provinces;

class ProvincesController extends Controller
{
    public function getProvincesByRegion(Request $request){
        $region_id = $request->route('region_id');
        $provinces = Provinces::where('region_id', $region_id)->get();
        
        return response()->json([
            'data' => $provinces,
        ]);
    }
}
