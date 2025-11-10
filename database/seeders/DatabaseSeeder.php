<?php

namespace Database\Seeders;


use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;

use App\Models\Vehicle;
use App\Models\Driver;
use App\Models\Customer;
use App\Models\Rental;
use App\Models\Maintenance;
use App\Models\Payment;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // --- Admin (idempotent) ---
        User::updateOrCreate(
            ['email' => 'admin@fleetflow.test'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password'), // change later in .env / UI
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );

        // --- Extra users (unique emails via factory) ---
        User::factory(4)->create();

        // --- Core entities ---
        Vehicle::factory(15)->create();
        Driver::factory(8)->create();
        Customer::factory(10)->create();

        // Collect IDs for relationships
        $vehicleIds  = Vehicle::query()->pluck('id')->all();
        $customerIds = Customer::query()->pluck('id')->all();


        // --- Rentals (link to existing customers & vehicles) ---
        $rates = [60, 75, 100, 125, 150, 175, 200, 225];

        Rental::factory(20)
            ->state(function () use ($customerIds, $vehicleIds, $rates) {
                $days = rand(1, 7);
                $rate = Arr::random($rates);

                return [
                    'customer_id' => Arr::random($customerIds),
                    'vehicle_id'  => Arr::random($vehicleIds),
                    'status'      => Arr::random(['pending','approved','completed','cancelled']),
                    // use total_cost (and do NOT set total_price)
                    'total_cost'  => $days * $rate,
                ];
            })
            ->create();

        // --- Maintenance (link to existing vehicles) ---
        Maintenance::factory(25)
            ->state(fn () => [
                'vehicle_id' => Arr::random($vehicleIds),
            ])
            ->create();

        // Payment (driver-linked)  ← ADD THIS BLOCK
        Payment::class::factory(20)->create();
    }
}
