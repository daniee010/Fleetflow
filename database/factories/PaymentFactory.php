<?php

namespace Database\Factories;

use App\Models\Driver;
use App\Models\Payment;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    protected $model = Payment::class;

    public function definition(): array
    {
        return [
            'driver_id'    => Driver::query()->inRandomOrder()->value('id') ?? Driver::factory(),
            'amount'       => $this->faker->randomFloat(2, 50, 1500),
            'payment_date' => $this->faker->dateTimeBetween('-6 months', 'now'),
            'payment_type' => $this->faker->randomElement(['rental','contract']),
            'notes'        => $this->faker->optional()->sentence(),
        ];
    }
}
