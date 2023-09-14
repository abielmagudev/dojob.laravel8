<?php

namespace App\Models\ApiExtensions\Kernel;

use App\Models\Order;

trait HasOrderRelationship
{
    public function scopeWhereOrder($query, $id)
    {
        return $query->where('order_id', $id);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public static function prepareToSave(array $inputs, Order $order = null): array
    {
        $prepared = method_exists(self::class, 'prepareData') ? self::prepareData(...[$inputs, $order]) : $inputs;
        
        if( $order instanceof Order )
            $prepared['order_id'] = $order->id;
        
        return $prepared;
    }
}
