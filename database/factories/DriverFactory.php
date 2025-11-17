<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Vehicle;
use App\Models\User;

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
            'user_id'        => User::factory(),   // <-- puts name/email/password on users table
            //'email'          => $this->faker->safeEmail(),
            'name'           => $this->faker->name(),
            'phone'          => $this->faker->phoneNumber(),
            'license_number' => strtoupper($this->faker->bothify('??######')),
            'address'        => $this->faker->address(),
            'vehicle_id'     => \App\Models\Vehicle::inRandomOrder()->value('id'), // may be null if none
        ];
    }
}
