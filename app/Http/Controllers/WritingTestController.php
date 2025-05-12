<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\WritingTest;

class WritingTestController extends Controller
{
    //
    public function index()
    {
        $writingTests = WritingTest::where('task', 'task1')->get();
        return view('writing.index', 
            [
                'writingTests' => $writingTests
            ]
        );
    }
}
