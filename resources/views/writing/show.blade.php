@extends('layouts.app')

@section('title', 'Your Test Grading')

@section('content')
@php
    // Dữ liệu mẫu - sau này sẽ từ Controller
    $gradingData = $gradingData ?? (object) [
        'overall_score_text' => 'Good Progress!', // Hoặc số điểm
        'image_url' => asset('images/figma/grading-illustration.png'), // THAY TÊN ẢNH
        'tips_and_tricks' => [
            "Focus on varying your sentence structures.",
            "Try to use a wider range of topic-specific vocabulary.",
            "Ensure your arguments are well-supported with examples.",
        ]
    ];
@endphp
<div class="max-w-3xl mx-auto px-4 py-12 text-center">
    <h1 class="text-3xl lg:text-4xl font-extrabold text-figma-text-title mb-8 text-shadow-glow-yellow">
        Grading your test
    </h1>

    <div class="bg-figma-card-bg p-6 sm:p-8 rounded-xl shadow-xl mb-10">
        <img src="{{ $gradingData->image_url }}" alt="Grading Illustration" class="max-w-xs sm:max-w-sm mx-auto mb-6 rounded-lg">
        {{-- Hiển thị điểm số hoặc nhận xét chung --}}
        {{-- <p class="text-2xl font-bold text-figma-text-light mb-6">{{ $gradingData->overall_score_text }}</p> --}}
    </div>

    @if(!empty($gradingData->tips_and_tricks))
    <section class="text-left">
        <h2 class="text-2xl font-bold text-figma-text-title mb-6 text-shadow-glow-yellow">Tips and Tricks</h2>
        <div class="bg-figma-card-bg p-6 rounded-xl shadow-xl space-y-3">
            @foreach($gradingData->tips_and_tricks as $tip)
            <div class="flex items-start space-x-3">
                <svg class="h-5 w-5 text-figma-accent flex-shrink-0 mt-0.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                <p class="text-figma-text-card-desc text-sm">{{ $tip }}</p>
            </div>
            @endforeach
        </div>
    </section>
    @endif
</div>
@endsection