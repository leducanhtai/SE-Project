@extends('layouts.app') {{-- Kế thừa từ layout chung --}}

@section('title', 'Trang Chủ - Linglooma') {{-- Đặt tiêu đề cho trang này --}}

@section('content') {{-- Bắt đầu phần nội dung của trang --}}
    <!-- Hero Section (dựa trên thiết kế HomePage Figma) -->
    <section class="hero-section bg-gradient-to-r from-purple-600 to-indigo-600 text-white">
        <div class="container mx-auto flex flex-col md:flex-row items-center justify-between py-16 px-6 min-h-[70vh]">
            <div class="hero-text md:w-1/2 mb-10 md:mb-0 text-center md:text-left">
                <h1 class="text-4xl md:text-5xl font-bold mb-6 leading-tight">
                    Unlock Your Creative Potential
                </h1>
                <p class="text-lg md:text-xl mb-8">
                    Luyện thi IELTS thông minh với trợ lý AI. Chấm điểm ngay lập tức, cả speaking và writing. Phản hồi cá nhân hoá. Theo dõi tiến độ học tập rõ ràng.
                </p>
                <div class="space-x-4">
                    {{-- <a href="{{ route('register') }}" class="btn-primary bg-orange-500 hover:bg-orange-600 text-white font-bold py-3 px-8 rounded-lg text-lg">
                        Bắt đầu miễn phí
                    </a> --}}
                    {{-- <a href="{{ route('courses.index') }}" class="btn-secondary bg-white text-orange-500 font-bold py-3 px-8 rounded-lg text-lg hover:bg-gray-100">
                        Khám phá khoá học
                    </a> --}}
                     <a href="#" class="btn-secondary bg-white text-orange-500 font-bold py-3 px-8 rounded-lg text-lg hover:bg-gray-100">
                        Khám phá khoá học
                    </a>
                </div>
            </div>
            <div class="hero-image md:w-1/2 flex justify-center md:justify-end">
                <img src="{{ asset('images/hero-image.png') }}" alt="AI Learning Illustration" class="max-w-sm md:max-w-md">
            </div>
        </div>
    </section>

    <!-- Benefits Section -->
    <section class="benefits-section py-16">
        <div class="container mx-auto px-6">
            <h2 class="section-title text-3xl md:text-4xl font-bold text-center mb-12 text-gray-800">Benefits</h2>
            <div class="benefits-grid grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                {{-- Benefit Item 1 --}}
                <div class="benefit-item bg-white p-8 rounded-xl shadow-lg text-center hover:shadow-2xl transition-shadow duration-300">
                    <div class="benefit-number text-5xl font-extrabold text-orange-500 mb-3">01</div>
                    <h3 class="text-xl font-semibold mb-2 text-gray-700">Chấm điểm AI tự động</h3>
                    <p class="text-gray-600">Điểm chính xác theo tiêu chí IELTS, tiết kiệm thời gian.</p>
                </div>
                {{-- Benefit Item 2 --}}
                <div class="benefit-item bg-white p-8 rounded-xl shadow-lg text-center hover:shadow-2xl transition-shadow duration-300">
                    <div class="benefit-number text-5xl font-extrabold text-orange-500 mb-3">02</div>
                    <h3 class="text-xl font-semibold mb-2 text-gray-700">Học tập cá nhân hóa</h3>
                    <p class="text-gray-600">Phản hồi chi tiết, gợi ý lộ trình khắc phục điểm yếu.</p>
                </div>
                {{-- THÊM CÁC BENEFIT ITEMS CÒN LẠI TƯƠNG TỰ --}}
            </div>
        </div>
    </section>
    {{-- Các sections khác của trang chủ --}}
@endsection {{-- Kết thúc phần nội dung --}}