<x-app-layout>
    <div class="min-h-[70vh] flex items-center justify-center py-16 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
        <!-- Ambient Glowing Background Accents -->
        <div class="absolute top-1/4 left-1/2 -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-red-500/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-10 right-10 w-72 h-72 bg-amber-500/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-xl w-full text-center relative z-10" data-aos="zoom-in">
            <!-- 3D 500 Badge -->
            <div class="inline-flex items-center justify-center mb-6">
                <div class="relative">
                    <div class="text-8xl sm:text-9xl font-black tracking-tighter text-transparent bg-clip-text bg-gradient-to-r from-red-500 via-orange-500 to-amber-500 select-none">
                        500
                    </div>
                    <div class="absolute -bottom-2 left-1/2 -translate-x-1/2 bg-slate-900 text-white text-[11px] font-mono font-bold uppercase tracking-widest px-4 py-1 rounded-full shadow-lg border border-slate-700 whitespace-nowrap">
                        System Maintenance
                    </div>
                </div>
            </div>

            <!-- Error Heading & Friendly Explanation -->
            <h1 class="text-2xl sm:text-3xl font-black text-slate-900 mb-3">
                Kuch Technical Masla Aaya Hai
            </h1>
            <p class="text-sm sm:text-base text-slate-600 mb-8 max-w-md mx-auto leading-relaxed">
                Hamara server is waqt request process nahi kar saka. Hamari technical team ko notify kar diya gaya hai. Baraye meherbani page ko refresh karein ya thori der baad koshish karein.
            </p>

            <!-- Action Buttons -->
            <div class="flex flex-wrap items-center justify-center gap-3">
                <button onclick="window.location.reload()" class="inline-flex items-center gap-2 bg-gradient-to-r from-orange-500 to-amber-500 hover:from-orange-600 hover:to-amber-600 text-white font-extrabold text-sm px-6 py-3.5 rounded-2xl shadow-lg shadow-orange-500/30 transition transform hover:-translate-y-0.5 active:scale-95 cursor-pointer">
                    <i class="fa-solid fa-rotate-right"></i>
                    <span>Page Refresh Karein</span>
                </button>
                <a href="{{ url('/') }}" class="inline-flex items-center gap-2 bg-white hover:bg-slate-100 text-slate-800 font-bold text-sm px-6 py-3.5 rounded-2xl border border-slate-200 shadow-sm transition transform hover:-translate-y-0.5 active:scale-95">
                    <i class="fa-solid fa-house text-orange-500"></i>
                    <span>Home Page</span>
                </a>
                <a href="https://wa.me/923001234567" target="_blank" class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-sm px-6 py-3.5 rounded-2xl shadow-md transition transform hover:-translate-y-0.5 active:scale-95">
                    <i class="fa-brands fa-whatsapp text-lg"></i>
                    <span>WhatsApp Support</span>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
