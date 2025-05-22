@extends('layouts.app')

@section('content')

<div class="fixed top-25 left-65 right-0 z-[50] bg-[rgba(233,223,223,0.14)] px-5 py-5 flex justify-between items-center min-h-[80px] text-[48px]" style="text-shadow: 0px 0px 20px rgba(240, 229, 15, 0.876);">
    <div>{{ $writingTest->title }}</div>
    <div class="font-bold" id="countdown">40:00</div>
</div>

<div class="bg-[#1e1533] text-[rgba(255,231,152,1)] min-h-screen py-[60px] px-[30px]">
    <div class="mx-auto mt-[50px]">
        <p class="text-[36px] font-bold mb-6 leading-relaxed" style="text-shadow: 0px 0px 20px rgba(240,229,15,0.876);">
            {{ $writingTest->task_content }}
        </p>

        <form id="writingForm" action="{{ route('writing.submit') }}" method="POST">
            @csrf
            <input type="hidden" name="test_id" value="{{ $writingTest->id }}">

            <textarea
                id="writingAnswer"
                name="content"
                required
                placeholder="Viết bài tại đây..."
                class="w-full min-h-[400px] bg-white text-gray-900 rounded-[20px] p-5 text-base leading-relaxed shadow-[0_10px_30px_rgba(0,0,0,0.2)] resize-y font-['Poppins'] box-border"
            ></textarea>

            <div id="wordCount" class="text-right text-base font-medium mt-3" style="text-shadow: 0px 0px 20px rgba(240,229,15,0.876);">
                0 từ
            </div>

            <button type="submit" class="mt-5 px-8 py-2 bg-[#f8f7b8] text-[#1e1533] font-bold rounded-[30px] text-base transition hover:shadow-[0_0_20px_rgba(240,229,15,0.876)]">
                SUBMIT
            </button>
        </form>
    </div>

    <!-- Modal xác nhận -->
    <div id="confirmModal" class="fixed inset-0 flex items-center justify-center bg-white/25 bg-opacity-50 z-50 hidden">
        <div class="bg-white text-black p-6 rounded-[20px] max-w-md w-full text-center shadow-xl">
            <h2 class="text-xl font-bold mb-4">Bạn có chắc chắn muốn nộp bài?</h2>
            <p class="mb-6">Sau khi nộp, bạn sẽ không thể chỉnh sửa.</p>
            <div class="flex justify-center gap-4">
                <button id="cancelSubmit" class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400">Hủy</button>
                <button id="confirmSubmit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Nộp bài</button>
            </div>
        </div>
    </div>
</div>

<script>
    const countdownElement = document.getElementById('countdown');
    const textarea = document.getElementById('writingAnswer');
    const wordCountDisplay = document.getElementById('wordCount');
    const form = document.getElementById('writingForm');

    const testId = '{{ $writingTest->id }}';
    const timeLimitMinutes = {{ $writingTest->time_limit }};
    const timeLimitSeconds = timeLimitMinutes * 60;

    const startTimeKey = `writing_test_start_${testId}`;
    const answerKey = `writing_answer_${testId}`;

    function initStartTime() {
        if (!localStorage.getItem(startTimeKey)) {
            localStorage.setItem(startTimeKey, Date.now().toString());
        }
    }

    function calculateTimeLeft() {
        const startTimestamp = parseInt(localStorage.getItem(startTimeKey), 10);
        const nowTimestamp = Date.now();
        const timePassed = Math.floor((nowTimestamp - startTimestamp) / 1000);
        return timeLimitSeconds - timePassed;
    }

    function updateCountdownDisplay() {
        const minutes = Math.floor(timeLeft / 60);
        const seconds = timeLeft % 60;
        countdownElement.textContent = `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
    }

    function handleTimeUp() {
        if (form.requestSubmit) {
            form.requestSubmit();
        } else {
            form.submit();
        }

        clearInterval(countdownInterval);
        countdownElement.textContent = 'Hết giờ';
        textarea.disabled = true;

        alert('Đã hết thời gian làm bài!');

        localStorage.removeItem(answerKey);
        localStorage.removeItem(startTimeKey);
    }

    function loadSavedContent() {
        const savedContent = localStorage.getItem(answerKey);
        if (savedContent) {
            textarea.value = savedContent;
            updateWordCount(savedContent);
        }
    }

    function updateWordCount(text) {
        const words = text.trim().split(/\s+/).filter(word => word.length > 0);
        wordCountDisplay.textContent = `${words.length} từ`;
    }

    function attachEventListeners() {
        textarea.addEventListener('input', function () {
            updateWordCount(this.value);
            localStorage.setItem(answerKey, this.value);
        });

        form.addEventListener('submit', function (e) {
            e.preventDefault();
            confirmModal.classList.remove('hidden');
        });

        cancelSubmit.addEventListener('click', function () {
            confirmModal.classList.add('hidden');
        });

        confirmSubmit.addEventListener('click', function () {
   
            confirmSubmit.disabled = true;
            confirmSubmit.textContent = 'Đang nộp...';

            textarea.disabled = false;
            localStorage.removeItem(answerKey);
            localStorage.removeItem(startTimeKey);
            form.submit();
        });

    }

    initStartTime();
    let timeLeft = calculateTimeLeft();
    const countdownInterval = setInterval(() => {
        if (timeLeft <= 0) {
            handleTimeUp();
        } else {
            updateCountdownDisplay();
            timeLeft--;
        }
    }, 1000);
    updateCountdownDisplay();
    loadSavedContent();
    attachEventListeners();
</script>

@endsection
