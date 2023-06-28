<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'job_id' => $this->faker->numberBetween(1, 10),
            'scheduled_date' => $this->faker->dateTimeBetween('- 1 year', 'now', 'America/Matamoros'),
            'scheduled_time' => $this->faker->time(),
            'notes' => $this->faker->optional()->text(128),
        ];
    }
}
