<!DOCTYPE html>
<html lang="en" class="h-full bg-slate-950">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set New Password - {{ config('app.name', 'BazaarPK') }}</title>
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
                    }
                }
            }
        }
    </script>
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="min-h-screen bg-slate-950 text-slate-100 flex items-center justify-center p-4 relative overflow-x-hidden">

    <div class="fixed top-1/4 -left-32 w-96 h-96 bg-orange-600/20 rounded-full blur-3xl pointer-events-none"></div>
    <div class="fixed bottom-1/4 -right-32 w-96 h-96 bg-indigo-600/20 rounded-full blur-3xl pointer-events-none"></div>

    <div class="w-full max-w-md relative z-10 my-8">
        
        <div class="text-center mb-8">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-3 group">
                <div class="w-12 h-12 rounded-2xl bg-gradient-to-tr from-orange-500 to-amber-500 flex items-center justify-center text-white text-2xl shadow-lg shadow-orange-500/30">
                    <i class="fa-solid fa-bag-shopping"></i>
                </div>
                <div class="text-left">
                    <span class="text-2xl font-black tracking-tight text-white">Bazaar<span class="text-orange-500">PK</span></span>
                    <span class="block text-[10px] uppercase tracking-widest font-bold text-slate-400 -mt-1">Reset Password</span>
                </div>
            </a>
        </div>

        <div class="bg-slate-900/80 backdrop-blur-2xl border border-slate-800 rounded-3xl p-8 shadow-2xl shadow-black/80 relative overflow-hidden">
            <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-orange-500 via-amber-500 to-red-500"></div>

            <div class="text-center mb-6">
                <div class="w-16 h-16 rounded-2xl bg-orange-500/10 border border-orange-500/30 flex items-center justify-center text-orange-400 text-2xl mx-auto mb-4">
                    <i class="fa-solid fa-lock-open"></i>
                </div>
                <h1 class="text-2xl font-extrabold text-white">Choose New Password</h1>
                <p class="text-xs text-slate-400 mt-1">For account: <strong class="text-slate-200">{{ $user->email }}</strong></p>
            </div>

            @if($errors->any())
                <div class="mb-4 p-3.5 rounded-xl bg-red-500/10 border border-red-500/30 text-red-300 text-xs flex items-center gap-2">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            <form method="POST" action="{{ route('otp.reset-password.submit') }}" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-1.5">New Password</label>
                    <div class="relative">
                        <input type="password" name="password" id="newPassword" required minlength="8" class="w-full px-4 py-3 rounded-xl bg-slate-800 border border-slate-700 text-white placeholder-slate-500 focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 text-sm" placeholder="••••••••">
                        <button type="button" onclick="togglePassword('newPassword', 'eyeIcon1')" class="absolute right-3.5 top-3.5 text-slate-400 hover:text-slate-200">
                            <i id="eyeIcon1" class="fa-solid fa-eye text-sm"></i>
                        </button>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-1.5">Confirm New Password</label>
                    <div class="relative">
                        <input type="password" name="password_confirmation" id="confirmPassword" required minlength="8" class="w-full px-4 py-3 rounded-xl bg-slate-800 border border-slate-700 text-white placeholder-slate-500 focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 text-sm" placeholder="••••••••">
                        <button type="button" onclick="togglePassword('confirmPassword', 'eyeIcon2')" class="absolute right-3.5 top-3.5 text-slate-400 hover:text-slate-200">
                            <i id="eyeIcon2" class="fa-solid fa-eye text-sm"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="w-full mt-2 py-3.5 px-6 rounded-xl bg-gradient-to-r from-orange-500 to-amber-500 hover:from-orange-600 hover:to-amber-600 text-white font-extrabold text-sm shadow-lg shadow-orange-500/30 transition duration-200">
                    Update Password & Sign In
                </button>
            </form>
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
