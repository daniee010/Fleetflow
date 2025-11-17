<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;

    // Scheme type constants – easier to reuse in code
    public const SCHEME_SALES_ONLY = 'sales_only';
    public const SCHEME_WORK_AND_PAY = 'work_and_pay';
    public const SCHEME_MIXED = 'mixed';

    protected $fillable = [
        'user_id',
        'vehicle_id',
        'name',
        'phone',
        'license_number',
        'license_expiry',
        'address',
        'city',
        'country',
        'status',
        'avatar_path',
        'scheme_type', // 🔹 new
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function trips()
    {
        return $this->hasMany(Trip::class);
    }

    public function fuelLogs()
    {
        return $this->hasMany(FuelLog::class);
    }

    public function workAndPayContracts()
    {
        return $this->hasMany(WorkAndPayContract::class);
    }

    public function activeWorkAndPayContract()
    {
        return $this->hasOne(WorkAndPayContract::class)->where('status', 'active');
    }

    public function latestPayment()
    {
        return $this->hasOne(Payment::class)->latestOfMany();
    }

    public function salesPayments()
    {
        return $this->hasMany(\App\Models\Payment::class)
            ->where('payment_type', 'sales');
    }

    /*
    |--------------------------------------------------------------------------
    | Helper methods (business logic)
    |--------------------------------------------------------------------------
    */

    public function isSalesOnly(): bool
    {
        return $this->scheme_type === self::SCHEME_SALES_ONLY;
    }

    public function isWorkAndPay(): bool
    {
        return $this->scheme_type === self::SCHEME_WORK_AND_PAY;
    }

    public function isMixed(): bool
    {
        return $this->scheme_type === self::SCHEME_MIXED;
    }

    public function totalPaid(): float
    {
        return (float) $this->payments()->sum('amount');
    }

    public function tripsThisMonth(): int
    {
        return $this->trips()
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();
    }

    public function revenueThisMonth(): float
    {
        return (float) $this->trips()
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('revenue_amount');
    }

    /*
    |--------------------------------------------------------------------------
    | Query scopes
    |--------------------------------------------------------------------------
    */

    public function scopeSalesOnly($query)
    {
        return $query->where('scheme_type', self::SCHEME_SALES_ONLY);
    }

    public function scopeWorkAndPay($query)
    {
        return $query->where('scheme_type', self::SCHEME_WORK_AND_PAY);
    }

    public function scopeMixed($query)
    {
        return $query->where('scheme_type', self::SCHEME_MIXED);
    }
}
