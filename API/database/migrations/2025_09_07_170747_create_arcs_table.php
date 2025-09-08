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
        Schema::create('arcs', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('manga', 255)->nullable();
            $table->json('anime')->nullable(); // Array de IDs de AnimeEpisode
            $table->string('image')->nullable();
            $table->timestamps();
            
            // Index para búsquedas
            $table->index('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arcs');
    }
};
