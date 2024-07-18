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
        Schema::create('bookings', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('tenant_name');
            $table->foreignUuid('vehicle_id')->constrained('vehicles');
            $table->foreignUuid('admin_id')->constrained('users');
            $table->foreignUuid('driver_id')->constrained('drivers');
            $table->integer('level')->default(0);
            $table->enum('status', ['pending', 'acc', 'expired', 'rejected'])->default('pending');
            $table->date('start_date');
            $table->date('end_date');
            $table->date('accepted_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
