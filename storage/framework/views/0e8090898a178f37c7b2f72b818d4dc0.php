<header class="flex justify-between items-center h-[100px] px-10 bg-white border-b border-gray-300">
  <div class="flex items-center">
    <img src="<?php echo e(asset('icon/logo.svg')); ?>" alt="Lingoloma Logo" class="h-[50px]" />
  </div>
  <nav class="flex gap-[30px]">
    <a href="<?php echo e(route('home')); ?>" class="text-gray-800 font-medium px-[10px] py-[6px] rounded-md hover:bg-gray-100">Home</a>
    <a href="#" class="text-gray-800 font-medium px-[10px] py-[6px] rounded-md hover:bg-gray-100">Courses</a>
    <a href="#" class="text-gray-800 font-medium px-[10px] py-[6px] rounded-md hover:bg-gray-100">About Us</a>
    <a href="#" class="text-gray-800 font-medium px-[10px] py-[6px] rounded-md hover:bg-gray-100">Pricing</a>
    <a href="#" class="text-gray-800 font-medium px-[10px] py-[6px] rounded-md hover:bg-gray-100">Contact</a>
  </nav>
  <div class="flex items-center gap-5">
    <div class="text-xl">
      <img src="<?php echo e(asset('icon/avata.svg')); ?>" alt="">
    </div>
    <button class="bg-red-500 text-white border-none px-4 py-2 rounded-md font-medium cursor-pointer hover:bg-red-600">
      Sign out
    </button>
  </div>
</header>
<?php /**PATH C:\Users\Admin\Downloads\SE-Project-main (4)\SE-Project-main\resources\views/layouts/navigation.blade.php ENDPATH**/ ?>