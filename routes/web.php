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
Route::post('/test-gemini', [WritingController::class, 'testGemini'])->name('writing.test.gemini');
