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

            $table->id();

            // Business
            $table->foreignId('business_id')
                ->constrained('businesses')
                ->cascadeOnDelete();

            // Customer / User
            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            // Booking service
            $table->foreignId('business_service_id')
                ->nullable()
                ->constrained('business_services')
                ->nullOnDelete();

            // Customer information
            $table->string('customer_name');
            $table->string('customer_email')->nullable();
            $table->string('customer_phone');

            // Booking details
            $table->date('booking_date');
            $table->time('booking_time');

            $table->text('notes')->nullable();

            // pending, confirmed, completed, cancelled
            $table->string('status')->default('pending');

            // Admin notes
            $table->text('admin_notes')->nullable();

            $table->timestamps();

            // Faster admin filtering
            $table->index(['business_id', 'booking_date']);
            $table->index(['status', 'booking_date']);
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
