<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AiScoringService;

class WritingSubmissionController extends Controller
{
    protected $aiScoring;

    public function __construct(AiScoringService $aiScoring)
    {
        $this->aiScoring = $aiScoring;
    }

    public function submit(Request $request)
    {
        // $validated = $request->validate([
        //     'test_id' => 'required|exists:writing_tests,id',
        //     'content' => 'required|string|min:50',
        // ]);

        // $result = $this->aiScoring->scoreAndStore($validated);

        // if (isset($result['error'])) {
        //     return response()->json($result, 500);
        // }

        // return view('submissions.show', ['submission' => $result['submission']]);
        return view('submissions.show');
    }
}
