<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Booking;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory


{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'booking_id' => Booking::inRandomOrder()->first()->id,
            'method' => fake()->randomElement([
                'Transfer Bank',
                'E-Wallet',
                'Cash'
            ]),
            'amount' => fake()->randomElement([
                150000,
                300000
            ]),
            'status' => fake()->randomElement([
                'success',
                'pending'
            ])
        ];
    }
}
