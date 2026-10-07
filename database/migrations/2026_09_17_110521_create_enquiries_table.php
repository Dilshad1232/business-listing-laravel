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
        Schema::create('enquiries', function (Blueprint $table) {

            $table->id();

            // Business
            $table->foreignId('business_id')
                ->constrained('businesses')
                ->cascadeOnDelete();

            // Product - nullable because enquiry can be for a business
            // or specifically for a product
            $table->foreignId('product_id')
                ->nullable()
                ->constrained('products')
                ->nullOnDelete();

            // User - nullable for guest enquiries
            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            // Customer Information
            $table->string('name');
            $table->string('email');
            $table->string('phone')->nullable();

            // Enquiry
            $table->text('message');

            // Enquiry Status
            $table->string('status')
                ->default('new');

            // Admin Notes
            $table->text('admin_notes')->nullable();

            $table->timestamps();

            // Useful indexes
            $table->index('status');
            $table->index('product_id');
            $table->index('business_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enquiries');
    }
};
