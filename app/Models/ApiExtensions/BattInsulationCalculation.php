<?php

namespace App\Models\ApiExtensions;

use App\Models\ApiExtensions\Kernel\ApiExtensionModelTrait;
use App\Models\ApiExtensions\Kernel\MigratableInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BattInsulationCalculation extends Model implements MigratableInterface
{
    use HasFactory;
    use ApiExtensionModelTrait;

    const PREFIX = 'bic';

    protected $table = 'apix_batt_insulation_calculation';

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
        'wall' => array(
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

    public static function migrations(): array
    {
        return [
            'apix_batt_insulation_calculation' => 'batt-insulation-calculation/create_batt_insulation_calculation_table.php'
        ];
    }
}
