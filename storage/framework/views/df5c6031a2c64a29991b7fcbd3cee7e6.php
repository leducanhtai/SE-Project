<aside class="w-[260px] bg-[#FF9500] text-white p-5 flex flex-col gap-[30px]">
  <nav class="flex flex-col gap-4 mt-[103px]">
    <a href="<?php echo e(route('dashboard')); ?>" class="<?php echo e(request()->routeIs('dashboard') ? 'bg-white text-[#ffb700]' : 'text-white hover:bg-[#ffb700]'); ?> flex items-center gap-2 px-3 py-2 rounded-lg font-medium transition-colors">
      <img src="<?php echo e(asset('icon/overview.svg')); ?>" alt=""> Overview
    </a>
    <a href="#" class="<?php echo e(request()->routeIs('courses.*') ? 'bg-[#889cbca8] text-white' : 'text-white hover:bg-[#ffb700]'); ?> flex items-center gap-2 px-3 py-2 rounded-lg font-medium transition-colors">
      <img src="<?php echo e(asset('icon/h.svg')); ?>" alt="" class="<?php echo e(request()->routeIs('courses.*') ? 'filter brightness-0 invert' : ''); ?>"> Khoá học của tôi
    </a>
    <a href="<?php echo e(route('writing.test.part')); ?>" class="<?php echo e(request()->routeIs('writing.test.part') ? 'bg-[#889cbca8] text-white' : 'text-white hover:bg-[#ffb700]'); ?> flex items-center gap-2 px-3 py-2 rounded-lg font-medium transition-colors">
      <img src="<?php echo e(asset('icon/practice.svg')); ?>" alt="" class="<?php echo e(request()->routeIs('writing.test.part') ? 'filter brightness-0 invert' : ''); ?>"> Luyện tập
    </a>
    <a href="#" class="<?php echo e(request()->routeIs('history') ? 'bg-[#889cbca8] text-white' : 'text-white hover:bg-[#ffb700]'); ?> flex items-center gap-2 px-3 py-2 rounded-lg font-medium transition-colors">
      <img src="<?php echo e(asset('icon/learning_history.svg')); ?>" alt="" class="<?php echo e(request()->routeIs('history') ? 'filter brightness-0 invert' : ''); ?>"> Lịch sử học tập
    </a>
    <a href="#" class="<?php echo e(request()->routeIs('messages') ? 'bg-[#889cbca8] text-white' : 'text-white hover:bg-[#ffb700]'); ?> flex items-center gap-2 px-3 py-2 rounded-lg font-medium transition-colors">
      <img src="<?php echo e(asset('icon/message.svg')); ?>" alt="" class="<?php echo e(request()->routeIs('messages') ? 'filter brightness-0 invert' : ''); ?>"> Tin nhắn
    </a>
    <a href="#" class="<?php echo e(request()->routeIs('settings') ? 'bg-[#889cbca8] text-white' : 'text-white hover:bg-[#ffb700]'); ?> flex items-center gap-2 px-3 py-2 rounded-lg font-medium transition-colors">
      <img src="<?php echo e(asset('icon/setting.svg')); ?>" alt="" class="<?php echo e(request()->routeIs('settings') ? 'filter brightness-0 invert' : ''); ?>"> Cài đặt
    </a>
  </nav>
</aside>
<?php /**PATH C:\Users\Admin\Downloads\SE-Project-main (4)\SE-Project-main\resources\views/layouts/sidebar.blade.php ENDPATH**/ ?>