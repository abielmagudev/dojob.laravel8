<?php

namespace App\Http\Controllers;

use App\Http\Controllers\OrderJobExtensionController\GroupExtensionResultsTrait;
use App\Http\Controllers\OrderJobExtensionController\RoutesAjaxActionsTrait;
use App\Models\Job;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class OrderJobExtensionController extends Controller
{
    use RoutesAjaxActionsTrait;
    use GroupExtensionResultsTrait;

    public function create(Job $job)
    {
        return $job->extensions->map(function ($extension) {
            
            $controller = app($extension->controller);

            return [
                'view' => $controller->create()->render(),
                'script' => method_exists($controller, 'scriptResource') ? $controller->scriptResource('create') : null,
            ];

        });
    }

    public function store(Collection $extensions, Request $request, Order $order)
    {        
        $extensions->each(function ($extension) use ($request, $order) {

            $extension->result = app($extension->controller)->callAction('store', [$request, $order]);

        });

        return $this->groupByResult($extensions, 'stored');   
    }

    public function edit(Job $job, Order $order)
    {
        return $job->extensions->map(function ($extension) use ($order) {
            
            $controller = app($extension->controller);

            return [
                'view' => $controller->edit($order)->render(),
                'script' => method_exists($controller, 'scriptResource') ? $controller->scriptResource('edit') : null,
            ];

        });
    }

    public function update(Collection $extensions, Request $request, Order $order)
    {        
        $extensions->each(function ($extension) use ($request, $order) {

            $extension->result = app($extension->controller)->callAction('update', [$request, $order]);

        });

        return $this->groupByResult($extensions, 'updated');    
    }

    public function destroy(Collection $extensions, Request $request, Order $order)
    {        
        $extensions->each(function ($extension) use ($request, $order) {

            $extension->result = app($extension->controller)->callAction('destroy', [$request, $order]);

        });

        return $this->groupByResult($extensions, 'destroyed');  
    }
}
