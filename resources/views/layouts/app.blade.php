<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-50 scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'TinyChamps') }} - Premium Baby &amp; Kids Tracksuits</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <!-- Alpine.js for dynamic modals & interactive state -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.5/dist/cdn.min.js"></script>

    <!-- Leaflet CSS for GPS Maps -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

    <!-- AOS (Animate on Scroll) CSS -->
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css" />

    <!-- Tailwind CSS (via Vite or CDN fallback) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            50: '#fff1f2',
                            100: '#ffe4e6',
                            500: '#f43f5e',
                            600: '#e11d48',
                            700: '#be123c',
                            900: '#881337',
                        },
                        westernunion: '#ffdd00',
                        wublack: '#000000',
                    },
                    animation: {
                        'float': 'float 5s ease-in-out infinite',
                        'float-delayed': 'float 6s ease-in-out 2s infinite',
                        'pulse-glow': 'pulseGlow 2.5s infinite',
                        'shimmer': 'shimmer 2.5s infinite',
                        'spin-slow': 'spin 20s linear infinite',
                        'tilt-pulse': 'tiltPulse 4s ease-in-out infinite',
                        'marquee': 'marquee 25s linear infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0px) rotate(0deg)' },
                            '50%': { transform: 'translateY(-12px) rotate(1deg)' },
                        },
                        marquee: {
                            '0%': { transform: 'translateX(0%)' },
                            '100%': { transform: 'translateX(-50%)' },
                        },
                        pulseGlow: {
                            '0%, 100%': { opacity: '0.6', transform: 'scale(1)' },
                            '50%': { opacity: '1', transform: 'scale(1.08)' },
                        },
                        shimmer: {
                            '100%': { transform: 'translateX(100%)' },
                        },
                        tiltPulse: {
                            '0%, 100%': { transform: 'perspective(1000px) rotateY(0deg)' },
                            '50%': { transform: 'perspective(1000px) rotateY(4deg)' },
                        }
                    }
                }
            }
        }
    </script>

    <!-- 3D Graphics & Animations Libraries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vanilla-tilt/1.8.1/vanilla-tilt.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <!-- Leaflet JS for Maps -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <style>
        html, body {
            overflow-x: hidden;
            max-width: 100vw;
            -webkit-tap-highlight-color: transparent;
            -webkit-font-smoothing: antialiased;
        }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #fafafa;
            background-image: 
                radial-gradient(at 0% 0%, rgba(244, 63, 94, 0.04) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(14, 165, 233, 0.04) 0px, transparent 50%),
                radial-gradient(at 50% 50%, rgba(251, 191, 36, 0.035) 0px, transparent 50%);
            background-attachment: fixed;
            padding-bottom: env(safe-area-inset-bottom, 0px);
        }
        /* Custom Smooth Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 9999px;
            border: 2px solid #f1f5f9;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #f43f5e;
        }
        .leaflet-container {
            font-family: inherit;
            border-radius: 0.75rem;
            z-index: 10;
        }
        [x-cloak] { display: none !important; }

        /* Mobile Touch & Micro-Animation Utilities */
        .touch-press {
            transition: transform 0.15s cubic-bezier(0.34, 1.56, 0.64, 1), box-shadow 0.15s ease;
        }
        .touch-press:active {
            transform: scale(0.96) !important;
        }

        /* 3D Visual Utilities */
        .card-3d-wrap {
            perspective: 1200px;
            transform-style: preserve-3d;
        }
        .card-3d {
            transition: transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1), box-shadow 0.4s ease;
            transform-style: preserve-3d;
        }
        @media (hover: hover) and (pointer: fine) {
            .card-3d:hover {
                transform: translateY(-8px) scale(1.02);
                box-shadow: 0 20px 40px -15px rgba(244, 63, 94, 0.25);
            }
        }
        .glow-neon-orange {
            box-shadow: 0 0 25px -5px rgba(244, 63, 94, 0.5);
        }
        .glow-neon-emerald {
            box-shadow: 0 0 25px -5px rgba(16, 185, 129, 0.5);
        }
        .glass-panel {
            background: rgba(15, 23, 42, 0.75);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .glass-card-light {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.6);
        }

        /* Hide scrollbar for Chrome, Safari and Opera */
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
        /* Hide scrollbar for IE, Edge and Firefox */
        .no-scrollbar {
            -ms-overflow-style: none;  /* IE and Edge */
            scrollbar-width: none;  /* Firefox */
        }

        /* Ambient Side Cyber Rails (<100px) for Wide Desktop Viewports */
        .side-rail-left, .side-rail-right {
            width: 72px;
            pointer-events: none;
            z-index: 35;
        }
        .writing-mode-vertical {
            writing-mode: vertical-rl;
            text-orientation: mixed;
            transform: rotate(180deg);
        }
    </style>
    @stack('styles')
