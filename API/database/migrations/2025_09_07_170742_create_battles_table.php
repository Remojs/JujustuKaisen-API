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
        Schema::create('battles', function (Blueprint $table) {
            $table->id();
            $table->string('event', 500);
            $table->text('result');
            $table->string('arc', 255);
            $table->string('date', 100)->nullable();
            $table->string('location', 255);
            $table->foreignId('location_data')->nullable()->constrained('locations');
            $table->json('participants')->nullable(); // Array de IDs de Character
            $table->json('nonDirectParticipants')->nullable(); // Array de IDs de Character
            $table->string('image')->nullable();
            $table->timestamps();
            
            // Index para búsquedas
            $table->index('arc');
            $table->index('location');
            $table->index('date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('battles');
    }
};
