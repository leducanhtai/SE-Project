<!DOCTYPE html>
<html lang="vi">
  <head>
    <meta charset="UTF-8" />
    <title>Đang chấm điểm...</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
  </head>
  <body
    class="bg-[#1f1433] text-[#f8f7b8] font-sans min-h-screen flex items-center justify-center"
  >
    <div class="text-center">
      <h1
        class="text-3xl md:text-4xl font-bold mb-6 drop-shadow-[0_0_20px_rgba(240,229,15,0.876)]"
      >
        Grading your test...
      </h1>

      <div class="rounded-2xl overflow-hidden flex flex-col items-center mb-10">
        <img
          src="{{ asset('image/grading.png') }}"
          alt="Grading Illustration"
          class="w-full max-w-2xl"
        />
        <div class="px-12 text-left mt-4 max-w-[780px]">
          <h2 class="text-[#f8f7b8] text-xl mb-2 font-semibold">
            Tips and tricks
          </h2>
          <p id="trick-text" class="text-base leading-relaxed text-[#f8f7b8]">
            {{ $tricks->first()->trick ?? 'No tips available.' }}
          </p>
        </div>
      </div>

      <!-- Progress bar thay thế spinner -->
        <div class="w-[600px] h-3 rounded-full overflow-hidden bg-gray-300 mb-6 mx-auto">
            <div id="progress-bar" class="h-full bg-yellow-300 transition-all duration-500" style="width: 0%"></div>
        </div>


      <!-- Error box giữ nguyên -->
      <div
        id="error-box"
        class="error-box"
        style="{{ $error ? '' : 'display: none;' }}"
      >
        @if ($error)
        <strong>Lỗi:</strong> {{ $error }} @endif
      </div>
    </div>

    <style>
      .spinner {
        width: 40px;
        height: 40px;
        border: 5px solid #ccc;
        border-top-color: #333;
        border-radius: 50%;
        animation: spin 1s linear infinite;
        display: inline-block;
      }

      @keyframes spin {
        to {
          transform: rotate(360deg);
        }
      }

      .error-box {
        background-color: #fee2e2;
        border: 1px solid #fca5a5;
        color: #b91c1c;
        padding: 16px;
        border-radius: 8px;
        display: inline-block;
      }
    </style>

    <script>
        @if (!$error)
        const errorBox = document.getElementById('error-box');

        const checkStatus = async () => {
            try {
                const res = await fetch('/submission/{{ $submissionId }}/check-error');
                const data = await res.json();

                if (data.status === 'done') {
                    window.location.href = '/submission/{{ $submissionId }}';
                } else if (data.error) {
                    errorBox.innerHTML = '<strong>Lỗi:</strong> ' + data.error;
                    errorBox.style.display = 'inline-block';
                }
            } catch (err) {
                console.error("Không thể kiểm tra trạng thái:", err);
            }
        };

        setInterval(checkStatus, 3000);

        setTimeout(() => {
            window.location.reload();
        }, 50000);
        @endif


      const tricks = @json($tricks->pluck('trick'));
      let currentTrick = 0;

      if (tricks.length > 1) {
        setInterval(() => {
          currentTrick = (currentTrick + 1) % tricks.length;
          document.getElementById('trick-text').innerText = tricks[currentTrick];
        }, 3000);
      }
    </script>
  </body>
</html>
