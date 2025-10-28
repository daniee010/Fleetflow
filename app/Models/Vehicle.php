<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
// app/Models/Vehicle.php
{
    use HasFactory;

    public function driver()
    {
        return $this->hasOne(Driver::class);
    }

    public function maintenanceRecords()
    {
        return $this->hasMany(Maintenance::class);
    }

    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }

    // If a contract ties a driver to a specific vehicle
    public function workAndPayContracts()
    {
        return $this->hasMany(WorkAndPayContract::class);
    }
}

