<?php

namespace App\Models\ApiExtensions\Kernel\Traits;

use App\Models\Order;

trait HasEssentialFeatures
{
    public function scopeWhereOrder($query, $id)
    {
        return $query->where('order_id', $id);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }


    // Static

    public static function prefix(string $text = '', string $separator = '_'): string
    {
        return sprintf('%s%s%s', self::PREFIX, $separator, $text);
    }

    public static function getTableName()
    {
        return with(new self)->getTable();
    }

    public static function prepareToSave(array $inputs, Order $order = null): array
    {
        $prepared = method_exists(self::class, 'prepareData') ? self::prepareData(...[$inputs, $order]) : $inputs;
        
        if( $order instanceof Order )
            $prepared['order_id'] = $order->id;
        
        return $prepared;
    }
}
