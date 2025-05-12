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
        Schema::create('writing_submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('test_id')->constrained('writing_tests')->onDelete('cascade');
            $table->text('content');
            $table->float('ai_score')->nullable();
            $table->text('ai_feedback')->nullable();
            $table->integer('word_count')->nullable(); // Tổng số từ
            $table->float('coherence_score')->nullable(); // Chấm mức độ mạch lạc
            $table->float('vocabulary_score')->nullable(); // Chấm từ vựng
            $table->float('grammar_score')->nullable(); // Chấm ngữ pháp
            $table->timestamp('submitted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('writing_submissions');
    }
};
