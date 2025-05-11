<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WritingSubmission extends Model
{
    //
    use HasFactory;
    
    protected $fillable = [
        'test_id',
        'content',
        'ai_score',
        'ai_score_task1',
        'ai_score_task2',
        'ai_feedback_task1',
        'ai_feedback_task2',
        'ai_feedback',
        'word-count_task1',
        'word_count_task2',
        'word_count',
        'coherence_score',
        'vocabulary_score',
        'grammar_score',
        'submitted_at',
    ];

    public function test()
    {
        return $this->belongsTo(WritingTest::class, 'test_id');
    }

    public function feedback()
    {
        return $this->hasMany(WritingSubmissionFeedBack::class, 'submission_id');
    }
}
