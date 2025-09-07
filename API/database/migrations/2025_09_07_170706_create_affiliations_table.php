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
        Schema::create('affiliations', function (Blueprint $table) {
            $table->id();
            $table->string('affiliation_name', 255);
            $table->string('type', 100);
            $table->unsignedBigInteger('controlled_by')->nullable();
            $table->string('location', 255)->nullable();
            $table->text('location_data')->nullable();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
            
            // Index para búsquedas
            $table->index('affiliation_name');
            $table->index('type');
            $table->index('controlled_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('affiliations');
    }
};
