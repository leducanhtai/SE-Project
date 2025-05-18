<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Models\WritingSubmission;
use App\Models\WritingSubmissionFeedback;
use App\Models\WritingTest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class AiScoringService
{
    public function scoreAndStore(array $data)
    {
        $test = WritingTest::findOrFail($data['test_id']);
        $content = $data['content'];
        $wordCount = str_word_count(strip_tags($content));

        $prompt = "
            You are an IELTS writing examiner. Please:
            1. Evaluate the following writing task and essay response.
            2. Provide scores (0–9) for grammar, vocabulary, and coherence.
            3. Give overall feedback and detailed comments in this JSON format:
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
                        }]
                }

            --- Writing Task ---
            Title: {$test->title}
            Description: {$test->description}
            Instructions: {$test->task_content}
            Word Limit: {$test->task_word_limit}

            --- Essay ---
            {$content}
        ";

        $response = Http::withHeaders([
            'api-key' => env('AZURE_OPENAI_API_KEY'),
            'Content-Type' => 'application/json',
        ])->post(rtrim(env('AZURE_OPENAI_ENDPOINT'), '/') . '/openai/deployments/' . env('AZURE_OPENAI_DEPLOYMENT') . '/chat/completions?api-version=' . env('AZURE_OPENAI_API_VERSION', '2025-01-01-preview'), [
            'messages' => [
                ['role' => 'system', 'content' => 'You are a helpful assistant.'],
                ['role' => 'user', 'content' => $prompt]
            ],
            'temperature' => 0.3,
            'max_tokens' => 500,
        ]);

        $json = $response->json();
        $resultContent = $json['choices'][0]['message']['content'] ?? null;

        if (!$resultContent) {
            return ['error' => 'Azure không trả về nội dung.', 'response' => $json];
        }

        preg_match('/({.*})/s', $resultContent, $matches);
        $parsed = json_decode($matches[1] ?? '', true);

        if (!$parsed) {
            return ['error' => 'Không thể parse JSON từ Azure.', 'raw' => $resultContent];
        }

        $submission = WritingSubmission::create([
            'test_id' => $test->id,
            'content' => $content,
            'word_count' => $wordCount,
            'ai_score' => $parsed['overall_score'] ?? null,
            'ai_feedback' => $parsed['overall_feedback'] ?? '',
            'grammar_score' => $parsed['grammar'] ?? null,
            'vocabulary_score' => $parsed['vocabulary'] ?? null,
            'coherence_score' => $parsed['coherence'] ?? null,
            'submitted_at' => now(),
        ]);

        foreach ($parsed['detailed_feedback'] ?? [] as $fb) {
            WritingSubmissionFeedback::create([
                'submission_id' => $submission->id,
                'original_text' => $fb['original_text'],
                'feedback' => $fb['feedback'],
                'issue_type' => $fb['issue_type'],
                'start_offset' => $fb['start_offset'],
                'end_offset' => $fb['end_offset'],
            ]);
        }

        return ['submission' => $submission->load('feedbacks')];
    }
}
