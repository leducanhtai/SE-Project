<header class="bg-db-header-bg text-db-header-text shadow-sm print:hidden sticky top-0 z-40 border-b border-gray-200">
    <div class="max-w-full mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="flex-shrink-0">
                    <img class="h-9 w-auto" src="{{ asset('images/figma/linglooma-logo.png') }}" alt="Linglooma Logo">
                </a>
            </div>
            <nav class="hidden md:flex space-x-8 ml-10">
                <a href="{{ route('home') }}" class="text-sm font-medium {{ request()->routeIs('home') ? 'text-db-text-link border-b-2 border-db-text-link' : 'text-gray-500 hover:text-gray-700' }}">Home</a>
                <a href="{{ route('courses') }}" class="text-sm font-medium {{ request()->routeIs('courses*') ? 'text-db-text-link border-b-2 border-db-text-link' : 'text-gray-500 hover:text-gray-700' }}">Courses</a>
                <a href="{{ route('about') }}" class="text-sm font-medium {{ request()->routeIs('about') ? 'text-db-text-link border-b-2 border-db-text-link' : 'text-gray-500 hover:text-gray-700' }}">About Us</a>
                <a href="{{ route('pricing') }}" class="text-sm font-medium {{ request()->routeIs('pricing') ? 'text-db-text-link border-b-2 border-db-text-link' : 'text-gray-500 hover:text-gray-700' }}">Pricing</a>
                <a href="{{ route('contact') }}" class="text-sm font-medium px-3 py-1.5 border-2 border-db-header-contact-border rounded-md {{ request()->routeIs('contact') ? 'bg-db-header-contact-border text-white' : 'text-db-header-contact-border hover:bg-gray-100' }}">Contact</a>
            </nav>
            <div class="flex items-center ml-auto space-x-4">
                <button type="button" class="p-1 rounded-full text-gray-400 hover:text-gray-500 focus:outline-none">
                    <img class="h-7 w-7 rounded-full" src="{{ asset('images/figma/user-icon-placeholder.svg') }}" alt="User">
                </button>
                <form method="POST" action="{{-- route('logout') --}}"> @csrf
                    <button type="submit" class="bg-db-header-signout-bg text-white px-4 py-2 rounded-md text-sm font-semibold hover:opacity-90">
                        Sign out
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>