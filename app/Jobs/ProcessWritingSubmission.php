<?php

namespace App\Jobs;

use App\Models\WritingSubmission;
use App\Services\AiScoringService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ProcessWritingSubmission implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected array $validated;

    public function __construct(array $validated)
    {
        $this->validated = $validated;
    }

    public function handle(AiScoringService $aiScoring): void
    {
        try {
            Log::info('Start scoring submission', ['submission_id' => $this->validated['submission_id']]);

            $result = $aiScoring->scoreAndStore($this->validated);

            $submission = WritingSubmission::find($this->validated['submission_id']);
            if (!$submission || $submission->ai_score === null) {
                Log::warning('Submission missing or not scored', ['id' => $this->validated['submission_id']]);
                return;
            }

            $previous = WritingSubmission::where('test_id', $submission->test_id)
                ->where('id', '<', $submission->id)
                ->whereNotNull('ai_score')
                ->orderByDesc('id')
                ->first();

            $scoreChange = null;
            $scoreIncreased = null;

            if ($previous) {
                $scoreChange = $submission->ai_score - $previous->ai_score;
                $scoreIncreased = $scoreChange > 0;

                $submission->update([
                    'score_change' => $scoreChange,
                    'score_increased' => $scoreIncreased,
                ]);
            }

            Log::info('Submission processed successfully', ['id' => $submission->id]);

        } catch (\Throwable $e) {
            Log::error('Job failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            throw $e;
        }
    }
}
