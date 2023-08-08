<?php

namespace App\Http\Controllers\ApiExtensions;

use App\Http\Controllers\Controller;
use App\Models\ApiExtensions\AtticInsulationCalculation;
use App\Models\Order;
use Illuminate\Http\Request;

class AtticInsulationCalculationController extends Controller
{
    public function create()
    {
        return [
            'template' => view('api-extensions/attic-insulation-calculation/create', [
                'class' => AtticInsulationCalculation::class,
            ])->render(),
            'script' => 'aic.js',
        ];
    }

    public function store(Request $request, Order $order)
    {
        $prepared = AtticInsulationCalculation::prepareToSave($request->validated(), $order);
        $stored = AtticInsulationCalculation::create($prepared);
        return $stored ? $stored->id : false;
    }

    public function edit(Order $order)
    {
        return [
            'template' => view('api-extensions/attic-insulation-calculation/edit', [
                'class' => AtticInsulationCalculation::class,
                'data' => AtticInsulationCalculation::where('order_id', $order->id)->first(),
            ])->render(),
            'script' => 'aic.js',
        ];
    }

    public function update(Request $request, Order $order)
    {
        $prepared = AtticInsulationCalculation::prepareToSave($request->validated());
        $updated = AtticInsulationCalculation::whereOrder($order->id)->update($prepared);
        return $updated ? $order->id : false;
    }

    public function destroy(Request $request, Order $order)
    {

    }
}
