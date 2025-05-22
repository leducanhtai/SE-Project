<header class="bg-figma-header-bg text-figma-text-light shadow-md print:hidden sticky top-0 z-40">
    <div class="container mx-auto px-6 lg:px-8">
        <div class="flex items-center justify-between h-16 md:h-20">
            <div class="flex-shrink-0">
                <a href="{{ route('home') }}">
                    <img class="h-10 md:h-12 w-auto" src="{{ asset('images/figma/logo-linglooma.png') }}" alt="Linglooma Logo">
                </a>
            </div>
            <nav class="flex items-center space-x-5 lg:space-x-7">
                <a href="{{ route('home') }}" class="px-3 py-2 rounded-md text-sm font-medium hover:text-figma-accent {{ request()->routeIs('home') ? 'text-figma-accent border-b-2 border-figma-accent' : 'text-gray-300' }} transition-colors">Home</a>
                <a href="{{ route('courses') }}" class="px-3 py-2 rounded-md text-sm font-medium hover:text-figma-accent {{ request()->routeIs('courses*') ? 'text-figma-accent border-b-2 border-figma-accent' : 'text-gray-300' }} transition-colors">Courses</a>
                <a href="{{ route('about') }}" class="px-3 py-2 rounded-md text-sm font-medium hover:text-figma-accent {{ request()->routeIs('about') ? 'text-figma-accent border-b-2 border-figma-accent' : 'text-gray-300' }} transition-colors">About Us</a>
                <a href="{{ route('pricing') }}" class="px-3 py-2 rounded-md text-sm font-medium hover:text-figma-accent {{ request()->routeIs('pricing') ? 'text-figma-accent border-b-2 border-figma-accent' : 'text-gray-300' }} transition-colors">Pricing</a>
                <a href="{{ route('contact') }}" class="px-3 py-2 rounded-md text-sm font-semibold hover:text-figma-header-bg {{ request()->routeIs('contact') ? 'bg-figma-text-light text-figma-header-bg border-2 border-transparent' : 'text-figma-text-light border-2 border-figma-text-light hover:bg-figma-text-light' }} transition-colors">Contact</a>
            </nav>
            <div class="flex items-center space-x-4">
                <button type="button" class="text-gray-300 hover:text-figma-text-light p-1 rounded-full">
                    <span class="sr-only">User Profile</span>
                    <img class="h-8 w-8 rounded-full object-cover" src="{{ asset('images/figma/user-avatar-placeholder.svg') }}" alt="User Profile">
                </button>
                <form method="POST" action="{{-- route('logout') --}}">
                    @csrf
                    <button type="submit" class="bg-figma-button-primary text-white px-4 py-2 rounded-md text-sm font-semibold hover:opacity-90 transition-opacity focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-figma-header-bg focus:ring-figma-button-primary">
                        Sign out
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>