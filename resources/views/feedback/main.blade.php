@extends('layouts.app')

@section('title', 'AI Feedback - Submission #' . ($submission->id ?? 'N/A'))

@section('content')
@php
    // Dữ liệu mẫu - sau này sẽ từ Controller
    $submission = $submission ?? (object) [
        'id' => 123,
        'submitted_text' => "The bar chart illustrates the amount of money donated by a company to six different types of charity from 2012 to 2014. Overall, it is evident that social welfare consistently received the largest donations, whereas wildlife and arts attracted the least funding throughout the period. Additionally, while some categories witnessed fluctuations, others experienced steady increases or remained relatively unchanged. In 2012, social welfare topped the list with approximately 25 units of donation, which then rose to just under 30 units in 2013 before falling slightly to 28 units in 2014. Health care, the second most popular charity, started at 22 units and saw a gradual increase to 25 units over the three years. Donations to education and environment followed a similar upward trend, albeit at lower levels, ending at 15 and 12 units respectively in 2014. In contrast, funding for wildlife and arts remained the lowest. Wildlife donations fluctuated around 5 units, while arts funding stayed consistently at approximately 3 units throughout the entire period. It is also noteworthy that the gap between the most and least funded charities widened over time.",
        'overall_score' => 75,
        'score_since_last' => 15, // %
        'performance_by_skill' => [
            (object)['skill' => 'Grammar', 'score' => 80],
            (object)['skill' => 'Vocabulary', 'score' => 70],
            (object)['skill' => 'Cohesion', 'score' => 75],
            (object)['skill' => 'Task Achievement', 'score' => 65],
        ],
        'ai_feedbacks_raw' => [ // Dữ liệu AI feedback thô - cần JS để xử lý highlight
            (object)['type' => 'grammar', 'segment' => 'amount of money donated by a company to six different types', 'suggestion' => 'Consider "amount of money a company donated to six different types"...', 'explanation' => 'Slightly more natural phrasing.'],
            (object)['type' => 'vocabulary', 'segment' => 'topped the list', 'suggestion' => 'Alternative: "led the ranking"', 'explanation' => 'Provides variety.'],
        ]
    ];
@endphp

<div class="max-w-5xl mx-auto px-4 py-8 space-y-10">
    {{-- Overview Section --}}
    <section class="bg-figma-card-bg p-6 rounded-xl shadow-xl">
        <h2 class="text-2xl font-bold text-figma-text-title mb-6">Overview</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
            {{-- Summary Score & Pie Chart --}}
            <div class="flex flex-col md:flex-row items-center space-y-4 md:space-y-0 md:space-x-6">
                <div class="relative w-40 h-40">
                    {{-- Placeholder cho Pie Chart --}}
                    <svg viewBox="0 0 36 36" class="w-full h-full">
                        <path class="text-gray-700" stroke-width="3.8" fill="none"
                              d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                        <path class="text-figma-accent" stroke-width="3.8" fill="none"
                              stroke-dasharray="{{ $submission->overall_score }}, 100"
                              d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                    </svg>
                    <div class="absolute inset-0 flex flex-col items-center justify-center">
                        <span class="text-4xl font-bold text-figma-text-light">{{ $submission->overall_score }}%</span>
                    </div>
                </div>
                <div class="text-center md:text-left">
                    <p class="text-lg text-figma-text-light">Summary Score</p>
                    @if(isset($submission->score_since_last) && $submission->score_since_last > 0)
                    <p class="text-sm text-green-400">+{{ $submission->score_since_last }}% since last test</p>
                    @elseif(isset($submission->score_since_last) && $submission->score_since_last < 0)
                    <p class="text-sm text-red-400">{{ $submission->score_since_last }}% since last test</p>
                    @endif
                </div>
            </div>

            {{-- Performance on Each Skill (Bar Chart) --}}
            <div>
                <h3 class="text-lg font-semibold text-figma-text-light mb-3 text-center md:text-left">Average Performance on Each Skill</h3>
                <div class="space-y-2">
                    @foreach($submission->performance_by_skill as $skill_data)
                    <div class="flex items-center">
                        <span class="text-sm text-figma-text-card-desc w-1/3 truncate">{{ $skill_data->skill }}</span>
                        <div class="w-2/3 bg-gray-700 rounded-full h-2.5">
                            <div class="bg-figma-accent h-2.5 rounded-full" style="width: {{ $skill_data->score }}%"></div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- AI Feedback Section --}}
    <section class="bg-figma-card-bg p-6 rounded-xl shadow-xl">
        <h2 class="text-2xl font-bold text-figma-text-title mb-6">AI Feedback</h2>
        <div id="submission-text-display" class="prose prose-invert max-w-none text-figma-text-card-desc leading-relaxed p-4 bg-gray-800/30 rounded-lg">
            {{-- JavaScript sẽ được dùng để highlight text ở đây dựa trên $submission->ai_feedbacks_raw --}}
            {{-- Hiện tại chỉ hiển thị text thô --}}
            <p>{{ $submission->submitted_text }}</p>
        </div>

        {{-- Danh sách gợi ý (ví dụ) --}}
        <div class="mt-6 space-y-3">
            @if(!empty($submission->ai_feedbacks_raw))
                @foreach($submission->ai_feedbacks_raw as $feedback_item)
                    <div class="p-3 bg-gray-700/50 rounded-md">
                        <p class="text-sm text-figma-accent font-semibold">Suggestion ({{ $feedback_item->type }}):</p>
                        <p class="text-xs text-figma-text-card-desc italic">"...{{ $feedback_item->segment }}..."</p>
                        <p class="text-sm text-figma-text-light mt-1">{{ $feedback_item->suggestion }}</p>
                        @if(isset($feedback_item->explanation))
                        <p class="text-xs text-gray-400 mt-1">{{ $feedback_item->explanation }}</p>
                        @endif
                    </div>
                @endforeach
            @else
                <p class="text-figma-text-card-desc">No specific AI feedback items to display.</p>
            @endif
        </div>
    </section>
</div>
@endsection

@push('scripts')
{{-- Script để vẽ biểu đồ và highlight text sẽ được thêm vào đây sau --}}
{{-- Ví dụ: <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> --}}
<script>
</script>
@endpush