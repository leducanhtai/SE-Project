@extends('layouts.app')

@section('title', 'Writing Test History')

@section('content')
@php
    // Dữ liệu mẫu - sau này sẽ từ Controller
    $histories = $histories ?? [
        (object)['id' => 1, 'test_title' => 'Test About Traditional Games', 'part_title' => 'Part 1', 'submission_date' => \Carbon\Carbon::now()->subDays(2)->format('M d, Y - H:i A'), 'score' => 85, 'status' => 'Graded'],
        (object)['id' => 2, 'test_title' => 'Essay on Environmental Issues', 'part_title' => 'Part 2', 'submission_date' => \Carbon\Carbon::now()->subDays(5)->format('M d, Y - H:i A'), 'score' => null, 'status' => 'Submitted for Grading'],
        (object)['id' => 3, 'test_title' => 'Report on Charity Donations', 'part_title' => 'Part 1', 'submission_date' => \Carbon\Carbon::now()->subDays(10)->format('M d, Y - H:i A'), 'score' => 70, 'status' => 'Graded'],
    ];
    $groupedHistories = collect($histories)->groupBy(function($item) {
        return \Carbon\Carbon::parse($item->submission_date)->isSameWeek(\Carbon\Carbon::now()) ? 'This Week' : (\Carbon\Carbon::parse($item->submission_date)->isSameWeek(\Carbon\Carbon::now()->subWeek()) ? 'Last Week' : 'Older');
    });
@endphp

<div class="max-w-4xl mx-auto px-4 py-8">
    <h1 class="text-3xl lg:text-4xl font-extrabold text-figma-text-title mb-10 text-shadow-glow-yellow">
        Test History
    </h1>

    @if($groupedHistories->isEmpty())
        <p class="text-figma-text-light text-center text-xl">You haven't submitted any tests yet.</p>
    @else
        @foreach($groupedHistories as $groupTitle => $groupItems)
            <section class="mb-10">
                <h2 class="text-xl font-semibold text-figma-text-light mb-4">{{ $groupTitle }}</h2>
                <div class="bg-figma-card-bg rounded-xl shadow-xl overflow-hidden">
                    <ul role="list" class="divide-y divide-gray-700/50">
                        @foreach($groupItems as $history)
                        <li class="px-6 py-4 hover:bg-figma-card-bg/70 transition-colors">
                            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between space-y-2 sm:space-y-0">
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-semibold text-figma-text-card-title truncate">{{ $history->test_title }}</p>
                                    <p class="text-xs text-figma-text-card-desc">{{ $history->part_title }} - Submitted: {{ $history->submission_date }}</p>
                                </div>
                                <div class="flex items-center space-x-4 flex-shrink-0 sm:ml-6">
                                    @if($history->status == 'Graded' && !is_null($history->score))
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-700 text-green-100">
                                        {{ $history->score }}/100
                                    </span>
                                    @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-700 text-yellow-100">
                                        {{ $history->status }}
                                    </span>
                                    @endif
                                    <a href="{{-- route('submission.feedback.show', ['submission' => $history->id]) --}}" class="text-figma-accent hover:text-yellow-300 text-sm font-medium">
                                        View Details
                                    </a>
                                    {{-- Placeholder cho nút menu 3 chấm --}}
                                    <button type="button" class="text-gray-400 hover:text-white">
                                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                          <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </section>
        @endforeach
    @endif
</div>
@endsection