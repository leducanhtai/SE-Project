<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppController; // Controller cho trang chủ/dashboard
use App\Http\Controllers\WritingTestController;
use App\Http\Controllers\WritingSubmissionController;
use App\Http\Controllers\WritingSubmissionFeedbackController;
use App\Services\AiScoringService;

Route::get('/', [AppController::class, 'index'])->name('home');
Route::get('/dashboard', [AppController::class, 'index'])->name('dashboard'); // Thường thì dashboard sẽ là trang chính sau khi login

// --- CÁC ROUTE CHO CHỨC NĂNG WRITING ---
Route::get('/writing-parts', function () {
    $partsData = [
        ['id' => 1, 'title' => 'Part 1', 'image_url' => asset('images/figma/part1-image.png'), 'description' => "Desc for Part 1", 'route' => route('writing.test.start', ['writingPart' => 1]) ],
        ['id' => 2, 'title' => 'Part 2', 'image_url' => asset('images/figma/part2-image.png'), 'description' => "Desc for Part 2", 'route' => route('writing.test.start', ['writingPart' => 2]) ],
        ['id' => 3, 'title' => 'Part 3', 'image_url' => asset('images/figma/part3-image.png'), 'description' => "Desc for Part 3", 'route' => route('writing.test.start', ['writingPart' => 3]) ],
    ];
    return view('writing.part-list', ['parts' => $partsData]);
})->name('writing.parts');

Route::get('/writing/part/{writingPart}/test/start', function($writingPartId){
    $testId = (int)$writingPartId + 100; // Logic tạo testId mẫu
    return redirect()->route('writing.test.show', ['writingTest' => $testId]);
})->name('writing.test.start');

Route::get('/writing/test/{writingTest}', function ($writingTestId) {
    $testData = (object) [
        'id' => $writingTestId,
        'title' => 'Writing test ' . str_pad( ($writingTestId-100), 2, '0', STR_PAD_LEFT),
        'time_limit_seconds' => 20 * 60,
        'prompt' => "Some people think traditional games are better than modern games in helping children develop their abilities. To what extent do you agree? (Test ID: {$writingTestId})",
        'initial_text' => '',
    ];
    return view('writing.test', ['test' => $testData]);
})->name('writing.test.show');

Route::post('/writing/test/{writingTest}/submit', function (Illuminate\Http\Request $request, $writingTestId) {
    // Tạm thời redirect đến trang feedback mẫu với submission ID giả
    return redirect()->route('submission.feedback.show', ['submission' => 12345]);
})->name('writing.test.submit');

Route::get('/submission/{submission}/feedback', function ($submissionId) {
    // Dữ liệu mẫu sẽ được xử lý trong view feedback.main
    $submissionData = (object) ['id' => $submissionId];
    return view('feedback.main', ['submission' => $submissionData]);
})->name('submission.feedback.show');

Route::get('/writing-histories', function () {
    // Dữ liệu mẫu sẽ được xử lý trong view writing.histories
    return view('writing.histories');
})->name('writing.history');

Route::get('/grading/{submission}', function ($submissionId) {
    // Dữ liệu mẫu sẽ được xử lý trong view grading.show
    return view('grading.show', ['submissionId' => $submissionId]);
})->name('grading.show');


// --- CÁC ROUTE KHÁC (PLACEHOLDER) ---
Route::get('/courses-placeholder', function(){ return view('placeholder-page', ['pageTitle' => 'Courses']); })->name('courses');
Route::get('/about-placeholder', function(){ return view('placeholder-page', ['pageTitle' => 'About Us']); })->name('about');
Route::get('/pricing-placeholder', function(){ return view('placeholder-page', ['pageTitle' => 'Pricing']); })->name('pricing');
Route::get('/contact-placeholder', function(){ return view('placeholder-page', ['pageTitle' => 'Contact']); })->name('contact');
Route::get('/messages-placeholder', function(){ return view('placeholder-page', ['pageTitle' => 'Messages']); })->name('messages.index');
Route::get('/settings-placeholder', function(){ return view('placeholder-page', ['pageTitle' => 'Settings']); })->name('settings.profile');

// Nếu bạn có file auth.php từ Breeze hoặc Jetstream, hãy giữ lại:
// require __DIR__.'/auth.php';