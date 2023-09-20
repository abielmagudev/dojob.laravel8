<?php

namespace App\Models\ApiExtensions\Kernel;

use App\Models\Order;
use ReflectionClass;

trait ApiExtensionModelTrait
{
    // Static

    static $reflection_cache = null;
    
    public static function reflection()
    {
        if( is_null(self::$reflection_cache) )
            self::$reflection_cache = new ReflectionClass(__CLASS__);

        return self::$reflection_cache;
    }
    
    public static function prefix()
    {
        return self::reflection()->getConstant('PREFIX') ?? '';
    }

    public static function concatPrefix(string $text = null)
    {
        return sprintf('%s_%s', self::prefix(), $text);
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


    // Object

    public function scopeWhereOrder($query, $id)
    {
        return $query->where('order_id', $id);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
