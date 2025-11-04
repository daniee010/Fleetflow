<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle>
 */
class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $brand = $this->faker->randomElement([
            'Toyota','Honda','Nissan','Ford','Hyundai','Kia','BMW','Mercedes'
        ]);

        return [
            'plate_number' => strtoupper($this->faker->bothify('??-####')),
            'make'         => $this->faker->randomElement(['Toyota','Ford','Honda','Nissan','Hyundai','Tesla']),
            'model'        => $this->faker->word(),
            'year'         => $this->faker->numberBetween(2005, now()->year),
            'color'        => $this->faker->safeColorName(),
            'daily_rate'   => $this->faker->randomFloat(2, 40, 250),
            'status'       => $this->faker->randomElement(['available','maintenance','rented']),
        ];
    }
}
