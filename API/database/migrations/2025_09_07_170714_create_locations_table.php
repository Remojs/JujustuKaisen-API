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
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('location_name', 255);
            $table->string('located_in', 255)->nullable();
            $table->text('description')->nullable();
            $table->foreignId('events')->nullable()->constrained('battles'); // ID del Battle
            $table->string('image')->nullable();
            $table->timestamps();
            
            // Index para búsquedas
            $table->index('location_name');
            $table->index('located_in');
            $table->index('events');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};
