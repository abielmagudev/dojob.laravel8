<?php

namespace App\Models\ApiExtensions\Weatherization;

use Illuminate\Database\Eloquent\Model;

class WeatherizationProduct extends Model
{
    protected $table = 'apix_weatherization_products';

    protected $fillable = [
        'name',
        'unit_price',
        'category_id',
    ];
}
