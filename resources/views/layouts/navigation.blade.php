<nav x-data="{ open: false, searchOpen: false }" class="bg-[#131921] border-b border-[#2d3748] shadow-lg">

    <style>
        /* Nav Link text color fix for dark navbar */
        nav .flex a:not([class*="bg-"]):not([class*="px-3"]):not([class*="p-2"]):not([class*="w-"]),
        nav [class*="space-x"] a {
            color: #cbd5e1 !important;
        }
        nav [class*="space-x"] a:hover {
            color: #ffffff !important;
        }
        nav [class*="space-x"] a svg {
            stroke: #94a3b8 !important;
        }
        nav [class*="space-x"] a:hover svg {
            stroke: #ffffff !important;
        }
        /* Active state - bottom border */
        nav [class*="space-x"] a[class*="border-b"] {
            border-color: #f59e0b !important;
            color: #ffffff !important;
        }
        nav [class*="space-x"] a[class*="border-b"] svg {
            stroke: #f59e0b !important;
        }
        /* Responsive nav links */
        nav .sm\:hidden a:not([class*="p-2"]):not([class*="bg-"]) {
            color: #cbd5e1 !important;
        }
        nav .sm\:hidden a:not([class*="p-2"]):not([class*="bg-"]):hover {
            color: #ffffff !important;
            background-color: rgba(255,255,255,0.08) !important;
        }
        nav .sm\:hidden a[class*="border-b"] {
            border-color: #f59e0b !important;
            color: #ffffff !important;
            background-color: rgba(245,158,11,0.1) !important;
        }
        /* Dropdown content */
        nav [class*="bg-white"] {
            background-color: #1e293b !important;
            border-color: #334155 !important;
        }
        nav [class*="bg-white"] a,
        nav [class*="bg-white"] button {
            color: #cbd5e1 !important;
        }
        nav [class*="bg-white"] a:hover,
        nav [class*="bg-white"] button:hover {
            color: #ffffff !important;
            background-color: rgba(255,255,255,0.08) !important;
        }
    </style>

    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex items-center h-24 gap-3">

            <div class="flex">

                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ auth()->user()->is_admin ? route('admin.dashboard') : route('shop') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-white" />
                    </a>
                </div>

            </div>

            <!-- Search Bar (Amazon Style) -->
            <div class="flex-1 max-w-2xl hidden sm:block">
                <form action="{{ route('shop') }}" method="GET" class="flex rounded-lg overflow-hidden ring-1 ring-transparent focus-within:ring-2 focus-within:ring-amber-500">
                    <input
                        type="text"
                        name="query"
                        placeholder="Search products, wiki..."
                        class="w-full px-4 py-2 text-sm text-gray-900 bg-white focus:outline-none placeholder-gray-400"
                    >
                    <button type="submit" class="px-4 bg-[#febd69] hover:bg-[#f3a847] transition-colors duration-200 flex items-center justify-center">
                        <svg class="w-5 h-5 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </button>
                </form>
            </div>

            <!-- Navigation Links with Icons -->
            <div class="hidden space-x-1 sm:-my-px sm:ms-2 sm:flex">

                @if(auth()->user()->is_admin)

                    <x-nav-link
                        :href="route('admin.dashboard')"
                        :active="request()->routeIs('admin.dashboard')">

                        <span class="flex items-center gap-1.5">
                            <svg class="w-4 h-4 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                            </svg>
                            Admin Dashboard
                        </span>

                    </x-nav-link>

                    <x-nav-link
                        :href="route('wiki.index')"
                        :active="request()->routeIs('wiki.index')">

                        <span class="flex items-center gap-1.5">
                            <svg class="w-4 h-4 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            Wiki Search
                        </span>

                    </x-nav-link>

                @else

                    <x-nav-link
                        :href="route('shop')"
                        :active="request()->routeIs('shop')">

                        <span class="flex items-center gap-1.5">
                            <svg class="w-4 h-4 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/>
                            </svg>
                            Shop
                        </span>

                    </x-nav-link>

                    <x-nav-link
                        :href="route('cart')"
                        :active="request()->routeIs('cart')">

                        <span class="flex items-center gap-1.5">
                            <svg class="w-4 h-4 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                            </svg>
                            Cart
                        </span>

                    </x-nav-link>

                    <x-nav-link
                        :href="route('wiki.index')"
                        :active="request()->routeIs('wiki.index')">

                        <span class="flex items-center gap-1.5">
                            <svg class="w-4 h-4 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                            Wiki Search
                        </span>

                    </x-nav-link>

                @endif

            </div>

            <!-- User Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-2">

                <x-dropdown align="right" width="48">

                    <x-slot name="trigger">

                        <button class="inline-flex items-center gap-2 px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-300 hover:text-white hover:bg-white/10 transition-all duration-200">

                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>

                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                          d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                          clip-rule="evenodd"/>
                                </svg>
                            </div>

                        </button>

                    </x-slot>

                    <x-slot name="content">

                        <x-dropdown-link :href="route('profile.edit')">
                            Profile
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link
                                :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">

                                Log Out

                            </x-dropdown-link>

                        </form>

                    </x-slot>

                </x-dropdown>

            </div>

            <!-- Mobile Right Icons -->
            <div class="flex items-center gap-1 sm:hidden ms-auto">

                <!-- Mobile Search Toggle -->
                <button @click="searchOpen = !searchOpen"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-300 hover:text-white hover:bg-white/10 transition-all duration-200">

                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>

                </button>

                <!-- Mobile Cart -->
                <a href="{{ route('cart') }}"
                   class="inline-flex items-center justify-center p-2 rounded-md text-gray-300 hover:text-white hover:bg-white/10 transition-all duration-200 relative">

                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>

                </a>

                <!-- Mobile Hamburger -->
                <button @click="open = !open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-300 hover:text-white hover:bg-white/10 transition-all duration-200">

                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">

                        <path :class="{ 'hidden': open, 'inline-flex': !open }"
                              class="inline-flex"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>

                        <path :class="{ 'hidden': !open, 'inline-flex': open }"
                              class="hidden"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M6 18L18 6M6 6l12 12"/>

                    </svg>

                </button>

            </div>

        </div>

    </div>

    <!-- Mobile Search Bar (Collapsible) -->
    <div x-show="searchOpen" x-transition.duration.200ms class="sm:hidden px-4 pb-3">
        <form action="{{ route('wiki.index') }}" method="GET" class="flex rounded-lg overflow-hidden ring-1 ring-transparent focus-within:ring-2 focus-within:ring-amber-500">
            <input
                type="text"
                name="query"
                placeholder="Search..."
                class="w-full px-4 py-2.5 text-sm text-gray-900 bg-white focus:outline-none placeholder-gray-400"
            >
            <button type="submit" class="px-4 bg-[#febd69] hover:bg-[#f3a847] transition-colors duration-200 flex items-center justify-center">
                <svg class="w-5 h-5 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </button>
        </form>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden bg-[#1a2332]">

        <div class="pt-2 pb-3 space-y-1">

            @if(auth()->user()->is_admin)

                <x-responsive-nav-link
                    :href="route('admin.dashboard')"
                    :active="request()->routeIs('admin.dashboard')">

                    Admin Dashboard

                </x-responsive-nav-link>

                <x-responsive-nav-link
                    :href="route('wiki.index')"
                    :active="request()->routeIs('wiki.index')">

                    Wiki Search

                </x-responsive-nav-link>

            @else

                <x-responsive-nav-link
                    :href="route('shop')"
                    :active="request()->routeIs('shop')">

                    Shop

                </x-responsive-nav-link>

                <x-responsive-nav-link
                    :href="route('cart')"
                    :active="request()->routeIs('cart')">

                    Cart

                </x-responsive-nav-link>

                <x-responsive-nav-link
                    :href="route('wiki.index')"
                    :active="request()->routeIs('wiki.index')">

                    Wiki Search

                </x-responsive-nav-link>

            @endif

        </div>

        <div class="pt-4 pb-1 border-t border-gray-700">

            <div class="px-4 flex items-center gap-3">

                <div class="w-10 h-10 rounded-full bg-[#febd69] flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>

                <div>
                    <div class="font-medium text-base text-white">
                        {{ Auth::user()->name }}
                    </div>
                    <div class="font-medium text-sm text-gray-400">
                        {{ Auth::user()->email }}
                    </div>
                </div>

            </div>

            <div class="mt-3 space-y-1">

                <x-responsive-nav-link :href="route('profile.edit')">
                    Profile
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link
                        :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">

                        Log Out

                    </x-responsive-nav-link>

                </form>

            </div>

        </div>

    </div>

</nav>