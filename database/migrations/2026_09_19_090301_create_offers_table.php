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
        Schema::create('offers', function (Blueprint $table) {
            $table->id();

            // Business
            $table->foreignId('business_id')
                ->constrained()
                ->cascadeOnDelete();

            // Basic Offer Information
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();

            // Offer / Discount
            $table->enum('discount_type', [
                'percentage',
                'fixed',
                'none',
            ])->default('none');

            $table->decimal('discount_value', 12, 2)->nullable();
            $table->decimal('minimum_purchase', 12, 2)->nullable();
            $table->decimal('maximum_discount', 12, 2)->nullable();

            // Coupon
            $table->string('coupon_code')->nullable()->unique();

            // Validity
            $table->dateTime('starts_at')->nullable();
            $table->dateTime('ends_at')->nullable();

            // Terms
            $table->longText('terms_conditions')->nullable();

            // Display / Status
            $table->boolean('is_featured')->default(false);
            $table->boolean('status')->default(true);
            $table->unsignedInteger('sort_order')->default(0);

            $table->timestamps();

            // Indexes
            $table->index(['business_id', 'status']);
            $table->index(['is_featured', 'status']);
            $table->index(['starts_at', 'ends_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};
