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
        Schema::create('character_affiliation', function (Blueprint $table) {
            $table->id();
            $table->foreignId('character_id')->constrained('characters')->onDelete('cascade');
            $table->foreignId('affiliation_id')->constrained('affiliations')->onDelete('cascade');
            $table->timestamps();
            
            // Index para performance en consultas
            $table->unique(['character_id', 'affiliation_id']);
            $table->index('character_id');
            $table->index('affiliation_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('character_affiliation');
    }
};
