@extends('layouts.app')

@section('title', 'Choose Your Writing Part')

@section('content')
    <div class="text-center pt-8 md:pt-12 pb-10 md:pb-16">
        <h1 class="text-4xl lg:text-5xl font-extrabold text-figma-text-title mb-12 lg:mb-16 text-shadow-glow-yellow">
            Choose your writing part
        </h1>

        @php
            $parts = $parts ?? [
                ['id' => 1, 'title' => 'Part 1', 'image_url' => asset('images/figma/part1-image.png'), 'description' => "Kick off your speaking quest!<br />Chat about yourself, your hobbies, and where you come from - it's the easy level where you share your story.", 'route' => route('writing.test.start', ['writingPart' => 1]) ],
                ['id' => 2, 'title' => 'Part 2', 'image_url' => asset('images/figma/part2-image.png'), 'description' => "Dive deeper into discussion topics.<br />You'll get a topic card and a minute to prepare your thoughts before speaking for 1-2 minutes.", 'route' => route('writing.test.start', ['writingPart' => 2]) ],
                ['id' => 3, 'title' => 'Part 3', 'image_url' => asset('images/figma/part3-image.png'), 'description' => "Engage in a two-way conversation.<br />Explore more abstract ideas and issues related to the topic from Part 2.", 'route' => route('writing.test.start', ['writingPart' => 3]) ],
            ];
        @endphp

        @if (!empty($parts))
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-6xl mx-auto">
                @foreach ($parts as $index => $part)
                    <a href="{{ $part['route'] }}"
                       class="bg-figma-card-bg p-6 rounded-xl shadow-xl flex flex-col text-center group hover:shadow-2xl hover:-translate-y-1.5 transform transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-figma-accent focus:ring-offset-2 focus:ring-offset-figma-bg-dark animate-rise-up delay-[{{ ($index + 1) * 150 }}ms]">
                        <div class="mb-5 h-40 md:h-48 flex items-center justify-center">
                            <img class="max-h-full max-w-full object-contain transition-transform duration-300 group-hover:scale-105"
                                 src="{{ $part['image_url'] }}" alt="{{ $part['title'] }} Illustration"/>
                        </div>
                        <h2 class="text-2xl lg:text-3xl font-bold text-figma-text-card-title mb-3">{{ $part['title'] }}</h2>
                        <div class="text-figma-text-card-desc text-sm leading-relaxed mb-4 flex-grow px-1 min-h-[80px]">
                            {!! $part['description'] !!}
                        </div>
                        <span class="mt-auto inline-block bg-figma-accent text-figma-bg-dark font-semibold py-2.5 px-5 rounded-lg group-hover:opacity-90 transition-opacity text-base">
                            Start {{ $part['title'] }}
                        </span>
                    </a>
                @endforeach
            </div>
        @else
            <p class="text-figma-text-light text-xl">No writing parts available at the moment.</p>
        @endif
    </div>
@endsection