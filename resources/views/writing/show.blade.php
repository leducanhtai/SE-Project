@extends('layouts.app')

@section('content')


    <div class="container">
        <div class="countdown-timer" id="countdown">
            {{ $writingTest->time_limit }}:00
        </div>
        <p class="task-text">
            Task 2: <span>{{ $writingTest->task_content }}</span>
        </p>
        {{-- <img src="{{ asset('image/' . $writingTest->task_image) }}" alt="Ảnh bài kiểm tra" class="task-image"> --}}
        
        {{-- <div>
        <label for="writingAnswer">Nhập bài viết của bạn (khoảng 200 từ):</label>
            <textarea id="writingAnswer" name="writingAnswer" class="writing-input" placeholder="Viết bài tại đây..."></textarea>
            <div class="word-count" id="wordCount">0 từ</div>
        </div>
        <a href="#" class="btn">Submiss</a> --}}

        <div class="word-count" id="wordCount">0 từ</div>
        <form action="{{ route('writing.submit') }}" method="POST">
            @csrf
            <input type="hidden" name="test_id" value="{{ $writingTest->id }}">
            <textarea id="writingAnswer" name="content" required class="writing-input" placeholder="Viết bài tại đây..."></textarea>
            <button type="submit" class="btn">Submit</button>
        </form>

    
    </div class="container">>

<script>
    // Countdown timer
    const countdownElement = document.getElementById('countdown');
    let timeInMinutes = {{ $writingTest->time_limit }};
    let time = timeInMinutes * 60; // Đổi sang giây

    const textarea = document.getElementById('writingAnswer');
    const wordCountDisplay = document.getElementById('wordCount');

    // Đếm từ
    textarea.addEventListener('input', function () {
        const words = this.value.trim().split(/\s+/).filter(word => word.length > 0);
        wordCountDisplay.textContent = `${words.length} từ`;
    });

    // Hàm định dạng thời gian
    function updateCountdown() {
        const minutes = Math.floor(time / 60);
        const seconds = time % 60;
        countdownElement.textContent = `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
        time--;

        if (time < 0) {
            clearInterval(countdownInterval);
            countdownElement.textContent = 'Hết giờ';
            textarea.disabled = true;
            alert('Đã hết thời gian làm bài!');
        }
    }

    const countdownInterval = setInterval(updateCountdown, 1000);

</script>

@endsection
