<?php

namespace App\Http\Controllers\ApiExtensions;

use App\Http\Controllers\Controller;
use App\Models\ApiExtensions\AtticInsulationCalculation;
use App\Models\Order;

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

    public function edit(Order $order)
    {
        return [
            'template' => "- View edit of extension AtticInsulationCalculation - {$order->id}",
        ];
    }
}
