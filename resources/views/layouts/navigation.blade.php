<header class="flex justify-between items-center h-[100px] px-10 bg-white border-b border-gray-300">
  <div class="flex items-center">
    <img src="{{ asset('icon/logo.svg') }}" alt="Lingoloma Logo" class="h-[50px]" />
  </div>
  <nav class="flex gap-[30px]">
    <a href="#" class="text-gray-800 font-medium px-[10px] py-[6px] rounded-md hover:bg-gray-100">Home</a>
    <a href="#" class="text-gray-800 font-medium px-[10px] py-[6px] rounded-md hover:bg-gray-100">Courses</a>
    <a href="#" class="text-gray-800 font-medium px-[10px] py-[6px] rounded-md hover:bg-gray-100">About Us</a>
    <a href="#" class="text-gray-800 font-medium px-[10px] py-[6px] rounded-md hover:bg-gray-100">Pricing</a>
    <a href="#" class="text-gray-800 font-medium px-[10px] py-[6px] rounded-md bg-gray-200">Contact</a>
  </nav>
  <div class="flex items-center gap-5">
    <div class="text-xl">
      <img src="{{ asset('icon/avata.svg') }}" alt="">
    </div>
    <button class="bg-red-500 text-white border-none px-4 py-2 rounded-md font-medium cursor-pointer hover:bg-red-600">
      Sign out
    </button>
  </div>
</header>
