<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\ProcessWritingSubmission;
use App\Models\WritingSubmission;
use App\Models\WritingTest;
use App\Models\WritingSubmissionFeedBack;
use App\Services\AiScoringService;
use Illuminate\Support\Str;


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

    $feedbacks = $feedbacks->sortBy('start_offset');

    $modified = '';
    $lastPos = 0;

    foreach ($feedbacks as $f) {
        $start = $f->start_offset;
        $end = $f->end_offset;
        $segment = Str::of($content)->substr($start, $end - $start);

        $class = match ($f->issue_type) {
            'coherence' => 'span-desc bg-green-300/60',
            'grammar' => 'span-desc-highlight bg-yellow-200/60',
            'vocabulary' => 'span-desc-red bg-red-200/60',
            default => '',
        };

        $modified .= e(Str::of($content)->substr($lastPos, $start - $lastPos));
        $modified .= "<span class=\"{$class}\" data-tooltip=\"".e($f->feedback)."\">".e($segment)."</span>";
        $lastPos = $end;
    }

    $modified .= e(Str::of($content)->substr($lastPos));

    return view('submissions.show', [
        'submission' => $submission,
        'highlightedContent' => $modified,
    ]);
   }

    public function processing($id)
    {
        $submission = WritingSubmission::findOrFail($id);

        return view('submissions.processing', [
            'submissionId' => $id,
            'error' => $submission->error_message,
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