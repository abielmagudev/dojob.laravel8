<?php

namespace App\Http\Controllers\ApiExtensions;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiExtensions\ExampleExtension\StoreRequest;
use App\Models\ApiExtensions\ExampleApiExtension;
use App\Models\Order;
use Illuminate\Http\Request;

class ExampleApiExtensionController extends Controller
{
    public function index(Request $request)
    {
        return ExampleApiExtension::all();
    }

    public function create()
    {
        //
    }

    public function store(StoreRequest $request, Order $order)
    {
        //
    }

    public function show(Order $order)
    {
        //
    }

    public function edit(Order $order)
    {
        //
    }

    public function update(Request $request, Order $order)
    {
        //
    }

    public function destroy(Request $request, Order $order)
    {
        //
    }
}
