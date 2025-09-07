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
            $table->string('title', 255);
            $table->string('release_date', 50)->nullable();
            $table->text('description')->nullable();
            $table->string('chapters', 100)->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
            
            // Index para búsquedas
            $table->index('volume_number');
            $table->index('title');
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
