<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        //'email',
        'phone',
        'license_number',
        'address',
    ];

    public function user() {
        return $this->belongsTo(User::class); }

    // Each driver can be assigned a vehicle
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    // Each driver may have multiple payments
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
