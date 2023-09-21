<?php

namespace App\Http\Controllers\ApiExtensions;

use App\Http\Controllers\Controller;
use App\Models\ApiExtensions\BattInsulationCalculation;
use Illuminate\Http\Request;

class BattInsulationCalculationController extends Controller
{
    public function create()
    {
        return view('api-extensions/batt-insulation-calculation/create', [
            'class' => BattInsulationCalculation::class
        ]);
    }
}
