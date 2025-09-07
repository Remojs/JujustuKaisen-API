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
            $table->string('name', 255);
            $table->unsignedBigInteger('user'); // FK a characters
            $table->string('range', 255)->nullable();
            $table->string('type', 100)->default('Domain Expansion');
            $table->text('description');
            $table->string('image')->nullable();
            $table->timestamps();
            
            // Index para búsquedas
            $table->index('name');
            $table->index('user');
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
