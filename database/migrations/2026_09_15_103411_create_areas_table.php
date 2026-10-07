<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('areas', function (Blueprint $table) {

            $table->id();

            $table->foreignId('country_id')
                ->constrained('countries')
                ->cascadeOnDelete();

            $table->foreignId('state_id')
                ->constrained('states')
                ->cascadeOnDelete();

            $table->foreignId('city_id')
                ->constrained('cities')
                ->cascadeOnDelete();

            $table->string('name');

            $table->string('slug');

            $table->string('code', 20)
                ->nullable();

            $table->text('description')
                ->nullable();

            $table->boolean('status')
                ->default(true);

            $table->unsignedInteger('sort_order')
                ->default(0);

            $table->timestamps();

            $table->unique([
                'city_id',
                'slug',
            ]);

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('areas');
    }
};
