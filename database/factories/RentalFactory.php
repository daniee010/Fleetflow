<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Vehicle;
use App\Models\Rental;
use Illuminate\Database\Eloquent\Factories\Factory;

class RentalFactory extends Factory
{
    public function definition(): array
    {
        $start = $this->faker->dateTimeBetween('-30 days', '-1 day');
        $days  = $this->faker->numberBetween(1, 10);
        $end   = (clone $start)->modify("+{$days} days");

        $dailyRate = $this->faker->numberBetween(50, 250);

        return [
            // use existing IDs if present; otherwise let factories create
            'customer_id' => Customer::query()->inRandomOrder()->value('id') ?? Customer::factory(),
            'vehicle_id'  => Vehicle::query()->inRandomOrder()->value('id') ?? Vehicle::factory(),

            //Eloquent can handle DateTime instances
            'start_date'  => $start,
            'end_date'    => $end,

            // IMPORTANT: use total_cost, not total_price
            'total_cost'  => $days * $dailyRate,

            'status'      => $this->faker->randomElement(['booked', 'active', 'completed', 'cancelled']),
        ];
    }

}
