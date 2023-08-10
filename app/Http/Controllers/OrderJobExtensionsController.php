<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class OrderJobExtensionsController extends Controller
{
    private function call(Collection $extensions, string $method, array $parameters = [])
    {
        $result = $extensions->map(function ($extension) use ($method, $parameters) {
            $extension->called = null;

            if( method_exists($extension->controller_class, $method) )
                $extension->called = app($extension->controller_class)->callAction($method, $parameters);
            
            return $extension;
        });

        return $result->filter(function ($extension) {
            return $extension->called <> null;
        });
    }

    public function ajaxCreate(Job $job)
    {
        $result = $this->call($job->extensions, 'create');

        return response()->json([
            'templates' => $result->map(function ($extension) {
                return $extension->called;
            })
        ]);
    }

    public function store(Request $request, Order $order, Collection $extensions)
    {        
        $result = $this->call($extensions, 'store', [$request, $order]);

        return $result->groupBy( function ($extension) {
            return $extension->called['stored'] ? 'success' : 'failed';
        });   
    }

    public function ajaxEdit(Order $order)
    {
        $result = $this->call($order->job->extensions, 'edit', ['order' => $order]);

        return response()->json([
            'templates' => $result->map(function ($extension) {
                return $extension->called;
            })
        ]);
    }

    public function update(Request $request, Order $order, Collection $extensions)
    {        
        $result = $this->call($extensions, 'update', [$request, $order]);

        return $result->groupBy( function ($extension) {
            return $extension->called['updated'] ? 'success' : 'failed';
        }); 
    }

    public function destroy(Request $request, Order $order, Collection $extensions)
    {
        $result = $this->call($extensions, 'destroy', [$request, $order]);

        return $result->groupBy( function ($extension) {
            return $extension->called['destroyed'] ? 'success' : 'failed';
        }); 
    }
}
