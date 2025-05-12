@extends('layouts.app')

@section('content')
<style>
    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 1rem;
        
    }
    .tests-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1rem;
    }
    .test-card {
        background: #2b2a2a94;
        border: 1px solid #ddd;
        border-radius: 10px;
        padding: 1rem;
        box-shadow: 0 0 8px rgba(0,0,0,0.05);
    }
    .test-title {
        font-size: 1.25rem;
        font-weight: bold;
        color: #f8f7b8;
        text-shadow: 0px 0px 15px rgba(227, 225, 191, 0.868);
    }
    .test-description {
        color: #666;
        margin-top: 0.5rem;
    }
    .test-link {
        display: inline-block;
        margin-top: 1rem;
        color: #007bff;
        text-decoration: none;
    }
    .test-link:hover {
        text-decoration: underline;
    }
    .test-image {
        margin-top: 0.75rem;
        max-width: 100%;
        border-radius: 6px;
    }
    .no-tests {
        grid-column: span 3;
        text-align: center;
        color: #999;
    }
    .btn {
        display: inline-block;
        padding: 0.5rem 1rem;
        background-color: rgb(251, 251, 116);
        color: rgb(47, 25, 125);
        font-weight: bold;
        text-decoration: none;
        border-radius: 999px;
        transition: background-color 0.3s ease;
        box-shadow: 0px 0px 20px rgba(218, 208, 32, 0.876);
    }
</style>

<div class="container">
    <h1 class="test-title">Danh sách Writing Tests</h1>

    <div class="tests-grid">
        @forelse ($writingTests as $test)
            <div class="test-card">
                <h2 class="test-title">{{ $test->title }}</h2>
                
                @if ($test->image)
                    <img src="{{ asset('image/' . $test->image) }}" alt="{{ $test->title }}" class="test-image">
                @endif

                <p class="test-description">{{ Str::limit($test->description, 100) }}</p>

                <a href="#" class="btn">làm bài</a>
            </div>
        @empty
            <p class="no-tests">Không có bài viết nào.</p>
        @endforelse
    </div>
</div>
@endsection
