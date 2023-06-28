<?php

namespace App\Http\Controllers\ApiExtensions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BattInsulationCalculationController extends Controller
{
    public function create(Request $request)
    {
        return [
            'template' => view('api-extensions/batt-insulation-calculation/create')->render(),
            'script' => null,
        ];
    }
}
