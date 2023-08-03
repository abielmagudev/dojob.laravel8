<?php

namespace App\Models\ApiExtensions\Kernel;

use Exception;
use Illuminate\Support\Str;

trait HasHelpers
{   
    static $reflection_cache = null;

    public static function reflectionHimself()
    {
        if( is_null(self::$reflection_cache) )
            self::$reflection_cache = new \ReflectionClass(__CLASS__);

        return self::$reflection_cache;
    }

    public static function getPrefix()
    {
        if( self::reflectionHimself()->hasProperty('prefix') )
            return self::reflectionHimself()->getProperty('prefix')->getValue();

        return 'prefix?'; 
    }

    public static function concatPrefix(string $value = '', string $glue = '_')
    {
        return implode($glue, [self::getPrefix(), $value]);
    }

    public static function getTableName()
    {
        return with(new self)->getTable();
    }
}
