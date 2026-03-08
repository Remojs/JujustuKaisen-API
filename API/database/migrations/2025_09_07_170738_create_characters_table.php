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
            $table->json('alias')->nullable(); // Array de strings
            $table->integer('speciesId')->nullable(); // ID del constant de Specie
            $table->string('birthday', 50)->nullable();
            $table->string('height', 20)->nullable();
            $table->string('age', 20)->nullable();
            $table->integer('gender')->nullable(); // Enum de Gender
            $table->json('occupationId')->nullable(); // Array de IDs de Occupation
            $table->json('affiliationId')->nullable(); // Array de IDs de Affiliation
            $table->string('animeDebut', 100)->nullable();
            $table->string('mangaDebut', 100)->nullable();
            $table->json('cursedTechniquesIds')->nullable(); // Array de IDs de CursedTechniques
            $table->integer('gradeId')->nullable(); // ID del constant de Grade
            $table->unsignedBigInteger('domainExpansionId')->nullable(); // ID del DomainExpansion
            $table->json('battlesId')->nullable(); // Array de IDs de Battles
            $table->json('cursedToolId')->nullable(); // Array de IDs de CursedTool
            $table->integer('status')->nullable(); // Enum de Status
            $table->json('relatives')->nullable(); // Array de strings
            $table->string('image')->nullable();
            $table->timestamps();
            
            // Indexes para búsquedas optimizadas
            $table->index('name');
            $table->index('speciesId');
            $table->index('gender');
            $table->index('gradeId');
            $table->index('status');
            $table->index(['speciesId', 'gradeId']); // Composite index
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
