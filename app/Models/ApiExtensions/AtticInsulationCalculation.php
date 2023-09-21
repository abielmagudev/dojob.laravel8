<?php

namespace App\Models\ApiExtensions;

use App\Models\ApiExtensions\Kernel\Traits\HasEssentialFeatures;
use App\Models\ApiExtensions\Kernel\Interfaces\Migratable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AtticInsulationCalculation extends Model implements Migratable
{
    use HasFactory;
    use HasEssentialFeatures;

    const PREFIX = 'aic';

    protected $table = 'apix_attic_insulation_calculation';

    protected $fillable = [
        'method',
        'rvalue_name',
        'rvalue_amount',
        'square_feets',
        'bags',
        'order_id',
    ];

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

    public static function getAllMethodsWithRValues(): array
    {
        return self::$all_methods_with_rvalues;
    }

    public static function getAllMethods(): array
    {
        return array_keys(self::$all_methods_with_rvalues);
    }

    public static function getRValuesMethod(string $method_name): array
    {
        if(! in_array($method_name, self::getAllMethods()) )
            return [];

        return self::getAllMethodsWithRValues()[$method_name];
    }

    public static function getRValueAmount(string $method_name, string $rvalue_name)
    {
        $rvalues = self::getRValuesMethod($method_name);

        if(! array_key_exists($rvalue_name, $rvalues) )
            return 0;

        return $rvalues[$rvalue_name];
    }

    public static function calculateBags(string $method_name, string $rvalue_name, float $square_feets)
    {
        $rvalue_amount = self::getRValueAmount($method_name, $rvalue_name);

        if( $rvalue_amount == 0 || $square_feets == 0 )
            return 0;
        
        return ceil( ($square_feets / $rvalue_amount) );
    }

    public static function prepareData(array $inputs): array
    {
        $input_method = $inputs[ self::concatPrefix('method') ];
        $input_rvalue = $inputs[ self::concatPrefix('rvalue') ];
        $input_square_feets = $inputs[ self::concatPrefix('square_feets') ];

        return [
            'method' => $input_method,
            'rvalue_name' => $input_rvalue,
            'square_feets' => $input_square_feets,
            'rvalue_amount' => self::getRValueAmount($input_method, $input_rvalue),
            'bags' => self::calculateBags($input_method, $input_rvalue, $input_square_feets),
        ];
    }


    // Migratable

    public static function migrations(): array
    {
        return [
            'apix_attic_insulation_calculation' => 'attic-insulation-calculation/create_attic_insulation_calculation_table.php',
        ];
    }
}
