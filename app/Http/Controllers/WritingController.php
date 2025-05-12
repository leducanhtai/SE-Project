<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\WritingSubmission;
use App\Models\WritingSubmissionFeedback;
use App\Models\WritingTest;

class WritingController extends Controller
{
    public function submit(Request $request)
    {
        $request->validate([
            'test_id' => 'required|exists:writing_tests,id',
            'content' => 'required|string|min:50',
        ]);

        $test = WritingTest::findOrFail($request->test_id);
        $content = $request->input('content');
        $wordCount = str_word_count(strip_tags($content));
        $apiKey = env('OPENROUTER_API_KEY');

        // Prompt dành cho Claude
        $prompt = "
You are an IELTS writing examiner. Please:
1. Evaluate the following writing task and essay response.
2. Provide scores (0–9) for grammar, vocabulary, and coherence.
3. Give overall feedback and provide detailed feedback in the following JSON format:
{
  \"overall_score\": float,
  \"grammar\": float,
  \"vocabulary\": float,
  \"coherence\": float,
  \"overall_feedback\": \"...\",
  \"detailed_feedback\": [
    {
      \"original_text\": \"...\",
      \"feedback\": \"...\",
      \"issue_type\": \"grammar|vocabulary|coherence\",
      \"start_offset\": int,
      \"end_offset\": int
    }
  ]
}

--- Writing Task ---
Title: {$test->title}
Description: {$test->description}
Instructions: {$test->task_content}
Word Limit: {$test->task_word_limit}

--- Essay ---
{$content}
";

        // Gọi Claude 3 Sonnet qua OpenRouter
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $apiKey,
            'HTTP-Referer' => 'http://127.0.0.1:8000', // hoặc http://localhost:8000
            'X-Title' => 'IELTS Writing Evaluator'
        ])->post('https://openrouter.ai/api/v1/chat/completions', [
            'model' => 'anthropic/claude-3-sonnet-20240229',
            'messages' => [
            ['role' => 'user', 'content' => $prompt]
            ],
            'temperature' => 0.3,
            'max_tokens' => 2000 // Tăng số lượng token tối đa nếu cần

        ]);


        $json = $response->json();
        logger()->debug('Claude response:', $json);

        $text = $json['choices'][0]['message']['content'] ?? null;

        

        if (!$text) {
            return response()->json(['error' => 'Claude không trả về nội dung.'], 500);
        }

        try {
            preg_match('/({.*})/s', $text, $matches);
            $parsed = json_decode($matches[1], true);

            if (!$parsed) {
                return response()->json(['error' => 'Không thể parse JSON từ Claude.', 'raw' => $text], 500);
            }

            $submission = WritingSubmission::create([
                'test_id' => $request->test_id,
                'content' => $content,
                'ai_score' => $parsed['overall_score'] ?? null,
                'ai_feedback' => $parsed['overall_feedback'] ?? '',
                'word_count' => $wordCount,
                'coherence_score' => $parsed['coherence'] ?? null,
                'vocabulary_score' => $parsed['vocabulary'] ?? null,
                'grammar_score' => $parsed['grammar'] ?? null,
                'submitted_at' => now(),
            ]);

            foreach ($parsed['detailed_feedback'] ?? [] as $item) {
                WritingSubmissionFeedback::create([
                    'submission_id' => $submission->id,
                    'original_text' => $item['original_text'],
                    'feedback' => $item['feedback'],
                    'issue_type' => $item['issue_type'],
                    'start_offset' => $item['start_offset'],
                    'end_offset' => $item['end_offset'],
                ]);
            }

            return response()->json(['message' => 'Đã chấm điểm thành công.', 'data' => $submission->load('feedbacks')]);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Lỗi xử lý phản hồi từ Claude: ' . $e->getMessage()], 500);
        }
    }

    public function testClaude(Request $request)
    {
        $apiKey = env('OPENROUTER_API_KEY');

        $prompt = "Explain how AI works in simple terms.";

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $apiKey,
            'HTTP-Referer' => 'https://yourdomain.com',
            'X-Title' => 'Claude Test'
        ])->post('https://openrouter.ai/api/v1/chat/completions', [
            'model' => 'anthropic/claude-3-sonnet-20240229',
            'messages' => [
                ['role' => 'user', 'content' => $prompt]
            ],
            'temperature' => 0.3,
            'max_tokens' => 1000 
        ]);

        $json = $response->json();
        logger()->debug('Claude test response:', $json);

        return response()->json(['claude_raw_response' => $json]);
    }
}
