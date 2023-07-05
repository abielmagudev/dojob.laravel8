<?php

namespace App\Models\ApiExtensions\Kernel;

use Exception;
use Illuminate\Support\Str;

trait HasGetters
{    
    public static function getTableName()
    {
        return with(new self)->getTable();
    }

    public static function getWithPrefix(string $concat = '')
    {
        return sprintf('%s_%s', self::PREFIX, $concat);
    }
}
