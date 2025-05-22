@php
    $currentRouteName = Route::currentRouteName() ?? '';
    $menuItems = [
        ['label' => 'Overview', 'icon' => asset('images/figma/sidebar-icon-overview.svg'), 'route_name' => 'dashboard', 'active_check' => 'dashboard'],
        ['label' => 'Khoá học của tôi', 'icon' => asset('images/figma/sidebar-icon-courses.svg'), 'route_name' => 'courses', 'active_check' => 'courses'],
        ['label' => 'Luyện tập', 'icon' => asset('images/figma/sidebar-icon-practice.svg'), 'route_name' => 'writing.parts', 'active_check' => 'writing.parts'],
        ['label' => 'Lịch sử học tập', 'icon' => asset('images/figma/sidebar-icon-history.svg'), 'route_name' => 'writing.history', 'active_check' => 'writing.history'],
        ['label' => 'Tin nhắn', 'icon' => asset('images/figma/sidebar-icon-messages.svg'), 'route_name' => 'messages.index', 'active_check' => 'messages.index'],
        ['label' => 'Cài đặt', 'icon' => asset('images/figma/sidebar-icon-settings.svg'), 'route_name' => 'settings.profile', 'active_check' => 'settings.profile'],
    ];
@endphp
<aside class="w-64 bg-figma-sidebar text-figma-sidebar-text p-5 space-y-6 flex flex-col print:hidden">
    <nav class="flex-grow pt-4">
        <ul class="space-y-1.5">
            @foreach ($menuItems as $item)
                <li>
                    <a href="{{ route($item['route_name']) }}"
                       class="flex items-center space-x-3 px-3 py-2.5 rounded-md text-sm font-semibold transition-all duration-200 ease-in-out group
                              {{ Str::contains($currentRouteName, $item['active_check']) || ($item['route_name'] == 'home' && request()->is('/')) ? 'bg-orange-400/30 text-white shadow-inner scale-105' : 'hover:bg-orange-400/20 hover:text-white hover:scale-105' }}">
                        <img class="w-5 h-5 {{ Str::contains($currentRouteName, $item['active_check']) ? 'opacity-100' : 'opacity-70 group-hover:opacity-90' }}"
                             src="{{ $item['icon'] }}" alt="{{ $item['label'] }} icon" />
                        <span>{{ $item['label'] }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </nav>
</aside>