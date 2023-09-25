<?php

namespace App\Models\ApiExtensions\Weatherization;

use Illuminate\Database\Eloquent\Model;

class WeatherizationCategory extends Model
{
    protected $table = 'apix_weatherization_categories';

    protected $fillable = [
        'name',
    ];

    public static function install()
    {
        foreach(self::stock() as $category_name)
        {
            self::create([
                'name' => $category_name,
            ]);
        }
    }

    private static function stock()
    {
        return [
            'AIR CONDITIONING / HEATING MEASURES',
            'DOOR MEASURES',
            'DUCT MEASURES',
            'HEALTH AND SAFETY',
            'INSULATION MEASURES',
            'OTHER MEASURES AND REPAIRS',
            'VENTING MEASURES',
            'WEATHERIZATION MEASURES',
            'WINDOW MEASURES',
        ];
    }
}
