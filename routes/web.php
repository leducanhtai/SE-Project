<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WritingTestController;
use App\Http\Controllers\WritingSubmissionController;
use App\Http\Controllers\WritingSubmissionFeedbackController;
// use App\Http\Controllers\WritingController;
use App\Services\AiScoringService;

Route::get('/', function () {
    return view('home');
})->name('home');



Route::get('/test',[WritingTestController::class, 'index'])->name('writing.test.index');
Route::get('/test/{id}', [WritingTestController::class, 'show'])->name('writing.test.show');
Route::post('/submit-writing', [WritingSubmissionController::class, 'submit'])->name('writing.submit');
Route::get('/submission/{id}', [WritingSubmissionController::class, 'show'])->name('submissions.show');
Route::get('/submission/{id}/processing', [WritingSubmissionController::class, 'processing'])->name('submissions.processing');
Route::get('/api/submission-status/{id}', function ($id) {
    $submission = \App\Models\WritingSubmission::find($id);
    return [
        'status' => $submission && $submission->ai_score !== null ? 'done' : 'processing',
    ];
});

