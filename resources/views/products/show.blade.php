<x-app-layout>

    <!-- Breadcrumb -->
    <div class="bg-rose-50/70 border-b border-rose-100 py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center gap-2 text-xs font-semibold text-slate-500">
                <a href="{{ route('home') }}" class="hover:text-rose-600 transition">Home</a>
                <i class="fa-solid fa-chevron-right text-[10px] text-slate-400"></i>
                <a href="{{ route('shop') }}" class="hover:text-rose-600 transition">Tracksuits</a>
                @if($product->category)
                    <i class="fa-solid fa-chevron-right text-[10px] text-slate-400"></i>
                    <a href="{{ route('shop', ['category' => $product->category->slug]) }}" class="hover:text-rose-600 transition">{{ $product->category->name }}</a>
                @endif
                <i class="fa-solid fa-chevron-right text-[10px] text-slate-400"></i>
                <span class="text-rose-600 font-bold truncate max-w-xs">{{ $product->name }}</span>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12" x-data="{ 
        qrModalOpen: false, 
        quantity: 1, 
        selectedSize: '1-2Y',
        showAmountInQr: true,
        getWuQrUrl() {
            let total = {{ $product->price }} * this.quantity;
            let baseUrl = 'https://api.qrserver.com/v1/create-qr-code/?size=260x260&margin=10&data=';
            let payload = 'WESTERN UNION GLOBAL TRANSFER\nReceiver: TINYCHAMPS GLOBAL LTD\nCountry: United States\nCity: New York\nProduct: {{ addslashes($product->name) }}\nSize: ' + this.selectedSize;
            if (this.showAmountInQr) {
                payload += '\nAmount: $' + total.toFixed(2) + ' USD';
            }
            return baseUrl + encodeURIComponent(payload);
        }
    }">
        <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs p-6 sm:p-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12">
                
                <!-- Product Image Showcase with 3D Depth -->
                <div class="lg:col-span-6 space-y-4" data-aos="fade-right">
                    <div data-tilt data-tilt-max="10" data-tilt-glare="true" data-tilt-max-glare="0.2" class="card-3d relative bg-slate-50 rounded-3xl border border-slate-200/80 overflow-hidden flex items-center justify-center p-6 min-h-[380px] sm:min-h-[460px] group shadow-inner">
                        @if($product->discount_percentage > 0)
                            <span class="absolute top-5 left-5 bg-rose-600 text-white text-xs font-black px-3.5 py-1.5 rounded-xl shadow-lg z-10">
                                -{{ $product->discount_percentage }}% OFF
                            </span>
                        @endif

                        <span class="absolute top-5 right-5 bg-slate-900/85 text-white text-[11px] font-extrabold px-3 py-1 rounded-xl backdrop-blur-md z-10 flex items-center gap-1.5 shadow-md">
                            <i class="fa-solid fa-feather text-emerald-400"></i> 100% Organic Cotton
                        </span>

                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="max-h-[420px] max-w-full object-cover rounded-2xl group-hover:scale-105 transition-all duration-500">
                    </div>
                </div>

                <!-- Product Info & Action Area -->
                <div class="lg:col-span-6 flex flex-col justify-between space-y-6">
                    <div>
                        <!-- Category, Stock & SKU -->
                        <div class="flex items-center justify-between flex-wrap gap-2">
                            @if($product->category)
                                <span class="text-xs font-extrabold uppercase tracking-wider text-rose-600 bg-rose-50 border border-rose-200/60 px-3.5 py-1 rounded-full">
                                    {{ $product->category->name }}
                                </span>
                            @endif
                            <span class="text-xs text-slate-400 font-mono">SKU: {{ $product->sku ?: 'TC-' . $product->id }}</span>
                        </div>

                        <!-- Product Title -->
                        <h1 class="text-2xl sm:text-3xl font-black text-slate-900 mt-3 leading-snug">
                            {{ $product->name }}
                        </h1>

                        <!-- Ratings -->
                        <div class="flex items-center gap-3 mt-3">
                            <div class="flex text-amber-400 text-sm">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                            <span class="text-xs text-slate-500 font-bold">5.0 (180+ Verified Parents)</span>
                            <span class="text-slate-300">|</span>
                            <span class="text-xs text-emerald-600 font-extrabold flex items-center gap-1">
                                <i class="fa-solid fa-circle-check"></i> In Stock &amp; Worldwide Dispatch
                            </span>
                        </div>

                        <!-- Pricing Card -->
                        <div class="mt-6 p-4 sm:p-5 bg-gradient-to-br from-slate-900 via-slate-950 to-slate-900 rounded-3xl text-white shadow-xl flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3">
                            <div>
                                <span class="text-[10px] sm:text-[11px] text-slate-400 uppercase tracking-widest font-bold block">International Price</span>
                                <div class="flex items-baseline gap-3 mt-0.5">
                                    <span class="text-2xl sm:text-3xl font-black text-amber-300">${{ number_format($product->price, 2) }}</span>
                                    @if($product->original_price && $product->original_price > $product->price)
                                        <span class="text-xs sm:text-base line-through text-slate-400 font-medium">${{ number_format($product->original_price, 2) }}</span>
                                    @endif
                                </div>
                            </div>

                            <!-- Direct Western Union QR Modal Trigger -->
                            <button 
                                type="button" 
                                @click="qrModalOpen = true"
                                class="w-full sm:w-auto bg-[#ffdd00] hover:bg-yellow-400 text-black font-black text-xs px-4 py-2.5 rounded-2xl shadow-lg flex items-center justify-center gap-2 transition hover:scale-105 active:scale-95 cursor-pointer"
                            >
                                <i class="fa-solid fa-bolt text-sm"></i>
                                <span>Western Union QR</span>
                            </button>
                        </div>

                        <!-- Size Selector -->
                        <div class="mt-6">
                            <div class="flex items-center justify-between mb-2">
                                <label class="text-xs font-black text-slate-900 uppercase tracking-wider">Select Baby / Toddler Age &amp; Size</label>
                                <span class="text-[11px] text-rose-600 font-bold flex items-center gap-1"><i class="fa-solid fa-ruler"></i> Standard Fit</span>
                            </div>
                            <div class="grid grid-cols-3 sm:grid-cols-6 gap-2">
                                <template x-for="sz in ['0-6M', '6-12M', '1-2Y', '2-3Y', '3-4Y', '4-5Y']">
                                    <button 
                                        type="button" 
                                        @click="selectedSize = sz"
                                        :class="selectedSize === sz ? 'bg-rose-600 text-white font-black border-rose-600 shadow-md ring-2 ring-rose-300' : 'bg-slate-50 text-slate-700 font-bold border-slate-200 hover:bg-slate-100'"
                                        class="py-2.5 px-3 rounded-2xl border text-xs text-center transition cursor-pointer"
                                        x-text="sz"
                                    ></button>
                                </template>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="mt-6">
                            <h3 class="text-xs font-black text-slate-900 uppercase tracking-wider mb-2">Outfit Details &amp; Fabric</h3>
                            <p class="text-xs sm:text-sm text-slate-600 leading-relaxed whitespace-pre-line">
                                {{ $product->description }}
                            </p>
                        </div>
                    </div>

                    <!-- Cart and Purchase Controls -->
                    <div class="pt-6 border-t border-slate-100">
                        <form action="{{ route('cart.add', $product->id) }}" method="POST" class="space-y-4">
                            @csrf
                            
                            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 sm:gap-4">
                                <div class="w-full sm:w-36">
                                    <label class="block text-xs font-extrabold text-slate-700 mb-1.5">Quantity</label>
                                    <div class="flex items-center border border-slate-300 rounded-2xl overflow-hidden bg-slate-50">
                                        <button type="button" @click="if(quantity > 1) quantity--" class="px-4 sm:px-3 py-2 text-slate-600 hover:bg-slate-200 transition font-bold text-base">-</button>
                                        <input type="number" name="quantity" x-model="quantity" min="1" max="{{ max(1, $product->stock) }}" class="w-full text-center border-0 bg-transparent text-sm font-extrabold focus:ring-0">
                                        <button type="button" @click="quantity++" class="px-4 sm:px-3 py-2 text-slate-600 hover:bg-slate-200 transition font-bold text-base">+</button>
                                    </div>
                                </div>

                                <div class="flex-1 sm:pt-6">
                                    <button type="submit" {{ $product->stock <= 0 ? 'disabled' : '' }} class="w-full py-3.5 sm:py-4 px-6 rounded-2xl font-black text-xs sm:text-sm text-white bg-gradient-to-r from-rose-500 via-amber-500 to-rose-600 hover:from-rose-600 hover:to-amber-600 shadow-xl shadow-rose-500/25 transition duration-200 flex items-center justify-center gap-2 hover:scale-[1.01] active:scale-[0.99] {{ $product->stock <= 0 ? 'opacity-50 cursor-not-allowed' : '' }}">
                                        <i class="fa-solid fa-cart-shopping"></i>
                                        <span>Add to Bag ($<span x-text="({{ $product->price }} * quantity).toFixed(2)"></span> USD)</span>
                                    </button>
                                </div>
                            </div>
                        </form>

                        <!-- Trust Features -->
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 mt-6 pt-6 border-t border-slate-100 text-xs font-semibold text-slate-600">
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-plane-departure text-rose-600"></i>
                                <span>Worldwide Express</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-rotate-left text-rose-600"></i>
                                <span>14-Day Global Returns</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-certificate text-rose-600"></i>
                                <span>100% Baby Safe</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-shield-halved text-rose-600"></i>
                                <span>SSL Encrypted</span>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>

        <!-- Western Union Dynamic QR Modal -->
        <div 
            x-show="qrModalOpen" 
            x-cloak 
            class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/80 backdrop-blur-md animate-in fade-in duration-200"
        >
            <div 
                @click.away="qrModalOpen = false" 
                class="bg-white rounded-3xl max-w-md w-full p-6 sm:p-8 shadow-2xl border border-slate-200 text-center space-y-4"
            >
                <div class="flex items-center justify-between border-b pb-3">
                    <div class="flex items-center gap-2">
                        <span class="bg-[#ffdd00] text-black font-black px-2.5 py-1 rounded-xl text-xs flex items-center gap-1 shadow-sm">
                            <i class="fa-solid fa-bolt"></i> Western Union
                        </span>
                        <span class="text-xs font-bold text-slate-800">Dynamic Payment QR</span>
                    </div>
                    <button @click="qrModalOpen = false" class="text-slate-400 hover:text-slate-800 text-xl font-bold">&times;</button>
                </div>

                <p class="text-xs text-slate-500">
                    Scan via Western Union mobile app or visit an agent with this scannable recipient code:
                </p>

                <div class="p-3 bg-slate-50 rounded-2xl border border-slate-200 inline-block mx-auto">
                    <img :src="getWuQrUrl()" alt="Western Union QR" class="w-48 h-48 mx-auto object-contain rounded-xl">
                </div>

                <div class="space-y-1 text-xs">
                    <div class="font-extrabold text-slate-900 text-base">
                        Payable: $<span x-text="({{ $product->price }} * quantity).toFixed(2)"></span> USD
                    </div>
                    <div class="text-slate-500">Receiver: <strong>TINYCHAMPS GLOBAL LTD</strong></div>
                    <div class="text-slate-500">City / Country: <strong>New York, United States</strong></div>
                    <div class="text-[11px] text-amber-600 font-mono mt-1">Agent Code: WU-GLOBAL-7789</div>
                </div>

                <div class="pt-2 flex gap-2">
                    <button @click="qrModalOpen = false" class="flex-1 bg-slate-100 hover:bg-slate-200 text-slate-700 py-2.5 rounded-xl text-xs font-bold transition">
                        Close
                    </button>
                    <form action="{{ route('cart.add', $product->id) }}" method="POST" class="flex-1">
                        @csrf
                        <input type="hidden" name="quantity" :value="quantity">
                        <button type="submit" class="w-full bg-rose-600 hover:bg-rose-700 text-white py-2.5 rounded-xl text-xs font-black transition">
                            Add &amp; Checkout
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>

</x-app-layout>
