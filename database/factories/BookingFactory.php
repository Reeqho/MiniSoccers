<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Field;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $start = fake()->numberBetween(8, 20);
        $duration = fake()->numberBetween(1, 2);
        return [
            //
            'user_id' => User::inRandomOrder()->first()->id,
            'field_id' => Field::inRandomOrder()->first()->id,
            'date' => fake()->dateTimeBetween('now', '+30 days'),
            'start_time' => $start . ':00:00',
            'end_time' => ($start + $duration) . ':00:00',
            'total_price' => fake()->randomElement([
                150000,
                300000
            ]),
            'status' => fake()->randomElement([
                'pending',
                'paid'
            ])
        ];
    }
}
