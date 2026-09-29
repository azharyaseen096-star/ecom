@php
    $cartCount = count(session('cart', []));
    $navCategories = \App\Models\Category::where('is_active', true)->take(8)->get();
@endphp

<!-- Top Announcement & Live Status Bar -->
<div class="bg-gradient-to-r from-slate-950 via-slate-900 to-rose-950 text-slate-200 text-[11px] sm:text-xs py-1.5 sm:py-2 px-3 sm:px-4 border-b border-rose-500/20 shadow-xs relative z-50 overflow-hidden">
    <!-- Ambient glowing line -->
    <div class="absolute inset-x-0 bottom-0 h-px bg-gradient-to-r from-transparent via-rose-500/50 to-transparent"></div>
    
    <div class="max-w-7xl mx-auto flex items-center justify-between gap-2">
        <div class="flex items-center gap-2 sm:gap-4 overflow-hidden truncate">
            <span class="inline-flex items-center gap-1.5 text-amber-300 font-bold shrink-0">
                <span class="flex h-1.5 w-1.5 relative">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-rose-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-1.5 w-1.5 bg-rose-500"></span>
                </span>
                <i class="fa-solid fa-plane-departure text-rose-400 text-[10px]"></i>
                <span class="truncate">Worldwide Express &bull; DHL / FedEx</span>
            </span>
            <span class="hidden md:inline text-slate-700">|</span>
            <span class="hidden md:flex items-center gap-1.5 text-slate-300 font-medium truncate">
                <i class="fa-solid fa-certificate text-emerald-400"></i> 100% Organic Cotton Babywear
            </span>
        </div>
        
        <div class="flex items-center gap-2 shrink-0">
            <div class="hidden lg:flex items-center gap-1.5 text-xs text-slate-300">
                <span class="text-slate-400 text-[11px] font-semibold">Global Pay:</span>
                <span class="bg-[#ffdd00] text-black font-black px-2 py-0.5 rounded-md text-[10px] tracking-wide shadow-xs flex items-center gap-1">
                    <i class="fa-solid fa-bolt text-[9px]"></i> Western Union QR
                </span>
                <span class="bg-blue-600/90 text-white font-black px-2 py-0.5 rounded-md text-[10px] tracking-wide shadow-xs">Bank Wire</span>
                <span class="bg-emerald-600/90 text-white font-black px-2 py-0.5 rounded-md text-[10px] tracking-wide shadow-xs">Cards &bull; USD ($)</span>
            </div>
            
            @auth
                @if(auth()->user()->is_admin)
                    <a href="{{ route('admin.dashboard') }}" class="bg-gradient-to-r from-amber-400 to-rose-500 hover:from-amber-300 hover:to-rose-400 text-slate-950 font-black px-2 py-0.5 rounded-lg text-[10px] sm:text-xs transition shadow-md flex items-center gap-1">
                        <i class="fa-solid fa-gauge-high"></i> Admin
                    </a>
                @endif
            @endauth
        </div>
    </div>
</div>

