<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Arr;
use App\Models\Maintenance;
use App\Models\Vehicle;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Maintenance>
 */
class MaintenanceFactory extends Factory
{
    use HasFactory;
    protected $model = Maintenance::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'vehicle_id'   => Vehicle::query()->inRandomOrder()->value('id') ?? Vehicle::factory(),
            'service_date' => $this->faker->dateTimeBetween('-6 months', 'now'),
            'service_type' => Arr::random(Maintenance::SERVICE_TYPES),
            'cost'         => $this->faker->numberBetween(50, 1500,),
            'notes'        => $this->faker->sentence(),
        ];
    }
}
