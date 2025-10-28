<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class WorkAndPayContract extends Model
{
    use HasFactory;

    public function driver()
    {
        // work_and_pay_contracts.driver_id
        return $this->belongsTo(Driver::class);
    }

    public function vehicle()
    {
        // work_and_pay_contracts.vehicle_id (recommended)
        return $this->belongsTo(Vehicle::class);
    }

    // If you pay drivers via a payments table linked to the contract
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
