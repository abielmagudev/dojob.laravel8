<?php

namespace Database\Seeders;

use App\Models\FakeApiExtension;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FakeApiExtensionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FakeApiExtension::factory( self::seedsCount() )->create();
    }

    public static function seeds(): array
    {
        return [
            [
                'name' => 'Air Conditioning Installation',
                'classname' => 'AirConditioningInstallation',
                'description' => 'Air conditioning installation description.',
            ],
            [
                'name' => 'Attic Insulation Calculation',
                'classname' => 'AtticInsulationCalculation',
                'description' => 'Attic Insulation Calculation description.',
            ],
            [
                'name' => 'Batt Insulation Calculation',
                'classname' => 'BattInsulationCalculation',
                'description' => 'Batt insulation calculation description.',
            ],
            [
                'name' => 'Minisplit Installation',
                'classname' => 'MinisplitInstallation',
                'description' => 'Minisplit installation description.',
            ],
            [
                'name' => 'Preventive Maintenance',
                'classname' => 'PreventiveMaintenance',
                'description' => 'Preventive maintenance description.',
            ],
            [
                'name' => 'Wall Insulation Calculation',
                'classname' => 'WallInsulationCalculation',
                'description' => 'Wall insulation calculation description.',
            ],

            // ...
        ];
    }

    public static function seedsCount(): int
    {
        return count( self::seeds() );
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

    public static function tagsCount(): int
    {
        return count( self::tags() );
    }
}