<!-- Main Sticky Header with Frosted Glassmorphism -->
<nav x-data="{ open: false, searchOpen: false, userMenu: false, searchFocused: false }" class="bg-white/95 backdrop-blur-2xl border-b border-slate-200/90 sticky top-0 z-40 shadow-xs transition-all duration-300">
    <div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-14 sm:h-20 gap-2 sm:gap-4">
            
            <!-- 3D Brand Logo with Hover Glow & Tilt -->
            <div class="shrink-0 flex items-center">
                <a href="{{ route('home') }}" class="flex items-center gap-2 sm:gap-3 group touch-press">
                    <div class="w-8 h-8 sm:w-11 sm:h-11 rounded-xl sm:rounded-2xl bg-gradient-to-tr from-rose-500 via-amber-400 to-rose-600 flex items-center justify-center text-white text-sm sm:text-xl shadow-md sm:shadow-lg shadow-rose-500/25 group-hover:scale-110 group-hover:rotate-6 transition-all duration-300 transform">
                        <i class="fa-solid fa-child-reaching"></i>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-lg sm:text-2xl font-black tracking-tight text-slate-900 group-hover:text-rose-600 transition leading-none">Tiny<span class="text-transparent bg-clip-text bg-gradient-to-r from-rose-600 via-amber-500 to-rose-500">Champs</span></span>
                        <span class="text-[8px] sm:text-[10px] uppercase tracking-widest font-extrabold text-slate-400 flex items-center gap-1 mt-0.5">
                            <span class="inline-block w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span> Baby Tracksuits
                        </span>
                    </div>
                </a>
            </div>

            <!-- Intelligent Interactive Search Form (Desktop) -->
            <div class="flex-1 max-w-2xl hidden md:block">
                <form action="{{ route('shop') }}" method="GET" class="relative flex items-center group">
                    <input
                        type="text"
                        name="query"
                        value="{{ request('query') }}"
                        @focus="searchFocused = true"
                        @blur="searchFocused = false"
                        placeholder="Search baby fleece tracksuits, velvet sets, jogger outfits... (Press Enter)"
                        class="w-full pl-11 pr-24 py-2.5 sm:py-3 bg-slate-100/90 border border-slate-200/90 rounded-2xl text-xs sm:text-sm text-slate-900 placeholder-slate-400 focus:outline-none focus:bg-white focus:ring-2 focus:ring-rose-500/50 focus:border-rose-500 shadow-inner transition-all duration-200"
                    >
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-rose-500 transition">
                        <i class="fa-solid fa-magnifying-glass text-sm"></i>
                    </div>
                    <button type="submit" class="absolute right-1.5 bg-gradient-to-r from-rose-500 via-amber-500 to-rose-600 hover:from-rose-600 hover:to-amber-600 text-white text-xs font-black px-4 py-2 rounded-xl shadow-md hover:shadow-rose-500/30 transition duration-200 flex items-center gap-1.5 hover:scale-105 active:scale-95 transform">
                        <span>Search</span>
                        <i class="fa-solid fa-arrow-right text-[10px]"></i>
                    </button>
                </form>
            </div>

            <!-- Header Action Links & Cart -->
            <div class="flex items-center gap-1.5 sm:gap-3">
                
                <!-- Mobile Search Toggle Button -->
                <button 
                    @click="searchOpen = !searchOpen" 
                    class="md:hidden w-8 h-8 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 flex items-center justify-center text-xs transition active:scale-90"
                    title="Search Outfits"
                >
                    <i :class="searchOpen ? 'fa-solid fa-xmark text-rose-600' : 'fa-solid fa-magnifying-glass'"></i>
                </button>

                <!-- Shop Link (Desktop) -->
                <a href="{{ route('shop') }}" class="hidden lg:flex items-center gap-1.5 text-sm font-black text-slate-700 hover:text-rose-600 px-3.5 py-2.5 rounded-xl hover:bg-rose-50/70 transition">
                    <i class="fa-solid fa-shirt text-rose-500 text-sm"></i>
                    <span>All Tracksuits</span>
                </a>

                @auth
                    <!-- My Orders Link (Desktop) -->
                    <a href="{{ route('orders.index') }}" class="hidden sm:flex items-center gap-1.5 text-sm font-black text-slate-700 hover:text-rose-600 px-3.5 py-2.5 rounded-xl hover:bg-rose-50/70 transition">
                        <i class="fa-solid fa-box-open text-rose-500 text-sm"></i>
                        <span>My Orders</span>
                    </a>
                @endauth

                <!-- 3D Cart Pill with Animated Counter Badge -->
                <a href="{{ route('cart') }}" class="relative flex items-center gap-1.5 sm:gap-2.5 bg-gradient-to-r from-rose-50 via-amber-50 to-rose-50 hover:from-rose-100 hover:to-amber-100 text-rose-800 px-2.5 sm:px-4 py-1.5 sm:py-2.5 rounded-xl sm:rounded-2xl font-black text-xs sm:text-sm transition border border-rose-200/80 shadow-xs hover:shadow-md hover:-translate-y-0.5 transform">
                    <i class="fa-solid fa-bag-shopping text-sm sm:text-base text-rose-600"></i>
                    <span class="hidden sm:inline">Bag</span>
                    <span class="bg-gradient-to-r from-rose-600 to-amber-600 text-white text-[10px] sm:text-xs font-black rounded-full px-1.5 sm:px-2.5 py-0.2 sm:py-0.5 shadow-sm min-w-[18px] sm:min-w-[22px] text-center {{ $cartCount > 0 ? 'animate-bounce' : '' }}">
                        {{ $cartCount }}
                    </span>
                </a>

                <!-- User Profile / Auth Links (Desktop) -->
                @auth
                    <div class="relative hidden sm:block">
                        <button @click="userMenu = !userMenu" class="flex items-center gap-2 text-sm font-bold text-slate-800 bg-slate-100 hover:bg-slate-200/80 px-3.5 py-2 rounded-2xl border border-slate-200 transition">
                            <div class="w-7 h-7 rounded-xl bg-gradient-to-tr from-rose-500 to-amber-500 text-white flex items-center justify-center font-black text-xs shadow-xs">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                            <span class="hidden md:inline max-w-[100px] truncate font-extrabold">{{ auth()->user()->name }}</span>
                            <i class="fa-solid fa-chevron-down text-[10px] text-slate-500 transition-transform" :class="userMenu ? 'rotate-180' : ''"></i>
                        </button>

                        <div x-show="userMenu" @click.away="userMenu = false" x-cloak class="absolute right-0 mt-2 w-56 bg-white/95 backdrop-blur-xl rounded-2xl shadow-2xl border border-slate-100 py-2 z-50 divide-y divide-slate-100 animate-in fade-in slide-in-from-top-2 duration-200">
                            <div class="px-4 py-3">
                                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Signed in as</p>
                                <p class="text-sm font-extrabold text-slate-900 truncate">{{ auth()->user()->email }}</p>
                            </div>

                            <div class="py-1">
                                <a href="{{ route('orders.index') }}" class="flex items-center gap-2.5 px-4 py-2.5 text-sm font-bold text-slate-700 hover:bg-rose-50 hover:text-rose-600 transition">
                                    <i class="fa-solid fa-box text-xs text-rose-500 w-4"></i> My Orders
                                </a>
                                @if(auth()->user()->is_admin)
                                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2.5 px-4 py-2.5 text-sm font-black text-amber-700 bg-amber-50/80 hover:bg-amber-100 transition">
                                        <i class="fa-solid fa-gauge-high text-xs w-4"></i> Admin Panel
                                    </a>
                                @endif
                            </div>

                            <div class="py-1">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full flex items-center gap-2.5 px-4 py-2.5 text-sm font-bold text-red-600 hover:bg-red-50 transition text-left">
                                        <i class="fa-solid fa-arrow-right-from-bracket text-xs w-4"></i> Log Out
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="hidden sm:flex items-center gap-2">
                        <a href="{{ route('login') }}" class="text-xs sm:text-sm font-black text-slate-700 hover:text-rose-600 px-3 py-2 rounded-xl hover:bg-slate-100 transition">
                            Login
                        </a>
                        <a href="{{ route('register') }}" class="bg-gradient-to-r from-slate-950 to-slate-900 hover:from-rose-600 hover:to-amber-600 text-white text-xs font-black px-3.5 py-2 rounded-xl transition shadow-md hover:shadow-rose-500/20">
                            Register
                        </a>
                    </div>
                @endauth

                <!-- Mobile menu toggle button -->
                <button @click="open = !open" class="md:hidden w-8 h-8 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 flex items-center justify-center transition active:scale-90">
                    <i :class="open ? 'fa-solid fa-xmark text-base text-rose-600' : 'fa-solid fa-bars text-sm'"></i>
                </button>
            </div>
        </div>

        <!-- Mobile Expandable Search Dropdown -->
        <div x-show="searchOpen" x-cloak class="md:hidden pb-3 pt-1 border-t border-slate-100 animate-in fade-in slide-in-from-top-1 duration-200">
            <form action="{{ route('shop') }}" method="GET" class="relative flex items-center">
                <input
                    type="text"
                    name="query"
                    value="{{ request('query') }}"
                    placeholder="Search fleece, velvet, tracksuits..."
                    class="w-full pl-9 pr-20 py-2 bg-slate-100/90 border border-slate-200 rounded-xl text-xs text-slate-900 focus:outline-none focus:bg-white focus:ring-2 focus:ring-rose-500/50"
                >
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                    <i class="fa-solid fa-magnifying-glass text-xs"></i>
                </div>
                <button type="submit" class="absolute right-1 top-1 bottom-1 bg-gradient-to-r from-rose-500 to-amber-500 text-white text-[11px] font-black px-3 rounded-lg shadow-xs">
                    Search
                </button>
            </form>
        </div>

        <!-- Category Quick Access Bar (Desktop Only) -->
        <div class="hidden md:flex items-center gap-2 py-2 border-t border-slate-100 overflow-x-auto no-scrollbar text-xs">
            <span class="font-black text-slate-400 uppercase tracking-wider text-[10px] mr-1 shrink-0 flex items-center gap-1">
                <i class="fa-solid fa-fire text-rose-500"></i> Tracksuits:
            </span>
            @foreach($navCategories as $cat)
                <a href="{{ route('shop', ['category' => $cat->slug]) }}" class="px-3 py-1.5 rounded-xl bg-slate-100/80 hover:bg-rose-500 hover:text-white text-slate-700 font-extrabold transition duration-200 shrink-0 flex items-center gap-1.5 hover:shadow-xs">
                    <span>{{ $cat->icon ?: '🧸' }}</span>
                    <span>{{ $cat->name }}</span>
                </a>
            @endforeach
            <a href="{{ route('shop') }}" class="px-3 py-1.5 rounded-xl text-rose-600 font-black hover:underline shrink-0 ml-auto flex items-center gap-1">
                <span>View All Outfits</span> <i class="fa-solid fa-arrow-right text-[10px]"></i>
            </a>
        </div>

        <!-- Mobile Drawer Menu -->
        <div x-show="open" x-cloak class="md:hidden border-t border-slate-100 py-3 space-y-1 bg-white/95 backdrop-blur-xl rounded-2xl my-2 p-3 shadow-xl border">
            <a href="{{ route('home') }}" class="flex items-center px-3 py-2 rounded-xl text-xs font-bold text-slate-800 hover:bg-rose-50 hover:text-rose-600 transition">
                <i class="fa-solid fa-house mr-3 text-rose-500 w-4"></i> Home Page
            </a>
            <a href="{{ route('shop') }}" class="flex items-center px-3 py-2 rounded-xl text-xs font-bold text-slate-800 hover:bg-rose-50 hover:text-rose-600 transition">
                <i class="fa-solid fa-shirt mr-3 text-rose-500 w-4"></i> Baby Tracksuits Collection
            </a>
            <a href="{{ route('cart') }}" class="flex items-center justify-between px-3 py-2 rounded-xl text-xs font-bold text-slate-800 hover:bg-rose-50 hover:text-rose-600 transition">
                <span class="flex items-center"><i class="fa-solid fa-bag-shopping mr-3 text-rose-500 w-4"></i> Shopping Bag</span>
                <span class="bg-rose-600 text-white text-[10px] font-black px-2 py-0.5 rounded-full">{{ $cartCount }}</span>
            </a>
            @auth
                <a href="{{ route('orders.index') }}" class="flex items-center px-3 py-2 rounded-xl text-xs font-bold text-slate-800 hover:bg-rose-50 hover:text-rose-600 transition">
                    <i class="fa-solid fa-box mr-3 text-rose-500 w-4"></i> My Orders
                </a>
                @if(auth()->user()->is_admin)
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center px-3 py-2 rounded-xl text-xs font-black text-amber-800 bg-amber-50">
                        <i class="fa-solid fa-gauge mr-3 text-amber-600 w-4"></i> Admin Dashboard
                    </a>
                @endif
                <form method="POST" action="{{ route('logout') }}" class="pt-2 border-t border-slate-100">
                    @csrf
                    <button type="submit" class="w-full flex items-center px-3 py-2 text-xs font-bold text-red-600 hover:bg-red-50 rounded-xl transition text-left">
                        <i class="fa-solid fa-arrow-right-from-bracket mr-3 text-red-500 w-4"></i> Log Out
                    </button>
                </form>
            @else
                <div class="grid grid-cols-2 gap-2 pt-2 border-t border-slate-100">
                    <a href="{{ route('login') }}" class="text-center py-2 text-xs font-bold bg-slate-100 text-slate-800 rounded-xl hover:bg-slate-200 transition">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="text-center py-2 text-xs font-black bg-rose-600 text-white rounded-xl hover:bg-rose-700 transition shadow-xs">
                        Register
                    </a>
                </div>
            @endauth
        </div>
    </div>
