<?php

namespace Database\Factories;

use App\Models\ApiExtension;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Extension>
 */
class ExtensionFactory extends Factory
{
    public static $api_extensions_cache;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $api_extension_id = $this->faker->unique()->numberBetween(1, self::getApiExtensions()->count());
        $api_extension = self::getApiExtensions()->find($api_extension_id);
                
        return [
            'api_extension_info' => json_encode($api_extension->info_array),
            'api_extension_id' => $api_extension->id,
        ];
    }

    public static function getApiExtensions()
    {
        if( is_null(self::$api_extensions_cache) )
            self::$api_extensions_cache = ApiExtension::all();

        return self::$api_extensions_cache;
    }
}
