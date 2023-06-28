<?php

namespace App\Models\ApiExtensions;

use App\Models\ApiExtensions\Kernel\HasMigrationUpdates;
use App\Models\ApiExtensions\Kernel\HasPropertyGetters;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BattInsulationCalculation extends Model
{
    use HasFactory;
    use HasMigrationUpdates;
    use HasPropertyGetters;

    protected $table = 'api_extension_batt_insulation_calculation';

    public $prefix = 'bic';

    public $name = 'Batt Insulation Calculation';
    
    public $description = 'Batt insulation calculation description.';

    public static $all_methods_with_rvalues = [
        'attic' => array(
            'R-19',
            'R-30',
            'R-38',
        ),
        'underbelly' => array(
            'R-11',
            'R-13',
            'R-19',
            'R-30',
            'R-38',
            'R-60',
        ),
        'wall'	=> array(
            'R-13',
            'R-19',
            'R-38',
        ),
    ];

    public static $all_facing = [
        0 => 'unface',
        1 => 'face',
    ];

    public static $all_sizes = [
        'big',
        'small',
    ];

    public static function getAllMethodsWithRValues()
    {
        return self::$all_methods_with_rvalues;
    }

    public static function getAllMethods()
    {
        return array_keys(self::$all_methods_with_rvalues);
    }

    public static function getAllFacing()
    {
        return self::$all_facing;
    }

    public static function getAllSizes()
    {
        return self::$all_sizes;
    }
}
