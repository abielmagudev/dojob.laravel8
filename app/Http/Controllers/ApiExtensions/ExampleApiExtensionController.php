<?php

namespace App\Http\Controllers\ApiExtensions;

use App\Http\Controllers\ApiExtensions\Kernel\HasScriptResourceTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\ApiExtensions\ExampleExtension\StoreRequest;
use App\Models\ApiExtensions\ExampleExtension;
use App\Models\Order;
use Illuminate\Http\Request;

class ExampleApiExtensionController extends Controller
{
    use HasScriptResourceTrait;

    public $script_resources = [
        'method_name' => 'script_name.js'
    ];

    public function index(Request $request)
    {
        //
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
