<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\WritingSubmission;
use App\Models\WritingSubmissionFeedback;
use App\Models\WritingTest;

class WritingController extends Controller
{
    // public function submit(Request $request)
    // {
    //     $validated = $request->validate([
    //         'test_id' => 'required|exists:writing_tests,id',
    //         'content' => 'required|string|min:50',
    //    ]);

    //     $test = WritingTest::findOrFail($validated['test_id']);
    //     $wordCount = str_word_count(strip_tags($validated['content']));

    //     $prompt = "
    //         You are an IELTS writing examiner. Please:
    //         1. Evaluate the following writing task and essay response.
    //         2. Provide scores (0–9) for grammar, vocabulary, and coherence.
    //         3. Give overall feedback and detailed comments in this JSON format:
    //            {
    //                 \"overall_score\": float,
    //                 \"grammar\": float,
    //                 \"vocabulary\": float,
    //                 \"coherence\": float,
    //                 \"overall_feedback\": \"...\",
    //                 \"detailed_feedback\": [
    //                     {
    //                         \"original_text\": \"...\",
    //                         \"feedback\": \"...\",
    //                         \"issue_type\": \"grammar|vocabulary|coherence\",
    //                         \"start_offset\": int,
    //                         \"end_offset\": int
    //                     }]
    //             }

    //         --- Writing Task ---
    //         Title: {$test->title}
    //         Description: {$test->description}
    //         Instructions: {$test->task_content}
    //         Word Limit: {$test->task_word_limit}

    //         --- Essay ---
    //         {$validated['content']}
    //     ";

    //     $response = Http::withHeaders([
    //         'api-key' => env('AZURE_OPENAI_API_KEY'),
    //         'Content-Type' => 'application/json',
    //     ])->post(rtrim(env('AZURE_OPENAI_ENDPOINT'), '/') . '/openai/deployments/' . env('AZURE_OPENAI_DEPLOYMENT') . '/chat/completions?api-version=' . env('AZURE_OPENAI_API_VERSION', '2025-01-01-preview'), [
    //         'messages' => [
    //             ['role' => 'system', 'content' => 'You are a helpful assistant.'],
    //             ['role' => 'user', 'content' => $prompt]
    //         ],
    //         'temperature' => 0.3,
    //         'max_tokens' => 500,
    //     ]);

    //     $json = $response->json();
    //     $content = $json['choices'][0]['message']['content'] ?? null;

    //     if (!$content) {
    //         return response()->json(['error' => 'Azure không trả về nội dung.', 'response' => $json], 500);
    //     }

    //     preg_match('/({.*})/s', $content, $matches);
    //     $parsed = json_decode($matches[1] ?? '', true);

    //     if (!$parsed) {
    //         return response()->json(['error' => 'Không thể parse JSON từ Azure.', 'raw' => $content], 500);
    //     }

    //     $submission = WritingSubmission::create([
    //         'test_id' => $test->id,
    //         'content' => $validated['content'],
    //         'word_count' => $wordCount,
    //         'ai_score' => $parsed['overall_score'] ?? null,
    //         'ai_feedback' => $parsed['overall_feedback'] ?? '',
    //         'grammar_score' => $parsed['grammar'] ?? null,
    //         'vocabulary_score' => $parsed['vocabulary'] ?? null,
    //         'coherence_score' => $parsed['coherence'] ?? null,
    //         'submitted_at' => now(),
    //     ]);

    //     foreach ($parsed['detailed_feedback'] ?? [] as $fb) {
    //         WritingSubmissionFeedback::create([
    //             'submission_id' => $submission->id,
    //             'original_text' => $fb['original_text'],
    //             'feedback' => $fb['feedback'],
    //             'issue_type' => $fb['issue_type'],
    //             'start_offset' => $fb['start_offset'],
    //             'end_offset' => $fb['end_offset'],
    //         ]);
    //     }

    //     return view('submissions.show', ['submission' => $submission->load('feedbacks')]);
    // }


    // public function quickTestAzureOpenAI()
    // {
    //     $response = Http::withHeaders([
    //         'api-key' => env('AZURE_OPENAI_API_KEY'),
    //         'Content-Type' => 'application/json'
    //     ])->post(rtrim(env('AZURE_OPENAI_ENDPOINT'), '/') . '/openai/deployments/' . env('AZURE_OPENAI_DEPLOYMENT') . '/chat/completions?api-version=' . env('AZURE_OPENAI_API_VERSION', '2025-01-01-preview'), [
    //         'messages' => [
    //             ['role' => 'system', 'content' => 'You are a helpful assistant.'],
    //             ['role' => 'user', 'content' => 'Say hello in 3 different languages.']
    //        ],
    //         'temperature' => 0.2,
    //         'max_tokens' => 100
    //     ]);

    //     return response()->json($response->json());
    // }


}
