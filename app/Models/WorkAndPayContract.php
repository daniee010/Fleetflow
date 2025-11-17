<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Driver;
use App\Models\Vehicle;

class WorkAndPayContract extends Model
{
    use HasFactory;

    protected $table = 'work_and_pay_contracts';

    protected $fillable = [
        'driver_id',
        'vehicle_id',
        'start_date',
        'end_date',
        'total_amount',
        'amount_paid',
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

    // If you pay drivers via a payments table linked to the contracts
    public function payments()
    {
        return $this->hasMany(Payment::class, 'work_and_pay_contract_id');
    }

    public function getBalanceAttribute()
    {
        return $this->total_amount - $this->amount_paid;
    }

    public function getProgressPercentAttribute()
    {
        if ($this->total_amount <= 0) {
            return 0;
        }

        return round(($this->amount_paid / $this->total_amount) * 100);
    }
}
