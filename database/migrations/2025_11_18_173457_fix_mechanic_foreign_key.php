<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Only add foreign key if mechanics table exists and column exists
        if (Schema::hasTable('mechanics') && Schema::hasColumn('maintenances', 'mechanic_id')) {
            Schema::table('maintenances', function (Blueprint $table) {
                $table->foreign('mechanic_id')
                    ->references('id')
                    ->on('mechanics')
                    ->nullOnDelete();
            });
        }
    }

    public function down(): void
    {
        Schema::table('maintenances', function (Blueprint $table) {
            $table->dropForeign(['mechanic_id']);
        });
    }
};
