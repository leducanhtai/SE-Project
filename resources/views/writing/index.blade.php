@extends('layouts.app')

@section('content')
<style>
   
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

                <a href="{{ route('writing.test.show',['id'=>$test->id]) }}" class="btn">làm bài</a>
            </div>
        @empty
            <p class="no-tests">Không có bài viết nào.</p>
        @endforelse
    </div>
</div>
@endsection
