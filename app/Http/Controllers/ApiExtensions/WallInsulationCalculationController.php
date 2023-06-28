<?php

namespace App\Http\Controllers\ApiExtensions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WallInsulationCalculationController extends Controller
{
    public function create(Request $request)
    {
        return [
            'template' => view('api-extensions/wall-insulation-calculation/create')->render(),
            'script' => null,
        ];
    }
}
