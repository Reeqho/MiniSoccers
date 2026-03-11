<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Field>
 */
class FieldFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => 'Lapangan ' . fake()->randomLetter(),
            'type' => fake()->randomElement([
                'Rumput Sintetis',
                'Vinyl Indoor'
            ]),
            'price_per_hour' => fake()->randomElement([
                120000,
                150000,
                180000
            ]),
            'description' => fake()->sentence()
        ];
    }
}
