<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('expenses', function (Blueprint $table) {
            // Add vehicle_id if your table doesn't have it yet
            if (!Schema::hasColumn('expenses', 'vehicle_id')) {
                $table->foreignId('vehicle_id')
                    ->nullable()
                    ->constrained('vehicles')
                    ->nullOnDelete()
                    ->after('id');
            }
            // Add maintenance_id (no "after" to avoid the error)
            if (!Schema::hasColumn('expenses', 'maintenance_id')) {
                $table->foreignId('maintenance_id')
                    ->nullable()
                    ->constrained('maintenances') // plural form here
                    ->cascadeOnDelete()
                    ->after('vehicle_id');
            }

            if (!Schema::hasColumn('expenses', 'expense_date')) {
                $table->date('expense_date')->nullable()->after('maintenance_id');
            }
            if (!Schema::hasColumn('expenses', 'category')) {
                $table->string('category', 50)->default('maintenance')->after('expense_date');
            }
            if (!Schema::hasColumn('expenses', 'amount')) {
                $table->decimal('amount', 10, 2)->default(0)->after('category');
            }
            if (!Schema::hasColumn('expenses', 'notes')) {
                $table->text('notes')->nullable()->after('amount');
            }

            // ✅ Unique constraint: only one expense per maintenance
            if (Schema::hasColumn('expenses', 'maintenance_id')) {
                $table->unique('maintenance_id', 'expenses_maintenance_id_unique');
            }
        });
    }

    public function down(): void
    {
        Schema::table('expenses', function (Blueprint $table) {
            if (Schema::hasColumn('expenses', 'maintenance_id')) {
                $table->dropUnique('expenses_maintenance_id_unique');
                $table->dropConstrainedForeignId('maintenance_id');
            }
            if (Schema::hasColumn('expenses', 'vehicle_id')) {
                $table->dropConstrainedForeignId('vehicle_id');
            }
            if (Schema::hasColumn('expenses', 'expense_date')) $table->dropColumn('expense_date');
            if (Schema::hasColumn('expenses', 'category')) $table->dropColumn('category');
            if (Schema::hasColumn('expenses', 'amount')) $table->dropColumn('amount');
            if (Schema::hasColumn('expenses', 'notes')) $table->dropColumn('notes');
        });
    }
};
