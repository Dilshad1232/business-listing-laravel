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
        Schema::create('business_services', function (Blueprint $table) {

            $table->id();

            $table->foreignId('business_id')
                ->constrained('businesses')
                ->cascadeOnDelete();

            $table->string('name');

            $table->string('slug');

            $table->string('short_description')
                ->nullable();

            $table->text('description')
                ->nullable();

            $table->decimal('price', 12, 2)
                ->nullable();

            $table->string('duration')
                ->nullable();

            $table->boolean('status')
                ->default(true);

            $table->unsignedInteger('sort_order')
                ->default(0);

            $table->timestamps();

            $table->index([
                'business_id',
                'status'
            ]);

            $table->unique([
                'business_id',
                'slug'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('business_services');
    }
};
