<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    use HasFactory;

    protected $table = 'maintenances';

    public const SERVICE_TYPES = [
        'oil_change',
        'tire_rotation',
        'inspection',
        'brake_service',
        'engine_repair',
        'transmission_service',
        'battery_replacement',
        'alignment',
    ];

    protected $fillable = [
        'vehicle_id','service_date','service_type','cost','notes',
        // 'mechanic_id', // include only if the column exists
    ];

    protected $casts = [
        'service_date' => 'date',
        'cost'         => 'decimal:2',
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function mechanic()
    {
        return $this->belongsTo(Mechanic::class, 'mechanic_id'); // remove if column doesn’t exist
    }

    public function expense()
    {
        return $this->hasOne(Expense::class, 'maintenance_id'); // ✅ correct FK
    }

    public function scopeRecent($query)
    {
        return $query->orderByDesc('service_date');
    }
}
