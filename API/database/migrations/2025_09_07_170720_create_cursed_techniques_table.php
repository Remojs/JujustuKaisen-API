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
        Schema::create('cursed_techniques', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->string('technique_name', 255);
            $table->text('description')->nullable();
            $table->integer('type')->nullable(); // ID del constant de TechniqueType
            $table->integer('range')->nullable(); // ID del constant de TechniqueRange
            $table->json('users')->nullable(); // Array de IDs de Characters
            $table->timestamps();
            
            // Index para búsquedas
            $table->index('technique_name');
            $table->index('type');
            $table->index('range');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cursed_techniques');
    }
};
