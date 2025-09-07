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
            $table->string('image')->nullable();
            $table->string('name', 255);
            $table->string('type', 100);
            $table->foreignId('owners')->nullable()->constrained('characters'); // ID del Character
            $table->text('description');
            $table->timestamps();
            
            // Index para búsquedas
            $table->index('name');
            $table->index('type');
            $table->index('owners');
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
