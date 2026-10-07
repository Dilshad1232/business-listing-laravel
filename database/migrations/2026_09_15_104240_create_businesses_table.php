<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('businesses', function (Blueprint $table) {

            $table->id();

            // Business Owner
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            // Category
            $table->foreignId('category_id')
                ->constrained('categories')
                ->restrictOnDelete();

            // Subcategory
            $table->foreignId('subcategory_id')
                ->nullable()
                ->constrained('subcategories')
                ->nullOnDelete();

            // Location
            $table->foreignId('country_id')
                ->nullable()
                ->constrained('countries')
                ->nullOnDelete();

            $table->foreignId('state_id')
                ->nullable()
                ->constrained('states')
                ->nullOnDelete();

            $table->foreignId('city_id')
                ->nullable()
                ->constrained('cities')
                ->nullOnDelete();

            $table->foreignId('area_id')
                ->nullable()
                ->constrained('areas')
                ->nullOnDelete();

            // Basic Business Information
            $table->string('name');

            $table->string('slug')
                ->unique();

            $table->string('tagline')
                ->nullable();

            $table->text('description')
                ->nullable();

            // Contact Information
            $table->string('phone', 30)
                ->nullable();

            $table->string('email')
                ->nullable();

            $table->string('website')
                ->nullable();

            // Address
            $table->text('address')
                ->nullable();

            $table->string('pincode', 20)
                ->nullable();

            // Business Media
            $table->string('logo')
                ->nullable();

            $table->string('cover_image')
                ->nullable();

            // Approval Workflow
            $table->enum('status', [
                'pending',
                'approved',
                'rejected',
            ])->default('pending');

            $table->text('admin_notes')
                ->nullable();

            // Featured
            $table->boolean('is_featured')
                ->default(false);

            // Rating
            $table->decimal('rating', 2, 1)
                ->default(0);

            $table->unsignedInteger('reviews_count')
                ->default(0);

            // SEO
            $table->string('meta_title')
                ->nullable();

            $table->text('meta_description')
                ->nullable();

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('businesses');
    }
};
