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
        Schema::create('writing_submission_feedback', function (Blueprint $table) {
            $table->id();
            $table->foreignId('submission_id')->constrained('writing_submissions')->onDelete('cascade');
            $table->text('original_text'); // Đoạn văn hoặc câu gốc
            $table->text('feedback'); // Góp ý từ AI
            $table->string('issue_type')->nullable(); // Loại lỗi: grammar, coherence, vocab, etc.
            $table->integer('start_offset')->nullable(); // Vị trí bắt đầu trong văn bản
            $table->integer('end_offset')->nullable(); // Vị trí kết thúc
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('writing_submission_feedback');
    }
};
