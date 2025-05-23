<?php

namespace Tests\Unit\Jobs;

use App\Jobs\ProcessWritingSubmission;
use App\Models\WritingSubmission;
use App\Services\AiScoringService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;
use Mockery;

class ProcessWritingSubmissionTest extends TestCase
{
    use RefreshDatabase;

    public function test_job_calls_score_and_updates_submission()
    {
        // Fake submission data
        $submission = WritingSubmission::factory()->create([
            'ai_score' => null,
        ]);

        $validated = [
            'submission_id' => $submission->id,
            'user_id' => $submission->user_id,
            'content' => 'Nội dung bài viết',
        ];

        // Mock AiScoringService
        $mockAiService = Mockery::mock(AiScoringService::class);
        $mockAiService->shouldReceive('scoreAndStore')
            ->once()
            ->with($validated)
            ->andReturn(['score' => 85]);

        $this->app->instance(AiScoringService::class, $mockAiService);

        // Update ai_score manually to simulate that AI already stored it
        $submission->update(['ai_score' => 85]);

        $job = new ProcessWritingSubmission($validated);
        $job->handle($mockAiService);

        $submission->refresh();

        $this->assertEquals(85, $submission->ai_score);
    }

    public function test_job_sets_error_message_if_ai_score_missing()
    {
        $submission = WritingSubmission::factory()->create([
            'ai_score' => null,
        ]);

        $validated = [
            'submission_id' => $submission->id,
            'user_id' => $submission->user_id,
            'content' => 'Some content',
        ];

        $mockAiService = Mockery::mock(AiScoringService::class);
        $mockAiService->shouldReceive('scoreAndStore')
            ->once()
            ->with($validated)
            ->andReturn([]);

        $this->app->instance(AiScoringService::class, $mockAiService);

        $job = new ProcessWritingSubmission($validated);
        $job->handle($mockAiService);

        $submission->refresh();
        $this->assertNotNull($submission->error_message);
        $this->assertEquals('Hệ thống AI bị quá tải. Vui lòng thử lại sau.', $submission->error_message);
    }

    public function test_job_calculates_score_change_correctly()
    {
        $previous = WritingSubmission::factory()->create([
            'test_id' => 1,
            'ai_score' => 70,
        ]);

        $submission = WritingSubmission::factory()->create([
            'test_id' => 1,
            'ai_score' => null,
        ]);

        $validated = [
            'submission_id' => $submission->id,
            'user_id' => $submission->user_id,
            'content' => 'Test',
        ];

        $mockAiService = Mockery::mock(AiScoringService::class);
        $mockAiService->shouldReceive('scoreAndStore')
            ->once()
            ->with($validated)
            ->andReturn(['score' => 80]);

        $this->app->instance(AiScoringService::class, $mockAiService);

        // Simulate score saved by AI
        $submission->update(['ai_score' => 80]);

        $job = new ProcessWritingSubmission($validated);
        $job->handle($mockAiService);

        $submission->refresh();

        $this->assertEquals(10, $submission->score_change);
        $this->assertTrue($submission->score_increased);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
