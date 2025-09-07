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
        Schema::create('manga_volumes', function (Blueprint $table) {
            $table->id();
            $table->string('volume_number', 10);
            $table->string('volume_name', 255);
            $table->date('release_date')->nullable();
            $table->integer('pages');
            $table->string('chapters', 100)->nullable();
            $table->string('cover_character', 255)->nullable();
            $table->timestamps();
            
            // Index para búsquedas
            $table->index('volume_number');
            $table->index('volume_name');
            $table->index('cover_character');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manga_volumes');
    }
};
