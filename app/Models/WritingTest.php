<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WritingTest extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'image',
        'title',
        'description',
        'task_content',
        'task_image',
        'task_word_limit',
        'time_limit',
        'task',
    ];

    public function submissions()
    {
        return $this->hasMany(WritingSubmission::class, 'test_id');
    }
}
