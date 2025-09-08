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
        Schema::create('manga_chapters', function (Blueprint $table) {
            $table->id();
            $table->integer('chapter_number');
            $table->string('arc')->nullable();
            $table->string('title')->nullable();
            $table->integer('pages')->nullable();
            $table->date('release_date')->nullable();
            $table->text('cover_image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manga_chapters');
    }
};
