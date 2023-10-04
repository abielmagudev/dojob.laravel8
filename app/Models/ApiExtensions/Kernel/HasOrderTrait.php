<?php

namespace App\Models\ApiExtensions\Kernel;

use App\Models\Order;

trait HasOrderTrait
{
    public function scopeWhereOrder($query, $id)
    {
        return $query->where('order_id', $id);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
