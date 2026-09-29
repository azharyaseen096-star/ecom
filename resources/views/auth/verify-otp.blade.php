<!DOCTYPE html>
<html lang="en" class="h-full bg-slate-950">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Email OTP - {{ config('app.name', 'BazaarPK') }}</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
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
                        'float': 'float 6s ease-in-out infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-10px)' },
                        }
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .otp-box:focus {
            transform: scale(1.08);
            border-color: #f97316;
            box-shadow: 0 0 20px rgba(249, 115, 22, 0.4);
            background-color: #0f172a;
        }
    </style>
</head>
<body class="min-h-screen bg-slate-950 text-slate-100 flex items-center justify-center p-4 relative overflow-x-hidden selection:bg-orange-500 selection:text-white">

    <!-- Ambient 3D Glowing Lights -->
    <div class="fixed top-1/4 -left-32 w-96 h-96 bg-orange-600/20 rounded-full blur-3xl pointer-events-none animate-pulse-slow"></div>
    <div class="fixed bottom-1/4 -right-32 w-96 h-96 bg-indigo-600/20 rounded-full blur-3xl pointer-events-none animate-pulse-slow"></div>
    <div class="fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] bg-amber-500/10 rounded-full blur-[120px] pointer-events-none"></div>

    <div class="w-full max-w-lg relative z-10 my-8">
        
        <!-- Header Logo -->
        <div class="text-center mb-8">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-3 group">
                <div class="w-12 h-12 rounded-2xl bg-gradient-to-tr from-orange-500 via-amber-500 to-orange-600 flex items-center justify-center text-white text-2xl shadow-lg shadow-orange-500/30 group-hover:scale-110 group-hover:rotate-6 transition duration-300">
                    <i class="fa-solid fa-bag-shopping"></i>
                </div>
                <div class="text-left">
                    <span class="text-2xl font-black tracking-tight text-white">Bazaar<span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-amber-400">PK</span></span>
                    <span class="block text-[10px] uppercase tracking-widest font-black text-slate-400 -mt-1">Verified OTP Security</span>
                </div>
            </a>
        </div>

        <!-- Glassmorphism OTP Verification Card -->
        <div class="bg-slate-900/85 backdrop-blur-2xl border border-slate-800 rounded-3xl p-8 sm:p-10 shadow-2xl shadow-black/90 relative overflow-hidden">
            <!-- Top Gradient Accent Line -->
            <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-orange-500 via-amber-500 to-red-500"></div>

            <!-- Lock Animation Icon -->
            <div class="flex justify-center mb-6">
                <div class="relative animate-float">
                    <div class="w-20 h-20 rounded-3xl bg-gradient-to-br from-orange-500/20 to-amber-500/10 border border-orange-500/30 flex items-center justify-center text-orange-400 text-3xl shadow-inner">
                        <i class="fa-solid fa-envelope-circle-check"></i>
                    </div>
                    <span class="absolute -bottom-1 -right-1 flex h-4 w-4">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-4 w-4 bg-emerald-500 border-2 border-slate-900"></span>
                    </span>
                </div>
            </div>

            <!-- Title & Destination Email -->
            <div class="text-center mb-8">
                <h1 class="text-2xl sm:text-3xl font-black text-white tracking-tight">
                    Enter Verification Code
                </h1>
                <p class="text-sm text-slate-400 mt-2">
                    A secure 6-digit one-time password was sent to:
                </p>
                <div class="inline-flex items-center gap-2 mt-2 px-4 py-1.5 rounded-full bg-slate-800/90 border border-slate-700 text-orange-400 font-bold text-xs tracking-wide">
                    <i class="fa-solid fa-envelope text-[11px]"></i>
                    <span>{{ $maskedEmail }}</span>
                </div>
                <p class="text-[11px] text-slate-500 mt-2">
                    Please check your <strong>Inbox</strong> (or <strong>Spam/Promotions</strong> folder).
                </p>
            </div>

            <!-- Flash Alerts -->
            @if(session('success'))
                <div class="mb-6 p-4 rounded-2xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-300 text-xs flex items-center gap-3">
                    <i class="fa-solid fa-circle-check text-emerald-400 text-lg shrink-0"></i>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            @endif

            @if(session('info'))
                <div class="mb-6 p-4 rounded-2xl bg-gradient-to-r from-blue-500/15 via-indigo-500/15 to-purple-500/15 border border-blue-500/30 text-blue-200 text-xs space-y-2">
                    <div class="flex items-center gap-2.5">
                        <i class="fa-solid fa-circle-info text-blue-400 text-base shrink-0"></i>
                        <span class="font-bold">{{ session('info') }}</span>
                    </div>
                    @php
                        preg_match('/\b\d{6}\b/', session('info'), $matches);
                        $foundOtp = $matches[0] ?? null;
                    @endphp
                    @if($foundOtp)
                        <div class="pt-1 flex items-center gap-2">
                            <button type="button" onclick="quickFillOtp('{{ $foundOtp }}')" class="px-3 py-1.5 rounded-xl bg-gradient-to-r from-orange-500 to-amber-500 text-white font-black text-xs shadow-md hover:scale-105 transition flex items-center gap-1.5">
                                <i class="fa-solid fa-wand-magic-sparkles"></i>
                                <span>1-Tap Auto-Fill Code ({{ $foundOtp }})</span>
                            </button>
                        </div>
                    @endif
                </div>
            @endif

            @if(isset($errors) && $errors->any())
                <div class="mb-6 p-4 rounded-2xl bg-red-500/10 border border-red-500/30 text-red-300 text-xs flex items-center gap-3">
                    <i class="fa-solid fa-triangle-exclamation text-red-400 text-lg shrink-0"></i>
                    <span class="font-medium">{{ $errors->first() }}</span>
                </div>
            @endif

            <!-- 6-Box OTP Form -->
            <form method="POST" action="{{ route('otp.verify.submit') }}" id="otpForm" class="space-y-6">
                @csrf
                <input type="hidden" name="otp_code" id="fullOtpCode">

                <div>
                    <label class="block text-center text-xs font-bold uppercase tracking-widest text-slate-400 mb-4">
                        6-Digit Security Code
                    </label>
                    
                    <div class="flex items-center justify-center gap-2 sm:gap-3" id="otpBoxContainer">
                        <input type="text" maxlength="1" inputmode="numeric" pattern="[0-9]*" class="otp-box w-11 h-14 sm:w-14 sm:h-16 text-center text-2xl sm:text-3xl font-mono font-black rounded-2xl bg-slate-800/90 border border-slate-700 text-white focus:outline-none transition-all duration-200" autofocus>
                        <input type="text" maxlength="1" inputmode="numeric" pattern="[0-9]*" class="otp-box w-11 h-14 sm:w-14 sm:h-16 text-center text-2xl sm:text-3xl font-mono font-black rounded-2xl bg-slate-800/90 border border-slate-700 text-white focus:outline-none transition-all duration-200">
                        <input type="text" maxlength="1" inputmode="numeric" pattern="[0-9]*" class="otp-box w-11 h-14 sm:w-14 sm:h-16 text-center text-2xl sm:text-3xl font-mono font-black rounded-2xl bg-slate-800/90 border border-slate-700 text-white focus:outline-none transition-all duration-200">
                        <input type="text" maxlength="1" inputmode="numeric" pattern="[0-9]*" class="otp-box w-11 h-14 sm:w-14 sm:h-16 text-center text-2xl sm:text-3xl font-mono font-black rounded-2xl bg-slate-800/90 border border-slate-700 text-white focus:outline-none transition-all duration-200">
                        <input type="text" maxlength="1" inputmode="numeric" pattern="[0-9]*" class="otp-box w-11 h-14 sm:w-14 sm:h-16 text-center text-2xl sm:text-3xl font-mono font-black rounded-2xl bg-slate-800/90 border border-slate-700 text-white focus:outline-none transition-all duration-200">
                        <input type="text" maxlength="1" inputmode="numeric" pattern="[0-9]*" class="otp-box w-11 h-14 sm:w-14 sm:h-16 text-center text-2xl sm:text-3xl font-mono font-black rounded-2xl bg-slate-800/90 border border-slate-700 text-white focus:outline-none transition-all duration-200">
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" id="submitBtn" class="w-full py-4 px-6 rounded-2xl bg-gradient-to-r from-orange-500 via-amber-500 to-orange-600 hover:from-orange-600 hover:to-amber-600 text-white font-black text-base shadow-lg shadow-orange-500/30 hover:shadow-orange-500/50 hover:scale-[1.02] active:scale-[0.98] transition-all duration-200 flex items-center justify-center gap-2">
                    <span>Verify & Continue</span>
                    <i class="fa-solid fa-arrow-right text-sm"></i>
                </button>
            </form>

            <!-- Resend Countdown & Action -->
            <div class="mt-8 pt-6 border-t border-slate-800 text-center">
                <div id="countdownContainer" class="flex flex-col items-center justify-center gap-1.5 text-xs text-slate-400 mb-3">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-slate-800/80 border border-slate-700/80">
                        <i class="fa-solid fa-stopwatch text-orange-400 text-xs animate-pulse"></i>
                        <span>Resend code available in:</span>
                        <span id="timer" class="font-mono font-extrabold text-orange-400 text-sm">02:00</span>
                    </div>
                    <span class="text-[11px] text-slate-500">Please check your spam/promotions folder if not in inbox</span>
                </div>

                <form method="POST" action="{{ route('otp.resend') }}" id="resendForm" class="hidden">
                    @csrf
                    <button type="submit" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-slate-800 hover:bg-slate-700 border border-orange-500/40 text-sm font-bold text-orange-400 hover:text-orange-300 transition duration-200 shadow-md">
                        <i class="fa-solid fa-rotate-right"></i>
                        <span>Resend 6-Digit Code</span>
                    </button>
                </form>

                <div class="mt-5 flex flex-wrap items-center justify-center gap-4 text-xs">
                    <a href="{{ route('login') }}" class="text-slate-500 hover:text-slate-300 transition inline-flex items-center gap-1.5 py-1">
                        <i class="fa-solid fa-arrow-left text-[10px]"></i>
                        <span>Back to Login</span>
                    </a>
                    <span class="text-slate-700">&bull;</span>
                    <a href="{{ route('public.mail.test') }}" target="_blank" class="text-orange-400 hover:text-orange-300 transition inline-flex items-center gap-1.5 py-1 font-bold">
                        <i class="fa-solid fa-gear text-[10px]"></i>
                        <span>Gmail SMTP Tester</span>
                    </a>
                </div>
            </div>

        </div>

        <!-- Security Trust Footnote -->
        <div class="mt-6 flex flex-wrap items-center justify-center gap-3 sm:gap-4 text-xs text-slate-500 font-semibold text-center">
            <span class="flex items-center gap-1.5"><i class="fa-solid fa-shield-halved text-emerald-500"></i> 256-Bit SSL Encryption</span>
            <span class="hidden sm:inline">•</span>
            <span class="flex items-center gap-1.5"><i class="fa-solid fa-clock text-amber-500"></i> 2-Minute Resend Window</span>
        </div>

    </div>

    <!-- OTP Input JavaScript -->
    <script>
        const boxes = document.querySelectorAll('.otp-box');
        const fullOtpInput = document.getElementById('fullOtpCode');
        const otpForm = document.getElementById('otpForm');

        function updateFullOtp() {
            let code = '';
            boxes.forEach(box => code += box.value);
            fullOtpInput.value = code;
            return code;
        }

        boxes.forEach((box, index) => {
            box.addEventListener('input', (e) => {
                const val = e.target.value;
                if (!/^[0-9]$/.test(val)) {
                    e.target.value = '';
                    return;
                }
                if (index < boxes.length - 1) {
                    boxes[index + 1].focus();
                }
                const code = updateFullOtp();
                if (code.length === 6) {
                    otpForm.submit();
                }
            });

            box.addEventListener('keydown', (e) => {
                if (e.key === 'Backspace' && !box.value && index > 0) {
                    boxes[index - 1].focus();
                }
            });

            box.addEventListener('paste', (e) => {
                e.preventDefault();
                const pasteData = (e.clipboardData || window.clipboardData).getData('text').trim();
                if (/^\d{6}$/.test(pasteData)) {
                    const digits = pasteData.split('');
                    boxes.forEach((b, i) => {
                        b.value = digits[i] || '';
                    });
                    updateFullOtp();
                    otpForm.submit();
                }
            });
        });

        function quickFillOtp(code) {
            if (!code || code.length !== 6) return;
            const digits = code.split('');
            boxes.forEach((b, i) => {
                b.value = digits[i] || '';
            });
            updateFullOtp();
            setTimeout(() => {
                otpForm.submit();
            }, 300);
        }

        otpForm.addEventListener('submit', (e) => {
            const code = updateFullOtp();
            if (code.length !== 6) {
                e.preventDefault();
                alert('Please enter all 6 digits of the OTP code.');
            }
        });

        // 2-Minute (120 Seconds) Countdown Timer
        let totalSeconds = 120;
        const timerEl = document.getElementById('timer');
        const countdownContainer = document.getElementById('countdownContainer');
        const resendForm = document.getElementById('resendForm');

        function formatTime(sec) {
            const m = Math.floor(sec / 60).toString().padStart(2, '0');
            const s = (sec % 60).toString().padStart(2, '0');
            return `${m}:${s}`;
        }

        if (timerEl) {
            timerEl.textContent = formatTime(totalSeconds);
        }

        const interval = setInterval(() => {
            totalSeconds--;
            if (timerEl) {
                timerEl.textContent = formatTime(totalSeconds);
            }
            if (totalSeconds <= 0) {
                clearInterval(interval);
                if (countdownContainer) countdownContainer.classList.add('hidden');
                if (resendForm) resendForm.classList.remove('hidden');
            }
        }, 1000);
    </script>
</body>
</html>
