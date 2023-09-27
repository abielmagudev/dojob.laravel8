<?php

namespace App\Http\Controllers\ApiExtensions;

use App\Http\Controllers\Controller;
use App\Models\ApiExtensions\Weatherization;
use App\Models\ApiExtensions\Weatherization\WeatherizationCategory;
use App\Models\ApiExtensions\Weatherization\WeatherizationProduct;
use App\Models\Order;
use Illuminate\Http\Request;

class WeatherizationController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        return view('api-extensions/weatherization/create', [
            'class' => Weatherization::class,
        ]);
    }

    public function store(Request $request, Order $order)
    {
        $data = $this->generateDataToInsert($request, $order);

        return [
            'stored' => Weatherization::insert($data),
        ];
    }

    public function show()
    {
        return view('api-extensions.weatherization.show', [
            'categories' => WeatherizationCategory::all(),
            'products' => WeatherizationProduct::with('category')->get(),
        ]);
    }

    public function edit(Order $order)
    {
        return view('api-extensions/weatherization/edit', [
            'class' => Weatherization::class,
            'collection' => Weatherization::whereOrder($order->id)->get(),
        ]);
    }

    public function update(Request $request, Order $order)
    {
        $this->destroy($request, $order);

        $data = $this->generateDataToInsert($request, $order);

        return [
            'updated' => Weatherization::insert($data)
        ];
    }

    public function destroy(Request $request, Order $order)
    {
        return [
            'destroyed' => Weatherization::whereOrder($order->id)->delete()
        ];
    }

    
    // Helpers

    private function generateDataToInsert(Request $request, Order $order)
    {
        $products_count = count(
            $request->get(Weatherization::prefix('products'), [])
        );

        $data = [];

        for($i = 0; $i < $products_count; $i++)
        {
            array_push($data, [
                'product' => data_get($request->get(Weatherization::prefix('products')), $i),
                'quantity' => data_get($request->get(Weatherization::prefix('quantities')), $i),
                'order_id' => $order->id,
                'created_at' => now(),
            ]);
        }

        return $data;
    }
}
