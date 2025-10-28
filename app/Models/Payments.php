<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Payments extends Model
{
    use HasFactory;

    public function rental()
    {
        // payments.rental_id
        return $this->belongsTo(Rental::class);
    }

    // Optional: driver payout via contract
    public function workAndPayContract()
    {
        // payments.work_and_pay_contract_id (if you add it)
        return $this->belongsTo(WorkAndPayContract::class);
    }
}
