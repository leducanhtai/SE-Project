<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\WritingTest;

class WritingTestController extends Controller
{
    //
    public function index()
    {
        $writingTests = WritingTest::where('task', 'task2')->get();
        return view('writing.index', 
            [
                'writingTests' => $writingTests
            ]
        );
    }

    public function show($id)
    {
        $writingTest = WritingTest::findOrFail($id);
        return view('writing.show', 
            [
                'writingTest' => $writingTest
            ]
        );
    }

    public function showPart()
    {
       return view('writing.writing-part-list');
    }

    public function showDashboard()
    {
        return view('dashboard.index');
    }
}
