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
        Schema::create('products', function (Blueprint $table) {

            $table->id();

            // Business
            $table->foreignId('business_id')
                ->constrained('businesses')
                ->cascadeOnDelete();

            // Category
            $table->foreignId('category_id')
                ->nullable()
                ->constrained('categories')
                ->nullOnDelete();

            // Subcategory
            $table->foreignId('subcategory_id')
                ->nullable()
                ->constrained('subcategories')
                ->nullOnDelete();

            // Product Information
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('sku')->nullable()->unique();

            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();

            // Pricing
            $table->decimal('price', 12, 2)->nullable();
            $table->decimal('discount_price', 12, 2)->nullable();

            // Inventory
            $table->unsignedInteger('stock')->default(0);

            // Status
            $table->boolean('status')->default(true);
            $table->boolean('is_featured')->default(false);

            // Ordering
            $table->unsignedInteger('sort_order')->default(0);

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
