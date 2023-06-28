<?php

namespace Database\Seeders;

use App\Models\ApiExtension;
use App\Models\Extension;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExtensionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {        
        Extension::factory( 
            mt_rand(1, ApiExtension::all()->count())
         )->create();
    }
}
