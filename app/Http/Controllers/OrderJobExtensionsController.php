<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderJobExtensionsController extends Controller
{
    public function create(Job $job)
    {
        return response()->json([
            'templates' => $this->extensionTemplates($job, 'create')
        ]);
    }

    public function edit(Order $order)
    {
        return response()->json([
            'templates' => $this->extensionTemplates($order->job, 'edit', ['order' => $order])
        ]);
    }

    private function extensionTemplates(Job $job, string $method, array $parameters = [])
    {
        return $job->extensions->map(function ($extension) use ($method, $parameters) {
            return app()->call([new $extension->controller_class, $method], $parameters);
        });
    }
}
