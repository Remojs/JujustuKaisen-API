<?php

use     public function up(): void
    {
        Schema::table('characters', function (Blueprint $table) {
            // Drop existing columns that don't match JSON
            $table->dropColumn([
                'character_name', 'series', 'weight', 'species', 'occupation', 
                'grade', 'clan', 'origin', 'affiliation', 'abilities', 
                'domain_expansion', 'cursed_technique', 'cursed_energy_nature',
                'personality', 'appearance', 'background', 'first_appearance_manga',
                'first_appearance_anime', 'voice_actors', 'quote'
            ]);
        });

        Schema::table('characters', function (Blueprint $table) {
            // Add columns that match your JSON exactly
            $table->string('name')->after('id');
            $table->json('alias')->nullable()->after('name');
            $table->string('animeDebut')->nullable()->after('affiliationId');
            $table->string('mangaDebut')->nullable()->after('animeDebut');
            $table->json('cursedTechniquesIds')->nullable()->after('mangaDebut');
            $table->integer('gradeId')->nullable()->after('cursedTechniquesIds');
            $table->integer('domainExpansionId')->nullable()->after('gradeId');
            $table->json('battlesId')->nullable()->after('domainExpansionId');
            $table->json('cursedToolId')->nullable()->after('battlesId');
            $table->json('occupationId')->nullable()->after('cursedToolId');
            
            // Modify existing columns to match JSON types
            $table->integer('gender')->change();
            $table->integer('status')->change();
            $table->json('affiliationId')->change();
        });
    }

    public function down(): void
    {
        // Reverse the changes if needed
        Schema::table('characters', function (Blueprint $table) {
            $table->dropColumn([
                'name', 'alias', 'animeDebut', 'mangaDebut', 'cursedTechniquesIds',
                'gradeId', 'domainExpansionId', 'battlesId', 'cursedToolId', 'occupationId'
            ]);
            
            // Add back the old columns
            $table->string('character_name');
            // ... etc
        });
    }ase\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('match_json', function (Blueprint $table) {
            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('match_json', function (Blueprint $table) {
            //
        });
    }
};
