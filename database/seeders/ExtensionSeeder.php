<?php

namespace Database\Seeders;

use App\Models\Extension;
use App\Models\FakeApiExtension;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExtensionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {        
        $fake_api_extensions_count = FakeApiExtension::all()->count();
        
        Extension::factory( mt_rand(1, $fake_api_extensions_count) )->create();
    }
}
