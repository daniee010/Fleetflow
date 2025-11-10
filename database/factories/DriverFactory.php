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
            'name'           => $this->faker->name(),
            'email'          => $this->faker->safeEmail(),
            'phone'          => $this->faker->phoneNumber(),
            'license_number' => strtoupper($this->faker->bothify('??######')),
            'address'        => $this->faker->address(),
            'vehicle_id'     => \App\Models\Vehicle::inRandomOrder()->value('id'), // may be null if none
        ];
    }
}
