<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model

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
        return $this->hasMany(Expense::class);
    }

    // If a contracts ties a driver to a specific vehicle
    public function WorkAndPayContract()
    {
        return $this->hasMany(WorkAndPayContract::class);
    }

    public function getSchemeLabelAttribute(): string
    {
        return match ($this->status) {
            'sales'    => 'Sales Vehicle',
            'contract' => 'Work & Pay Vehicle',
            'rented'   => 'Rental Vehicle',
            default    => 'Pool / General Fleet',
        };
    }

    // For now, we treat daily_rate as the weekly payment when status is sales/contract
    public function getWeeklyPaymentAttribute(): ?float
    {
        if (in_array($this->status, ['sales', 'contract'])) {
            return $this->daily_rate;
        }

        return null;
    }
}

