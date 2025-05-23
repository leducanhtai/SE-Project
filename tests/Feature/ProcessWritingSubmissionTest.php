<?php

namespace Tests\Unit\Jobs;

use App\Jobs\ProcessWritingSubmission;
use App\Services\AiScoringService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Mockery;

class ProcessWritingSubmissionTest extends TestCase
{
    use RefreshDatabase;

    public function test_handle_calls_score_and_store_on_ai_service()
    {
        // Arrange
        $validatedData = [
            'user_id' => 1,
            'content' => 'This is a writing test'
        ];

        // Tạo mock cho AiScoringService
        $aiServiceMock = Mockery::mock(AiScoringService::class);
        $aiServiceMock->shouldReceive('scoreAndStore')
            ->once()
            ->with($validatedData);

        // Gắn mock vào service container
        $this->app->instance(AiScoringService::class, $aiServiceMock);

        // Act
        $job = new ProcessWritingSubmission($validatedData);
        $job->handle($aiServiceMock);

        // Assert - đã được kiểm bởi Mockery assertion ở trên
        $this->assertTrue(true); // Để test không báo "no assertions"
    }

    protected function tearDown(): void
    {
        Mockery::close(); // Đóng mock sau mỗi test
        parent::tearDown();
    }
}
