<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     * 
     * Examples 1
     * \App\Models\User::factory(10)->create();
     * 
     * Example 2
     * \App\Models\User::factory()->create(['attribute' => 'value']);
     * 
     * Example 3
     * $this->call([NameSeeder::class, ...]);
     */
    public function run(): void
    {
        $this->call([
            ApiExtensionSeeder::class,
            JobSeeder::class,
            ExtensionSeeder::class,
            ExtensionJobSeeder::class,
            OrderSeeder::class,
        ]);

    }
}
