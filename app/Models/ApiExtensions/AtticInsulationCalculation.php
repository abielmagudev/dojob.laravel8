<?php

namespace App\Models\ApiExtensions;

use App\Models\ApiExtensions\Kernel\HasMigrationUpdates;
use App\Models\ApiExtensions\Kernel\HasPropertyGetters;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AtticInsulationCalculation extends Model
{
    use HasFactory;
    use HasMigrationUpdates;
    use HasPropertyGetters;

    protected $table = 'api_extension_attic_insulation_calculation';

    public $prefix = 'aic';

    public $name = 'Attic Insulation Calculation';
    
    public $description = 'Attic Insulation Calculation description.';

    public static $all_methods_with_rvalues = [
        'airkrete' => [
            'R-21 (2x4)' => 0, // 750
            'R-33 (2x6)' => 0, // 550
        ],
        'blown' => [
            'R-13' => 168.5,
            'R-19' => 109.5,
            'R-22' => 94.1,
            'R-26' => 79.6,
            'R-30' => 68.5,
            'R-38' => 51.8,
            'R-44' => 44.5,
            'R-49' => 39.5,
            'R-60' => 31.4,
        ],
        'cellulose' => [
            'R-11' => 112.5,
            'R-13' => 88.3,
            'R-19' => 53.1,
            'R-20' => 50.1,
            'R-22' => 44.3,
            'R-24' => 39.4,
            'R-30' => 29.6,
            'R-32' => 21.3,
            'R-38' => 21.9,
            'R-40' => 20.6,
            'R-44' => 18.2,
            'R-48' => 16.4,
            'R-50' => 13.6,
            'R-60' => 12.4,
        ],
        'foam' => [
            'R-13 (2x4)' => 0,
            'R-19 (2x6)' => 0,
        ],
    ];

    public static function getAllMethodsWithRValues()
    {
        return self::$all_methods_with_rvalues;
    }

    public static function getAllMethods()
    {
        return array_keys(self::$all_methods_with_rvalues);
    }
}
