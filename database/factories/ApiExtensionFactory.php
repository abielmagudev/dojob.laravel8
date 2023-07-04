<?php

namespace Database\Factories;

use App\Models\ApiExtension;
use Database\Seeders\ApiExtensionSeeder;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ApiExtension>
 */
class ApiExtensionFactory extends Factory
{
    public static $stock_api_extensions_cache;

    public function definition(): array
    {
        $api_extension = self::getNextApiExtension();
        $random_tags = self::getRandomTags($this->faker);

        return [
            'name' => $api_extension['name'],
            'description' => $api_extension['description'],
            'model_class' => $api_extension['model_class'],
            'controller_class' => $api_extension['controller_class'],
            'tags_csv_format' => implode(',', $random_tags),
            'price' => $this->faker->optional()->randomFloat(2, 1, 500),
        ];
    }

    public static function getNextApiExtension()
    {
        if( is_null(self::$stock_api_extensions_cache) )
            self::$stock_api_extensions_cache = ApiExtensionSeeder::stock();
        else
            next(self::$stock_api_extensions_cache);

        return current(self::$stock_api_extensions_cache);
    }

    public static function getRandomTags(Faker $faker, int $min = 1)
    {
        return $faker->randomElements(
            ApiExtensionSeeder::tags(), 
            mt_rand(1, count(ApiExtensionSeeder::tags()))
        );
    }
}
