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
            count( ApiExtension::stockByClasses() )
         )->create();
    }
}
