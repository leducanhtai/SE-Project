@extends('layouts.app')

@section('title', $test->title ?? 'Writing Test')

@section('content')
    <div class="max-w-3xl mx-auto px-4 py-8">
        <div class="flex flex-col sm:flex-row justify-between items-center mb-8">
            <h1 class="text-3xl lg:text-4xl font-extrabold text-figma-text-title text-shadow-glow-yellow mb-4 sm:mb-0">
                {{ $test->title }}
            </h1>
            <div id="timer-display" class="text-3xl lg:text-4xl font-bold text-figma-text-light bg-gray-700/50 px-4 py-2 rounded-md">
                {{ gmdate("i:s", $test->time_limit_seconds ?? 1200) }}
            </div>
        </div>

        <div class="bg-transparent p-1 rounded-lg mb-8">
            <p class="text-figma-text-light text-base md:text-lg leading-relaxed">
                {{ $test->prompt }}
            </p>
        </div>

        <form id="writingTestForm" action="{{ route('writing.test.submit', ['writingTest' => $test->id]) }}" method="POST">
            @csrf
            <div class="mb-6">
                <textarea id="writingArea" name="writing_submission"
                          class="w-full min-h-[300px] md:min-h-[350px] p-4 sm:p-5 bg-figma-textarea-bg text-figma-textarea-text text-base rounded-xl shadow-lg focus:ring-2 focus:ring-figma-accent focus:border-transparent placeholder-gray-400/70 resize-y"
                          placeholder="Start typing your answer here..."
                          style="color: #374151; line-height: 1.6;">{{ $test->initial_text ?? '' }}</textarea>
            </div>

            <div class="flex flex-col sm:flex-row justify-between items-center">
                <button type="submit"
                        class="bg-figma-button-submit-bg text-figma-button-submit-text font-semibold py-2.5 px-10 rounded-full shadow-md hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:ring-opacity-50 transition-opacity text-base order-last sm:order-first mt-4 sm:mt-0">
                    SUBMIT
                </button>
                <div id="wordCountDisplay" class="text-figma-text-light font-medium text-md">
                    0 words
                </div>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const writingArea = document.getElementById('writingArea');
    const wordCountDisplay = document.getElementById('wordCountDisplay');
    const timerDisplay = document.getElementById('timer-display');
    let timeRemaining = {{ $test->time_limit_seconds ?? 1200 }};

    function updateWordCount() {
        if (!writingArea) return;
        const text = writingArea.value.trim();
        const words = text === '' ? 0 : text.split(/\s+/).filter(Boolean).length;
        if (wordCountDisplay) wordCountDisplay.textContent = `${words} word${words !== 1 ? 's' : ''}`;
    }

    function updateTimerDisplay() {
        if (!timerDisplay) return;
        const minutes = Math.floor(timeRemaining / 60);
        const seconds = timeRemaining % 60;
        timerDisplay.textContent = `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
    }

    if (writingArea) {
        writingArea.addEventListener('input', updateWordCount);
        updateWordCount();
    }

    if (timerDisplay && timeRemaining > 0) {
        updateTimerDisplay();
        const countdown = setInterval(() => {
            timeRemaining--;
            if (timeRemaining >= 0) {
                updateTimerDisplay();
            } else {
                clearInterval(countdown);
                timerDisplay.textContent = "00:00";
                if(writingArea) writingArea.disabled = true;
            }
        }, 1000);
    } else if (timerDisplay) {
         timerDisplay.textContent = "00:00";
    }
});
</script>
@endpush