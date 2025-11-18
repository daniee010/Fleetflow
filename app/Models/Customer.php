<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = ['name','email','phone','address'];

    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }

    public function payments()
    {
        return $this->hasManyThrough(
            Payment::class,
            Rental::class,
            'customer_id',
            'rental_id',
            'id',
            'id'
        );
    }
}
