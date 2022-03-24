<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Municipalities;
use App\Http\Resources\MunicipalitiesResource;

class MunicipalitiesController extends Controller
{
    public function getMunicipalities(Request $request){
        return new MunicipalitiesResource(Municipalities::all());
    }

    public function getMunicipalitiesByProvince(Request $request){
        $province_id = $request->route('province_id');
        $municipalities = Municipalities::where('province_id', $province_id)->get();
        
        return new MunicipalitiesResource($municipalities);
    }

    public function addMunicipality(Request $request){
        if(!empty($request->input('data'))){
            $data = $request->input('data');
            $new_municipality = Municipalities::create([
                'region_id' => $data['region_id'],
                'province_id' => $data['province_id'],
                'municipality_id' => $data['municipality_id'],
                'name' => $data['name'],
            ]);

            return $new_municipality;
        }
        
        return response(['message' => 'No data provided.'], 204);
    }

    public function updateMunicipality(Request $request){
        $municipality_id = $request->route('municipality_id');

        if(!empty($request->input('data'))){
            $data = $request->input('data');
            $updated_municipality = Municipalities::where('municipality_id', $municipality_id)
            ->update([
                'region_id' => $data['region_id'],
                'province_id' => $data['province_id'],
                'municipality_id' => $municipality_id,
                'name' => $data['name'],
            ]);

            return $updated_municipality;
        }

        return response(['message' => 'No data provided.'], 204);
    }
}
