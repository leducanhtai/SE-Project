<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use App\Models\WritingTest;
use App\Models\WritingSubmission;
use Illuminate\Support\Facades\Queue;
use App\Jobs\ProcessWritingSubmission;

class WritingSubmissionControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware; // Tắt middleware như CSRF để tránh lỗi 419

    public function test_submit_writing_successfully()
    {
        Queue::fake();

        // Tạo một WritingTest mẫu
        $test = WritingTest::factory()->create();

        // Kiểm tra WritingTest đã tạo thành công
        $this->assertDatabaseCount('writing_tests', 1);

        // Gửi POST request tới route gửi bài viết
        $response = $this->post(route('writing.submit'), [
            'test_id' => $test->id,
            'content' => str_repeat('word ', 60), // >= 50 words
        ]);

        // Lấy submission đầu tiên để kiểm tra
        $submission = WritingSubmission::first();

        // Kiểm tra submission đã được tạo
        $this->assertNotNull($submission, 'Submission was not created.');

        // Kiểm tra redirect tới trang processing
        $response->assertRedirect(route('submissions.processing', ['id' => $submission->id]));

        // Kiểm tra dữ liệu đã được ghi vào DB
        $this->assertDatabaseHas('writing_submissions', [
            'test_id' => $test->id,
            'id' => $submission->id,
        ]);

        // Kiểm tra job đã được dispatch
        Queue::assertPushed(ProcessWritingSubmission::class);
    }

    public function test_submit_writing_validation_fails()
    {
        // Gửi request sai dữ liệu
        $response = $this->from('/writing-form')->post(route('writing.submit'), [
            'test_id' => 999, // ID không tồn tại
            'content' => '', // dưới 50 từ
        ]);

        // Phải redirect lại form ban đầu
        $response->assertRedirect('/writing-form');

        // Session phải có lỗi
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
        $submission = WritingSubmission::factory()->create();

        $response = $this->get(route('submissions.processing', ['id' => $submission->id]));

        $response->assertStatus(200);
        $response->assertViewIs('submissions.processing');
        $response->assertViewHas('submissionId', $submission->id);
    }
}
