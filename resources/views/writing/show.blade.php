@extends('layouts.app')

@section('content')

<div class="fixed top-25 left-65 right-0 z-[50] bg-[rgba(233,223,223,0.14)] px-5 py-5 flex justify-between items-center min-h-[80px] text-[48px]" style="text-shadow: 0px 0px 20px rgba(240, 229, 15, 0.876);">
    <div>{{ $writingTest->title }}</div>
    <div class="font-bold" id="countdown">40:00</div>
</div>

<div class="bg-[#1e1533] text-[rgba(255,231,152,1)] min-h-screen py-[60px] px-[30px]">
    
    <div class="max-w-9xl mx-auto mt-20 w-full">

        <p class="text-[36px] font-bold mb-6 leading-relaxed" style="text-shadow: 0px 0px 20px rgba(240,229,15,0.876);">
            {{ $writingTest->task_content }}
        </p>

        <form action="{{ route('writing.submit') }}" method="POST">
            @csrf
            <textarea id="writingAnswer"
                      name="content"
                      required
                      placeholder="Viết bài tại đây..."
                      class="w-full min-h-[400px] bg-white text-gray-900 rounded-[20px] p-5 text-base leading-relaxed shadow-[0_10px_30px_rgba(0,0,0,0.2)] resize-y font-['Poppins'] box-border"
            ></textarea>

            <div id="wordCount"
                 class="text-right text-base font-medium mt-3"
                 style="text-shadow: 0px 0px 20px rgba(240,229,15,0.876);"
            >
                0 từ
            </div>

            <button type="submit"
                    class="mt-5 px-8 py-2 bg-[#f8f7b8] text-[#1e1533] font-bold rounded-[30px] text-base transition hover:shadow-[0_0_20px_rgba(240,229,15,0.876)]"
            >
                SUBMIT
            </button>
        </form>
    </div>
</div>

<script>
    const countdownElement = document.getElementById('countdown');
    let timeInMinutes = {{ $writingTest->time_limit }};
    let time = timeInMinutes * 60;

    const textarea = document.getElementById('writingAnswer');
    const wordCountDisplay = document.getElementById('wordCount');

    textarea.addEventListener('input', function () {
        const words = this.value.trim().split(/\s+/).filter(word => word.length > 0);
        wordCountDisplay.textContent = `${words.length} từ`;
    });

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
