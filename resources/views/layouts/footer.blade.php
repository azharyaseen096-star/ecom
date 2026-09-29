<footer class="bg-slate-950 text-slate-400 mt-auto border-t border-slate-800">
    <!-- Value Propositions Section -->
    <div class="border-b border-slate-800/80 py-8 sm:py-10 bg-slate-900/60">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-3 sm:gap-6">
                
                <div data-tilt data-tilt-max="8" class="flex items-center gap-3 sm:gap-4 p-3.5 sm:p-4 rounded-2xl bg-slate-900/90 border border-slate-800 shadow-sm hover:border-rose-500/50 transition">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-2xl bg-gradient-to-tr from-rose-500 to-amber-500 text-white flex items-center justify-center text-lg sm:text-xl shrink-0 shadow-md shadow-rose-500/20">
                        <i class="fa-solid fa-plane-departure"></i>
                    </div>
                    <div>
                        <h4 class="text-white font-extrabold text-xs sm:text-sm">Worldwide Express</h4>
                        <p class="text-[10px] sm:text-xs text-slate-400 mt-0.5">3-7 days worldwide</p>
                    </div>
                </div>

                <div data-tilt data-tilt-max="8" class="flex items-center gap-3 sm:gap-4 p-3.5 sm:p-4 rounded-2xl bg-slate-900/90 border border-slate-800 shadow-sm hover:border-emerald-500/50 transition">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-2xl bg-gradient-to-tr from-emerald-500 to-teal-500 text-white flex items-center justify-center text-lg sm:text-xl shrink-0 shadow-md shadow-emerald-500/20">
                        <i class="fa-solid fa-certificate"></i>
                    </div>
                    <div>
                        <h4 class="text-white font-extrabold text-xs sm:text-sm">100% Organic</h4>
                        <p class="text-[10px] sm:text-xs text-slate-400 mt-0.5">Hypoallergenic cotton</p>
                    </div>
                </div>

                <div data-tilt data-tilt-max="8" class="flex items-center gap-3 sm:gap-4 p-3.5 sm:p-4 rounded-2xl bg-slate-900/90 border border-slate-800 shadow-sm hover:border-amber-500/50 transition">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-2xl bg-gradient-to-tr from-amber-400 to-yellow-500 text-black flex items-center justify-center text-lg sm:text-xl shrink-0 shadow-md shadow-amber-500/20">
                        <i class="fa-solid fa-bolt"></i>
                    </div>
                    <div>
                        <h4 class="text-white font-extrabold text-xs sm:text-sm">Western Union QR</h4>
                        <p class="text-[10px] sm:text-xs text-slate-400 mt-0.5">Global Money Transfer</p>
                    </div>
                </div>

                <div data-tilt data-tilt-max="8" class="flex items-center gap-3 sm:gap-4 p-3.5 sm:p-4 rounded-2xl bg-slate-900/90 border border-slate-800 shadow-sm hover:border-blue-500/50 transition">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-2xl bg-gradient-to-tr from-blue-500 to-indigo-500 text-white flex items-center justify-center text-lg sm:text-xl shrink-0 shadow-md shadow-blue-500/20">
                        <i class="fa-solid fa-headset"></i>
                    </div>
                    <div>
                        <h4 class="text-white font-extrabold text-xs sm:text-sm">24/7 Global Care</h4>
                        <p class="text-[10px] sm:text-xs text-slate-400 mt-0.5">WhatsApp / Live Help</p>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Main Footer Links -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-12 pb-24 sm:pb-12">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            
            <!-- Brand Info -->
            <div class="space-y-4">
                <div class="flex items-center gap-2">
                    <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-rose-500 to-amber-500 flex items-center justify-center text-white text-lg shadow-md">
                        <i class="fa-solid fa-child-reaching"></i>
                    </div>
                    <span class="text-2xl font-black text-white">Tiny<span class="text-rose-500">Champs</span></span>
                </div>
                <p class="text-sm text-gray-400 leading-relaxed">
                    International boutique for premium baby, infant, and toddler tracksuits. Crafted with organic cotton, cozy fleece, and luxury velvet designed for joyful adventures.
                </p>
                <div class="flex gap-3 text-gray-400">
                    <a href="#" class="w-8 h-8 rounded-full bg-gray-800 hover:bg-rose-600 hover:text-white flex items-center justify-center transition"><i class="fa-brands fa-facebook-f text-xs"></i></a>
                    <a href="#" class="w-8 h-8 rounded-full bg-gray-800 hover:bg-rose-600 hover:text-white flex items-center justify-center transition"><i class="fa-brands fa-instagram text-xs"></i></a>
                    <a href="#" class="w-8 h-8 rounded-full bg-gray-800 hover:bg-rose-600 hover:text-white flex items-center justify-center transition"><i class="fa-brands fa-whatsapp text-xs"></i></a>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h3 class="text-white font-bold text-sm mb-4 uppercase tracking-wider">Quick Navigation</h3>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('home') }}" class="hover:text-rose-400 transition">Home Page</a></li>
                    <li><a href="{{ route('shop') }}" class="hover:text-rose-400 transition">Baby Tracksuits Catalog</a></li>
                    <li><a href="{{ route('cart') }}" class="hover:text-rose-400 transition">Shopping Bag</a></li>
                    @auth
                        <li><a href="{{ route('orders.index') }}" class="hover:text-rose-400 transition">Track My Orders</a></li>
                    @endauth
                </ul>
            </div>

            <!-- Categories -->
            <div>
                <h3 class="text-white font-bold text-sm mb-4 uppercase tracking-wider">Popular Collections</h3>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('shop', ['category' => 'baby-boy-tracksuits']) }}" class="hover:text-rose-400 transition">Baby Boy Tracksuits</a></li>
                    <li><a href="{{ route('shop', ['category' => 'baby-girl-tracksuits']) }}" class="hover:text-rose-400 transition">Baby Girl Tracksuits</a></li>
                    <li><a href="{{ route('shop', ['category' => 'toddler-fleece-velvet']) }}" class="hover:text-rose-400 transition">Toddler Fleece &amp; Velvet</a></li>
                    <li><a href="{{ route('shop', ['category' => 'organic-cotton-suits']) }}" class="hover:text-rose-400 transition">Organic Cotton Sets</a></li>
                    <li><a href="{{ route('shop', ['category' => 'newborn-romper-tracksuits']) }}" class="hover:text-rose-400 transition">Newborn Rompers</a></li>
                </ul>
            </div>

            <!-- Payment & Contact -->
            <div class="space-y-4">
                <h3 class="text-white font-bold text-sm uppercase tracking-wider">Accepted Worldwide</h3>
                <div class="flex flex-wrap gap-2 text-xs">
                    <span class="bg-[#ffdd00] text-black font-black px-3 py-1.5 rounded-xl flex items-center gap-1.5 shadow-sm">
                        <i class="fa-solid fa-bolt"></i> Western Union
                    </span>
                    <span class="bg-slate-800 text-slate-200 font-bold px-3 py-1.5 rounded-xl border border-slate-700">
                        <i class="fa-solid fa-building-columns mr-1"></i> Bank Wire
                    </span>
                    <span class="bg-slate-800 text-slate-200 font-bold px-3 py-1.5 rounded-xl border border-slate-700">
                        <i class="fa-solid fa-credit-card mr-1"></i> Cards
                    </span>
                </div>
                <div class="pt-2">
                    <p class="text-xs text-slate-400 flex items-center gap-2">
                        <i class="fa-solid fa-envelope text-rose-500"></i> support@tinychamps.com
                    </p>
                    <p class="text-xs text-slate-400 flex items-center gap-2 mt-1">
                        <i class="fa-solid fa-phone text-rose-500"></i> +1 (800) 555-0199
                    </p>
                </div>
            </div>

        </div>

        <div class="border-t border-slate-800/80 mt-10 pt-6 text-center text-xs text-slate-500">
            <p>&copy; {{ date('Y') }} TinyChamps KidsWear International. All Rights Reserved. Delivered Worldwide with 100% Quality Guarantee.</p>
        </div>
    </div>
</footer>