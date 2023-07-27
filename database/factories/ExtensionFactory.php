<?php

namespace Database\Factories;

use App\Models\FakeApiExtension;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Extension>
 */
class ExtensionFactory extends Factory
{
    public $fake_api_extensions_cache;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $fake_api_extension_id = $this->faker->unique()->numberBetween(1, $this->fakeApiExtensions()->count());
        $fake_api_extension = $this->fakeApiExtensions()->find($fake_api_extension_id);
                
        return [
            'api_extension_id' => $fake_api_extension->id,
            'name' => $fake_api_extension->name,
            'classname' => $fake_api_extension->classname,
            'description' => $fake_api_extension->description,
        ];
    }

    public function fakeApiExtensions()
    {
        if( is_null($this->fake_api_extensions_cache) )
            $this->fake_api_extensions_cache = FakeApiExtension::all();

        return $this->fake_api_extensions_cache;
    }
}
