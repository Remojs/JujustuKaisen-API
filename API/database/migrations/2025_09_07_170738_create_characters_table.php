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
        Schema::create('characters', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->json('alias')->nullable(); // Array de aliases
            $table->unsignedTinyInteger('species_id'); // Referencias SpeciesConstants
            $table->string('birthday', 50)->nullable();
            $table->string('height', 50)->nullable();
            $table->string('age', 10)->nullable();
            $table->unsignedTinyInteger('gender')->nullable(); // Referencias GenderEnum
            $table->string('anime_debut', 50)->nullable();
            $table->string('manga_debut', 50)->nullable();
            $table->unsignedTinyInteger('grade_id')->nullable(); // Referencias GradeConstants
            $table->foreignId('domain_expansion_id')->nullable()->constrained('domain_expansions');
            $table->unsignedTinyInteger('status')->nullable(); // Referencias StatusEnum
            $table->json('relatives')->nullable(); // Array de familiares
            $table->string('image')->nullable();
            $table->timestamps();
            
            // Indexes para búsquedas optimizadas
            $table->index('name');
            $table->index('species_id');
            $table->index('gender');
            $table->index('grade_id');
            $table->index('status');
            $table->index(['species_id', 'grade_id']); // Composite index
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('characters');
    }
};
