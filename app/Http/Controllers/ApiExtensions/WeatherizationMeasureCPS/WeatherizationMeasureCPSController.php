<?php

namespace App\Http\Controllers\ApiExtensions\WeatherizationMeasureCPS;

use App\Http\Controllers\Controller;
use App\Models\ApiExtensions\WeatherizationMeasureCPS\WeatherizationMeasureCPS;
use App\Models\Extension;
use Illuminate\Http\Request;

class WeatherizationMeasureCPSController extends Controller
{    
    public function show(Request $request, Extension $extension)
    {
        return view('api-extensions.weatherization-measures-cps.show', [
            'extension' => $extension,
            'products' => WeatherizationMeasureCPS::all(),
        ]);
    }

    public function store(Request $request, Extension $extension)
    {
        WeatherizationMeasureCPS::create($request->all());
        return redirect()->route('extensions.show', $extension)->with('success', 'Product added');
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
