<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gmail SMTP Live Inbox Tester - {{ config('app.name', 'BazaarPK') }}</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="min-h-screen bg-slate-950 text-slate-100 flex items-center justify-center p-4">

    <div class="w-full max-w-2xl bg-slate-900/90 backdrop-blur-2xl border border-slate-800 rounded-3xl p-6 sm:p-10 shadow-2xl space-y-6">
        
        <!-- Header -->
        <div class="flex items-center justify-between border-b border-slate-800 pb-5">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 rounded-2xl bg-gradient-to-tr from-rose-500 to-amber-500 text-white flex items-center justify-center text-xl shadow-lg shadow-rose-500/30">
                    <i class="fa-solid fa-envelope-circle-check"></i>
                </div>
                <div>
                    <h1 class="text-xl sm:text-2xl font-black text-white">Gmail SMTP Inbox Tester</h1>
                    <p class="text-xs text-slate-400">1-Click Live Email &amp; OTP Delivery Diagnostics</p>
                </div>
            </div>
            <a href="{{ route('home') }}" class="text-xs text-slate-400 hover:text-white px-3 py-1.5 rounded-xl bg-slate-800 border border-slate-700">
                Back to Site
            </a>
        </div>

        <!-- Flash Messages -->
        @if(session('success'))
            <div class="p-4 rounded-2xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-300 text-xs sm:text-sm flex items-start gap-3">
                <i class="fa-solid fa-circle-check text-emerald-400 text-xl shrink-0 mt-0.5"></i>
                <div class="space-y-1">
                    <strong class="font-bold block">Delivery Successful!</strong>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="p-4 rounded-2xl bg-red-500/10 border border-red-500/30 text-red-300 text-xs sm:text-sm flex items-start gap-3">
                <i class="fa-solid fa-triangle-exclamation text-red-400 text-xl shrink-0 mt-0.5"></i>
                <div class="space-y-1">
                    <strong class="font-bold block">SMTP Error Detected:</strong>
                    <span>{{ session('error') }}</span>
                </div>
            </div>
        @endif

        <!-- Current Configuration Matrix -->
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 bg-slate-950/70 p-4 rounded-2xl border border-slate-800 text-xs">
            <div>
                <span class="text-[10px] uppercase font-bold text-slate-500 block">Mailer</span>
                <span class="font-mono font-bold text-amber-400">{{ config('mail.default') }}</span>
            </div>
            <div>
                <span class="text-[10px] uppercase font-bold text-slate-500 block">Host &amp; Port</span>
                <span class="font-mono font-bold text-slate-200">{{ config('mail.mailers.smtp.host') }}:{{ config('mail.mailers.smtp.port') }}</span>
            </div>
            <div>
                <span class="text-[10px] uppercase font-bold text-slate-500 block">Sender User</span>
                <span class="font-mono font-bold text-slate-200 truncate block">{{ config('mail.mailers.smtp.username') }}</span>
            </div>
            <div>
                <span class="text-[10px] uppercase font-bold text-slate-500 block">Encryption</span>
                <span class="font-mono font-bold text-emerald-400 uppercase">{{ config('mail.mailers.smtp.encryption') ?: 'none' }}</span>
            </div>
        </div>

        <!-- Google 2-Step Instructions Banner -->
        <div class="bg-amber-500/10 border border-amber-500/20 rounded-2xl p-4 text-xs text-amber-200 space-y-1.5">
            <div class="font-black flex items-center gap-1.5 text-amber-300 text-sm">
                <i class="fa-brands fa-google"></i> How to get your 16-character Google App Password:
            </div>
            <ol class="list-decimal list-inside space-y-1 text-slate-300 ml-1">
                <li>Go to <a href="https://myaccount.google.com/apppasswords" target="_blank" class="text-amber-400 underline font-bold">Google App Passwords</a> (ensure 2-Step Verification is ON).</li>
                <li>Type App Name: <strong>BazaarPK</strong> and click <strong>Create</strong>.</li>
                <li>Copy the 16 letters generated (e.g. <code class="bg-slate-800 px-1 py-0.5 rounded text-amber-300">abcd efgh ijkl mnop</code>) and paste below.</li>
            </ol>
        </div>

        <!-- Test Form -->
        <form method="POST" action="{{ route('mail.test.send') }}" class="space-y-4">
            @csrf

            <div>
                <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-1.5">
                    Destination Gmail / Email Address (Where to send test OTP):
                </label>
                <input 
                    type="email" 
                    name="email" 
                    value="{{ old('email', 'shanishanshani06@gmail.com') }}" 
                    required 
                    placeholder="e.g. shanishanshani06@gmail.com"
                    class="w-full px-4 py-3 rounded-xl bg-slate-800/90 border border-slate-700 text-white text-sm focus:outline-none focus:border-rose-500"
                >
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-1.5">
                    Fresh 16-Character Google App Password:
                </label>
                <input 
                    type="password" 
                    name="app_password" 
                    placeholder="Paste your 16-character code here..."
                    class="w-full px-4 py-3 rounded-xl bg-slate-800/90 border border-slate-700 text-white text-sm focus:outline-none focus:border-rose-500 font-mono"
                >
                <span class="text-[11px] text-slate-400 mt-1 block">Leave empty to test with the current password saved in .env</span>
            </div>

            <div class="flex items-center gap-2 pt-1">
                <input type="checkbox" name="save_to_env" id="save_to_env" value="1" checked class="rounded bg-slate-800 border-slate-700 text-rose-500 focus:ring-0">
                <label for="save_to_env" class="text-xs font-medium text-slate-300 cursor-pointer">
                    Automatically save this App Password to <code class="text-amber-400">.env</code> when testing
                </label>
            </div>

            <button type="submit" class="w-full py-3.5 px-6 rounded-2xl bg-gradient-to-r from-rose-500 via-amber-500 to-rose-600 hover:from-rose-600 hover:to-amber-600 text-white font-black text-sm shadow-lg shadow-rose-500/30 transition flex items-center justify-center gap-2">
                <i class="fa-solid fa-paper-plane"></i>
                <span>Send Live Verification OTP to Inbox</span>
            </button>
        </form>

    </div>

</body>
</html>
