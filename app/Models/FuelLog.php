<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FuelLog extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'driver_id',
        'vehicle_id',
        'liters',
        'cost',
        'filled_at',
        'odometer',
    ];

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
