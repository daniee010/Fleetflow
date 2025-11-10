<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'driver_id',
        'rental_id',
        'amount',
        'payment_date',
        'payment_type',
        'notes',
    ];
    public function rental(){
        return $this->belongsTo(Rental::class);
    }
    public function driver()
    {
        // payments.rental_id
        return $this->belongsTo(Driver::class);
    }

    // Optional: driver payout via contract
    public function workAndPayContract()
    {
        // payments.work_and_pay_contract_id (if you add it)
        return $this->belongsTo(WorkAndPayContract::class);
    }
}
