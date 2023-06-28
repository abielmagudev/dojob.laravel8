<?php

namespace App\Http\Controllers\ApiExtensions;

use App\Http\Controllers\Controller;
use App\Models\ApiExtensions\AtticInsulationCalculation;
use Illuminate\Http\Request;

class AtticInsulationCalculationController extends Controller
{
    public function create(Request $request)
    {
        return [
            'template' => view('api-extensions/attic-insulation-calculation/create', [
                'atticInsulationCalculation' => AtticInsulationCalculation::class,
            ])->render(),
            'script' => 'aic.js',
        ];
    }
}
