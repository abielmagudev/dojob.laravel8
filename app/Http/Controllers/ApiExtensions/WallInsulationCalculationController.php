<?php

namespace App\Http\Controllers\ApiExtensions;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class WallInsulationCalculationController extends Controller
{
    public function create()
    {
        return view('api-extensions/wall-insulation-calculation/create');
    }

    public function store(Request $request, Order $order)
    {
        return [
            'id' => null,
            'stored' => false,
        ];
    }

    public function destroy(Order $order, Request $request = null)
    {
        return;
    }
}
