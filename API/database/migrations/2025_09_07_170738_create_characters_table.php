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
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->unsignedTinyInteger('gender')->nullable(); // Referencias GenderEnum
            $table->string('age', 10)->nullable();
            $table->date('birthday')->nullable();
            $table->string('height', 50)->nullable();
            $table->string('weight', 50)->nullable();
            $table->string('hair_color', 100)->nullable();
            $table->string('eye_color', 100)->nullable();
            $table->unsignedTinyInteger('status')->nullable(); // Referencias StatusEnum
            $table->unsignedTinyInteger('species_id'); // Referencias SpeciesConstants
            $table->unsignedTinyInteger('grade_id')->nullable(); // Referencias GradeConstants
            $table->foreignId('location_id')->nullable()->constrained('locations');
            $table->json('abilities')->nullable(); // Array de habilidades
            $table->string('first_appearance_manga', 50)->nullable();
            $table->string('first_appearance_anime', 50)->nullable();
            $table->timestamps();
            
            // Indexes para búsquedas optimizadas
            $table->index('name');
            $table->index('species_id');
            $table->index('gender');
            $table->index('grade_id');
            $table->index('status');
            $table->index('location_id');
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
