@extends('layouts.app')

@section('content')
{{-- <style>
   .container{
    color:  #f8f7b8;

   }
</style>
<h2 class="overview">Overview</h2>

<!-- PHẦN TỔNG QUAN - CHI TIẾT ĐIỂM SỐ -->
<div class="container_overview">
  <div class="left-section">
    <div class="score-section">
      <div class="score-container">
        <h2 class="summary">Summary score</h2>
        <div class="score">75%</div>
        <div class="change">15% since last test</div>
      </div>
      <div class="pie"></div>
    </div>
  </div>
  
  <div class="right-section">
    <h3>AVERAGE PERFORMANCE ON EACH SKILL</h3>
    <div class="performance">
      <div class="legend">
        <div class="legend-item">
          <div class="legend-color" style="background: #72d8f8"></div>
          Coherence
        </div>
        <div class="legend-item">
          <div class="legend-color" style="background: #7647db"></div>
          Vocabulary
        </div>
        <div class="legend-item">
          <div class="legend-color" style="background: #07191e"></div>
          Grammar
        </div>
      </div>
      <div class="bars">
        <div class="bar coherence"></div>
        <div class="bar vocabulary"></div>
        <div class="bar grammar"></div>
      </div>
    </div>
  </div>
</div>

<!-- PHẦN BÀI VIẾT ĐƯỢC CHẤM ĐIỂM - ĐƯA RA NGOÀI container_overview -->
<div class="container">
  <h2>Bài viết đã chấm điểm</h2>

  <div id="essay" class="border p-3 rounded bg-light" style="white-space: pre-wrap;"></div>

  <h4 class="mt-4">Phản hồi chi tiết</h4>
  <ul>
    @foreach ($submission->feedbacks as $fb)
        <li><strong>{{ ucfirst($fb->issue_type ?? 'General') }}:</strong> {{ $fb->feedback }}</li>
    @endforeach
  </ul>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const content = @json($submission->content);
        const feedbacks = @json($submission->feedbacks);

        let segments = [];
        let lastIndex = 0;

        // Sort feedbacks by start_offset ascending
        feedbacks.sort((a, b) => a.start_offset - b.start_offset);

        feedbacks.forEach(fb => {
            const { start_offset, end_offset, feedback, issue_type } = fb;

            // Push plain text before highlight
            if (start_offset > lastIndex) {
                segments.push({
                    type: 'text',
                    content: content.slice(lastIndex, start_offset)
                });
            }

            // Push highlighted text
            segments.push({
                type: 'highlight',
                content: content.slice(start_offset, end_offset),
                tooltip: feedback,
                issue: issue_type
            });

            lastIndex = end_offset;
        });

        // Push remaining plain text
        if (lastIndex < content.length) {
            segments.push({
                type: 'text',
                content: content.slice(lastIndex)
            });
        }

        // Render to DOM
        const container = document.getElementById("essay");

        segments.forEach(seg => {
            const span = document.createElement("span");
            span.textContent = seg.content;

            if (seg.type === 'highlight') {
                span.style.backgroundColor = seg.issue === 'coherence' ? '#ffeeba' :
                                             seg.issue === 'vocabulary' ? '#cce5ff' :
                                             '#d4edda';
                span.title = seg.tooltip;
                span.style.borderBottom = "1px dashed #666";
                span.style.cursor = "help";
            }

            container.appendChild(span);
        });
    });
</script> --}}

