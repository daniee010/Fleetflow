<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Driver>
 */
class DriverFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'license_number' => strtoupper(fake()->bothify('DRV-#####')),
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'status' => 'active',
        ];
    }
}
