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
        Schema::table('bookings', function (Blueprint $table) {

            $table->foreignId('offer_id')
                ->nullable()
                ->after('business_service_id')
                ->constrained('offers')
                ->nullOnDelete();

            $table->decimal('original_amount', 12, 2)
                ->nullable()
                ->after('booking_time');

            $table->decimal('discount_amount', 12, 2)
                ->default(0)
                ->after('original_amount');

            $table->decimal('final_amount', 12, 2)
                ->nullable()
                ->after('discount_amount');
        });
    }

    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {

            $table->dropForeign(['offer_id']);

            $table->dropColumn([
                'offer_id',
                'original_amount',
                'discount_amount',
                'final_amount',
            ]);
        });
    }
};
