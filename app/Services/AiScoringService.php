<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Models\WritingSubmission;
use App\Models\WritingSubmissionFeedback;
use App\Models\WritingTest;
use Illuminate\Support\Facades\Log;

class AiScoringService
{
    public function scoreAndStore(array $data)
    {
        $submission = WritingSubmission::findOrFail($data['submission_id']);
        $test = \App\Models\WritingTest::findOrFail($data['test_id']);
        $content = $data['content'];
        $wordCount = str_word_count(strip_tags($content));

        $chunks = $this->splitEssayIntoChunks($content, 70);

        $allFeedback = [];
        $totalScore = ['grammar' => 0, 'vocabulary' => 0, 'coherence' => 0, 'count' => 0];
        $overallFeedbacks = [];

        foreach ($chunks as $index => $chunk) {
            $prompt = "
                You are an IELTS examiner. Please evaluate the following essay section.
                Provide scores (0–9) for grammar, vocabulary, and coherence,
                and return feedback in JSON format:

                {
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

                --- Essay Section #{$index} ---
                {$chunk}
            ";

            $response = Http::timeout(60)->withHeaders([
                'api-key' => env('AZURE_OPENAI_API_KEY'),
                'Content-Type' => 'application/json',
            ])->post(
                rtrim(env('AZURE_OPENAI_ENDPOINT'), '/') . '/openai/deployments/' . env('AZURE_OPENAI_DEPLOYMENT') . '/chat/completions?api-version=' . env('AZURE_OPENAI_API_VERSION', '2025-01-01-preview'),
                [
                    'messages' => [
                        ['role' => 'system', 'content' => 'You are a helpful assistant.'],
                        ['role' => 'user', 'content' => $prompt],
                    ],
                    'temperature' => 0.3,
                    'max_tokens' => 500,
                ]
            );

            if ($response->status() === 429) {
                Log::warning('Rate limit hit on Azure OpenAI API', ['response' => $response->body()]);
                return ['error' => 'RATE_LIMIT'];
            } 

            $json = $response->json();
            $resultContent = $json['choices'][0]['message']['content'] ?? null;

            if (!$resultContent || !preg_match('/({.*})/s', $resultContent, $matches)) {
                Log::error("Chunk #$index error", ['response' => $json]);
                continue;
            }

            $parsed = json_decode($matches[1], true);

            if (!$parsed) {
                continue;
            }

            $totalScore['grammar'] += $parsed['grammar'] ?? 0;
            $totalScore['vocabulary'] += $parsed['vocabulary'] ?? 0;
            $totalScore['coherence'] += $parsed['coherence'] ?? 0;
            $totalScore['count']++;

            $overallFeedbacks[] = $parsed['overall_feedback'] ?? '';
            $allFeedback = array_merge($allFeedback, $parsed['detailed_feedback'] ?? []);

            sleep(2); 
        }

        if ($totalScore['count'] === 0) {
            return ['error' => 'Không thể lấy phản hồi từ Azure.'];
        }

        $avgGrammar = round($totalScore['grammar'] / $totalScore['count'], 1);
        $avgVocabulary = round($totalScore['vocabulary'] / $totalScore['count'], 1);
        $avgCoherence = round($totalScore['coherence'] / $totalScore['count'], 1);
        $overallScore = round(($avgGrammar + $avgVocabulary + $avgCoherence) / 3, 1);

        $submission->update([
            'ai_score' => $overallScore,
            'ai_feedback' => implode("\n\n", $overallFeedbacks),
            'grammar_score' => $avgGrammar,
            'vocabulary_score' => $avgVocabulary,
            'coherence_score' => $avgCoherence,
        ]);

        foreach ($allFeedback as $fb) {
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

    /**
     * Tách bài viết thành nhiều đoạn khoảng 300 từ
     */
    private function splitEssayIntoChunks(string $content, int $maxWords = 300): array
    {
        $words = preg_split('/\s+/', strip_tags($content));
        $chunks = [];
        $current = [];

        foreach ($words as $word) {
            $current[] = $word;

            if (count($current) >= $maxWords) {
                $chunks[] = implode(' ', $current);
                $current = [];
            }
        }

        if (!empty($current)) {
            $chunks[] = implode(' ', $current);
        }

        return $chunks;
    }
}
