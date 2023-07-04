<?php

namespace Database\Seeders;

use App\Models\ApiExtension;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ApiExtensionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ApiExtension::factory( 
            count( self::stock() )
         )->create();
    }

    public static function stock(): array
    {
        return [
            [
                'name' => 'Air Conditioning Installation',
                'description' => 'Air conditioning installation description.',
                'model_class' => \App\Models\ApiExtensions\AirConditioningInstallation::class,
                'controller_class' => \App\Http\Controllers\ApiExtensions\AirConditioningInstallationController::class,
            ],
            [
                'name' => 'Attic Insulation Calculation',
                'description' => 'Attic Insulation Calculation description.',
                'model_class' => \App\Models\ApiExtensions\AtticInsulationCalculation::class,
                'controller_class' => \App\Http\Controllers\ApiExtensions\AtticInsulationCalculationController::class,
            ],
            [
                'name' => 'Batt Insulation Calculation',
                'description' => 'Batt insulation calculation description.',
                'model_class' => \App\Models\ApiExtensions\BattInsulationCalculation::class,
                'controller_class' => \App\Http\Controllers\ApiExtensions\BattInsulationCalculationController::class,
            ],
            [
                'name' => 'Minisplit Installation',
                'description' => 'Minisplit installation description.',
                'model_class' => \App\Models\ApiExtensions\MinisplitInstallation::class,
                'controller_class' => \App\Http\Controllers\ApiExtensions\MinisplitInstallationController::class,
            ],
            [
                'name' => 'Preventive Maintenance',
                'description' => 'Preventive maintenance description.',
                'model_class' => \App\Models\ApiExtensions\PreventiveMaintenance::class,
                'controller_class' => \App\Http\Controllers\ApiExtensions\PreventiveMaintenanceController::class,
            ],
            [
                'name' => 'Wall Insulation Calculation',
                'description' => 'Wall insulation calculation description.',
                'model_class' => \App\Models\ApiExtensions\WallInsulationCalculation::class,
                'controller_class' => \App\Http\Controllers\ApiExtensions\WallInsulationCalculationController::class,
            ],

            // ...
        ];
    }

    public static function tags(): array
    {
        return [
            'carpenter',
            'cooling',
            'heater',
            'inspection',
            'insulation',
            'maintenance', 
            'painting', 
            'testing',
            'weatherization', 
        ];
    }
}
