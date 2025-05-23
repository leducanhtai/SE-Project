<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Route;

class AppController extends Controller
{
    public function index(): View
    {
        $userName = auth()->check() ? auth()->user()->name : "George";
        $overallScore = "7.5";
        $ratingImageUrl = asset('images/figma/rating-star-icon.svg');
        $writingScore = "N/A";
        $listeningScore = "N/A";
        $speakingScore = "N/A";
        $writingScoreText = "Điểm Writing";
        $listeningScoreText = "Điểm Listening";
        $speakingScoreText = "Điểm Speaking";

        $homeworkItems = [
            "1. Làm bài speaking part 1",
            "2. Viết dàn ý writing part 2",
            "3. Ghi nhớ 30 từ vựng mới",
        ];

        $classItems = [
            [
                'title' => 'Tổng ôn Speaking',
                'bg_color' => 'bg-db-class-speaking-bg',
                'thumbnail' => asset('images/figma/class-thumb-speaking.png'),
                'progress_icon' => asset('images/figma/progress-icon-speaking.svg'),
                'participants_icon' => asset('images/figma/participants-icon.svg')
            ],
            [
                'title' => 'Tổng ôn Writing',
                'bg_color' => 'bg-db-class-writing-bg',
                'thumbnail' => asset('images/figma/class-thumb-writing.png'),
                'progress_icon' => asset('images/figma/progress-icon-writing.svg'),
                'participants_icon' => asset('images/figma/participants-icon.svg')
            ],
            [
                'title' => 'Tổng ôn Listening',
                'bg_color' => 'bg-db-class-listening-bg',
                'thumbnail' => asset('images/figma/class-thumb-listening.png'),
                'progress_icon' => asset('images/figma/progress-icon-listening.svg'),
                'participants_icon' => asset('images/figma/participants-icon.svg')
            ],
        ];

        $practiceItem = [
            'thumbnail' => asset('images/figma/practice-thumb-cambridge.png'),
            'title' => 'Đề Cambridge 2022',
            'description' => 'Đề hay để luyện trước thi',
            'participants' => '100 Participants',
            'progress_icon' => asset('images/figma/progress-icon-practice.svg')
        ];

        $upcomingEvents = [
            [
                'date_tag' => '3rd',
                'icon' => asset('images/figma/event-calendar-icon.svg'),
                'title' => 'Tổng ôn Speaking',
                'bg_color' => 'bg-db-event-item-purple'
            ],
            [
                'date_tag' => '5th',
                'icon' => asset('images/figma/event-calendar-icon.svg'),
                'title' => 'Chữa đề Cambridge 2023',
                'bg_color' => 'bg-db-event-item-green'
            ],
            [
                'date_tag' => '6th',
                'icon' => asset('images/figma/event-calendar-icon.svg'),
                'title' => 'Học chuyên đề 8 Writing',
                'bg_color' => 'bg-db-event-item-blue'
            ],
            [
                'date_tag' => '7th',
                'icon' => asset('images/figma/event-calendar-icon.svg'),
                'title' => 'Thi Listening',
                'bg_color' => 'bg-db-event-item-orange'
            ],
        ];
        $currentMonthYearForEvents = "Feb, 2025";

        $dataToView = [
            'userName' => $userName,
            'overallScore' => $overallScore,
            'ratingImageUrl' => $ratingImageUrl,
            'writingScore' => $writingScore,
            'listeningScore' => $listeningScore,
            'speakingScore' => $speakingScore,
            'writingScoreText' => $writingScoreText,
            'listeningScoreText' => $listeningScoreText,
            'speakingScoreText' => $speakingScoreText,
            'homeworkItems' => $homeworkItems,
            'classItems' => $classItems,
            'practiceItem' => (object) $practiceItem,
            'upcomingEvents' => $upcomingEvents,
            'currentMonthYearForEvents' => $currentMonthYearForEvents,
        ];

        return view('dashboard.index', $dataToView);
    }
}