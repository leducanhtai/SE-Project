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
            $table->float('ai_score_task1')->nullable();
            $table->float('ai_score_task2')->nullable();
            $table->text('ai_feedback_task1')->nullable();
            $table->text('ai_feedback_task2')->nullable();
            $table->text('ai_feedback')->nullable();
            $table->timestamp('submitted_at')->nullable();
            $table->integer('word_count_task1')->nullable(); // Số từ của bài viết 1
            $table->integer('word_count_task2')->nullable(); // Số từ của bài viết 2
            $table->integer('word_count')->nullable(); // Tổng số từ
            $table->float('coherence_score')->nullable(); // Chấm mức độ mạch lạc
            $table->float('vocabulary_score')->nullable(); // Chấm từ vựng
            $table->float('grammar_score')->nullable(); // Chấm ngữ pháp
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
