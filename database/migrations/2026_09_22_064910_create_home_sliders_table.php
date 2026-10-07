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
        Schema::create('home_sliders', function (Blueprint $table) {
            $table->id();

            $table->string('badge')->nullable();

            $table->string('title');

            $table->string('highlight')->nullable();

            $table->text('typed_words')->nullable();

            $table->text('description')->nullable();

            $table->string('background_image')->nullable();

            $table->string('button_text')->nullable();

            $table->string('button_url')->nullable();

            $table->integer('sort_order')->default(0);

            $table->boolean('status')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_sliders');
    }
};
