<?php

namespace App\Models\ApiExtensions\WeatherizationMeasureCPS;

use App\Models\ApiExtensions\Kernel\HasOrderTrait;
use App\Models\ApiExtensions\Kernel\HasPrefixTrait;
use App\Models\ApiExtensions\Kernel\MigratableInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WeatherizationMeasureCPSOrder extends Model implements MigratableInterface
{
    use HasOrderTrait;
    use HasPrefixTrait;
    use SoftDeletes;

    protected $table = 'apix_weatherization_measures_cps_order';

    public static function migrations(): array
    {
        return [
            'weatherization-measures-cps/create_apix_weatherization_measures_cps_table',
            'weatherization-measures-cps/create_apix_weatherization_products_prices_cps_table',
        ];
    }
}
