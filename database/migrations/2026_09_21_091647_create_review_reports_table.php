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
        Schema::create('review_reports', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Review
            |--------------------------------------------------------------------------
            */

            $table->foreignId('review_id')
                ->constrained('business_reviews')
                ->cascadeOnDelete();


            /*
            |--------------------------------------------------------------------------
            | Reporter
            |--------------------------------------------------------------------------
            */

            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();


            /*
            |--------------------------------------------------------------------------
            | Report Information
            |--------------------------------------------------------------------------
            */

            $table->string('reporter_name')->nullable();

            $table->string('reporter_email')->nullable();

            $table->string('reason');

            $table->text('message')->nullable();


            /*
            |--------------------------------------------------------------------------
            | Moderation
            |--------------------------------------------------------------------------
            */

            $table->enum('status', [
                'pending',
                'reviewed',
                'dismissed',
            ])->default('pending');

            $table->text('admin_notes')->nullable();

            $table->timestamp('reviewed_at')->nullable();


            /*
            |--------------------------------------------------------------------------
            | Indexes
            |--------------------------------------------------------------------------
            */

            $table->index(['review_id', 'status']);

            $table->index('status');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('review_reports');
    }
};
