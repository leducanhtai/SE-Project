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
        'task1-content',
        'task1-image',
        'task2-content',
        'task2-image',
        'task1-word-limit',
        'task2-word-limit',
        'time_limit'
    ];

    public function submissions()
    {
        return $this->hasMany(WritingSubmission::class, 'test_id');
    }
}
