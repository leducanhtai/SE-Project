@extends('layouts.app')

@section('title', $pageTitle ?? 'Page Under Construction')

@section('content')
    <div class="text-center py-20">
        <h1 class="text-4xl font-bold mb-4 text-figma-text-light">{{ $pageTitle ?? 'Page Under Construction' }}</h1>
        <p class="text-lg text-gray-400">This page is currently under construction. Please check back later!</p>
        <a href="{{ route('home') }}" class="mt-8 inline-block bg-figma-accent text-figma-bg-dark px-6 py-3 rounded-lg font-semibold hover:opacity-90 transition-opacity">
            Go to Homepage
        </a>
    </div>
@endsection