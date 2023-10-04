<?php

namespace App\Models\ApiExtensions\WeatherizationMeasureCPS;

use App\Models\ApiExtensions\Kernel\MigratableInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WeatherizationMeasureCPS extends Model implements MigratableInterface
{
    use SoftDeletes;

    protected $table = 'api_extension_weatherization_products_prices_cps';

    protected $fillable = [
        'name',
        'item_price_id',
        'material_price',
        'labor_price',
    ];

    public function getTotalCostAttribute()
    {
        return ($this->material_price ?? 0) + ($this->labor_price ?? 0);
    }

    public static function migrations(): array
    {
        return [
            'weatherization-measures-cps/create_api_extension_weatherization_products_prices_cps_table',
            'weatherization-measures-cps/create_api_extension_weatherization_measures_cps_order_table',
        ];
    }
}
