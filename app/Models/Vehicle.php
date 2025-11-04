<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
// app/Models/Vehicle.php
{
    use HasFactory;

    protected $fillable = [
        'plate_number',
        'make',
        'model',
        'year',
        'color',
        'daily_rate',
        'status', // available, maintenance, rented
    ];

    public function driver()
    {
        return $this->hasOne(Driver::class);
    }

    public function rental()
    {
        return $this->hasOne(Rental::class);
    }

    public function maintenance()
    {
        return $this->hasMany(Maintenance::class);
    }


    public function expenses()
    {
        return $this->hasMany(Expenses::class);
    }

    // If a contract ties a driver to a specific vehicle
    public function WorkAndPayContract()
    {
        return $this->hasMany(WorkAndPayContract::class);
    }
}

