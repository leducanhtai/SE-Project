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
        Schema::create('writing_tests', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->string('title');
            $table->text('description')->nullable();
            $table->text('task1_content')->nullable();
            $table->string('task1_image')->nullable();
            $table->text('task2_content')->nullable();
            $table->string('task2_image')->nullable();
            $table->integer('task1_word_limit')->nullable();
            $table->integer('task2_word_limit')->nullable();
            $table->integer('time_limit')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('writing_tests');
    }
};
