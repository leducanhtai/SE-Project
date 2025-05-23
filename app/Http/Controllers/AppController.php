<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View; // Quan trọng: Import View facade

class AppController extends Controller
{    
    public function index(): View
    {
        // Ở đây bạn có thể chuẩn bị dữ liệu cho trang Dashboard
        // Ví dụ: lấy thông tin người dùng, các thống kê, thông báo, v.v.
        // $user = auth()->user(); // Nếu người dùng đã đăng nhập
        // $stats = [...]; // Dữ liệu thống kê

        // Dữ liệu mẫu cho dashboard (bạn có thể xóa hoặc thay thế bằng dữ liệu thật)
        $dashboardData = [
            'userName' => auth()->check() ? auth()->user()->name : "George", // Lấy tên user nếu đã login
            'overallScore' => "7.5",
            'homeworkProgress' => "7/10",
            'speakingProgress' => "50%",
            // ... thêm các dữ liệu khác mà dashboard/index.blade.php cần
        ];

        // Trả về view của trang Dashboard
        // Đảm bảo bạn đã tạo file resources/views/dashboard/index.blade.php
        return view('dashboard.index', $dashboardData);
    }
}