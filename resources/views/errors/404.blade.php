<x-app-layout>
    <div class="min-h-[70vh] flex items-center justify-center py-16 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
        <!-- Ambient Glowing Background Accents -->
        <div class="absolute top-1/4 left-1/2 -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-orange-500/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-10 right-10 w-72 h-72 bg-blue-500/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-xl w-full text-center relative z-10" data-aos="zoom-in">
            <!-- 3D 404 Badge -->
            <div class="inline-flex items-center justify-center mb-6">
                <div class="relative">
                    <div class="text-8xl sm:text-9xl font-black tracking-tighter text-transparent bg-clip-text bg-gradient-to-r from-orange-500 via-amber-500 to-red-500 select-none animate-pulse">
                        404
                    </div>
                    <div class="absolute -bottom-2 left-1/2 -translate-x-1/2 bg-slate-900 text-white text-[11px] font-mono font-bold uppercase tracking-widest px-4 py-1 rounded-full shadow-lg border border-slate-700 whitespace-nowrap">
                        Page Not Found
                    </div>
                </div>
            </div>

            <!-- Error Heading & Friendly Explanation -->
            <h1 class="text-2xl sm:text-3xl font-black text-slate-900 mb-3">
                Oops! Yeh Page Dastyab Nahi Hai
            </h1>
            <p class="text-sm sm:text-base text-slate-600 mb-8 max-w-md mx-auto leading-relaxed">
                Aap jis page ya product ko dhoond rahay hain wo remove ho chuka hai ya is ka link tabdeel ho gaya hai.
            </p>

            <!-- Quick Product Search Box -->
            <div class="mb-8 max-w-md mx-auto">
                <form action="{{ route('shop') }}" method="GET" class="relative flex items-center shadow-lg rounded-2xl overflow-hidden border border-slate-200 bg-white focus-within:border-orange-500 focus-within:ring-2 focus-within:ring-orange-500/20 transition">
                    <input type="text" name="search" placeholder="Koi bhi product search karein..." class="w-full pl-5 pr-14 py-3.5 text-sm bg-transparent border-none outline-none focus:ring-0 text-slate-800 placeholder-slate-400">
                    <button type="submit" class="absolute right-1.5 top-1.5 bottom-1.5 px-4 bg-orange-500 hover:bg-orange-600 text-white rounded-xl text-sm font-bold flex items-center justify-center transition">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </form>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-wrap items-center justify-center gap-3">
                <a href="{{ url('/') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-orange-500 to-amber-500 hover:from-orange-600 hover:to-amber-600 text-white font-extrabold text-sm px-6 py-3.5 rounded-2xl shadow-lg shadow-orange-500/30 transition transform hover:-translate-y-0.5 active:scale-95">
                    <i class="fa-solid fa-house"></i>
                    <span>Home Page Par Jayen</span>
                </a>
                <a href="{{ route('shop') }}" class="inline-flex items-center gap-2 bg-white hover:bg-slate-100 text-slate-800 font-bold text-sm px-6 py-3.5 rounded-2xl border border-slate-200 shadow-sm transition transform hover:-translate-y-0.5 active:scale-95">
                    <i class="fa-solid fa-store text-orange-500"></i>
                    <span>Shop Explore Karein</span>
                </a>
                <a href="{{ route('cart') }}" class="inline-flex items-center gap-2 bg-white hover:bg-slate-100 text-slate-800 font-bold text-sm px-6 py-3.5 rounded-2xl border border-slate-200 shadow-sm transition transform hover:-translate-y-0.5 active:scale-95">
                    <i class="fa-solid fa-cart-shopping text-emerald-500"></i>
                    <span>Cart Dekhein</span>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
