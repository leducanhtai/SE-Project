@extends('layouts.app')

@section('title', 'Choose Your Writing Part')

@section('content')
<div class="text-center pt-8 md:pt-12 pb-10 md:pb-16">
    <h1 class="text-4xl lg:text-5xl font-extrabold text-figma-text-title mb-12 lg:mb-16 text-shadow-glow-yellow">
        Choose your writing part
    </h1>

    <div class="bg-[url('/public/image/part-background-image.png')] bg-cover bg-center max-w-6xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-6xl mx-auto">
            <a href="{{ route('writing.test.index') }}"
               class="bg-white/25 bg-figma-card-bg p-6 rounded-xl shadow-xl flex flex-col text-center group hover:shadow-2xl hover:-translate-y-1.5 transform transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-figma-accent focus:ring-offset-2 focus:ring-offset-figma-bg-dark animate-rise-up delay-[30ms] min-h-[600px]">
                <div class="mb-5 h-40 md:h-48 flex items-center justify-center">
                    <img class="max-h-full max-w-full object-contain transition-transform duration-300 group-hover:scale-105"
                         src="{{ asset('/image/part1-image.png') }}" alt="Part 1 Illustration"/>
                </div>
                <h2 class="text-2xl lg:text-3xl font-bold text-figma-text-card-title mb-3">Part 1</h2>
                <div class="text-figma-text-card-desc text-sm leading-relaxed mb-4 flex-grow px-1 min-h-[80px]">
                    Kick off your speaking quest!<br />Chat about yourself, your hobbies, and where you come from - it's the easy level where you share your story.
                </div>
            </a>
    
            <a href="{{ route('writing.test.index') }}"
               class="bg-white/25 bg-figma-card-bg p-6 rounded-xl shadow-xl flex flex-col text-center group hover:shadow-2xl hover:-translate-y-1.5 transform transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-figma-accent focus:ring-offset-2 focus:ring-offset-figma-bg-dark animate-rise-up delay-[300ms]">
                <div class="mb-5 h-40 md:h-48 flex items-center justify-center">
                    <img class="max-h-full max-w-full object-contain transition-transform duration-300 group-hover:scale-105"
                         src="{{ asset('/image/part2-image.png') }}" alt="Part 2 Illustration"/>
                </div>
                <h2 class="text-2xl lg:text-3xl font-bold text-figma-text-card-title mb-3">Part 2</h2>
                <div class="text-figma-text-card-desc text-sm leading-relaxed mb-4 flex-grow px-1 min-h-[80px]">
                    Dive deeper into discussion topics.<br />You'll get a topic card and a minute to prepare your thoughts before speaking for 1-2 minutes.
                </div>
            </a>
    
            <a href="{{ route('writing.test.index') }}"
               class="bg-white/25 bg-figma-card-bg p-6 rounded-xl shadow-xl flex flex-col text-center group hover:shadow-2xl hover:-translate-y-1.5 transform transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-figma-accent focus:ring-offset-2 focus:ring-offset-figma-bg-dark animate-rise-up delay-[450ms]">
                <div class="mb-5 h-40 md:h-48 flex items-center justify-center">
                    <img class="max-h-full max-w-full object-contain transition-transform duration-300 group-hover:scale-105"
                         src="{{ asset('/image/part3-image.png') }}" alt="Part 3 Illustration"/>
                </div>
                <h2 class="text-2xl lg:text-3xl font-bold text-figma-text-card-title mb-3">Part 3</h2>
                <div class="text-figma-text-card-desc text-sm leading-relaxed mb-4 flex-grow px-1 min-h-[80px]">
                    Engage in a two-way conversation.<br />Explore more abstract ideas and issues related to the topic from Part 2.
                </div>
            </a>
        </div>
    </div>
</div>
@endsection
