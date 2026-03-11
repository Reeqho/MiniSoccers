<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Booking;
use App\Models\Field;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => "admin123",
            'role' => 'admin'
        ]);

        // 20 user
        User::factory(20)->create();

        // 5 lapangan
        Field::factory(5)->create();

        // 100 booking
        Booking::factory(100)->create();

        // 100 payment
        Payment::factory(100)->create();
    }
}
