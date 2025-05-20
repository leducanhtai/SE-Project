<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\ProcessWritingSubmission;
use App\Models\WritingSubmission;
use App\Models\WritingTest;
use App\Models\WritingSubmissionFeedBack;
use App\Services\AiScoringService;


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

        return redirect()->route('submissions.processing', ['id' => $submission->id]);
    }

    public function show($id)
    {
        $submission = WritingSubmission::with('feedbacks')->findOrFail($id);
        return view('submissions.show', compact('submission'));
    }

    public function processing($id)
    {
        return view('submissions.processing', ['submissionId' => $id]);
    }
}
