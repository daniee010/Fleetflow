<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BackfillMaintenanceExpensesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        \App\Models\Maintenance::with('expense')->chunk(200, function ($chunk) {
            foreach ($chunk as $m) {
                if (!$m->expense) {
                    \App\Models\Expense::create([
                        'maintenance_id' => $m->id,
                        'expense_date' => $m->service_date,
                        'category' => 'maintenance',
                        'amount' => $m->cost,
                        'vehicle_id' => $m->vehicle_id,
                        'description'    => "Maintenance: {$m->service_type} on {$m->service_date}",
                        'notes' => "Auto from maintenance #{$m->id} ({$m->service_type})",
                    ]);
                }
            }
        });
        }
}
