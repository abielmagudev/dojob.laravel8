<?php

namespace Database\Factories;

use Database\Seeders\FakeApiExtensionSeeder;
// use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ApiExtension>
 */
class FakeApiExtensionFactory extends Factory
{
    public $fake_api_extensions_seeds_cache;

    public function definition(): array
    {
        $api_extension = $this->nextFakeApiExtensionSeed();

        return [
            'name' => $api_extension->name,
            'classname' => $api_extension->classname,
            'description' => $api_extension->description,
            'tags_csv_format' => $this->randomFakeApiExtensionTagsCsvFormat(),
            'price' => $this->faker->optional()->randomFloat(2, 1, 500),
        ];
    }

    public function nextFakeApiExtensionSeed()
    {
        if( is_null($this->fake_api_extensions_seeds_cache) )
            $this->fake_api_extensions_seeds_cache = FakeApiExtensionSeeder::seeds();
        else
            next($this->fake_api_extensions_seeds_cache);

        return (object) current($this->fake_api_extensions_seeds_cache);
    }

    public function randomFakeApiExtensionTagsCsvFormat()
    {        
        $random_fake_tags = $this->faker->randomElements(
            FakeApiExtensionSeeder::tags(),
            mt_rand(1, FakeApiExtensionSeeder::tagsCount())
        );

        return implode(',', $random_fake_tags);
    }
}
