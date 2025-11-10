<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Maintenance;

class Mechanic extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','phone','specialization'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function maintenances() {
        return $this->hasMany(Maintenance::class);
    }
}

