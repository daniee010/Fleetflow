<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        'maintenance_id','vehicle_id','expense_date','category',
        'amount','description','notes',
    ];

    protected $casts = [
        'expense_date' => 'datetime',
        'amount' => 'decimal:2',

    ];
    public function vehicle()
    {
        // expenses.vehicle_id
        return $this->belongsTo(Vehicle::class);
    }

    public function maintenance(){
        return $this->belongsTo(Maintenance::class);
    }

    // Who recorded the expense (optional but useful for audit)
    public function recordedBy()
    {
        // expenses.recorded_by -> users.id
        return $this->belongsTo(User::class, 'recorded_by');
    }
}
