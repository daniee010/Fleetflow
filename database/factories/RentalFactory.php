<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class RentalFactory extends Factory
{
    public function definition(): array
    {
        $start = $this->faker->dateTimeBetween('-30 days', '+10 days');
        $end   = (clone $start)->modify('+' . $this->faker->numberBetween(1, 7) . ' days');
        $days      = (new Carbon($start))->diffInDays(new Carbon($end)) ?: 1;
        $dailyRate = $this->faker->randomFloat(2, 25, 250);

        return [
            // use existing IDs if present; otherwise let factories create
            'customer_id' => Customer::query()->inRandomOrder()->value('id') ?? Customer::factory(),
            'vehicle_id'  => Vehicle::query()->inRandomOrder()->value('id') ?? Vehicle::factory(),

            //Eloquent can handle DateTime instances
            'start_date'  => Carbon::instance($start),
            'end_date'    => Carbon::instance($end),
            // IMPORTANT: use total_cost, not total_price
            'total_cost'  => $days * $dailyRate,

            'status'      => $this->faker->randomElement(['pending','approved','completed','cancelled']),
        ];
    }

}
