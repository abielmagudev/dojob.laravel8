<?php

namespace App\Models\ApiExtensions;

use App\Models\ApiExtensions\Kernel\Interfaces\Migratable;
use App\Models\ApiExtensions\Kernel\Traits\HasEssentialFeatures;
use App\Models\ApiExtensions\Weatherization\WeatherizationCategory;
use App\Models\ApiExtensions\Weatherization\WeatherizationProduct;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weatherization extends Model implements Migratable
{
    use HasFactory;
    use HasEssentialFeatures;

    const PREFIX = 'wz';

    protected $table = 'apix_weatherization';

    // Relations

    public function product()
    {
        return $this->hasMany(WeatherizationProduct::class);
    }


    public static function migrations(): array
    {
        return [
            'apix_weatherization' => 'weatherization/create_weatherization_table.php',
            'apix_weatherization_categories' => 'weatherization/create_weatherization_categories_table.php',
            'apix_weatherization_products' => 'weatherization/create_weatherization_products_table.php',
        ];
    }
}
