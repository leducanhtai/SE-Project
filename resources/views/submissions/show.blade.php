@extends('layouts.app')

@section('content')

<!-- MAIN CONTAINER -->
<div class="max-w-[1400px] w-full mx-auto font-[Poppins] text-white bg-[#1e1432] rounded-[20px]">
  <h2 class="text-[#f5d77f] text-[22px] font-semibold mb-[20px]">Overview</h2>
  <div class="flex flex-wrap justify-between bg-[#554c69] p-[40px] rounded-[30px] gap-[40px]">
    <!-- LEFT SUMMARY -->
    <div class="flex flex-[2] justify-between items-center px-[100px]">
      <div class="text-center">
        <p class="text-[24px] font-semibold mb-[10px]">summary score</p>
        <h1 id="score-display" class="text-[96px] font-bold m-0" data-score="{{ $submission->ai_score*10 ?? 0 }}">0%</h1>
        <p class="text-[24px] mt-[8px] flex items-center gap-[8px]">
           @if($submission->score_change !== null)
              <p class="text-[24px] mt-4 flex items-center space-x-2">
                <span>{{ abs($submission->score_change * 10) }}%</span>
                  @if($submission->score_increased)
                    <img src="{{ asset('icon/up.svg') }}" alt="Tăng so với lần trước" class="w-10 h-10">
                  @else
                    <img src="{{ asset('icon/down.svg') }}" alt="Giảm so với lần trước" class="w-10 h-10">
                  @endif
                <span>since last test</span>
              </p>
            @endif
        </p>

      </div>
      @php
        $score = $submission->ai_score ?? 0;
        $circlePercent = min(max($score * 10, 0), 100);
      @endphp

      <div class="pie-chart w-[227px] h-[227px] rounded-full" style="background: conic-gradient(#7edbfb 0% {{ $circlePercent }}%, #7e7a85 0%);"></div>

    </div>

    <!-- RIGHT CHART -->
    <div class="flex-1 bg-white text-[#2c2424] rounded-[30px] p-[30px] flex flex-col justify-center">
      <h3 class="text-[24px] font-bold text-center text-[#4a422e] mb-[30px]">
        AVERAGE PERFORMANCE<br />ON EACH SKILL
      </h3>
      <div class="flex">
        <ul class="list-none flex flex-col gap-[10px] text-[14px] font-medium p-0 text-black items-start mr-[100px]">
          <li class="flex items-center gap-[6px]"><span class="w-[12px] h-[12px] rounded-full bg-[#7edbfb] inline-block"></span> Coherence</li>
          <li class="flex items-center gap-[6px]"><span class="w-[12px] h-[12px] rounded-full bg-[#7042e8] inline-block"></span> Vocabulary</li>
          <li class="flex items-center gap-[6px]"><span class="w-[12px] h-[12px] rounded-full bg-[#041318] inline-block"></span> Grammar</li>
        </ul>
        @php
          $barUnit = 10; // 1 điểm = 10px
          $coherenceHeight = $submission->coherence_score * $barUnit;
          $vocabularyHeight = $submission->vocabulary_score * $barUnit;
          $grammarHeight = $submission->grammar_score * $barUnit;
        @endphp

        <div class="flex justify-around items-end h-[160px] mb-[20px] gap-[6px]">
          <div class="bar-chart w-[40px] rounded-t-[20px] bg-[#7edbfb] delay-[200ms]" style="height: {{ $coherenceHeight }}px"></div>
          <div class="bar-chart w-[40px] rounded-t-[20px] bg-[#7042e8] delay-[400ms]" style="height: {{ $vocabularyHeight }}px"></div>
          <div class="bar-chart w-[40px] rounded-t-[20px] bg-[#041318] delay-[600ms]" style="height: {{ $grammarHeight }}px"></div>
        </div>

      </div>
    </div>
  </div>
</div>

<!-- AI FEEDBACK -->
<div class="ai-feedback max-w-[1400px] w-full mx-auto mt-[50px] text-white font-[Poppins]">
  <div class="feedback-title text-[#f5d77f] text-[24px] font-bold mb-[10px]">AI Feedback</div>
  <div class="desc p-[20px] bg-white/25 rounded-[30px] text-[24px]">
    <p id="feedback-text" class="leading-8 text-[18px]">
       {!! $highlightedContent !!}
    </p>

  </div>
</div>

<!-- GENERAL COMMENTS -->
<div class="general max-w-[1400px] w-full mx-auto mt-[50px] text-white">
  <h2 class="title text-[#f5d77f] text-[24px] font-bold mb-[30px]">General comments</h2>
  <div class="general-comments bg-white/25 p-[30px] rounded-[30px] space-y-[30px]">
    <div class="comment-section">
      <h3 class="subtitle text-[20px] font-bold mb-[12px]">Strong points</h3>
      <div class="comment-box bg-white text-black p-[20px_25px] rounded-[20px] leading-[1.6]">
        <p>{{ $submission->ai_feedback }}</p>
      </div>
    </div>

    {{-- <div class="comment-section">
      <h3 class="subtitle text-[20px] font-bold mb-[12px]">Needs improvement</h3>
      <div class="comment-box bg-white text-black p-[20px_25px] rounded-[20px] leading-[1.6]">
        <p>Bài viết thể hiện khả năng paraphrase tốt, với cấu trúc đoạn rõ ràng và dễ theo dõi. Tác giả đã mô tả đầy đủ các dữ liệu chính trong biểu đồ mà không bỏ sót nội dung quan trọng. Ngoài ra, từ vựng được sử dụng khá chính xác, nổi bật với các cụm như “peaking”, “modest increase” và “remained stable”, cho thấy người viết có khả năng lựa chọn từ ngữ phù hợp với ngữ cảnh mô tả số liệu.</p>
      </div>
    </div> --}}

  </div>
