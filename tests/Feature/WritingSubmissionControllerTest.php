<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\WritingTest;
use App\Models\WritingSubmission;
use Illuminate\Support\Facades\Queue;
use App\Jobs\ProcessWritingSubmission;

class WritingSubmissionControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_submit_writing_successfully()
    {
        Queue::fake();

        $test = WritingTest::factory()->create();

        $response = $this->post(route('writing.submit'), [
            'test_id' => $test->id,
            'content' => str_repeat('word ', 60), // at least 50 words
        ]);

        $submission = WritingSubmission::first();

        $response->assertRedirect(route('submissions.processing', ['id' => $submission->id]));

        $this->assertDatabaseHas('writing_submissions', [
            'test_id' => $test->id,
        ]);

        Queue::assertPushed(ProcessWritingSubmission::class);
    }

    public function test_submit_writing_validation_fails()
    {
        $response = $this->post(route('writing.submit'), [
            'test_id' => 999, // invalid
            'content' => 'Too short',
        ]);

        $response->assertSessionHasErrors(['test_id', 'content']);
    }

    public function test_show_submission()
    {
        $submission = WritingSubmission::factory()->create();

        $response = $this->get(route('submissions.show', ['id' => $submission->id]));

        $response->assertStatus(200);
        $response->assertViewIs('submissions.show');
        $response->assertViewHas('submission');
    }

    public function test_processing_view()
    {
        $response = $this->get(route('submissions.processing', ['id' => 1]));

        $response->assertStatus(200);
        $response->assertViewIs('submissions.processing');
        $response->assertViewHas('submissionId', 1);
    }
}
