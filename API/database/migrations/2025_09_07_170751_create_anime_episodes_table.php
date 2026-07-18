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
        Schema::create('anime_episodes', function (Blueprint $table) {
            $table->id();
            $table->string('episode_number', 10);
            $table->foreignId('arc')->constrained('arcs');
            $table->string('season', 50)->nullable();
            $table->string('title', 255);
            $table->string('mangachapters_adapted', 100)->nullable();
            $table->date('air_date')->nullable();
            $table->string('opening_theme', 255)->nullable();
            $table->string('ending_theme', 255)->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
            
            // Index para búsquedas
            $table->index('episode_number');
            $table->index('arc');
            $table->index('season');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anime_episodes');
    }
};