</div>

<a href="{{ route('writing.test.index') }}" class="back-btn bg-[#f5d77f] text-[#1b0f2e] px-[30px] py-[10px] rounded-full font-bold text-[16px] float-right">BACK</a>

<div id="tooltip" class="tooltip">Câu mở đầu rõ ràng và chính xác, paraphrase tốt đề bài.</div>
<div id="tooltip-highlight" class="tooltip tooltip-highlight">Không hoàn toàn chính xác vì dữ liệu trong bài dường như không biến động quá lớn. Có thể thay bằng "some categories experienced moderate growth or remained stable."</div>
<div id="tooltip-red" class="tooltip tooltip-red">Không hoàn toàn chính xác vì dữ liệu trong bài dường như không biến động quá lớn. Có thể thay bằng "some categories experienced moderate growth or remained stable."</div>


  <style>
     /* Tooltip style */
    .tooltip {
      font-size: 50px;
      position: absolute;
      background-color: #0c3b07;
      color: white;
      padding: 15px 12px;
      border-radius: 8px;
      font-size: 24px !important;
      display: none;
      z-index: 999;

      max-width: 700px;
      white-space: normal;
      word-wrap: break-word;
    }

    .tooltip-highlight {
      background-color: #8e711b !important;
    }

    .tooltip-red {
      background-color: #4d0909 !important;
    }

  @keyframes rotateIn {
    0% {
      transform: rotate(0deg) scale(0.8);
      opacity: 0;
    }
    100% {
      transform: rotate(360deg) scale(1);
      opacity: 1;
    }
  }


  .animate-rotate-in {
    animation: rotateIn 1s ease-out forwards;
  }

  @keyframes growUp {
    0% {
      height: 0;
      transform: scaleY(0.2);
      opacity: 0;
    }
    100% {
      transform: scaleY(1);
      opacity: 1;
    }
  }

  .animate-grow {
    animation: growUp 0.8s cubic-bezier(0.25, 1.2, 0.5, 1) forwards;
    transform-origin: bottom;
  }
  </style>

<script>
  // ==== Tooltip logic ====

  function showTooltip(tooltipEl, event) {
  tooltipEl.style.display = "block";
  tooltipEl.style.left = `${event.pageX + 10}px`;
  tooltipEl.style.top = `${event.pageY + 10}px`;
}


  function hideTooltips(...tooltips) {
    tooltips.forEach(t => t.style.display = "none");
  }

  function setupAutoTooltip() {
  document.addEventListener('click', function (e) {
  const tooltip = document.getElementById("tooltip");
  const tooltipHighlight = document.getElementById("tooltip-highlight");
  const tooltipRed = document.getElementById("tooltip-red");

  if (e.target.matches('.span-desc, .span-desc-highlight, .span-desc-red')) {
    e.stopPropagation(); 

    hideTooltips(tooltip, tooltipHighlight, tooltipRed);

    const tooltipText = e.target.dataset.tooltip || '';
    let targetTooltip = tooltip;

    if (e.target.classList.contains('span-desc-highlight')) {
      targetTooltip = tooltipHighlight;
    } else if (e.target.classList.contains('span-desc-red')) {
      targetTooltip = tooltipRed;
    }

    targetTooltip.textContent = tooltipText;
    showTooltip(targetTooltip, e);
  }
});

}


  function setupGlobalTooltipClose(tooltipMap) {
    document.addEventListener("click", function (e) {
      for (const [triggers, tooltip] of tooltipMap) {
        const triggerList = Array.isArray(triggers) ? triggers : Array.from(triggers);
        const clickedInsideTrigger = triggerList.some(trigger => trigger.contains(e.target));
        if (!tooltip.contains(e.target) && !clickedInsideTrigger) {
          tooltip.style.display = "none";
        }
      }
    });
  }

  // ==== Animation logic ====

  function resetAnimation(el, className) {
    el.classList.remove(className);
    void el.offsetWidth; // Trigger reflow
    el.classList.add(className);
  }

  function animateOnLoad() {
    const pie = document.querySelector('.pie-chart');
    if (pie) resetAnimation(pie, 'animate-rotate-in');

    const bars = document.querySelectorAll('.bar-chart');
    bars.forEach(bar => resetAnimation(bar, 'animate-grow'));
  }

  function animateScore() {
    const scoreEl = document.getElementById("score-display");
    const targetScore = parseInt(scoreEl.dataset.score) || 0;
    let current = 0;

    const increment = Math.ceil(targetScore / 60);
    const interval = setInterval(() => {
      current += increment;
      if (current >= targetScore) {
        current = targetScore;
        clearInterval(interval);
      }
      scoreEl.textContent = `${current}%`;

    }, 20); 
  }

  // ==== Khởi tạo sau khi load ====

  window.addEventListener('load', () => {
    const tooltip = document.getElementById("tooltip");
    const tooltipHighlight = document.getElementById("tooltip-highlight");
    const tooltipRed = document.getElementById("tooltip-red");

    const spanDescs = document.querySelectorAll(".span-desc");
    const spanDescHighlights = document.querySelectorAll(".span-desc-highlight");
    const spanDescReds = document.querySelectorAll(".span-desc-red");

    setupAutoTooltip();
setupGlobalTooltipClose([
  [document.querySelectorAll('.span-desc'), tooltip],
  [document.querySelectorAll('.span-desc-highlight'), tooltipHighlight],
  [document.querySelectorAll('.span-desc-red'), tooltipRed]
]);

    setupGlobalTooltipClose([
      [spanDescs, tooltip],
      [spanDescHighlights, tooltipHighlight],
      [spanDescReds, tooltipRed]
    ]);

    animateOnLoad();
    animateScore();
  });
</script>



@endsection