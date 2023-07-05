<?php

namespace App\Models\ApiExtensions;

use App\Models\ApiExtensions\Kernel\HasGetters;
use App\Models\ApiExtensions\Kernel\HasMigrationUpdates;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AirConditioningInstallation extends Model
{
    use HasFactory;
    use HasGetters;
    use HasMigrationUpdates;

    const PREFIX = 'aci';

    protected $table = 'api_extension_air_conditioning_installation';

    public static $all_complete_items = [
        'change out',
        'system',
    ];

    public static $all_unit_types = [
        'electric',
        'gas',
        'heat pump',
    ];

    public static $all_components = [
        'Air handler',
        'Coil',
        'Condenser',
        'Cooper Line Cover',
        'Drain line',
        'Drain Pan',
        'Ductruns',
        'Ducts box and grill',
        'Electronic air cleaner',
        'Flex gas line for furnance',
        'Flex line',
        'Flue pipe',
        'Furnace',
        'Furnance feet',
        'Gas line cut off',
        'Grills',
        'KW Heater',
        'Media air cleaner',
        'Plenum',
        'Quick disconnect and whip',
        'Return Grills',
        'Secondary drain',
        'Slab',
        'Thermostat digital',
        'Thermostat Program',
        'Thermostat WiFi',
        'Transition',
        'Trunkline',
        'UV lights',
        'Zone system',
    ];

    public static function getAllCompleteItems()
    {
        return self::$all_complete_items;
    }

    public static function getAllUnitTypes()
    {
        return self::$all_unit_types;
    }
    
    public static function getAllComponents()
    {
        return self::$all_components;
    }
}
