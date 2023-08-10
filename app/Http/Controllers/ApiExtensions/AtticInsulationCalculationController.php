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
        $template_rendered = view('api-extensions/attic-insulation-calculation/edit', [
            'class' => AtticInsulationCalculation::class,
            'data' => AtticInsulationCalculation::where('order_id', $order->id)->first(),
        ])->render();

        return [
            'template' => $template_rendered,
            'script' => 'aic.js',
        ];
    }

    public function update(Request $request, Order $order)
    {
        $prepared = AtticInsulationCalculation::prepareToSave($request->validated());
        
        $record = AtticInsulationCalculation::whereOrder($order->id)->first();
        
        return [
            'id' => $record->id ?? null,
            'updated' => $record->fill($prepared)->save() === true,
        ];
    }

    public function destroy(Request $request, Order $order)
    {
        $record = AtticInsulationCalculation::whereOrder($order->id)->first();

        return [
            'id' => $record->id ?? null,
            'destroyed' => (bool) $record->delete() ?? false
        ];
    }
}
