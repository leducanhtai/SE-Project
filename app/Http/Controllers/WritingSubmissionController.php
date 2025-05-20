<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AiScoringService;
use App\Models\WritingSubmission;

class WritingSubmissionController extends Controller
{
    protected $aiScoring;

    public function __construct(AiScoringService $aiScoring)
    {
        $this->aiScoring = $aiScoring;
    }

    public function submit(Request $request)
    {
        $validated = $request->validate([
            'test_id' => 'required|exists:writing_tests,id',
            'content' => 'required|string|min:50',
        ]);

        $result = $this->aiScoring->scoreAndStore($validated);

        if (isset($result['error'])) {
            return response()->json($result, 500);
        }

        return redirect()->route('submissions.processing', ['id' => $result['submission']->id]);

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
