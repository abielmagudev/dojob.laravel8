<?php

namespace App\Models\ApiExtensions\Kernel;

use Exception;
use Illuminate\Support\Str;

trait HasPropertyGetters
{    
    public static $properties_cache;

    public static function getProperties()
    {
        if( is_null(self::$properties_cache) )
            self::$properties_cache = get_class_vars( self::class );

        return self::$properties_cache;
    }

    public static function getProperty(string $name)
    {
        if(! array_key_exists($name, self::getProperties()) )
            throw new Exception( sprintf('%s -> [%s] property not exists', self::class, $name) );

        return self::getProperties()[$name];
    }

    /**
     * Also:
     * return with(new self)->getTable();
     */
    public static function getTableName()
    {
        return self::getProperty('table');
    }

    public static function getPrefixInputId(string $name)
    {
        return sprintf('%s%s', self::getProperty('prefix'), Str::studly($name));
    }

    public static function getPrefixInputName($name)
    {
        return sprintf('%s_%s', self::getProperty('prefix'), Str::snake($name));
    }

    public static function getName()
    {
        return self::getProperty('name');
    }

    public static function getDescription()
    {
        return self::getProperty('description');
    }
}
