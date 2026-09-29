<!DOCTYPE html>
<html lang="en" class="h-full bg-slate-950">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account - {{ config('app.name', 'BazaarPK') }}</title>
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

    <!-- Ambient Glowing Background -->
    <div class="fixed top-1/4 -left-32 w-96 h-96 bg-orange-600/20 rounded-full blur-3xl pointer-events-none animate-pulse-slow"></div>
    <div class="fixed bottom-1/4 -right-32 w-96 h-96 bg-indigo-600/20 rounded-full blur-3xl pointer-events-none animate-pulse-slow"></div>

    <div class="w-full max-w-lg relative z-10 my-8">
        
        <!-- Logo -->
        <div class="text-center mb-8">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-3 group">
                <div class="w-12 h-12 rounded-2xl bg-gradient-to-tr from-orange-500 to-amber-500 flex items-center justify-center text-white text-2xl shadow-lg shadow-orange-500/30 group-hover:scale-105 transition duration-300">
                    <i class="fa-solid fa-bag-shopping"></i>
                </div>
                <div class="text-left">
                    <span class="text-2xl font-black tracking-tight text-white">Bazaar<span class="text-orange-500">PK</span></span>
                    <span class="block text-[10px] uppercase tracking-widest font-bold text-slate-400 -mt-1">Join the Premier Store</span>
                </div>
            </a>
        </div>

        <!-- Glass Card -->
        <div class="bg-slate-900/80 backdrop-blur-2xl border border-slate-800 rounded-3xl p-8 sm:p-10 shadow-2xl shadow-black/80 relative overflow-hidden">
            <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-orange-500 via-amber-500 to-red-500"></div>

            <div class="text-center mb-6">
                <h1 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight">Create Account</h1>
                <p class="text-xs sm:text-sm text-slate-400 mt-1">Get verified instantly via 6-Digit Email OTP</p>
            </div>

            <!-- OTP Notice Banner -->
            <div class="mb-5 p-3 rounded-2xl bg-orange-500/10 border border-orange-500/20 text-orange-300 text-xs flex items-center gap-2.5">
                <i class="fa-solid fa-envelope-circle-check text-amber-400 text-base"></i>
                <span>A 6-digit OTP verification code will be sent to your Gmail/Email.</span>
            </div>

            @if(isset($errors) && $errors->any())
                <div class="mb-5 p-3.5 rounded-2xl bg-red-500/10 border border-red-500/30 text-red-300 text-xs flex items-center gap-2.5">
                    <i class="fa-solid fa-triangle-exclamation text-red-400"></i>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf

                <!-- Full Name -->
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-1.5">Full Name</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-500">
                            <i class="fa-solid fa-user text-xs"></i>
                        </div>
                        <input type="text" name="name" value="{{ old('name') }}" required autofocus class="w-full pl-10 pr-4 py-3 rounded-xl bg-slate-800 border border-slate-700 text-white placeholder-slate-500 focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 text-sm" placeholder="Muhammad Ali">
                    </div>
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-1.5">Email (Gmail / Any Email)</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-500">
                            <i class="fa-solid fa-envelope text-xs"></i>
                        </div>
                        <input type="email" name="email" value="{{ old('email') }}" required class="w-full pl-10 pr-4 py-3 rounded-xl bg-slate-800 border border-slate-700 text-white placeholder-slate-500 focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 text-sm" placeholder="ali@gmail.com">
                    </div>
                </div>

                <!-- Phone (Optional) -->
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-1.5">Phone Number (Optional)</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-500">
                            <i class="fa-solid fa-phone text-xs"></i>
                        </div>
                        <input type="tel" name="phone" value="{{ old('phone') }}" class="w-full pl-10 pr-4 py-3 rounded-xl bg-slate-800 border border-slate-700 text-white placeholder-slate-500 focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 text-sm" placeholder="0300 1234567">
                    </div>
                </div>

                <!-- Password -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-1.5">Password</label>
                        <div class="relative">
                            <input type="password" name="password" id="regPassword" required minlength="8" class="w-full px-3.5 pr-9 py-3 rounded-xl bg-slate-800 border border-slate-700 text-white placeholder-slate-500 focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 text-sm" placeholder="••••••••">
                            <button type="button" onclick="togglePassword('regPassword', 'eyeReg1')" class="absolute right-2.5 top-3.5 text-slate-400 hover:text-slate-200">
                                <i id="eyeReg1" class="fa-solid fa-eye text-xs"></i>
                            </button>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-1.5">Confirm Password</label>
                        <div class="relative">
                            <input type="password" name="password_confirmation" id="regConfirmPassword" required minlength="8" class="w-full px-3.5 pr-9 py-3 rounded-xl bg-slate-800 border border-slate-700 text-white placeholder-slate-500 focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 text-sm" placeholder="••••••••">
                            <button type="button" onclick="togglePassword('regConfirmPassword', 'eyeReg2')" class="absolute right-2.5 top-3.5 text-slate-400 hover:text-slate-200">
                                <i id="eyeReg2" class="fa-solid fa-eye text-xs"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Terms -->
                <div class="pt-2">
                    <label class="flex items-start gap-2 cursor-pointer text-xs text-slate-400">
                        <input type="checkbox" required checked class="w-4 h-4 mt-0.5 rounded bg-slate-800 border-slate-700 text-orange-500 focus:ring-orange-500 focus:ring-offset-slate-900">
                        <span>I agree to the <a href="#" class="text-orange-400 hover:underline">Terms of Service</a> & <a href="#" class="text-orange-400 hover:underline">Privacy Policy</a></span>
                    </label>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full mt-2 py-3.5 px-6 rounded-xl bg-gradient-to-r from-orange-500 via-amber-500 to-orange-600 hover:from-orange-600 hover:to-amber-600 text-white font-extrabold text-sm shadow-lg shadow-orange-500/30 hover:shadow-orange-500/50 hover:scale-[1.01] active:scale-[0.99] transition duration-200 flex items-center justify-center gap-2">
                    <span>Create Account & Send OTP</span>
                    <i class="fa-solid fa-arrow-right text-xs"></i>
                </button>
            </form>

            <!-- Login Footer Link -->
            <div class="mt-6 pt-6 border-t border-slate-800 text-center">
                <p class="text-xs text-slate-400">
                    Already have an account?
                    <a href="{{ route('login') }}" class="text-orange-400 font-bold hover:text-orange-300 ml-1 underline decoration-orange-500/40">
                        Sign In Instead
                    </a>
                </p>
            </div>

        </div>

    </div>

    <script>
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
