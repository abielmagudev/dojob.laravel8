<?php

namespace App\Models\ApiExtensions\Kernel;

use App\Models\Order;

trait HasPrefixTrait
{
    public static function prefix(string $text = '', string $separator = '_'): string
    {
        return sprintf('%s%s%s', self::PREFIX, $separator, $text);
    }
}
