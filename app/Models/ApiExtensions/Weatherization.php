<?php

namespace App\Models\ApiExtensions;

use App\Models\ApiExtensions\Kernel\Interfaces\Migratable;
use App\Models\ApiExtensions\Kernel\Traits\HasEssentialFeatures;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weatherization extends Model implements Migratable
{
    use HasFactory;
    use HasEssentialFeatures;

    const PREFIX = 'wz';

    protected $table = 'apix_weatherization';

    public static function migrations(): array
    {
        return [
            'apix_weatherization' => 'weatherization/create_weatherization_table.php',
        ];
    }
}
