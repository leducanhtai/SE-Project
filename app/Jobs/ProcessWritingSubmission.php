<?php
namespace App\Jobs;

use App\Services\AiScoringService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessWritingSubmission implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $validated;

    public function __construct(array $validated)
    {
        $this->validated = $validated;
    }

    public function handle(AiScoringService $aiScoring)
    {
        $aiScoring->scoreAndStore($this->validated);
    }
}
