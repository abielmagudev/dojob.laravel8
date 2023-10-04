<?php

namespace Database\Seeders;

use App\Models\ApiExtensions\Kernel\Helpers\Migrator;
use App\Models\Extension;
use Illuminate\Database\Seeder;

class ExtensionSeeder extends Seeder
{
    public function run()
    {
        foreach(config('api-extensions.stock-installer') as $item)
        {
            $extension = Extension::create($item);

            if( Migrator::is($extension->model) )
                Migrator::install($extension->model);
        }
    }
}
