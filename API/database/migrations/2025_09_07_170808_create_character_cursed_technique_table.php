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
        Schema::create('character_cursed_technique', function (Blueprint $table) {
            $table->id();
            $table->foreignId('character_id')->constrained('characters')->onDelete('cascade');
            $table->foreignId('cursed_technique_id')->constrained('cursed_techniques')->onDelete('cascade');
            $table->timestamps();
            
            // Index para performance en consultas
            $table->unique(['character_id', 'cursed_technique_id']);
            $table->index('character_id');
            $table->index('cursed_technique_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('character_cursed_technique');
    }
};
