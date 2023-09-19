<?php

namespace App\Http\Controllers\ApiExtensions;

use App\Http\Controllers\ApiExtensions\Kernel\HasScriptResourceTrait;
use App\Http\Controllers\Controller;
use App\Models\ApiExtensions\AtticInsulationCalculation;
use App\Models\Order;
use Illuminate\Http\Request;

class AtticInsulationCalculationController extends Controller
{
    use HasScriptResourceTrait;

    public $script_resources = [
        'create' => 'aic.js',
        'edit' => 'aic.js',
    ];

    public function create()
    {
        return view('api-extensions/attic-insulation-calculation/create', [
            'class' => AtticInsulationCalculation::class,
        ]);
    }

    public function store(Request $request, Order $order)
    {        
        $stored = AtticInsulationCalculation::create(
            AtticInsulationCalculation::prepareToSave($request->validated(), $order)
        );

        return [
            'id' => $stored->id ?? null,
            'stored' => is_a($stored, AtticInsulationCalculation::class),
        ];
    }

    public function edit(Order $order)
    {
        return view('api-extensions/attic-insulation-calculation/edit', [
            'class' => AtticInsulationCalculation::class,
            'data' => AtticInsulationCalculation::where('order_id', $order->id)->first(),
        ]);
    }

    public function update(Request $request, Order $order)
    {
        $prepared = AtticInsulationCalculation::prepareToSave($request->validated());
        
        $updated = AtticInsulationCalculation::whereOrder($order->id)->first();
        
        return [
            'id' => $updated->id ?? null,
            'updated' => $updated->fill($prepared)->save() === true,
        ];
    }

    public function destroy(Request $request, Order $order)
    {
        $deleted = AtticInsulationCalculation::whereOrder($order->id)->first();

        return [
            'id' => $deleted->id ?? null,
            'destroyed' => is_object($deleted) ? (bool) $deleted->delete() : false
        ];
    }
}
