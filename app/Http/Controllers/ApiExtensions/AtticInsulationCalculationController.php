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
        $template_rendered = view('api-extensions/attic-insulation-calculation/create', [
            'class' => AtticInsulationCalculation::class,
        ])->render();

        return [
            'template' => $template_rendered,
            'script' => 'aic.js',
        ];
    }

    public function store(Request $request, Order $order)
    {
        $prepared = AtticInsulationCalculation::prepareToSave($request->validated(), $order);
        $stored = AtticInsulationCalculation::create($prepared);

        return [
            'id' => $stored->id ?? null,
            'stored' => is_a($stored, AtticInsulationCalculation::class),
        ];
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
        $stored = AtticInsulationCalculation::whereOrder($order->id)->first();
        $prepared = AtticInsulationCalculation::prepareToSave($request->validated());
        
        return [
            'id' => $stored->id ?? null,
            'updated' => $stored->fill($prepared)->save() === true,
        ];
    }

    public function destroy(Order $order, Request $request = null)
    {
        return AtticInsulationCalculation::whereOrder($order->id)->delete();
    }
}