</nav>

<!-- NATIVE-STYLE MOBILE BOTTOM FLOATING NAVIGATION BAR (Hidden on Desktop) -->
<nav aria-label="Mobile Navigation" class="md:hidden fixed bottom-0 left-0 right-0 z-50 bg-white/95 backdrop-blur-2xl border-t border-slate-200/90 shadow-[0_-5px_20px_rgba(0,0,0,0.08)] py-2 px-3">
    <div class="max-w-md mx-auto flex items-center justify-around">
        
        <!-- Home Link -->
        <a href="{{ route('home') }}" class="flex flex-col items-center gap-0.5 text-xs font-bold {{ request()->routeIs('home') ? 'text-rose-600' : 'text-slate-500 hover:text-slate-900' }} transition active:scale-90">
            <i class="fa-solid fa-house text-base"></i>
            <span class="text-[10px]">Home</span>
        </a>

        <!-- Shop Catalog -->
        <a href="{{ route('shop') }}" class="flex flex-col items-center gap-0.5 text-xs font-bold {{ request()->routeIs('shop*') ? 'text-rose-600' : 'text-slate-500 hover:text-slate-900' }} transition active:scale-90">
            <i class="fa-solid fa-shirt text-base"></i>
            <span class="text-[10px]">Suits</span>
        </a>

        <!-- 3D Center Cart Button -->
        <a href="{{ route('cart') }}" class="flex flex-col items-center relative -mt-5 active:scale-90 transition">
            <div class="w-12 h-12 rounded-2xl bg-gradient-to-tr from-rose-500 via-amber-400 to-rose-600 text-white flex items-center justify-center shadow-lg shadow-rose-500/40 border-2 border-white">
                <i class="fa-solid fa-bag-shopping text-lg"></i>
            </div>
            @if($cartCount > 0)
                <span class="absolute -top-1 -right-1 bg-red-600 text-white text-[10px] font-black rounded-full h-5 min-w-[20px] px-1 flex items-center justify-center border-2 border-white shadow-sm animate-bounce">
                    {{ $cartCount }}
                </span>
            @endif
            <span class="text-[10px] font-extrabold text-slate-800 mt-0.5">Bag</span>
        </a>

        <!-- Orders Track -->
        <a href="{{ auth()->check() ? route('orders.index') : route('login') }}" class="flex flex-col items-center gap-0.5 text-xs font-bold {{ request()->routeIs('orders*') ? 'text-rose-600' : 'text-slate-500 hover:text-slate-900' }} transition active:scale-90">
            <i class="fa-solid fa-box text-base"></i>
            <span class="text-[10px]">Orders</span>
        </a>

        <!-- User Profile / Auth -->
        @auth
            <a href="{{ auth()->user()->is_admin ? route('admin.dashboard') : route('orders.index') }}" class="flex flex-col items-center gap-0.5 text-xs font-bold {{ request()->routeIs('admin*') ? 'text-amber-600' : 'text-slate-500 hover:text-slate-900' }} transition active:scale-90">
                <i class="fa-solid {{ auth()->user()->is_admin ? 'fa-gauge-high text-amber-600' : 'fa-user' }} text-base"></i>
                <span class="text-[10px]">{{ auth()->user()->is_admin ? 'Admin' : 'Profile' }}</span>
            </a>
        @else
            <a href="{{ route('login') }}" class="flex flex-col items-center gap-0.5 text-xs font-bold text-slate-500 hover:text-rose-600 transition active:scale-90">
                <i class="fa-solid fa-user text-base"></i>
                <span class="text-[10px]">Login</span>
            </a>
        @endauth

    </div>
</nav>