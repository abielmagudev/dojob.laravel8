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
        return $extensions->map(function ($extension) use ($method, $parameters) {
            return app($extension->controller_class)->callAction($method, $parameters);
        });
    }

    public function store(Request $request, $order)
    {
        $extensions = $request->get('job_extensions_cache', $order->job->extensions);
        
        $result = $this->call($extensions, 'store', [$request, $order]);
        
        return $result->groupBy( function ($item) {
            return $item['stored'] ? 'success' : 'failed';
        }, true);   
    }

    public function update(Request $request, Order $order)
    {
        $extensions = $request->get('job_extensions_cache', $order->job->extensions);
        
        $result = $this->call($extensions, 'update', [$request, $order]);

        return $result->groupBy( function ($item) {
            return $item['updated'] ? 'success' : 'failed';
        }, true);   
    }

    public function ajaxCreate(Job $job)
    {
        return response()->json([
            'templates' => $this->call($job->extensions, 'create')
        ]);
    }

    public function ajaxEdit(Order $order)
    {
        return response()->json([
            'templates' => $this->call($order->job->extensions, 'edit', ['order' => $order])
        ]);
    }
}
