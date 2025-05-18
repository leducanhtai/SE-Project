<aside class="w-[260px] bg-[#FF9500] text-white p-5 flex flex-col gap-[30px]">
  <nav class="flex flex-col gap-4 mt-[103px]">
    <a href="#" class="{{ request()->routeIs('dashboard') ? 'bg-white text-[#ffb700]' : 'text-white hover:bg-[#ffb700]' }} flex items-center gap-2 px-3 py-2 rounded-lg font-medium transition-colors">
      <img src="{{ asset('icon/overview.svg') }}" alt=""> Overview
    </a>
    <a href="#" class="{{ request()->routeIs('courses.*') ? 'bg-[#889cbca8] text-white' : 'text-white hover:bg-[#ffb700]' }} flex items-center gap-2 px-3 py-2 rounded-lg font-medium transition-colors">
      <img src="{{ asset('icon/h.svg') }}" alt="" class="{{ request()->routeIs('courses.*') ? 'filter brightness-0 invert' : '' }}"> Khoá học của tôi
    </a>
    <a href="{{ route('writing.test.index') }}" class="{{ request()->routeIs('writing.test.index') ? 'bg-[#889cbca8] text-white' : 'text-white hover:bg-[#ffb700]' }} flex items-center gap-2 px-3 py-2 rounded-lg font-medium transition-colors">
      <img src="{{ asset('icon/practice.svg') }}" alt="" class="{{ request()->routeIs('writing.test.index') ? 'filter brightness-0 invert' : '' }}"> Luyện tập
    </a>
    <a href="#" class="{{ request()->routeIs('history') ? 'bg-[#889cbca8] text-white' : 'text-white hover:bg-[#ffb700]' }} flex items-center gap-2 px-3 py-2 rounded-lg font-medium transition-colors">
      <img src="{{ asset('icon/learning_history.svg') }}" alt="" class="{{ request()->routeIs('history') ? 'filter brightness-0 invert' : '' }}"> Lịch sử học tập
    </a>
    <a href="#" class="{{ request()->routeIs('messages') ? 'bg-[#889cbca8] text-white' : 'text-white hover:bg-[#ffb700]' }} flex items-center gap-2 px-3 py-2 rounded-lg font-medium transition-colors">
      <img src="{{ asset('icon/message.svg') }}" alt="" class="{{ request()->routeIs('messages') ? 'filter brightness-0 invert' : '' }}"> Tin nhắn
    </a>
    <a href="#" class="{{ request()->routeIs('settings') ? 'bg-[#889cbca8] text-white' : 'text-white hover:bg-[#ffb700]' }} flex items-center gap-2 px-3 py-2 rounded-lg font-medium transition-colors">
      <img src="{{ asset('icon/setting.svg') }}" alt="" class="{{ request()->routeIs('settings') ? 'filter brightness-0 invert' : '' }}"> Cài đặt
    </a>
  </nav>
</aside>