<div class="p-[30px] w-[1400px] font-[Poppins] text-white bg-[#1e1432]">
  <h2 class="text-[#f5d77f] text-[22px] font-semibold mb-[20px]">Overview</h2>
  <div class="flex justify-between bg-[#554c69] p-[40px] rounded-[30px] gap-[40px]">
    <!-- LEFT SUMMARY -->
    <div class="flex justify-between flex-[2] items-center ml-[20px] px-[100px]">
      <div class="text-center">
        <p class="text-[24px] font-semibold mb-[10px]">summary score</p>
        <h1 class="text-[96px] font-bold m-0">75%</h1>
        <p class="text-[24px] mt-[8px]">15% <span class="ml-[8px]">since last test</span></p>
      </div>
      <div class="pie-chart w-[227px] h-[227px] rounded-full bg-[conic-gradient(#7edbfb_0%_75%,_#7e7a85_0%_0%)] m-auto animate-rotate-in"></div>
    </div>

    <!-- RIGHT CHART -->
    <div class="flex-1 bg-white text-[#2c2424] rounded-[30px] p-[30px] flex flex-col justify-center">
      <h3 class="text-[24px] font-bold text-center text-[#4a422e] mb-[30px]">
        AVERAGE PERFORMANCE<br />ON EACH SKILL
      </h3>
      <div class="flex">
        <ul class="list-none flex flex-col gap-[10px] text-[14px] font-medium p-0 text-black items-start mr-[100px]">
          <li class="flex items-center gap-[6px]">
            <span class="w-[12px] h-[12px] rounded-full bg-[#7edbfb] inline-block"></span> Coherence
          </li>
          <li class="flex items-center gap-[6px]">
            <span class="w-[12px] h-[12px] rounded-full bg-[#7042e8] inline-block"></span> Vocabulary
          </li>
          <li class="flex items-center gap-[6px]">
            <span class="w-[12px] h-[12px] rounded-full bg-[#041318] inline-block"></span> Grammar
          </li>
        </ul>
        <div class="flex justify-around items-end h-[160px] mb-[20px] gap-[6px]">
          <div class="bar-chart w-[40px] h-[150px] rounded-t-[20px] bg-[#7edbfb] delay-[200ms]"></div>
          <div class="bar-chart w-[40px] h-[160px] rounded-t-[20px] bg-[#7042e8] delay-[400ms]"></div>
          <div class="bar-chart w-[40px] h-[100px] rounded-t-[20px] bg-[#041318] delay-[600ms]"></div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="ai-feedback">
  <div class="feedback-title">AI Feedback</div>
  <div class="desc">
    <p><span class="span-desc">The bar chart illustrates the amount of money donated by a company to six different types of</span> charity from 2012 to 2014.
  
  Overall, it is evident that social welfare consistently received the largest donations, whereas wildlife and arts attracted the least funding throughout the period. Additionally, while some categories witnessed fluctuations, others experienced steady increases or remained relatively unchanged.
  
  In 2012, social welfare topped the list with approximately 25 units of donation, which rose slightly to nearly 27 in 2014. Similarly, education and environment also saw modest increases during this period. The amount donated to education was around 7 units in 2012 but rose slightly to about 10 units in 2014. Donations to environmental charities followed a similar trend, growing steadily from approximately 9 units in 2012 to 12 units in 2014.
  In contrast, donations to health charities experienced a moderate increase, starting at roughly 15 units in 2012 and peaking at about 18 units in 2014. Meanwhile, wildlife charities saw a small but steady rise, from around 5 units in 2012 to 7 units by 2014. Arts consistently received the least funding, with donations remaining stable at approximately 3 units across all three years.</p>
  </div>
  </div>
  <div id="tooltip" class="tooltip">Thông tin chi tiết Thông tin chi tiết Thông tin chi tiết Thông tin chi tiết</div>

  <style>
    .ai-feedback {
      padding: 20px;
      border-radius: 20px;
      margin-top: 50px;
      margin: 0 auto;
    }

    .feedback-title {
      font-size: 24px;
      font-weight: bold;
      color: #f5d77f;
      margin-bottom: 10px;
    }

    .desc {
      font-size: 24px;
      color: #fff;
    }
    .desc{
      max-width: 1400px;
      padding: 20px;
      background-color: rgba(255, 255, 255, 0.25);
      border-radius: 30px;
    }
    .span-desc{
      background-color: rgba(126, 212, 126, 0.54);
    }

     /* Tooltip style */
  .tooltip {
    font-size: 50px;
    position: absolute;
    background-color: #0c3b07;
    color: white;
    padding: 8px 12px;
    border-radius: 8px;
    font-size: 14px;
    display: none;
    z-index: 999;
    white-space: nowrap;
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
  const spanDesc = document.querySelector(".span-desc");
  const tooltip = document.getElementById("tooltip");

 
  spanDesc.addEventListener("click", function (e) {
    e.stopPropagation(); 
    tooltip.style.display = "block";
    tooltip.style.left = `${e.pageX + 10}px`;
    tooltip.style.top = `${e.pageY + 10}px`;
  });


  document.addEventListener("click", function (e) {
    if (!tooltip.contains(e.target) && !spanDesc.contains(e.target)) {
      tooltip.style.display = "none";
    }
  });
  
  window.addEventListener('load', () => {
    // Pie chart giữ nguyên
    const pie = document.querySelector('.pie-chart');
    if (pie) {
      pie.classList.remove('animate-rotate-in');
      void pie.offsetWidth;
      pie.classList.add('animate-rotate-in');
    }

    // Bars: dùng animation "grow"
    const bars = document.querySelectorAll('.bar-chart');
    bars.forEach(bar => {
      bar.classList.remove('animate-grow');
      void bar.offsetWidth;
      bar.classList.add('animate-grow');
    });
  });


  
</script>

@endsection
