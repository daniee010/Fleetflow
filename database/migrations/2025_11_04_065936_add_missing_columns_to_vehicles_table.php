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
        Schema::table('vehicles', function (Blueprint $table) {
            //
            if (!Schema::hasColumn('vehicles', 'plate_number')) {
                $table->string('plate_number')->unique()->after('id');
            }
            if (!Schema::hasColumn('vehicles', 'make')) {
                $table->string('make')->nullable()->after('plate_number');
            }
            if (!Schema::hasColumn('vehicles', 'model')) {
                $table->string('model')->nullable()->after('make');
            }
            if (!Schema::hasColumn('vehicles', 'year')) {
                $table->unsignedSmallInteger('year')->nullable()->after('model');
            }
            if (!Schema::hasColumn('vehicles', 'color')) {
                $table->string('color')->nullable()->after('year');
            }
            if (!Schema::hasColumn('vehicles', 'daily_rate')) {
                $table->decimal('daily_rate', 10, 2)->default(0)->after('color');
            }
            if (!Schema::hasColumn('vehicles', 'status')) {
                // keep in sync with your factory/seeders: available | rented | maintenance
                $table->enum('status', ['available','rented','maintenance'])
                    ->default('available')
                    ->after('daily_rate');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vehicles', function (Blueprint $table) {
            //
            foreach (['status','daily_rate','color','year','model','make','plate_number'] as $col) {
                if (Schema::hasColumn('vehicles', $col)) {
                    $table->dropColumn($col);
                }
            }
        });
    }
};
