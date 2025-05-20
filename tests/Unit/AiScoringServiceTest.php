<?php

namespace Tests\Unit\Services;

use Tests\TestCase;
use App\Services\AiScoringService;
use App\Models\WritingTest;
use App\Models\WritingSubmission;
use App\Models\WritingSubmissionFeedback;
use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;

class AiScoringServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_score_and_store_with_valid_response()
    {
        // Tạo dữ liệu giả WritingTest
        $test = WritingTest::factory()->create();

        // Mock HTTP response từ Azure API
        Http::fake([
            '*' => Http::response([
                'choices' => [
                    [
                        'message' => [
                            'content' => json_encode([
                                'grammar' => 7.0,
                                'vocabulary' => 6.5,
                                'coherence' => 7.5,
                                'overall_feedback' => 'Good structure and vocabulary.',
                                'detailed_feedback' => [
                                    [
                                        'original_text' => 'This is a mistake.',
                                        'feedback' => 'Consider revising the sentence.',
                                        'issue_type' => 'grammar',
                                        'start_offset' => 0,
                                        'end_offset' => 20,
                                    ],
                                ],
                            ]),
                        ],
                    ],
                ],
            ], 200),
        ]);

        $service = new AiScoringService();

        $result = $service->scoreAndStore([
            'test_id' => $test->id,
            'content' => str_repeat("This is a test sentence. ", 100), // khoảng 100 câu
        ]);

        $this->assertArrayHasKey('submission', $result);
        $this->assertDatabaseHas('writing_submissions', [
            'test_id' => $test->id,
            'ai_score' => 7.0,
        ]);

        $this->assertDatabaseHas('writing_submission_feedback', [
            'issue_type' => 'grammar',
        ]);
    }
}
