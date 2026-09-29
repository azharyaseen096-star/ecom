<!DOCTYPE html>
<html lang="en" class="h-full bg-slate-950">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In - {{ config('app.name', 'BazaarPK') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    },
                    animation: {
                        'pulse-slow': 'pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                    }
                }
            }
        }
    </script>
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="min-h-screen bg-slate-950 text-slate-100 flex items-center justify-center p-4 relative overflow-x-hidden selection:bg-orange-500 selection:text-white">

    <!-- Ambient Glowing Orbs -->
    <div class="fixed top-1/4 -left-32 w-96 h-96 bg-orange-600/20 rounded-full blur-3xl pointer-events-none animate-pulse-slow"></div>
    <div class="fixed bottom-1/4 -right-32 w-96 h-96 bg-indigo-600/20 rounded-full blur-3xl pointer-events-none animate-pulse-slow"></div>

    <div class="w-full max-w-md relative z-10 my-8">
        
        <!-- Logo -->
        <div class="text-center mb-8">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-3 group">
                <div class="w-12 h-12 rounded-2xl bg-gradient-to-tr from-orange-500 to-amber-500 flex items-center justify-center text-white text-2xl shadow-lg shadow-orange-500/30 group-hover:scale-105 transition duration-300">
                    <i class="fa-solid fa-bag-shopping"></i>
                </div>
                <div class="text-left">
                    <span class="text-2xl font-black tracking-tight text-white">Bazaar<span class="text-orange-500">PK</span></span>
                    <span class="block text-[10px] uppercase tracking-widest font-bold text-slate-400 -mt-1">Official Store</span>
                </div>
            </a>
        </div>

        <!-- Glass Card -->
        <div class="bg-slate-900/80 backdrop-blur-2xl border border-slate-800 rounded-3xl p-8 sm:p-10 shadow-2xl shadow-black/80 relative overflow-hidden">
            <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-orange-500 via-amber-500 to-red-500"></div>

            <div class="text-center mb-6">
                <h1 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight">Welcome Back</h1>
                <p class="text-xs sm:text-sm text-slate-400 mt-1">Sign in to manage your orders & fast checkout</p>
            </div>

            <!-- Flash Notifications -->
            @if(session('success'))
                <div class="mb-5 p-3.5 rounded-2xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-300 text-xs flex items-center gap-2.5">
                    <i class="fa-solid fa-circle-check text-emerald-400"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-5 p-3.5 rounded-2xl bg-red-500/10 border border-red-500/30 text-red-300 text-xs flex items-center gap-2.5">
                    <i class="fa-solid fa-circle-exclamation text-red-400"></i>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            @if(session('info'))
                <div class="mb-5 p-3.5 rounded-2xl bg-blue-500/10 border border-blue-500/30 text-blue-300 text-xs flex items-center gap-2.5">
                    <i class="fa-solid fa-circle-info text-blue-400"></i>
                    <span>{{ session('info') }}</span>
                </div>
            @endif

            @if(isset($errors) && $errors->any())
                <div class="mb-5 p-3.5 rounded-2xl bg-red-500/10 border border-red-500/30 text-red-300 text-xs flex items-center gap-2.5">
                    <i class="fa-solid fa-triangle-exclamation text-red-400"></i>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            <!-- Tabs: Standard Login vs OTP Login -->
            <div class="flex rounded-xl bg-slate-800/80 p-1 mb-6 border border-slate-700/60" id="loginTabs">
                <button type="button" onclick="switchLoginMode('password')" id="tabPassword" class="flex-1 py-2 text-xs font-bold rounded-lg transition-all duration-200 bg-orange-600 text-white shadow">
                    <i class="fa-solid fa-key mr-1.5"></i> Password Login
                </button>
                <button type="button" onclick="switchLoginMode('otp')" id="tabOtp" class="flex-1 py-2 text-xs font-bold rounded-lg transition-all duration-200 text-slate-400 hover:text-white">
                    <i class="fa-solid fa-envelope-circle-check mr-1.5"></i> Email OTP Login
                </button>
            </div>

            <!-- 1. Standard Password Login Form -->
            <form method="POST" action="{{ route('login') }}" id="passwordLoginForm" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-1.5">Email Address</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-500">
                            <i class="fa-solid fa-envelope text-xs"></i>
                        </div>
                        <input type="email" name="email" value="{{ old('email') }}" required autofocus class="w-full pl-10 pr-4 py-3 rounded-xl bg-slate-800 border border-slate-700 text-white placeholder-slate-500 focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 text-sm" placeholder="you@example.com">
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <label class="text-xs font-bold uppercase tracking-wider text-slate-400">Password</label>
                        <a href="{{ route('password.request') }}" class="text-xs font-semibold text-orange-400 hover:text-orange-300 transition">Forgot?</a>
                    </div>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-500">
                            <i class="fa-solid fa-lock text-xs"></i>
                        </div>
                        <input type="password" name="password" id="loginPassword" required class="w-full pl-10 pr-10 py-3 rounded-xl bg-slate-800 border border-slate-700 text-white placeholder-slate-500 focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 text-sm" placeholder="••••••••">
                        <button type="button" onclick="togglePassword('loginPassword', 'eyeIconLogin')" class="absolute right-3.5 top-3.5 text-slate-400 hover:text-slate-200">
                            <i id="eyeIconLogin" class="fa-solid fa-eye text-sm"></i>
                        </button>
                    </div>
                </div>

                <div class="flex items-center justify-between pt-1">
                    <label class="flex items-center gap-2 cursor-pointer text-xs text-slate-400">
                        <input type="checkbox" name="remember" class="w-4 h-4 rounded bg-slate-800 border-slate-700 text-orange-500 focus:ring-orange-500 focus:ring-offset-slate-900">
                        <span>Remember me</span>
                    </label>
                </div>

                <button type="submit" class="w-full py-3.5 px-6 rounded-xl bg-gradient-to-r from-orange-500 to-amber-500 hover:from-orange-600 hover:to-amber-600 text-white font-extrabold text-sm shadow-lg shadow-orange-500/30 hover:shadow-orange-500/50 hover:scale-[1.01] active:scale-[0.99] transition duration-200 flex items-center justify-center gap-2">
                    <span>Sign In</span>
                    <i class="fa-solid fa-arrow-right text-xs"></i>
                </button>
            </form>

            <!-- 2. OTP Passwordless Login Form (Hidden by default) -->
            <form method="POST" action="{{ route('login.otp') }}" id="otpLoginForm" class="space-y-4 hidden">
                @csrf
                <div class="p-3 bg-orange-500/10 border border-orange-500/20 rounded-xl text-xs text-orange-300">
                    <i class="fa-solid fa-sparkles mr-1 text-amber-400"></i>
                    No password needed! We will send a secure 6-digit code to your Gmail/Email.
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-1.5">Your Registered Email</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-500">
                            <i class="fa-solid fa-envelope text-xs"></i>
                        </div>
                        <input type="email" name="email" required class="w-full pl-10 pr-4 py-3 rounded-xl bg-slate-800 border border-slate-700 text-white placeholder-slate-500 focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 text-sm" placeholder="you@example.com">
                    </div>
                </div>

                <button type="submit" class="w-full py-3.5 px-6 rounded-xl bg-gradient-to-r from-orange-500 via-amber-500 to-orange-600 hover:from-orange-600 hover:to-amber-600 text-white font-extrabold text-sm shadow-lg shadow-orange-500/30 transition duration-200 flex items-center justify-center gap-2">
                    <i class="fa-solid fa-paper-plane text-xs"></i>
                    <span>Send Verification Code</span>
                </button>
            </form>

            <!-- Register Footer Link -->
            <div class="mt-8 pt-6 border-t border-slate-800 text-center">
                <p class="text-xs text-slate-400">
                    Don't have an account yet?
                    <a href="{{ route('register') }}" class="text-orange-400 font-bold hover:text-orange-300 ml-1 underline decoration-orange-500/40">
                        Create Free Account
                    </a>
                </p>
            </div>

        </div>

    </div>

    <script>
        function switchLoginMode(mode) {
            const passForm = document.getElementById('passwordLoginForm');
            const otpForm = document.getElementById('otpLoginForm');
            const tabPass = document.getElementById('tabPassword');
            const tabOtp = document.getElementById('tabOtp');

            if (mode === 'password') {
                passForm.classList.remove('hidden');
                otpForm.classList.add('hidden');
                tabPass.className = 'flex-1 py-2 text-xs font-bold rounded-lg transition-all duration-200 bg-orange-600 text-white shadow';
                tabOtp.className = 'flex-1 py-2 text-xs font-bold rounded-lg transition-all duration-200 text-slate-400 hover:text-white';
            } else {
                passForm.classList.add('hidden');
                otpForm.classList.remove('hidden');
                tabOtp.className = 'flex-1 py-2 text-xs font-bold rounded-lg transition-all duration-200 bg-orange-600 text-white shadow';
                tabPass.className = 'flex-1 py-2 text-xs font-bold rounded-lg transition-all duration-200 text-slate-400 hover:text-white';
            }
        }

        function togglePassword(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>