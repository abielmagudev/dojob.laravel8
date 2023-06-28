<?php

namespace Database\Factories;

use App\Models\ApiExtension;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ApiExtension>
 */
class ApiExtensionFactory extends Factory
{
    public $stock;

    public function definition(): array
    {
        if( is_null($this->stock) )
            $this->stock = ApiExtension::stockByClasses();

        $api_extension = current($this->stock);
        
        next($this->stock);

        return [
            'model_class' => $api_extension['model_class'],
            'controller_class' => $api_extension['controller_class'],
            'tags_csv_format' => implode(',', 
                $this->faker->randomElements([
                    'carpenter',
                    'cooling',
                    'heater',
                    'inspection',
                    'insulation',
                    'maintenance', 
                    'painting', 
                    'testing',
                    'weatherization', 
                ], 3)
            ),
            'price' => $this->faker->optional()->randomFloat(2, 1, 500),
        ];
    }
}
