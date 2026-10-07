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
        Schema::create('business_reviews', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Business
            |--------------------------------------------------------------------------
            */

            $table->foreignId('business_id')
                ->constrained('businesses')
                ->cascadeOnDelete();


            /*
            |--------------------------------------------------------------------------
            | Reviewer
            |--------------------------------------------------------------------------
            */

            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();


            /*
            |--------------------------------------------------------------------------
            | Review Information
            |--------------------------------------------------------------------------
            */

            $table->string('reviewer_name')->nullable();

            $table->string('reviewer_email')->nullable();

            $table->unsignedTinyInteger('rating');

            $table->string('title')->nullable();

            $table->text('comment');


            /*
            |--------------------------------------------------------------------------
            | Status
            |--------------------------------------------------------------------------
            */

            $table->enum('status', [
                'pending',
                'approved',
                'rejected',
            ])->default('pending');


            /*
            |--------------------------------------------------------------------------
            | Admin Response
            |--------------------------------------------------------------------------
            */

            $table->text('admin_reply')->nullable();

            $table->timestamp('admin_replied_at')->nullable();


            /*
            |--------------------------------------------------------------------------
            | Helpful
            |--------------------------------------------------------------------------
            */

            $table->unsignedInteger('helpful_count')
                ->default(0);


            /*
            |--------------------------------------------------------------------------
            | Featured Review
            |--------------------------------------------------------------------------
            */

            $table->boolean('is_featured')
                ->default(false);


            /*
            |--------------------------------------------------------------------------
            | Indexes
            |--------------------------------------------------------------------------
            */

            $table->index(['business_id', 'status']);

            $table->index(['business_id', 'rating']);

            $table->index('is_featured');


            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('business_reviews');
    }
};
