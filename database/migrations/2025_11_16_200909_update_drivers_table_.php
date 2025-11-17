<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('drivers', function (Blueprint $table) {

            // New fields
            if (!Schema::hasColumn('drivers', 'name')) {
                $table->string('name')->after('user_id');
            }

            if (!Schema::hasColumn('drivers', 'vehicle_id')) {
                $table->foreignId('vehicle_id')->nullable()
                    ->constrained('vehicles')->nullOnDelete()
                    ->after('user_id');
            }

            if (!Schema::hasColumn('drivers', 'license_expiry')) {
                $table->date('license_expiry')->nullable()->after('license_number');
            }

            if (!Schema::hasColumn('drivers', 'avatar_path')) {
                $table->string('avatar_path')->nullable()->after('address');
            }

            if (!Schema::hasColumn('drivers', 'city')) {
                $table->string('city')->nullable()->after('address');
            }

            if (!Schema::hasColumn('drivers', 'country')) {
                $table->string('country')->nullable()->after('city');
            }

            // Expand status options
            $table->enum('status', ['active','inactive','suspended','pending'])
                ->default('active')
                ->change();
        });
    }

    public function down(): void
    {
        Schema::table('drivers', function (Blueprint $table) {
            $table->dropColumn(['name','vehicle_id','license_expiry','avatar_path','city','country']);
        });
    }
};
