<?php

namespace App\Models\ApiExtensions;

use App\Models\ApiExtensions\Kernel\ApiExtensionModelTrait;
use App\Models\ApiExtensions\Kernel\MigratableInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WallInsulationCalculation extends Model implements MigratableInterface
{
    use HasFactory;
    use ApiExtensionModelTrait;

    const PREFIX = 'wic';

    protected $table = 'apix_wall_insulation_calculation';

    public static $all_methods_with_rvalues = [
        'airkrete' => [
            'R-21 (2x4)' => 0, // 750
            'R-33 (2x6)' => 0, // 550
        ],
        'blown' => [
            'R-15 (2x4)' => 75.4,
            'R-21 (2x6)' => 55.4,
        ],
        'cellulose' => [
            'R-13 (2x4)' => 72.5,
            'R-15 (2x6)' => 61.5,
        ],
        'foam' => [
            'R-13 (2x4)' => 0,
            'R-19 (2x6)' => 0,
        ]
    ];

    public static function getAllMethodsWithRValues()
    {
        return self::$all_methods_with_rvalues;
    }

    public static function getAllMethods()
    {
        return array_keys(self::$all_methods_with_rvalues);
    }

    public static function migrations(): array
    {
        return [
            'apix_wall_insulation_calculation' => 'wall-insulation-calculation/create_wall_insulation_calculation_table.php'
        ];
    }
}
