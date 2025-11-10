<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class WorkAndPayContract extends Model
{
    use HasFactory;

    protected $table = 'work_and_pay_contracts';

    protected $fillable = [
        'driver_id',
        'vehicle_id',
        'start_date',
        'end_date',
        'weekly_payment',
        'status',
        'notes',
    ];
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
