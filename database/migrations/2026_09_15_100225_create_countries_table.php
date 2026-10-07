<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('countries', function (Blueprint $table) {

            $table->id();

            $table->string('name');

            $table->string('slug')->unique();

            $table->string('code', 10)->nullable()->unique();

            $table->string('phone_code', 20)->nullable();

            $table->text('description')->nullable();

            $table->boolean('status')->default(true);

            $table->unsignedInteger('sort_order')->default(0);

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
};
