<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WritingSubmissionFeedback extends Model
{
    //
      // Tên bảng tương ứng (nếu không theo chuẩn Laravel)
    protected $table = 'writing_submission_feedback';

    // Các trường có thể gán giá trị hàng loạt
    protected $fillable = [
        'submission_id',
        'task',
        'original_text',
        'feedback',
        'issue_type',
        'start_offset',
        'end_offset',
    ];

    /**
     * Quan hệ: Feedback thuộc về một bài viết.
     */
    public function submission(): BelongsTo
    {
        return $this->belongsTo(WritingSubmission::class, 'submission_id');
    }
}
