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
        FakeApiExtension::insert( self::stock() );
    }

    public static function stock()
    {
        return [
            [
                'name' => 'Air Conditioning Installation',
                'classname' => 'AirConditioningInstallation',
                'description' => 'Air conditioning installation description.',
                'tags_csv_format' => 'ac,cooling,freezer',
                'price' => '300',
            ],
            [
                'name' => 'Attic Insulation Calculation',
                'classname' => 'AtticInsulationCalculation',
                'description' => 'Attic Insulation Calculation description.',
                'tags_csv_format' => 'insulation,wheaterization,uphouse',
                'price' => '100',
            ],
            [
                'name' => 'Batt Insulation Calculation',
                'classname' => 'BattInsulationCalculation',
                'description' => 'Batt insulation calculation description.',
                'tags_csv_format' => 'insulation,wheaterization,underfloor',
                'price' => '55.50',
            ],
            [
                'name' => 'Minisplit Installation',
                'classname' => 'MinisplitInstallation',
                'description' => 'Minisplit installation description.',
                'tags_csv_format' => 'ac,cooling',
                'price' => '275.50',
            ],
            [
                'name' => 'Preventive Maintenance',
                'classname' => 'PreventiveMaintenance',
                'description' => 'Preventive maintenance description.',
                'tags_csv_format' => 'maintenance,prevent a problem',
                'price' => '30',
            ],
            [
                'name' => 'Wall Insulation Calculation',
                'classname' => 'WallInsulationCalculation',
                'description' => 'Wall insulation calculation description.',
                'tags_csv_format' => 'insulation,wheaterization,out house,in house',
                'price' => '120',
            ],
            [
                'name' => 'Weatherization',
                'classname' => 'Weatherization',
                'description' => 'Weatherization.',
                'tags_csv_format' => 'insulation, wheaterization, out house, in house',
                'price' => '399.99',
            ],
        ];
    }
}
