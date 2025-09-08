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
        Schema::table('characters', function (Blueprint $table) {
            // Make speciesId and other foreign keys nullable
            $table->unsignedBigInteger('speciesId')->nullable()->change();
            $table->integer('gradeId')->nullable()->change();
            $table->integer('domainExpansionId')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('characters', function (Blueprint $table) {
            $table->unsignedBigInteger('speciesId')->nullable(false)->change();
            $table->integer('gradeId')->nullable(false)->change();
            $table->integer('domainExpansionId')->nullable(false)->change();
        });
    }
};
