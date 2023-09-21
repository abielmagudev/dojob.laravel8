<?php

namespace App\Http\Controllers\OrderJobExtensionController\Traits;

use App\Models\Job;
use App\Models\Order;

trait RoutesAjaxActions
{
    public $actions_ajax = [
        'create',
        'edit',
    ];

    public function ajax(Job $job, string $action, Order $order = null)
    {
        if(! in_array($action, $this->actions_ajax) )
        {
            return response()->json([
                'status' => 404,
                'templates' => [],
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'templates' => call_user_func_array([$this, $action], [$job, $order]),
        ], 200);
    }
}
