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
        Schema::create('domain_expansions', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->string('name', 255);
            $table->foreignId('user')->constrained('characters'); // ID del Character
            $table->string('range', 100)->nullable();
            $table->string('Type', 100)->nullable(); // Note: mantiene la mayúscula como en dataStructure.md
            $table->text('description')->nullable();
            $table->timestamps();
            
            // Index para búsquedas
            $table->index('name');
            $table->index('user');
            $table->index('Type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('domain_expansions');
    }
};
