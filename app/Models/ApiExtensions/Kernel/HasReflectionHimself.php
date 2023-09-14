<?php

namespace App\Models\ApiExtensions\Kernel;

use Exception;
use Illuminate\Support\Str;
use ReflectionClass;

trait HasReflectionHimself
{   
    static $reflection_cache = null;
    
    public static function reflection()
    {
        if( is_null(self::$reflection_cache) )
            self::$reflection_cache = new ReflectionClass(__CLASS__);

        return self::$reflection_cache;
    }
    
    public static function prefix()
    {
        return self::reflection()->hasProperty('prefix') ? self::reflection()->getProperty('prefix')->getValue() : '';
    }

    public static function concatPrefix(string $text = null)
    {
        return self::prefix() . $text;
    }

    public static function getTableName()
    {
        return with(new self)->getTable();
    }
}
