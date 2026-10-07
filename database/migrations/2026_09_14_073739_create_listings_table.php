<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('listings', function (Blueprint $table) {

            $table->id();

            // Category
            $table->foreignId('category_id')
                ->constrained()
                ->cascadeOnDelete();

            // Subcategory
            $table->foreignId('subcategory_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            // Basic Information
            $table->string('name');
            $table->string('slug')->unique();

            $table->string('short_description')->nullable();

            $table->longText('description')->nullable();

            // Contact
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();

            // Location
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();

            // Business Information
            $table->decimal('price', 10, 2)->nullable();
            $table->decimal('rating', 2, 1)->default(0);

            $table->string('image')->nullable();

            // Status
            $table->boolean('status')->default(true);
            $table->boolean('is_featured')->default(false);

            $table->unsignedInteger('sort_order')->default(0);

            // SEO
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('listings');
    }
};
