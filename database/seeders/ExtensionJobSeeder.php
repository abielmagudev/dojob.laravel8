<?php

namespace Database\Seeders;

use App\Models\Extension;
use App\Models\Job;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExtensionJobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $extensions = Extension::all();

        foreach(Job::all() as $job)
        {
            if( mt_rand(0, 1) )
            {
                $extensions_random_count = $extensions->random( 
                    mt_rand(1, $extensions->count())
                );

                $job->extensions()->attach($extensions_random_count);
            }    
        }
    }
}
