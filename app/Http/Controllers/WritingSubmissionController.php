<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\ProcessWritingSubmission;
use App\Models\WritingSubmission;
use App\Models\WritingTest;
use App\Models\WritingSubmissionFeedBack;
use App\Services\AiScoringService;
use Illuminate\Support\Str;
use App\Models\Trick;


class WritingSubmissionController extends Controller
{
    public function submit(Request $request)
    {
        $validated = $request->validate([
            'test_id' => 'required|exists:writing_tests,id',
            'content' => 'required|string|min:50',
        ]);

        $submission = WritingSubmission::create([
            'test_id' => $validated['test_id'],
            'content' => $validated['content'],
            'word_count' => str_word_count(strip_tags($validated['content'])),
            'submitted_at' => now(),
        ]);

        ProcessWritingSubmission::dispatch([
            ...$validated,
            'submission_id' => $submission->id,
        ]);

        
        $previousSubmission = WritingSubmission::where('test_id', $submission->test_id)
            ->where('id', '<', $submission->id)
            ->whereNotNull('ai_score')
            ->orderByDesc('id')
            ->first();

       return redirect()->route('submissions.processing', ['id' => $submission->id]);

    }

   public function show($id)
   {
        $submission = WritingSubmission::with('feedbacks')->findOrFail($id);
        $content = $submission->content;
        $feedbacks = $submission->feedbacks;

        $feedbacks = $feedbacks->sortByDesc(fn ($f) => mb_strlen($f->original_text)); // Ưu tiên đoạn dài hơn để tránh bọc lồng nhau

        $replacements = [];

        foreach ($feedbacks as $f) {
            $original = $f->original_text;
            $escapedFeedback = e($f->feedback);

            $class = match ($f->issue_type) {
                'coherence' => 'span-desc bg-green-300/60',
                'grammar' => 'span-desc-highlight bg-yellow-200/60',
                'vocabulary' => 'span-desc-red bg-red-200/60',
                default => '',
            };

            $wrapped = "<span class=\"{$class}\" data-tooltip=\"{$escapedFeedback}\">" . e($original) . "</span>";

            $replacements[$original] = $wrapped;
        }

        $highlighted = e($content);

        foreach ($replacements as $original => $wrapped) {
            $highlighted = preg_replace('/' . preg_quote(e($original), '/') . '/u', $wrapped, $highlighted, 1);
        }

        return view('submissions.show', [
            'submission' => $submission,
            'highlightedContent' => $highlighted,
        ]);
    }


    public function processing($id)
    {
        $submission = WritingSubmission::findOrFail($id);
        $tricks = Trick::all();

        return view('submissions.processing', [
            'submissionId' => $id,
            'error' => $submission->error_message,
            'tricks' => $tricks,
        ]);
    }

    public function checkError($id)
    {
        $submission = WritingSubmission::findOrFail($id);

        return response()->json([
            'status' => $submission->ai_score ? 'done' : 'processing',
            'error' => $submission->error_message,
        ]);
    }


} 