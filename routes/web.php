<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WritingTestController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/test',[WritingTestController::class, 'index'])->name('writing.test.index');
