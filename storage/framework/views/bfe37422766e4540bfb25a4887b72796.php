<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<?php
    // Dữ liệu mẫu
    $overallScore = "7.5";
    $writingScore = "N/A"; $listeningScore = "N/A"; $speakingScore = "N/A";
    $homeworkItems = ["1. Làm bài speaking part 1", "2. Viết dàn ý writing part 2", "3. Ghi nhớ 30 từ vựng mới"];
    $classItems = [
        ['title' => 'Tổng ôn Speaking', 'bg_color' => 'bg-db-class-speaking-bg', 'thumbnail' => asset('images/figma/class-thumb-speaking.png'), 'progress_icon' => asset('images/figma/progress-icon-speaking.svg'), 'participants_icon' => asset('images/figma/participants-icon.svg')],
        ['title' => 'Tổng ôn Writing', 'bg_color' => 'bg-db-class-writing-bg', 'thumbnail' => asset('images/figma/class-thumb-writing.png'), 'progress_icon' => asset('images/figma/progress-icon-writing.svg'), 'participants_icon' => asset('images/figma/participants-icon.svg')],
        ['title' => 'Tổng ôn Listening', 'bg_color' => 'bg-db-class-listening-bg', 'thumbnail' => asset('images/figma/class-thumb-listening.png'), 'progress_icon' => asset('images/figma/progress-icon-listening.svg'), 'participants_icon' => asset('images/figma/participants-icon.svg')],
    ];
    $practiceItem = ['thumbnail' => asset('images/figma/practice-thumb-cambridge.png'), 'title' => 'Đề Cambridge 2022', 'description' => 'Đề hay để luyện trước thi', 'participants' => '100 Participants', 'progress_icon' => asset('images/figma/progress-icon-practice.svg')];
    $upcomingEvents = [
        ['icon' => asset('images/figma/event-calendar-icon.svg'), 'title' => 'Tổng ôn Speaking', 'bg_color' => 'bg-db-event-item-purple'],
        ['icon' => asset('images/figma/event-calendar-icon.svg'), 'title' => 'Chữa đề Cambridge 2023', 'bg_color' => 'bg-db-event-item-green'],
        ['icon' => asset('images/figma/event-calendar-icon.svg'), 'title' => 'Học chuyên đề 8 Writing', 'bg_color' => 'bg-db-event-item-blue'],
        ['icon' => asset('images/figma/event-calendar-icon.svg'), 'title' => 'Thi Listening', 'bg_color' => 'bg-db-event-item-orange'],
    ];
?>

