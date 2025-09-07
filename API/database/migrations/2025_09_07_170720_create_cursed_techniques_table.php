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
            $table->string('technique_name', 255);
            $table->text('description');
            $table->unsignedTinyInteger('type'); // Referencias TechniqueTypeConstants
            $table->unsignedTinyInteger('range'); // Referencias TechniqueRangeConstants
            $table->string('image')->nullable();
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
