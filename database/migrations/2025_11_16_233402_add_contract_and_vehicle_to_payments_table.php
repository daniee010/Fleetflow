<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            // Add vehicle_id if not already there
            if (!Schema::hasColumn('payments', 'vehicle_id')) {
                $table->foreignId('vehicle_id')
                    ->nullable()
                    ->constrained('vehicles')
                    ->nullOnDelete();
            }

            // Add work_and_pay_contract_id if not already there
            if (!Schema::hasColumn('payments', 'work_and_pay_contract_id')) {
                $table->foreignId('work_and_pay_contract_id')
                    ->nullable()
                    ->constrained('work_and_pay_contracts')
                    ->nullOnDelete();
            }
        });
    }

    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            if (Schema::hasColumn('payments', 'work_and_pay_contract_id')) {
                $table->dropForeign(['work_and_pay_contract_id']);
                $table->dropColumn('work_and_pay_contract_id');
            }

            if (Schema::hasColumn('payments', 'vehicle_id')) {
                $table->dropForeign(['vehicle_id']);
                $table->dropColumn('vehicle_id');
            }
        });
    }
};
