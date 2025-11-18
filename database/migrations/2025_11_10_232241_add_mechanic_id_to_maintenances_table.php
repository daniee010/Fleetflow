<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('maintenances', function (Blueprint $table) {
            // Check if column exists before adding
            if (!Schema::hasColumn('maintenances', 'mechanic_id')) {
                $table->foreignId('mechanic_id')
                    ->nullable()
                    ->after('vehicle_id')
                    ->constrained('mechanics')
                    ->nullOnDelete();
            } else {
                // Column exists, just add the foreign key constraint if missing
                $this->addForeignKeyIfMissing();
            }
        });
    }

    private function addForeignKeyIfMissing(): void
    {
        // Use Laravel's schema methods to check for foreign key
        $foreignKeys = Schema::getConnection()
            ->getDoctrineSchemaManager()
            ->listTableForeignKeys('maintenances');

        $hasMechanicForeignKey = false;
        foreach ($foreignKeys as $foreignKey) {
            if (in_array('mechanic_id', $foreignKey->getColumns())) {
                $hasMechanicForeignKey = true;
                break;
            }
        }

        if (!$hasMechanicForeignKey) {
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
            // Don't drop the column to avoid data loss
        });
    }
};
