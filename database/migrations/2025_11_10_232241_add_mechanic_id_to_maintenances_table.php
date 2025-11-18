<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('maintenances', function (Blueprint $table) {
            // Check if column already exists before adding
            if (!Schema::hasColumn('maintenances', 'mechanic_id')) {
                $table->foreignId('mechanic_id')
                    ->nullable()
                    ->after('vehicle_id');
            }

            // If column exists but no foreign key, add the constraint
            if (Schema::hasColumn('maintenances', 'mechanic_id')) {
                // Check if foreign key doesn't exist
                $sm = Schema::getConnection()->getDoctrineSchemaManager();
                $indexes = $sm->listTableIndexes('maintenances');
                $hasForeignKey = false;

                foreach ($indexes as $index) {
                    if ($index->isForeignKey() && in_array('mechanic_id', $index->getColumns())) {
                        $hasForeignKey = true;
                        break;
                    }
                }

                if (!$hasForeignKey) {
                    $table->foreign('mechanic_id')
                        ->references('id')
                        ->on('mechanics')
                        ->nullOnDelete();
                }
            }
        });
    }

    public function down(): void
    {
        // Don't drop the column in down() since it might contain data
        Schema::table('maintenances', function (Blueprint $table) {
            $table->dropForeign(['mechanic_id']);
            // Note: We're not dropping the column to avoid data loss
        });
    }
};
