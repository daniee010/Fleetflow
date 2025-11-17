<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'driver_id',
        'vehicle_id',
        'rental_id',
        'work_and_pay_contract_id',
        'amount',
        'payment_date',
        'payment_type',
        'notes',
    ];


    public function rental()
    {
        return $this->belongsTo(Rental::class);
    }

    public function driver()
    {

        return $this->belongsTo(Driver::class);
    }

    // Optional: driver payout via contracts
    public function workAndPayContract()
    {
        // payments.work_and_pay_contract_id (if you add it)
        return $this->belongsTo(WorkAndPayContract::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function getTypeLabelAttribute(): string
    {
        return match ($this->payment_type) {
            'rental'   => 'Customer Rental',
            'contract' => 'Work & Pay Contract',
            'sales'    => 'Sales Driver Payment',
            default    => ucfirst((string) $this->payment_type ?: 'Unknown'),
        };
    }

}
