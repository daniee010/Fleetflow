<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;

use App\Models\User;
use App\Models\Vehicle;
use App\Models\Driver;
use App\Models\Customer;
use App\Models\Rental;
use App\Models\Maintenance;
use App\Models\Payment;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin (idempotent)
        User::updateOrCreate(
            ['email' => 'admin@fleetflow.test'],
            [
                'name'              => 'Admin',
                'password'          => Hash::make('password'),
                'role'              => 'admin',
                'email_verified_at' => now(),
            ]
        );

        // Extra users
        User::factory(4)->create();

        // Core entities
        Vehicle::factory(15)->create();
        Driver::factory(8)->create();
        Customer::factory(10)->create();

        // Collect IDs
        $vehicleIds  = Vehicle::pluck('id')->all();
        $customerIds = Customer::pluck('id')->all();

        // Rentals
        $rates = [60, 75, 100, 125, 150, 175, 200, 225];

        Rental::factory(20)
            ->state(function () use ($customerIds, $vehicleIds, $rates) {
                $days = rand(1, 7);
                $rate = Arr::random($rates);

                return [
                    'customer_id' => Arr::random($customerIds),
                    'vehicle_id'  => Arr::random($vehicleIds),
                    'status'      => Arr::random(['pending','approved','completed','cancelled']),
                    'total_cost'  => $days * $rate,
                ];
            })
            ->create();

        // Grab rental IDs now that rentals exist
        $rentalIds  = Rental::pluck('id')->all();
        $driverIds  = Driver::pluck('id')->all(); // optional, if you also want to link drivers

        // Maintenance
        Maintenance::factory(25)
            ->state(fn () => ['vehicle_id' => Arr::random($vehicleIds)])
            ->create();

        // Payments (link to rentals, and optionally drivers)
        Payment::factory(20)
            ->state(fn () => [
                'rental_id'    => Arr::random($rentalIds),
                // if your payments table has driver_id and you want it set:
                'driver_id'    => Arr::random($driverIds), // remove if not desired
                // you can also set payment_type here if you want a mix:
                // 'payment_type' => Arr::random(['rental','contract']),
            ])
            ->create();
    }
}
