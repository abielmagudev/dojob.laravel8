<?php

namespace App\Http\Controllers\OrderController;

use App\Http\Controllers\OrderJobExtensionController;
use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

trait ExtensionsDataHandlerTrait
{
    public function managesExtensionData(Collection $extensions, Request $request, Order $order, string $action)
    {
        return app(OrderJobExtensionController::class)->callAction($action, [
            $extensions,
            $request, 
            $order
        ]);
    }

    public function storeExtensionData(Collection $extensions, Request $request, Order $order)
    {
        return $this->managesExtensionData($extensions, $request, $order, 'store');
    }

    public function updateExtensionData(Collection $extensions, Request $request, Order $order)
    {
        return $this->managesExtensionData($extensions, $request, $order, 'update');
    }

    public function destroyExtensionData(Collection $extensions, Request $request, Order $order)
    {
        return $this->managesExtensionData($extensions, $request, $order, 'destroy');
    }
}
