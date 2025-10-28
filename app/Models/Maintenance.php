<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Maintenance extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_id', 'service_date', 'service_type', 'cost', 'notes',
    ];
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class); // maintenance.vehicle_id
    }

    // If you store who handled it (mechanic_id -> users.id)
    public function mechanic()
    {
        return $this->belongsTo(User::class, 'mechanic_id');
    }
}
