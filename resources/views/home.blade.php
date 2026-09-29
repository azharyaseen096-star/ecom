<x-app-layout>

    <!-- 1. Interactive 3D WebGL Hero Stage -->
    <div class="relative bg-gradient-to-br from-slate-950 via-slate-900 to-rose-950 text-white overflow-hidden min-h-[520px] sm:min-h-[640px] flex items-center">
        <!-- Interactive Three.js WebGL Canvas -->
        <canvas id="hero-3d-canvas" class="absolute inset-0 w-full h-full pointer-events-none z-0"></canvas>

        <!-- Ambient Glowing Background Spheres -->
        <div class="absolute -top-24 -left-24 w-72 sm:w-96 h-72 sm:h-96 bg-rose-600/20 rounded-full blur-[100px] sm:blur-[120px] pointer-events-none animate-pulse-glow"></div>
        <div class="absolute top-1/2 -right-24 w-80 sm:w-[500px] h-80 sm:h-[500px] bg-amber-500/15 rounded-full blur-[100px] sm:blur-[140px] pointer-events-none"></div>
        <div class="absolute bottom-0 left-1/3 w-60 sm:w-80 h-60 sm:h-80 bg-rose-500/15 rounded-full blur-[80px] pointer-events-none"></div>

        <!-- Geometric Grid Pattern Overlay -->
        <div class="absolute inset-0 opacity-[0.06] bg-[radial-gradient(#ffffff_1px,transparent_1px)] [background-size:24px_24px] pointer-events-none"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-20 lg:py-24 relative z-10 w-full">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
                
                <!-- Hero Left Column: Headline & Action -->
                <div class="lg:col-span-7 space-y-4 sm:space-y-6 text-center lg:text-left" data-aos="fade-right">
                    <div class="inline-flex items-center gap-2 bg-gradient-to-r from-rose-500/20 to-amber-500/10 border border-rose-500/30 text-rose-400 px-3.5 py-1.5 sm:px-4 sm:py-2 rounded-full text-[11px] sm:text-xs font-black uppercase tracking-wider backdrop-blur-md shadow-lg shadow-rose-500/10 animate-float">
                        <span class="flex h-2 w-2 relative">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-rose-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-rose-500"></span>
                        </span>
                        <i class="fa-solid fa-sparkles text-amber-400 ml-1"></i> TinyChamps &bull; Global Babywear
                    </div>
                    
                    <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.15]">
                        Cute, Cozy &amp; Active <br class="hidden sm:inline"/>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-rose-400 via-amber-300 to-yellow-200">
                            Baby &amp; Toddler Tracksuits
                        </span>
                    </h1>
                    
                    <p class="text-xs sm:text-base lg:text-lg text-slate-300 max-w-2xl leading-relaxed mx-auto lg:mx-0 font-normal">
                        Crafted from 100% GOTS-certified organic cotton, plush velvet, and ultra-soft fleece. Worldwide express shipping with instant <strong>Western Union Dynamic QR Pay</strong>.
                    </p>

                    <!-- CTA Action Buttons -->
                    <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-center lg:justify-start gap-3 sm:gap-4 pt-2">
                        <a href="{{ route('shop') }}" class="group bg-gradient-to-r from-rose-500 via-amber-500 to-rose-600 hover:from-rose-600 hover:to-amber-600 text-white font-extrabold px-6 sm:px-8 py-3.5 sm:py-4 rounded-2xl shadow-xl shadow-rose-500/30 hover:shadow-rose-500/50 transition-all duration-300 flex items-center justify-center gap-3 touch-press">
                            <i class="fa-solid fa-shirt"></i>
                            <span>Explore Tracksuits</span>
                            <i class="fa-solid fa-arrow-right text-sm group-hover:translate-x-1.5 transition duration-200"></i>
                        </a>
                        <a href="#product-ads-banner" class="bg-slate-800/80 hover:bg-slate-800 text-slate-200 hover:text-white font-bold px-5 sm:px-6 py-3.5 sm:py-4 rounded-2xl border border-slate-700/80 backdrop-blur-md transition-all duration-200 flex items-center justify-center gap-2.5 touch-press">
                            <i class="fa-solid fa-fire text-amber-400 text-base sm:text-lg"></i>
                            <span>Special Deals Spotlight</span>
                        </a>
                    </div>

                    <!-- Payment Support Badges -->
                    <div class="pt-4 sm:pt-6 border-t border-slate-800/80 flex flex-wrap items-center justify-center lg:justify-start gap-2.5 sm:gap-4 text-xs text-slate-400">
                        <span class="font-bold text-slate-300 flex items-center gap-1.5 text-[11px] sm:text-xs">
                            <i class="fa-solid fa-globe text-rose-400"></i> Worldwide Pay:
                        </span>
                        <div class="flex flex-wrap items-center justify-center gap-1.5 sm:gap-2.5">
                            <span class="bg-[#ffdd00] text-black px-2.5 py-1 sm:px-3 sm:py-1.5 rounded-xl font-black flex items-center gap-1 text-[10px] sm:text-xs shadow-sm">
                                <i class="fa-solid fa-bolt text-xs"></i> Western Union QR
                            </span>
                            <span class="bg-blue-950/80 border border-blue-800/60 text-blue-200 px-2.5 py-1 sm:px-3 sm:py-1.5 rounded-xl font-bold flex items-center gap-1 text-[10px] sm:text-xs shadow-sm">
                                <i class="fa-solid fa-building-columns text-blue-400"></i> Bank Wire / Swift
                            </span>
                            <span class="bg-emerald-950/80 border border-emerald-800/60 text-emerald-200 px-2.5 py-1 sm:px-3 sm:py-1.5 rounded-xl font-bold flex items-center gap-1 text-[10px] sm:text-xs shadow-sm">
                                <i class="fa-solid fa-credit-card text-emerald-400"></i> Cards (USD $)
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Hero Right Column: Floating 3D Showcase Card with Depth Layering -->
                <div class="lg:col-span-5 relative" data-aos="fade-left">
                    <div class="card-3d-wrap max-w-md mx-auto">
                        <div 
                            data-tilt 
                            data-tilt-max="15" 
                            data-tilt-speed="400" 
                            data-tilt-glare="true" 
                            data-tilt-max-glare="0.3" 
                            class="card-3d relative bg-slate-900/90 backdrop-blur-2xl border border-slate-700/80 rounded-3xl p-4 sm:p-6 shadow-2xl space-y-3.5 sm:space-y-4 glow-neon-orange"
                        >
                            <!-- Glow Background Ambient -->
                            <div class="absolute -inset-1 bg-gradient-to-r from-rose-500 via-amber-500 to-yellow-500 rounded-3xl blur-xl opacity-30 -z-10"></div>

                            <!-- Header Badge -->
                            <div class="flex items-center justify-between">
                                <span class="bg-rose-500/20 border border-rose-500/30 text-rose-400 text-[10px] sm:text-[11px] font-black px-2.5 sm:px-3 py-1 rounded-xl uppercase tracking-wider flex items-center gap-1.5 shadow-xs">
                                    <i class="fa-solid fa-crown text-amber-300"></i> Star Baby Outfit &bull; 30% OFF
                                </span>
                                <span class="text-[10px] sm:text-xs text-amber-300 font-bold flex items-center gap-1 bg-amber-500/10 px-2 sm:px-2.5 py-1 rounded-lg border border-amber-500/20">
                                    <i class="fa-solid fa-star"></i> 5.0 Rating
                                </span>
                            </div>

                            <!-- Showcase Image with 3D Parallax Depth -->
                            <div class="relative rounded-2xl overflow-hidden bg-gradient-to-b from-slate-800 to-slate-900 h-56 sm:h-72 flex items-center justify-center p-2 group shadow-inner">
                                <img 
                                    src="{{ (isset($featuredProducts) && $featuredProducts->first() && $featuredProducts->first()->image_url) ? $featuredProducts->first()->image_url : asset('images/baby_tracksuit_hero.jpg') }}" 
                                    alt="Baby Tracksuit" 
                                    class="max-h-full max-w-full object-contain rounded-xl group-hover:scale-105 transition-all duration-500 drop-shadow-2xl"
                                >
                                <div class="absolute bottom-2.5 left-2.5 bg-slate-950/90 backdrop-blur-md px-2.5 py-1 rounded-xl border border-slate-700 text-[10px] sm:text-[11px] font-bold text-slate-200 shadow-md flex items-center gap-1">
                                    <i class="fa-solid fa-feather text-emerald-400"></i>
                                    <span>100% Combed Organic Cotton</span>
                                </div>
                            </div>
                            
                            <!-- Product Details -->
                            <div>
                                <h3 class="text-white font-extrabold text-base sm:text-lg tracking-tight line-clamp-1">
                                    {{ $featuredProducts->first()->name ?? 'Dino Champ 2-Piece Fleece Tracksuit Set' }}
                                </h3>
                                <p class="text-xs text-slate-400 mt-0.5 sm:mt-1 line-clamp-2">
                                    {{ $featuredProducts->first()->description ?? 'Ultra-soft cotton blend fleece to keep your little adventurer warm and cozy.' }}
                                </p>
                            </div>

                            <!-- Pricing & Instant Order Trigger -->
                            <div class="pt-2.5 sm:pt-3 border-t border-slate-800/80 flex items-center justify-between">
                                <div>
                                    @if(isset($featuredProducts) && $featuredProducts->first() && $featuredProducts->first()->original_price)
                                        <span class="block text-[10px] sm:text-xs line-through text-slate-500">${{ number_format($featuredProducts->first()->original_price, 2) }}</span>
                                        <span class="text-xl sm:text-2xl font-black text-transparent bg-clip-text bg-gradient-to-r from-rose-400 via-amber-300 to-yellow-200">${{ number_format($featuredProducts->first()->price, 2) }}</span>
                                    @else
                                        <span class="block text-[10px] sm:text-xs line-through text-slate-500">$50.00</span>
                                        <span class="text-xl sm:text-2xl font-black text-transparent bg-clip-text bg-gradient-to-r from-rose-400 via-amber-300 to-yellow-200">$35.00</span>
                                    @endif
                                </div>
                                <a href="{{ route('shop') }}" class="bg-gradient-to-r from-rose-500 to-amber-500 hover:from-rose-600 hover:to-amber-600 text-white font-extrabold px-4 sm:px-5 py-2 sm:py-2.5 rounded-xl shadow-lg shadow-rose-500/30 transition text-xs flex items-center gap-1.5 touch-press">
                                    <i class="fa-solid fa-cart-shopping"></i> Order Now
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- 2. Dynamic Product Ads Marquee Ticker -->
    @if(isset($latestProducts) && $latestProducts->count() > 0)
    <div class="bg-gradient-to-r from-rose-600 via-amber-600 to-rose-700 py-2.5 sm:py-3 overflow-hidden text-white font-black text-[11px] sm:text-xs uppercase tracking-wider relative shadow-inner">
        <div class="flex whitespace-nowrap animate-[marquee_25s_linear_infinite] items-center gap-6 sm:gap-8">
            @for($i = 0; $i < 3; $i++)
                @foreach($latestProducts as $prod)
                    <a href="{{ route('product.show', $prod->id) }}" class="inline-flex items-center gap-2 hover:underline touch-press">
                        <span class="bg-black/30 px-2 py-0.5 rounded-md text-[9px] sm:text-[10px] text-yellow-300 font-black">🧸 HOT SUIT</span>
                        <span class="truncate max-w-[160px] sm:max-w-none">{{ $prod->name }}</span>
                        <span class="text-yellow-200 font-extrabold">${{ number_format($prod->price, 2) }}</span>
                        <span class="text-rose-200">&bull;</span>
                    </a>
                @endforeach
            @endfor
        </div>
    </div>
    @endif

    <!-- 3. Dynamic Interactive Product Ads Banner / Featured Deals Carousel -->
    @if(isset($adProducts) && $adProducts->count() > 0)
    <section id="product-ads-banner" class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8 py-6 sm:py-10" 
        x-data="{ 
            currentSlide: 0, 
            totalSlides: {{ $adProducts->count() }}, 
            progress: 0, 
            timer: null, 
            progressTimer: null,
            duration: 4500,
            touchStartX: 0,
            touchEndX: 0,
            isPaused: false,
            startAutoPlay() {
                this.stopAutoPlay();
                this.progress = 0;
                let startTime = Date.now();
                
                this.progressTimer = setInterval(() => {
                    if (!this.isPaused) {
                        let elapsed = Date.now() - startTime;
                        this.progress = Math.min(100, (elapsed / this.duration) * 100);
                    } else {
                        startTime = Date.now() - ((this.progress / 100) * this.duration);
                    }
                }, 40);

                this.timer = setInterval(() => {
                    if (!this.isPaused) {
                        this.nextSlide();
                    }
                }, this.duration);
            },
            stopAutoPlay() {
                if (this.timer) clearInterval(this.timer);
                if (this.progressTimer) clearInterval(this.progressTimer);
            },
            nextSlide() {
                this.currentSlide = (this.currentSlide + 1) % this.totalSlides;
                this.startAutoPlay();
            },
            prevSlide() {
                this.currentSlide = (this.currentSlide - 1 + this.totalSlides) % this.totalSlides;
                this.startAutoPlay();
            },
            goTo(index) {
                this.currentSlide = index;
                this.startAutoPlay();
            },
            handleTouchStart(e) {
                this.touchStartX = e.changedTouches[0].screenX;
                this.isPaused = true;
            },
            handleTouchEnd(e) {
                this.touchEndX = e.changedTouches[0].screenX;
                this.isPaused = false;
                if (this.touchStartX - this.touchEndX > 45) {
                    this.nextSlide();
                } else if (this.touchEndX - this.touchStartX > 45) {
                    this.prevSlide();
                }
            }
        }" 
        x-init="startAutoPlay()"
        @mouseenter="isPaused = true"
        @mouseleave="isPaused = false"
        @touchstart="handleTouchStart($event)"
        @touchend="handleTouchEnd($event)"
    >
        <div class="bg-gradient-to-br from-slate-900 via-slate-950 to-slate-900 border border-slate-800/90 rounded-3xl p-4 sm:p-8 shadow-2xl relative overflow-hidden backdrop-blur-xl" data-aos="fade-up">
            
            <!-- Live Glowing Progress Bar (Top) -->
            <div class="absolute top-0 left-0 right-0 h-1 sm:h-1.5 bg-slate-800/80 overflow-hidden z-30">
                <div class="h-full bg-gradient-to-r from-rose-500 via-amber-400 to-emerald-400 transition-all duration-75 shadow-sm shadow-rose-500/50" :style="'width: ' + progress + '%'"></div>
            </div>

            <!-- Background Ambient Glows -->
            <div class="absolute -top-24 -right-24 w-80 sm:w-96 h-80 sm:h-96 bg-rose-500/15 rounded-full blur-3xl pointer-events-none animate-pulse"></div>
            <div class="absolute -bottom-24 -left-24 w-80 sm:w-96 h-80 sm:h-96 bg-amber-500/15 rounded-full blur-3xl pointer-events-none"></div>

            <!-- Header & Carousel Controls -->
            <div class="flex items-center justify-between gap-2 mb-3 sm:mb-6 border-b border-slate-800/80 pb-3 relative z-20">
                <div class="flex items-center gap-2">
                    <span class="flex h-2.5 w-2.5 relative">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-rose-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-rose-500"></span>
                    </span>
                    <span class="bg-gradient-to-r from-rose-600 via-amber-600 to-yellow-600 text-white font-black text-[10px] sm:text-xs uppercase tracking-wider px-2.5 py-1 rounded-xl shadow-md flex items-center gap-1.5">
                        <i class="fa-solid fa-fire text-yellow-300 animate-bounce"></i>
                        <span>Featured Tracksuits Spotlight</span>
                    </span>
                </div>

                <!-- Slide Number & Navigation Pills -->
                <div class="flex items-center gap-1.5 sm:gap-2">
                    <button @click="prevSlide()" class="w-7 h-7 sm:w-8 sm:h-8 rounded-xl bg-slate-800/90 hover:bg-rose-600 text-slate-300 hover:text-white flex items-center justify-center transition shadow-sm touch-press cursor-pointer">
                        <i class="fa-solid fa-chevron-left text-xs"></i>
                    </button>
                    
                    <div class="flex items-center gap-1 px-1.5 py-1 bg-slate-800/60 rounded-full border border-slate-700/60">
                        @foreach($adProducts as $index => $ad)
                            <button @click="goTo({{ $index }})" :class="currentSlide === {{ $index }} ? 'w-5 sm:w-7 bg-rose-500 shadow-sm shadow-rose-500/50' : 'w-2 bg-slate-600 hover:bg-slate-500'" class="h-2 rounded-full transition-all duration-300 cursor-pointer"></button>
                        @endforeach
                    </div>

                    <button @click="nextSlide()" class="w-7 h-7 sm:w-8 sm:h-8 rounded-xl bg-slate-800/90 hover:bg-rose-600 text-slate-300 hover:text-white flex items-center justify-center transition shadow-sm touch-press cursor-pointer">
                        <i class="fa-solid fa-chevron-right text-xs"></i>
                    </button>
                </div>
            </div>

            <!-- Slides Container with Staggered Animations -->
            <div class="relative min-h-[360px] sm:min-h-[300px] flex items-center">
                @foreach($adProducts as $index => $product)
                    <div 
                        x-show="currentSlide === {{ $index }}" 
                        x-transition:enter="transition-all ease-out duration-500"
                        x-transition:enter-start="opacity-0 scale-95 translate-y-3"
                        x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                        x-transition:leave="transition-all ease-in duration-300 absolute inset-0"
                        x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                        x-transition:leave-end="opacity-0 scale-95 -translate-y-3"
                        class="w-full grid grid-cols-1 md:grid-cols-12 gap-4 sm:gap-8 items-center"
                    >
                        <!-- Ad Left Image Showcase -->
                        <div class="md:col-span-5 flex items-center justify-center">
                            <div class="relative w-full max-w-[280px] sm:max-w-xs h-48 sm:h-64 bg-gradient-to-b from-slate-800/90 to-slate-900/90 rounded-3xl p-3 sm:p-5 border border-slate-700/80 flex items-center justify-center group overflow-hidden shadow-2xl" data-tilt data-tilt-max="10">
                                
                                <!-- Glowing Border Ring -->
                                <div class="absolute inset-0 rounded-3xl border border-rose-500/20 group-hover:border-rose-500/50 transition duration-500 pointer-events-none"></div>

                                @if($product->discount_percentage > 0)
                                    <span class="absolute top-2.5 left-2.5 bg-gradient-to-r from-rose-600 to-pink-600 text-white text-[10px] sm:text-xs font-black px-2.5 py-1 rounded-xl shadow-lg z-10 flex items-center gap-1 animate-pulse">
                                        <i class="fa-solid fa-bolt text-yellow-300"></i>
                                        <span>-{{ $product->discount_percentage }}% OFF</span>
                                    </span>
                                @endif
                                
                                <span class="absolute top-2.5 right-2.5 bg-amber-500/20 text-amber-300 border border-amber-500/40 text-[9px] sm:text-[10px] font-black px-2 py-0.5 rounded-xl uppercase tracking-wider z-10">
                                    Suit {{ $index + 1 }}/{{ $adProducts->count() }}
                                </span>

                                <a href="{{ route('product.show', $product->id) }}" class="w-full h-full flex items-center justify-center p-2">
                                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="max-h-full max-w-full object-cover rounded-2xl group-hover:scale-105 transition-transform duration-500 drop-shadow-xl animate-[float_5s_ease-in-out_infinite]">
                                </a>

                                <div class="absolute bottom-2 left-2 right-2 bg-slate-950/80 backdrop-blur-md py-1 px-2 rounded-xl text-[10px] text-slate-300 flex items-center justify-between border border-slate-800">
                                    <span class="text-emerald-400 font-bold"><i class="fa-solid fa-feather mr-1"></i> Hypoallergenic</span>
                                    <span class="text-amber-400 font-bold"><i class="fa-solid fa-plane-departure mr-1"></i> Global Express</span>
                                </div>
                            </div>
                        </div>

                        <!-- Ad Right Details & Actions -->
                        <div class="md:col-span-7 space-y-2.5 sm:space-y-4 text-center md:text-left">
                            <div class="flex flex-wrap items-center justify-center md:justify-start gap-2">
                                <span class="bg-rose-500/20 text-rose-400 border border-rose-500/30 text-[10px] sm:text-xs font-extrabold px-2.5 py-1 rounded-xl uppercase tracking-wider">
                                    {{ $product->category->name ?? 'Baby Tracksuits' }}
                                </span>
                                <span class="text-[10px] sm:text-xs text-emerald-400 font-bold flex items-center gap-1 bg-emerald-500/10 px-2.5 py-1 rounded-xl border border-emerald-500/20">
                                    <i class="fa-solid fa-circle-check"></i> Sizes: 0-6M, 1-2Y, 3-4Y
                                </span>
                            </div>

                            <h3 class="text-lg sm:text-2xl lg:text-3xl font-black text-white tracking-tight leading-snug">
                                <a href="{{ route('product.show', $product->id) }}" class="hover:text-rose-400 transition">
                                    {{ $product->name }}
                                </a>
                            </h3>

                            <p class="text-xs sm:text-sm text-slate-300 line-clamp-2 max-w-xl mx-auto md:mx-0">
                                {{ $product->description }}
                            </p>

                            <!-- Price & Savings Row -->
                            <div class="pt-1 flex flex-wrap items-baseline justify-center md:justify-start gap-2 sm:gap-3">
                                <span class="text-2xl sm:text-3xl font-black text-transparent bg-clip-text bg-gradient-to-r from-rose-400 via-amber-300 to-yellow-200">
                                    ${{ number_format($product->price, 2) }}
                                </span>
                                @if($product->original_price && $product->original_price > $product->price)
                                    <span class="text-xs sm:text-sm line-through text-slate-500">${{ number_format($product->original_price, 2) }}</span>
                                    <span class="bg-emerald-500/20 text-emerald-400 border border-emerald-500/30 text-[10px] sm:text-xs font-extrabold px-2 py-0.5 rounded-lg">
                                        Save ${{ number_format($product->original_price - $product->price, 2) }}
                                    </span>
                                @endif
                            </div>

                            <!-- Responsive Action Buttons (Full width touch-friendly on Mobile) -->
                            <div class="pt-2 flex items-center gap-2.5 w-full sm:w-auto justify-center md:justify-start">
                                <form method="POST" action="{{ route('cart.add', $product->id) }}" class="flex-1 sm:flex-initial">
                                    @csrf
                                    <button type="submit" class="w-full bg-gradient-to-r from-rose-500 to-amber-500 hover:from-rose-600 hover:to-amber-600 text-white font-black px-5 sm:px-7 py-3 sm:py-3.5 rounded-2xl shadow-lg shadow-rose-500/30 transition flex items-center justify-center gap-2 touch-press text-xs sm:text-sm cursor-pointer active:scale-95">
                                        <i class="fa-solid fa-cart-shopping"></i>
                                        <span>Add to Bag</span>
                                    </button>
                                </form>

                                <a href="{{ route('product.show', $product->id) }}" class="flex-1 sm:flex-initial bg-slate-800 hover:bg-slate-700 text-slate-200 font-extrabold px-4 sm:px-6 py-3 sm:py-3.5 rounded-2xl border border-slate-700 hover:border-slate-600 transition text-xs sm:text-sm flex items-center justify-center gap-1.5 touch-press active:scale-95">
                                    <span>Details &amp; Sizes</span>
                                    <i class="fa-solid fa-arrow-right text-xs text-rose-400"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section>
    @endif

    <!-- 4. Value Propositions Ribbon -->
    <div class="bg-white border-b border-slate-200/80 py-6 sm:py-8 px-4 shadow-xs relative z-20">
        <div class="max-w-7xl mx-auto grid grid-cols-2 md:grid-cols-4 gap-3 sm:gap-6">
            <div data-tilt data-tilt-max="8" class="flex items-center gap-3 sm:gap-4 p-3 rounded-2xl bg-slate-50/80 border border-slate-200/60 shadow-xs hover:border-rose-300 transition touch-press">
                <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-2xl bg-gradient-to-tr from-rose-500 to-amber-500 text-white flex items-center justify-center text-lg sm:text-xl shrink-0 shadow-md shadow-rose-500/20">
                    <i class="fa-solid fa-plane-departure"></i>
                </div>
                <div>
                    <h4 class="font-black text-slate-900 text-xs sm:text-sm">Worldwide Delivery</h4>
                    <p class="text-[10px] sm:text-xs text-slate-500">3-7 Days Express</p>
                </div>
            </div>

            <div data-tilt data-tilt-max="8" class="flex items-center gap-3 sm:gap-4 p-3 rounded-2xl bg-slate-50/80 border border-slate-200/60 shadow-xs hover:border-amber-300 transition touch-press">
                <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-2xl bg-gradient-to-tr from-amber-400 to-yellow-500 text-black flex items-center justify-center text-lg sm:text-xl shrink-0 shadow-md shadow-amber-500/20">
                    <i class="fa-solid fa-bolt"></i>
                </div>
                <div>
                    <h4 class="font-black text-slate-900 text-xs sm:text-sm">Western Union QR</h4>
                    <p class="text-[10px] sm:text-xs text-slate-500">1-Scan Global Pay</p>
                </div>
            </div>

            <div data-tilt data-tilt-max="8" class="flex items-center gap-3 sm:gap-4 p-3 rounded-2xl bg-slate-50/80 border border-slate-200/60 shadow-xs hover:border-emerald-300 transition touch-press">
                <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-2xl bg-gradient-to-tr from-emerald-500 to-teal-500 text-white flex items-center justify-center text-lg sm:text-xl shrink-0 shadow-md shadow-emerald-500/20">
                    <i class="fa-solid fa-feather"></i>
                </div>
                <div>
                    <h4 class="font-black text-slate-900 text-xs sm:text-sm">100% Organic</h4>
                    <p class="text-[10px] sm:text-xs text-slate-500">Soft &amp; Safe for Babies</p>
                </div>
            </div>

            <div data-tilt data-tilt-max="8" class="flex items-center gap-3 sm:gap-4 p-3 rounded-2xl bg-slate-50/80 border border-slate-200/60 shadow-xs hover:border-blue-300 transition touch-press">
                <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-2xl bg-gradient-to-tr from-blue-500 to-indigo-500 text-white flex items-center justify-center text-lg sm:text-xl shrink-0 shadow-md shadow-blue-500/20">
                    <i class="fa-solid fa-shield-halved"></i>
                </div>
                <div>
                    <h4 class="font-black text-slate-900 text-xs sm:text-sm">Quality Guaranteed</h4>
                    <p class="text-[10px] sm:text-xs text-slate-500">Easy Global Returns</p>
                </div>
            </div>
        </div>
    </div>

    <!-- 5. 1-Tap Western Union Dynamic QR Pay Interactive Preview -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-14" x-data="{
        amount: 35,
        showAmount: true,
        getQrUrl() {
            let baseUrl = 'https://api.qrserver.com/v1/create-qr-code/?size=250x250&margin=10&data=';
            let payload = 'WESTERN UNION GLOBAL TRANSFER\nReceiver: TINYCHAMPS GLOBAL LTD\nCountry: United States\nCity: New York\nAgent: WU-GLOBAL-7789';
            if (this.showAmount && this.amount > 0) {
                payload += '\nAmount: $' + this.amount + '.00 USD';
            }
            return baseUrl + encodeURIComponent(payload);
        }
    }">
        <div class="bg-gradient-to-r from-slate-950 via-slate-900 to-slate-950 rounded-3xl p-6 sm:p-10 border border-slate-800 text-white relative overflow-hidden shadow-2xl">
            <!-- Ambient Lighting -->
            <div class="absolute top-0 right-0 w-96 h-96 bg-amber-500/10 rounded-full blur-3xl pointer-events-none"></div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center relative z-10">
                
                <div class="lg:col-span-7 space-y-4">
                    <div class="inline-flex items-center gap-2 bg-[#ffdd00] text-black px-3 py-1 rounded-xl text-xs font-black uppercase tracking-wider shadow-md">
                        <i class="fa-solid fa-bolt"></i> Western Union Dynamic QR Pay
                    </div>
                    
                    <h2 class="text-2xl sm:text-4xl font-black tracking-tight">
                        Instant Global Payments with <br class="hidden sm:inline"/>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-300 via-yellow-200 to-amber-400">
                            Dynamic Fixed-Amount QR
                        </span>
                    </h2>

                    <p class="text-xs sm:text-sm text-slate-300 leading-relaxed max-w-xl">
                        Scan our official receiver QR code using the Western Union mobile app or at any local agent branch worldwide. The transfer amount locks in automatically for zero-error transactions.
                    </p>

                    <!-- Interactive Amount Selector & Toggle -->
                    <div class="space-y-3 pt-2">
                        <div class="flex items-center justify-between max-w-md">
                            <span class="text-xs font-extrabold text-slate-300">Set Sample Order Amount:</span>
                            <label class="flex items-center gap-2 cursor-pointer text-xs font-bold text-amber-300">
                                <input type="checkbox" x-model="showAmount" class="rounded border-slate-700 text-rose-500 focus:ring-0">
                                <span>Lock Amount in QR</span>
                            </label>
                        </div>

                        <div class="flex flex-wrap gap-2">
                            <template x-for="amt in [25, 35, 50, 75, 100]">
                                <button 
                                    @click="amount = amt; showAmount = true"
                                    :class="amount === amt && showAmount ? 'bg-[#ffdd00] text-black font-black shadow-md' : 'bg-slate-800 text-slate-300 hover:bg-slate-700'"
                                    class="px-3.5 py-1.5 rounded-xl text-xs transition active:scale-95"
                                    x-text="'$' + amt + ' USD'"
                                ></button>
                            </template>
                        </div>
                    </div>

                    <div class="pt-2 flex flex-wrap items-center gap-4 text-xs text-slate-400">
                        <span class="flex items-center gap-1.5 text-emerald-400 font-bold"><i class="fa-solid fa-shield-check"></i> MTCN Verification</span>
                        <span class="flex items-center gap-1.5 text-amber-300 font-bold"><i class="fa-solid fa-globe"></i> 200+ Countries</span>
                    </div>
                </div>

                <!-- QR Card Preview -->
                <div class="lg:col-span-5 flex justify-center">
                    <div class="bg-white p-5 rounded-3xl text-slate-900 max-w-xs w-full shadow-2xl border-4 border-slate-800/80 text-center space-y-3" data-aos="zoom-in">
                        <div class="flex items-center justify-between border-b pb-2">
                            <span class="text-xs font-black text-[#ffaa00] uppercase tracking-wider flex items-center gap-1">
                                <i class="fa-solid fa-bolt"></i> Western Union
                            </span>
                            <span class="text-[10px] bg-emerald-100 text-emerald-800 font-black px-2 py-0.5 rounded-full uppercase">
                                Verified
                            </span>
                        </div>

                        <div class="relative flex items-center justify-center p-2 bg-slate-50 rounded-2xl border border-slate-200">
                            <img :src="getQrUrl()" alt="Western Union Pay QR" class="w-44 h-44 object-contain rounded-lg">
                        </div>

                        <div>
                            <div class="text-[10px] uppercase font-mono text-slate-400">Receiver: TINYCHAMPS GLOBAL LTD</div>
                            <div class="text-lg font-black text-slate-900 mt-0.5" x-text="showAmount && amount > 0 ? '$' + amount + '.00 USD' : 'Pay Any Amount'"></div>
                            <div class="text-[10px] text-slate-500 font-medium">Payout: New York, USA</div>
                        </div>

                        <a href="{{ route('shop') }}" class="block w-full bg-slate-950 hover:bg-rose-600 text-white font-bold py-2 rounded-xl text-xs transition">
                            Browse Suits &bull; Pay via QR
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- 6. Categories Showcase (3-Col Mobile / 6-Col Desktop) -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12">
        <div class="flex flex-wrap items-center justify-between gap-3 mb-6">
            <div>
                <span class="text-xs font-black uppercase tracking-widest text-rose-500">Explore Collections</span>
                <h2 class="text-2xl sm:text-3xl font-black text-slate-900">Baby &amp; Toddler Tracksuit Styles</h2>
            </div>
            <a href="{{ route('shop') }}" class="inline-flex items-center gap-1.5 text-xs font-extrabold text-rose-600 hover:text-rose-700 bg-rose-50 px-3.5 py-2 rounded-xl border border-rose-200/60 transition">
                <span>View All Outfits</span>
                <i class="fa-solid fa-arrow-right text-[10px]"></i>
            </a>
        </div>

        <div class="grid grid-cols-3 sm:grid-cols-3 md:grid-cols-6 gap-2.5 sm:gap-4">
            @foreach($categories as $cat)
                <a href="{{ route('shop', ['category' => $cat->slug]) }}" class="group bg-white p-3 sm:p-4 rounded-2xl sm:rounded-3xl border border-slate-200/80 hover:border-rose-300 shadow-xs hover:shadow-lg transition-all duration-300 flex flex-col items-center text-center touch-press">
                    <div class="w-12 h-12 sm:w-16 sm:h-16 rounded-2xl bg-gradient-to-tr from-rose-50 to-amber-50 group-hover:from-rose-500 group-hover:to-amber-500 flex items-center justify-center text-2xl sm:text-3xl mb-2 sm:mb-3 shadow-xs group-hover:scale-110 transition-transform duration-300">
                        <span>{{ $cat->icon ?: '🧸' }}</span>
                    </div>
                    <h3 class="font-extrabold text-slate-900 text-[11px] sm:text-xs group-hover:text-rose-600 transition line-clamp-2 leading-tight">
                        {{ $cat->name }}
                    </h3>
                    <span class="text-[9px] sm:text-[10px] text-slate-400 font-bold mt-1">
                        {{ $cat->products_count ?? $cat->products()->count() }} Suits
                    </span>
                </a>
            @endforeach
        </div>
    </section>

    <!-- 7. Featured Best Sellers (2-Col Mobile / 4-Col Desktop) -->
    <section class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8 py-8 sm:py-12 border-t border-slate-200/80">
        <div class="flex items-center justify-between gap-3 mb-4 sm:mb-6 px-1">
            <div>
                <span class="text-xs font-black uppercase tracking-widest text-rose-500">Top Rated</span>
                <h2 class="text-xl sm:text-3xl font-black text-slate-900">Featured Baby Tracksuits</h2>
            </div>
            <a href="{{ route('shop') }}" class="text-xs font-black text-rose-600 hover:underline">
                View All &rarr;
            </a>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2.5 sm:gap-6">
            @foreach($featuredProducts as $product)
                <div class="bg-white rounded-2xl sm:rounded-3xl border border-slate-200/80 overflow-hidden shadow-xs hover:shadow-xl transition-all duration-300 flex flex-col group touch-press" data-tilt data-tilt-max="6">
                    
                    <!-- Product Image Container -->
                    <div class="relative bg-gradient-to-b from-slate-100/80 to-slate-50 h-44 sm:h-60 p-2 sm:p-4 flex items-center justify-center overflow-hidden rounded-t-2xl sm:rounded-t-3xl">
                        @if($product->discount_percentage > 0)
                            <span class="absolute top-2 left-2 bg-gradient-to-r from-rose-600 to-amber-600 text-white text-[9px] sm:text-[10px] font-black px-2 py-0.5 rounded-lg shadow-sm z-10">
                                -{{ $product->discount_percentage }}%
                            </span>
                        @endif

                        <a href="{{ route('product.show', $product->id) }}" class="w-full h-full flex items-center justify-center">
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="max-h-full max-w-full object-contain rounded-xl group-hover:scale-110 transition-transform duration-500 drop-shadow-md">
                        </a>
                    </div>

                    <!-- Details Container -->
                    <div class="p-3 sm:p-4 flex-1 flex flex-col justify-between space-y-2">
                        <div>
                            <span class="text-[9px] sm:text-[10px] uppercase font-extrabold text-rose-500 block truncate">
                                {{ $product->category->name ?? 'Baby Tracksuit' }}
                            </span>
                            <h3 class="font-extrabold text-slate-900 text-xs sm:text-sm line-clamp-2 leading-tight group-hover:text-rose-600 transition">
                                <a href="{{ route('product.show', $product->id) }}">{{ $product->name }}</a>
                            </h3>
                        </div>

                        <div>
                            <div class="flex items-baseline gap-1.5">
                                <span class="text-sm sm:text-base font-black text-slate-900">
                                    ${{ number_format($product->price, 2) }}
                                </span>
                                @if($product->original_price && $product->original_price > $product->price)
                                    <span class="text-[10px] sm:text-xs line-through text-slate-400">
                                        ${{ number_format($product->original_price, 2) }}
                                    </span>
                                @endif
                            </div>

                            <div class="pt-2 flex items-center gap-1.5">
                                <form method="POST" action="{{ route('cart.add', $product->id) }}" class="flex-1">
                                    @csrf
                                    <button type="submit" class="w-full bg-slate-900 hover:bg-rose-600 text-white font-black py-2 rounded-xl text-[11px] sm:text-xs transition flex items-center justify-center gap-1.5 touch-press cursor-pointer">
                                        <i class="fa-solid fa-cart-shopping text-[10px]"></i>
                                        <span>Add to Bag</span>
                                    </button>
                                </form>
                                <a href="{{ route('product.show', $product->id) }}" class="w-8 h-8 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 flex items-center justify-center text-xs shrink-0 transition">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- 8. New Arrivals Section -->
    <section class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8 py-8 sm:py-12 border-t border-slate-200/80">
        <div class="flex items-center justify-between gap-3 mb-4 sm:mb-6 px-1">
            <div>
                <span class="text-xs font-black uppercase tracking-widest text-amber-500">Fresh Outfits</span>
                <h2 class="text-xl sm:text-3xl font-black text-slate-900">New Baby Tracksuit Arrivals</h2>
            </div>
            <a href="{{ route('shop') }}" class="text-xs font-black text-rose-600 hover:underline">
                Explore All &rarr;
            </a>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2.5 sm:gap-6">
            @foreach($latestProducts as $product)
                <div class="bg-white rounded-2xl sm:rounded-3xl border border-slate-200/80 overflow-hidden shadow-xs hover:shadow-xl transition-all duration-300 flex flex-col group touch-press" data-tilt data-tilt-max="6">
                    
                    <!-- Product Image Container -->
                    <div class="relative bg-gradient-to-b from-slate-100/80 to-slate-50 h-44 sm:h-60 p-2 sm:p-4 flex items-center justify-center overflow-hidden rounded-t-2xl sm:rounded-t-3xl">
                        <span class="absolute top-2 left-2 bg-gradient-to-r from-amber-500 to-yellow-400 text-black text-[9px] sm:text-[10px] font-black px-2 py-0.5 rounded-lg shadow-sm z-10">
                            NEW
                        </span>

                        <a href="{{ route('product.show', $product->id) }}" class="w-full h-full flex items-center justify-center">
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="max-h-full max-w-full object-contain rounded-xl group-hover:scale-110 transition-transform duration-500 drop-shadow-md">
                        </a>
                    </div>

                    <!-- Details Container -->
                    <div class="p-3 sm:p-4 flex-1 flex flex-col justify-between space-y-2">
                        <div>
                            <span class="text-[9px] sm:text-[10px] uppercase font-extrabold text-amber-600 block truncate">
                                {{ $product->category->name ?? 'Babywear' }}
                            </span>
                            <h3 class="font-extrabold text-slate-900 text-xs sm:text-sm line-clamp-2 leading-tight group-hover:text-rose-600 transition">
                                <a href="{{ route('product.show', $product->id) }}">{{ $product->name }}</a>
                            </h3>
                        </div>

                        <div>
                            <div class="flex items-baseline gap-1.5">
                                <span class="text-sm sm:text-base font-black text-slate-900">
                                    ${{ number_format($product->price, 2) }}
                                </span>
                                @if($product->original_price && $product->original_price > $product->price)
                                    <span class="text-[10px] sm:text-xs line-through text-slate-400">
                                        ${{ number_format($product->original_price, 2) }}
                                    </span>
                                @endif
                            </div>

                            <div class="pt-2 flex items-center gap-1.5">
                                <form method="POST" action="{{ route('cart.add', $product->id) }}" class="flex-1">
                                    @csrf
                                    <button type="submit" class="w-full bg-slate-900 hover:bg-rose-600 text-white font-black py-2 rounded-xl text-[11px] sm:text-xs transition flex items-center justify-center gap-1.5 touch-press cursor-pointer">
                                        <i class="fa-solid fa-cart-shopping text-[10px]"></i>
                                        <span>Add to Bag</span>
                                    </button>
                                </form>
                                <a href="{{ route('product.show', $product->id) }}" class="w-8 h-8 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 flex items-center justify-center text-xs shrink-0 transition">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    @push('scripts')
    <script>
        // Interactive Three.js 3D Floating Mesh & Particle Field
        (function() {
            const canvas = document.getElementById('hero-3d-canvas');
            if (!canvas || typeof THREE === 'undefined') return;

            const scene = new THREE.Scene();
            const camera = new THREE.PerspectiveCamera(60, window.innerWidth / window.innerHeight, 0.1, 1000);
            camera.position.z = 30;

            const renderer = new THREE.WebGLRenderer({ canvas: canvas, alpha: true, antialias: true });
            renderer.setSize(canvas.parentElement.clientWidth, canvas.parentElement.clientHeight);
            renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));

            // Ambient & Directional Lights
            const ambientLight = new THREE.AmbientLight(0xffffff, 0.8);
            scene.add(ambientLight);

            const pointLight1 = new THREE.PointLight(0xf43f5e, 2, 100);
            pointLight1.position.set(20, 20, 20);
            scene.add(pointLight1);

            const pointLight2 = new THREE.PointLight(0xfbbf24, 2, 100);
            pointLight2.position.set(-20, -20, 10);
            scene.add(pointLight2);

            // Floating 3D Geometric Objects
            const shapes = [];
            const geometries = [
                new THREE.IcosahedronGeometry(1.8, 0),
                new THREE.TorusGeometry(2, 0.6, 16, 50),
                new THREE.OctahedronGeometry(1.5, 0),
                new THREE.SphereGeometry(1.2, 32, 32),
            ];

            const materials = [
                new THREE.MeshStandardMaterial({ color: 0xf43f5e, roughness: 0.2, metalness: 0.8, transparent: true, opacity: 0.65 }),
                new THREE.MeshStandardMaterial({ color: 0xfbbf24, roughness: 0.3, metalness: 0.7, transparent: true, opacity: 0.6 }),
                new THREE.MeshStandardMaterial({ color: 0x38bdf8, roughness: 0.2, metalness: 0.8, transparent: true, opacity: 0.55 }),
            ];

            for (let i = 0; i < 16; i++) {
                const geom = geometries[Math.floor(Math.random() * geometries.length)];
                const mat = materials[Math.floor(Math.random() * materials.length)];
                const mesh = new THREE.Mesh(geom, mat);

                mesh.position.x = (Math.random() - 0.5) * 50;
                mesh.position.y = (Math.random() - 0.5) * 30;
                mesh.position.z = (Math.random() - 0.5) * 25 - 5;

                mesh.rotation.x = Math.random() * Math.PI;
                mesh.rotation.y = Math.random() * Math.PI;

                const scale = 0.5 + Math.random() * 0.7;
                mesh.scale.set(scale, scale, scale);

                mesh.userData = {
                    rotSpeedX: (Math.random() - 0.5) * 0.015,
                    rotSpeedY: (Math.random() - 0.5) * 0.015,
                    floatSpeed: 0.001 + Math.random() * 0.002,
                    initialY: mesh.position.y,
                };

                scene.add(mesh);
                shapes.push(mesh);
            }

            // Mouse Interactive Movement
            let mouseX = 0, mouseY = 0;
            window.addEventListener('mousemove', (e) => {
                mouseX = (e.clientX / window.innerWidth - 0.5) * 4;
                mouseY = (e.clientY / window.innerHeight - 0.5) * 4;
            });

            // Gyroscope / Device Motion on Mobile
            if (window.DeviceOrientationEvent) {
                window.addEventListener('deviceorientation', (e) => {
                    if (e.gamma && e.beta) {
                        mouseX = (e.gamma / 45) * 2;
                        mouseY = (e.beta / 45) * 2;
                    }
                });
            }

            // Animation Loop
            let clock = new THREE.Clock();
            function animate() {
                requestAnimationFrame(animate);
                const elapsedTime = clock.getElapsedTime();

                shapes.forEach(shape => {
                    shape.rotation.x += shape.userData.rotSpeedX;
                    shape.rotation.y += shape.userData.rotSpeedY;
                    shape.position.y = shape.userData.initialY + Math.sin(elapsedTime * 2 + shape.position.x) * 1.5;
                });

                camera.position.x += (mouseX - camera.position.x) * 0.05;
                camera.position.y += (-mouseY - camera.position.y) * 0.05;
                camera.lookAt(scene.position);

                renderer.render(scene, camera);
            }
            animate();

            // Responsive Resize
            window.addEventListener('resize', () => {
                if (!canvas.parentElement) return;
                const width = canvas.parentElement.clientWidth;
                const height = canvas.parentElement.clientHeight;
                camera.aspect = width / height;
                camera.updateProjectionMatrix();
                renderer.setSize(width, height);
            });
        })();
    </script>
    @endpush

</x-app-layout>
