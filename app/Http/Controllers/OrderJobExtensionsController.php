<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class OrderJobExtensionsController extends Controller
{
    public $response = [];

    private function extensionTemplates(Job $job, string $method, array $parameters = [])
    {
        return $job->extensions->map(function ($extension) use ($method, $parameters) {
            return app()->call([new $extension->controller_class, $method], $parameters);
        });
    }

    private function call(Collection $extensions, string $method, array $parameters = [])
    {
        return $extensions->map(function ($extension) use ($method, $parameters) {
            return app($extension->controller_class)->callAction($method, $parameters);
        });
    }

    public function create(Job $job)
    {
        return response()->json([
            'templates' => $this->extensionTemplates($job, 'create')
        ]);
    }

    public function store(Request $request, $order)
    {
        $extensions = $request->get('job_extensions_cache', $order->job->extensions);
        $result = $this->call($extensions, 'store', [$request, $order]);

        foreach($result as $key => $item) {
            $status = $item['stored'] ? 'success' : 'failed';
            $this->response[$status][ $extensions->get($key)->name ] = $item;
        }

        return $this->response;
    }

    public function edit(Order $order)
    {
        return response()->json([
            'templates' => $this->extensionTemplates($order->job, 'edit', ['order' => $order])
        ]);
    }

    public function update(Request $request, Order $order)
    {
        $extensions = $request->get('job_extensions_cache', $order->job->extensions);
        $result = $this->call($extensions, 'update', [$request, $order]);

        foreach($result as $key => $item) {
            $status = $item['updated'] ? 'success' : 'failed';
            $this->response[$status][ $extensions->get($key)->name ] = $item;
        }

        return $this->response;
    }
}
