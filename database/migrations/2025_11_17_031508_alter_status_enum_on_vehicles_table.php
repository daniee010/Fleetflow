<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Update the ENUM for status to include 'sales' and 'contract'
        DB::statement("
            ALTER TABLE vehicles
            MODIFY status ENUM('available', 'maintenance', 'rented', 'sales', 'contract')
            NOT NULL DEFAULT 'available'
        ");
    }

    public function down(): void
    {
        // Roll back to the old set (adjust if your original was different)
        DB::statement("
            ALTER TABLE vehicles
            MODIFY status ENUM('available', 'maintenance', 'rented')
            NOT NULL DEFAULT 'available'
        ");
    }
};
