<?php

namespace App\Http\Controllers;

use App\Http\Controllers\OrderJobExtensionController\Traits\GroupExtensionResults;
use App\Http\Controllers\OrderJobExtensionController\Traits\RoutesAjaxActions;
use App\Models\Job;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class OrderJobExtensionController extends Controller
{
    use GroupExtensionResults;
    use RoutesAjaxActions;

    public function create(Job $job)
    {
        $views = $job->extensions->map(function ($extension) {
            
            $response = app($extension->controller)->callAction('create', []);

            return is_a($response, View::class) ? $response->render() : null;

        });

        return $views->filter();
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
        $views = $job->extensions->map(function ($extension) use ($order) {
            
            $response = app($extension->controller)->callAction('edit', [$order]);

            return is_a($response, View::class) ? $response->render() : null;
            
        });

        return $views->filter();
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
