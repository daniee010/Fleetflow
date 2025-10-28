<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('rentals', function (Blueprint $table) {
            //
            if (! Schema::hasColumn('rentals', 'total_price')) {
                $table->decimal('total_price', 10, 2)->default(0);
            }
            if (! Schema::hasColumn('rentals', 'status')) {
                // SQLite has no ENUM; use string
                $table->string('status')->default('booked');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rentals', function (Blueprint $table) {
            //
            if (Schema::hasColumn('rentals', 'total_price')) {
                $table->dropColumn('total_price');
            }
            if (Schema::hasColumn('rentals', 'status')) {
                $table->dropColumn('status');
            }
        });
    }
};
