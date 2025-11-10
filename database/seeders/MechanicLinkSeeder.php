<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Mechanic;
use App\Models\User;
use App\Models\Maintenance;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class MechanicLinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $generalUser = User::firstOrCreate(
            ['email' => 'general.mechanic@fleetflow.test'],
            [
                'name' => 'General Mechanic',
                'password' => bcrypt('password'),
                'role' => 'mechanic',
                'email_verified_at' => now(),
            ]
        );

        $generalist = Mechanic::firstOrCreate(
            ['user_id' => $generalUser->id],
            ['phone' => '555-0100', 'specialization' => 'general']
        );

        $generalist = Mechanic::firstOrCreate(
            ['user_id' => $generalUser->id],
            ['phone' => '555-0100', 'specialization' => 'general']
        );

        $bySpec = Mechanic::all()->groupBy('specialization');

        Maintenance::query()
            ->whereNull('mechanic_id')
            ->orderBy('id')
            ->chunk(200, function ($chunk) use ($bySpec, $generalist) {
                foreach ($chunk as $m) {
                    $bucket = $bySpec->get($m->service_type);
                    $mechanic = $bucket && $bucket->isNotEmpty()
                        ? $bucket->random()
                        : $generalist;

                    $m->update(['mechanic_id' => $mechanic->id]);
                }
            });
    }


}
