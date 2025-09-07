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
        Schema::create('cursed_tools', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('type', 100);
            $table->text('description');
            $table->string('image')->nullable();
            $table->timestamps();
            
            // Index para búsquedas
            $table->index('name');
            $table->index('type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cursed_tools');
    }
};
