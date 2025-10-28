<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    // If you tie a customer to a user account (optional)
    public function user()
    {
        // customers.user_id
        return $this->belongsTo(User::class);
    }

    public function rentals()
    {
        // rentals.customer_id
        return $this->hasMany(Rental::class);
    }

    // If payments are recorded per rental (typical), you’ll reach payments via rentals
    public function payments()
    {
        return $this->hasManyThrough(
            Payment::class,
            Rental::class,
            // rentals.customer_id
            'customer_id',
            // payments.rental_id
            'rental_id',
            // customers.id
            'id',
            // rentals.id
            'id'
        );
    }
}