</head>

<body class="font-sans antialiased text-slate-800 bg-slate-50 flex flex-col min-h-screen selection:bg-rose-500 selection:text-white relative pb-20 md:pb-0 overflow-x-hidden">

    <!-- 3D Opening Intro Preloader Animation Screen -->
    <div id="site-preloader" class="fixed inset-0 z-[9999] bg-slate-950 flex flex-col items-center justify-center transition-all duration-700 ease-out overflow-hidden selection:bg-rose-500">
        <!-- Ambient Glowing Orbs in Background -->
        <div class="absolute w-80 h-80 sm:w-96 sm:h-96 rounded-full bg-rose-600/25 blur-3xl animate-pulse pointer-events-none"></div>
        <div class="absolute w-64 h-64 sm:w-80 sm:h-80 rounded-full bg-amber-500/20 blur-3xl pointer-events-none -bottom-10 -right-10"></div>
        
        <div class="relative z-10 flex flex-col items-center text-center px-4 max-w-sm sm:max-w-md w-full">
            <!-- 3D Glowing Icon with Rotating Neon Rings -->
            <div class="relative mb-6">
                <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-3xl bg-gradient-to-tr from-rose-500 via-amber-500 to-rose-600 flex items-center justify-center text-white text-3xl sm:text-4xl shadow-2xl shadow-rose-500/40 transform hover:scale-105 transition duration-500 animate-bounce">
                    <i class="fa-solid fa-shirt"></i>
                </div>
                <div class="absolute -inset-2 border-2 border-dashed border-rose-500/60 rounded-3xl animate-spin-slow pointer-events-none"></div>
                <div class="absolute -inset-4 border border-amber-400/30 rounded-3xl animate-pulse-slow pointer-events-none"></div>
            </div>

            <!-- Brand Typography -->
            <div class="space-y-1 mb-6">
                <h1 class="text-3xl sm:text-4xl font-black tracking-tight text-white">
                    Bazaar<span class="text-transparent bg-clip-text bg-gradient-to-r from-rose-400 via-amber-300 to-yellow-200">PK</span>
                </h1>
                <p class="text-xs sm:text-sm font-bold tracking-widest uppercase text-rose-300/80">
                    Premium Baby &amp; Kids Tracksuits
                </p>
            </div>

            <!-- Progress Bar & Percentage Loading -->
            <div class="w-52 sm:w-64 bg-slate-800/90 rounded-full h-2 p-0.5 border border-slate-700/80 overflow-hidden shadow-inner mb-3">
                <div id="preloader-bar" class="h-full bg-gradient-to-r from-rose-500 via-amber-400 to-yellow-300 rounded-full transition-all duration-300 ease-out" style="width: 20%"></div>
            </div>
            
            <div class="flex items-center gap-2 text-[11px] font-mono text-slate-400">
                <span class="inline-block w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
                <span>Loading Experience... <strong id="preloader-pct" class="text-rose-400 font-bold">20%</strong></span>
            </div>
        </div>
    </div>

    <!-- DESKTOP 100PX FLANKING DECORATIVE ACCENT RAILS (Left & Right) -->
    <!-- Left Flanking Rail (Width < 100px, hidden on mobile/tablet) -->
    <aside aria-hidden="true" class="side-rail-left hidden 2xl:flex fixed left-0 top-0 bottom-0 flex-col items-center justify-between py-24 select-none">
        <!-- Top Nodes -->
        <div class="flex flex-col items-center gap-3 opacity-60">
            <div class="w-2.5 h-2.5 rounded-full bg-rose-500 animate-ping"></div>
            <div class="w-1.5 h-1.5 rounded-full bg-amber-400"></div>
            <div class="w-1 h-8 bg-gradient-to-b from-rose-500/60 to-transparent rounded-full"></div>
            <span class="text-[9px] font-mono tracking-widest text-slate-400 uppercase">KIDS//01</span>
        </div>

        <!-- Middle Vertical Typography & Track -->
        <div class="flex flex-col items-center gap-4">
            <div class="h-20 w-px bg-gradient-to-b from-transparent via-rose-400/40 to-transparent"></div>
            <div class="writing-mode-vertical text-[10px] font-black uppercase tracking-[0.3em] text-slate-400/70 hover:text-rose-500 transition">
                🧸 TINYCHAMPS &bull; TRACKSUITS
            </div>
            <div class="h-20 w-px bg-gradient-to-b from-rose-400/40 via-amber-400/30 to-transparent"></div>
        </div>

        <!-- Bottom Status Matrix -->
        <div class="flex flex-col items-center gap-2 opacity-50">
            <div class="grid grid-cols-2 gap-1">
                <span class="w-1 h-1 rounded-full bg-rose-500"></span>
                <span class="w-1 h-1 rounded-full bg-slate-400"></span>
                <span class="w-1 h-1 rounded-full bg-amber-400"></span>
                <span class="w-1 h-1 rounded-full bg-emerald-400"></span>
            </div>
            <span class="text-[8px] font-mono text-slate-400 tracking-wider">GLOBAL</span>
        </div>
    </aside>

    <!-- Right Flanking Rail (Width < 100px, hidden on mobile/tablet) -->
    <aside aria-hidden="true" class="side-rail-right hidden 2xl:flex fixed right-0 top-0 bottom-0 flex-col items-center justify-between py-24 select-none">
        <!-- Top Security Indicator -->
        <div class="flex flex-col items-center gap-3 opacity-60">
            <div class="w-2 h-2 rounded-full bg-emerald-500"></div>
            <span class="text-[9px] font-mono tracking-widest text-emerald-600 font-bold uppercase">SSL:256</span>
            <div class="w-1 h-8 bg-gradient-to-b from-emerald-500/60 to-transparent rounded-full"></div>
        </div>

        <!-- Middle Vertical Brand Guide & Scroll Indicator -->
        <div class="flex flex-col items-center gap-4">
            <div class="h-20 w-px bg-gradient-to-b from-transparent via-emerald-400/40 to-transparent"></div>
            <div class="writing-mode-vertical text-[10px] font-black uppercase tracking-[0.3em] text-slate-400/70 hover:text-emerald-500 transition">
                ⚡ WESTERN UNION &bull; WORLDWIDE
            </div>
            <div class="h-20 w-px bg-gradient-to-b from-emerald-400/40 via-sky-400/30 to-transparent"></div>
        </div>

        <!-- Bottom Quick Scroll-to-Top Trigger (Interactive) -->
        <div class="flex flex-col items-center gap-2 pointer-events-auto">
            <button 
                onclick="window.scrollTo({top: 0, behavior: 'smooth'})" 
                class="w-9 h-9 rounded-2xl bg-white/90 hover:bg-orange-500 hover:text-white text-slate-600 border border-slate-200 shadow-md flex items-center justify-center transition-all duration-300 transform hover:-translate-y-1"
                title="Scroll to Top"
            >
                <i class="fa-solid fa-arrow-up text-xs"></i>
            </button>
            <span class="text-[8px] font-mono text-slate-400 tracking-wider">TOP</span>
        </div>
    </aside>

    @include('layouts.navigation')

    <!-- Flash Messages -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4 w-full">
        @if(session('success'))
            <div class="flex items-center p-4 mb-4 text-sm text-emerald-900 rounded-2xl bg-emerald-50 border border-emerald-200 shadow-sm transition-all" role="alert">
                <i class="fa-solid fa-circle-check text-emerald-600 text-xl mr-3 shrink-0"></i>
                <div class="font-bold">{{ session('success') }}</div>
            </div>
        @endif

        @if(session('error'))
            <div class="flex items-center p-4 mb-4 text-sm text-red-900 rounded-2xl bg-red-50 border border-red-200 shadow-sm transition-all" role="alert">
                <i class="fa-solid fa-circle-exclamation text-red-600 text-xl mr-3 shrink-0"></i>
                <div class="font-bold">{{ session('error') }}</div>
            </div>
        @endif

        @if(session('info'))
            <div class="flex items-center p-4 mb-4 text-sm text-blue-900 rounded-2xl bg-blue-50 border border-blue-200 shadow-sm transition-all" role="alert">
                <i class="fa-solid fa-circle-info text-blue-600 text-xl mr-3 shrink-0"></i>
                <div class="font-bold">{{ session('info') }}</div>
            </div>
        @endif

        @if (isset($errors) && $errors->any())
            <div class="p-4 mb-4 text-sm text-red-900 rounded-2xl bg-red-50 border border-red-200 shadow-sm">
                <div class="font-bold flex items-center gap-2 mb-1">
                    <i class="fa-solid fa-triangle-exclamation text-red-600 text-lg"></i> Please check the highlighted errors:
                </div>
                <ul class="list-disc list-inside space-y-1 text-red-700 ml-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    <!-- Main Content Area -->
    <main class="flex-grow">
        @if (isset($header))
            <header class="bg-white border-b border-slate-200 shadow-xs">
                <div class="max-w-7xl mx-auto py-5 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        {{ $slot ?? '' }}
        @yield('content')
    </main>

    @include('layouts.footer')

    <script>
        // Opening Intro Preloader Controller
        (function() {
            const preloader = document.getElementById('site-preloader');
            const bar = document.getElementById('preloader-bar');
            const pct = document.getElementById('preloader-pct');
            
            if (preloader && bar && pct) {
                let progress = 20;
                const interval = setInterval(() => {
                    progress += Math.floor(Math.random() * 25) + 15;
                    if (progress >= 100) {
                        progress = 100;
                        clearInterval(interval);
                        bar.style.width = '100%';
                        pct.textContent = '100%';
                        setTimeout(() => {
                            preloader.style.opacity = '0';
                            preloader.style.pointerEvents = 'none';
                            preloader.style.transform = 'scale(1.04)';
                            setTimeout(() => {
                                preloader.style.display = 'none';
                            }, 650);
                        }, 200);
                    } else {
                        bar.style.width = progress + '%';
                        pct.textContent = progress + '%';
                    }
                }, 60);

                window.addEventListener('load', () => {
                    progress = 90;
                });
            }
        })();

        document.addEventListener('DOMContentLoaded', function() {
            // Initialize AOS (Animate on Scroll)
            if (typeof AOS !== 'undefined') {
                AOS.init({
                    duration: 800,
                    easing: 'ease-out-cubic',
                    once: true,
                    offset: 50
                });
            }

            // Auto-initialize VanillaTilt only on desktop devices with fine pointer (mouse)
            if (typeof VanillaTilt !== 'undefined' && window.matchMedia('(hover: hover) and (pointer: fine)').matches) {
                VanillaTilt.init(document.querySelectorAll("[data-tilt]"), {
                    max: 12,
                    speed: 400,
                    glare: true,
                    "max-glare": 0.25,
                    scale: 1.02
                });
            }
        });
    </script>

    @stack('scripts')
</body>

</html>