<div class="bg-[rgba(255, 255, 255, 1)] min-h-screen">
    <div class="text-db-text-title mb-6 text-2xl font-semibold">Dashboard</div>
    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <div class="lg:col-span-2 space-y-6">
            
            <section class="bg-db-card-bg p-5 rounded-lg border border-db-card-border shadow-card">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold">Stat</h2>
                    <a href="#" class="text-xs font-medium text-db-text-link hover:underline flex items-center">
                        <img src="<?php echo e(asset('images/figma/view-all-icon.svg')); ?>" class="w-3.5 h-3.5 mr-1" alt="">View all
                    </a>
                </div>
                <div class="flex flex-col md:flex-row gap-4">
                    <div class="md:w-2/3 h-64 bg-gray-200 rounded flex items-center justify-center text-db-text-muted">
                        Line chart placeholder
                    </div>
                    <div class="md:w-1/3 bg-db-stat-summary-bg p-4 rounded-md border border-db-card-border flex flex-col items-center justify-around">
                        <div class="space-y-1 text-center">
                            <span class="text-xs font-medium bg-white px-2 py-0.5 rounded border border-db-card-border text-db-text-content">• Điểm Writing</span>
                            <span class="block text-xs font-medium bg-white px-2 py-0.5 rounded border border-db-card-border text-db-text-content">• Điểm Speaking</span>
                            <span class="block text-xs font-medium bg-white px-2 py-0.5 rounded border border-db-card-border text-db-text-content">• Điểm Listening</span>
                        </div>
                        <div class="relative w-24 h-24 mt-2">
                            <svg viewBox="0 0 36 36" class="w-full h-full"><circle cx="18" cy="18" r="15.9155" fill="none" stroke="#E5E7EB" stroke-width="3"></circle><circle cx="18" cy="18" r="15.9155" fill="none" stroke="#1F2937" stroke-width="3" stroke-dasharray="75, 100" stroke-dashoffset="25"></circle></svg>
                            <div class="absolute inset-0 flex items-center justify-center text-xl font-bold text-db-text-primary">7.5</div>
                        </div>
                    </div>
                </div>
            </section>
    
            
            <section>
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold">Classes</h2>
                    <a href="#" class="text-xs font-medium text-db-text-link hover:underline flex items-center">
                         <img src="<?php echo e(asset('images/figma/view-all-icon.svg')); ?>" class="w-3.5 h-3.5 mr-1" alt="">View all
                    </a>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                    <?php $__currentLoopData = $classItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="<?php echo e($class['bg_color']); ?> p-4 rounded-lg border border-db-card-border shadow-card">
                        <div class="flex justify-between items-start mb-3">
                            <img src="<?php echo e($class['thumbnail']); ?>" alt="" class="w-10 h-10 rounded-md object-cover">
                            <button class="text-gray-500 hover:text-gray-700"> <img src="<?php echo e(asset('images/figma/dots-icon.svg')); ?>" class="w-4 h-4" alt=""></button>
                        </div>
                        <h3 class="text-base font-semibold text-db-text-primary mb-3"><?php echo e($class['title']); ?></h3>
                        <div class="flex justify-between items-center">
                            <img src="<?php echo e($class['participants_icon']); ?>" alt="Participants" class="h-5">
                            <img src="<?php echo e($class['progress_icon']); ?>" alt="Progress" class="h-7">
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </section>
    
            
            <section>
                <h2 class="text-lg font-semibold mb-4">Luyện đề</h2>
                <div class="bg-db-card-bg p-4 rounded-lg border border-db-card-border shadow-card flex items-center gap-4">
                    <img src="<?php echo e($practiceItem['thumbnail']); ?>" alt="" class="w-12 h-12 rounded-md object-cover flex-shrink-0">
                    <div class="flex-grow">
                        <h3 class="text-base font-semibold text-db-text-primary"><?php echo e($practiceItem['title']); ?></h3>
                        <div class="bg-yellow-100 text-yellow-700 p-2 rounded text-xs mt-1">
                            <?php echo e($practiceItem['description']); ?>

                            <a href="#" class="block font-medium hover:underline">Read More</a>
                        </div>
                    </div>
                    <div class="flex flex-col items-center text-center text-xs text-db-text-muted flex-shrink-0 ml-auto">
                        <span><?php echo e($practiceItem['participants']); ?></span>
                        <img src="<?php echo e($practiceItem['progress_icon']); ?>" alt="Progress" class="h-7 mt-1">
                    </div>
                </div>
            </section>
        </div>
    
        
        <div class="lg:col-span-1 space-y-6">
            
            <section class="bg-db-card-bg p-5 rounded-lg border border-db-card-border shadow-card">
                <h2 class="text-base font-semibold mb-3">Bài tập về nhà</h2>
                <ul class="space-y-2.5">
                    <?php $__currentLoopData = $homeworkItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="bg-db-homework-item-bg p-3 rounded-md text-sm text-db-text-content font-medium border border-gray-300">
                        <?php echo e($item); ?>

                    </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </section>
    
            
            <section class="bg-db-card-bg p-5 rounded-lg border border-db-card-border shadow-card">
                <h2 class="text-base font-semibold mb-3">Upcoming events</h2>
                <div class="flex justify-between items-center mb-4">
                    <button class="p-1.5 rounded-full bg-gray-200 hover:bg-gray-300 text-db-text-primary">
                        <img src="<?php echo e(asset('images/figma/arrow-left-icon.svg')); ?>" class="w-4 h-4" alt="">
                    </button>
                    <span class="text-xs font-semibold bg-db-event-nav-bg px-3 py-1 rounded-md text-db-text-content border border-gray-300">Feb, 2025</span>
                    <button class="p-1.5 rounded-full bg-gray-200 hover:bg-gray-300 text-db-text-primary">
                         <img src="<?php echo e(asset('images/figma/arrow-right-icon.svg')); ?>" class="w-4 h-4" alt="">
                    </button>
                </div>
                <ul class="space-y-2.5">
                    <?php $__currentLoopData = $upcomingEvents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="<?php echo e($event['bg_color']); ?> p-3 rounded-md text-sm text-db-text-content font-medium flex items-center space-x-2 border border-gray-300">
                        <img src="<?php echo e($event['icon']); ?>" alt="" class="w-4 h-4 flex-shrink-0">
                        <span><?php echo e($event['title']); ?></span>
                    </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </section>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Admin\Downloads\SE-Project-main (4)\SE-Project-main\resources\views/dashboard/index.blade.php ENDPATH**/ ?>