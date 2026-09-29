<x-app-layout>

    <div class="bg-rose-50/70 border-b border-rose-100 py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-extrabold text-slate-900">Your Shopping Bag</h1>
            <p class="text-sm text-slate-500 mt-1">Review your selected baby tracksuits before secure worldwide checkout</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-10">
        @if(count($cart) > 0)
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                
                <!-- Cart Items Table Area -->
                <div class="lg:col-span-8 space-y-6">
                    
                    <!-- Free Shipping Progress Banner -->
                    @if($subtotal < $freeShippingThreshold)
                        @php
                            $remaining = $freeShippingThreshold - $subtotal;
                            $percentage = min(100, round(($subtotal / $freeShippingThreshold) * 100));
                        @endphp
                        <div class="bg-rose-50 border border-rose-200 rounded-2xl p-4">
                            <div class="flex items-center justify-between text-xs font-bold text-rose-900 mb-1.5">
                                <span class="flex items-center gap-1.5">
                                    <i class="fa-solid fa-plane-departure text-rose-600"></i> Add <strong>${{ number_format($remaining, 2) }} USD</strong> more to unlock <strong>FREE Worldwide Express Shipping</strong>!
                                </span>
                                <span>{{ $percentage }}%</span>
                            </div>
                            <div class="w-full bg-rose-200 h-2 rounded-full overflow-hidden">
                                <div class="bg-rose-600 h-full rounded-full transition-all duration-500" style="width: {{ $percentage }}%"></div>
                            </div>
                        </div>
                    @else
                        <div class="bg-emerald-50 border border-emerald-200 rounded-2xl p-4 flex items-center gap-3 text-emerald-900 text-sm font-bold">
                            <i class="fa-solid fa-circle-check text-emerald-600 text-lg"></i>
                            <span>Congratulations! You have qualified for <strong>FREE Worldwide Express Delivery</strong>!</span>
                        </div>
                    @endif

                    <div class="bg-white rounded-3xl border border-slate-200 shadow-xs overflow-hidden">
                        <div class="divide-y divide-slate-100">
                            @foreach($cart as $id => $item)
                                <div class="p-4 sm:p-6 flex flex-col sm:flex-row items-start sm:items-center gap-4 sm:gap-6">
                                    <div class="flex items-center gap-3 sm:gap-4 w-full sm:w-auto">
                                        <!-- Image -->
                                        <div class="w-16 h-16 sm:w-24 sm:h-24 bg-slate-50 rounded-2xl border border-slate-100 overflow-hidden flex items-center justify-center p-2 shrink-0">
                                            <img src="{{ $item['image'] ?? 'https://images.unsplash.com/photo-1522771930-78848d9293e8?w=800' }}" alt="{{ $item['name'] }}" class="max-h-full max-w-full object-cover rounded-xl">
                                        </div>

                                        <!-- Mobile Item Name & Price -->
                                        <div class="flex-1 sm:hidden">
                                            <h3 class="font-extrabold text-slate-900 text-sm line-clamp-1">
                                                {{ $item['name'] }}
                                            </h3>
                                            <p class="text-xs font-black text-rose-600 mt-0.5">
                                                ${{ number_format($item['price'], 2) }} USD
                                            </p>
                                        </div>

                                        <!-- Mobile Remove button -->
                                        <div class="sm:hidden">
                                            <a href="{{ route('cart.remove', $id) }}" onclick="return confirm('Remove this tracksuit from bag?')" class="text-slate-400 hover:text-red-600 p-2" title="Remove item">
                                                <i class="fa-solid fa-trash-can text-sm"></i>
                                            </a>
                                        </div>
                                    </div>

                                    <!-- Details (Desktop) -->
                                    <div class="hidden sm:block flex-1 text-left">
                                        <h3 class="font-bold text-slate-900 text-base">
                                            {{ $item['name'] }}
                                        </h3>
                                        <p class="text-sm font-black text-rose-600 mt-1">
                                            ${{ number_format($item['price'], 2) }} USD each
                                        </p>
                                    </div>

                                    <!-- Bottom Controls on Mobile / Inline on Desktop -->
                                    <div class="w-full sm:w-auto flex items-center justify-between sm:justify-end gap-4 pt-2 sm:pt-0 border-t sm:border-t-0 border-slate-50">
                                        <!-- Quantity Stepper -->
                                        <div class="flex items-center border border-slate-200 rounded-xl overflow-hidden bg-slate-50 shadow-xs">
                                            <a href="{{ route('cart.decrease', $id) }}" class="px-3 py-1.5 text-slate-600 hover:bg-slate-200 font-bold transition">-</a>
                                            <span class="px-3.5 py-1.5 font-bold text-xs sm:text-sm text-slate-900 bg-white">{{ $item['quantity'] }}</span>
                                            <a href="{{ route('cart.increase', $id) }}" class="px-3 py-1.5 text-slate-600 hover:bg-slate-200 font-bold transition">+</a>
                                        </div>

                                        <!-- Subtotal -->
                                        <div class="text-right min-w-[90px]">
                                            <span class="text-[10px] text-slate-400 block sm:hidden uppercase font-bold">Total</span>
                                            <span class="text-sm sm:text-base font-black text-slate-900">
                                                ${{ number_format($item['price'] * $item['quantity'], 2) }}
                                            </span>
                                        </div>

                                        <!-- Desktop Remove Action -->
                                        <div class="hidden sm:block">
                                            <a href="{{ route('cart.remove', $id) }}" onclick="return confirm('Remove this tracksuit from bag?')" class="text-slate-400 hover:text-red-600 transition p-2" title="Remove item">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Table Footer Actions -->
                        <div class="p-4 bg-slate-50 border-t border-slate-100 flex items-center justify-between">
                            <a href="{{ route('shop') }}" class="text-xs font-bold text-rose-600 hover:text-rose-700 flex items-center gap-1">
                                <i class="fa-solid fa-arrow-left text-[10px]"></i> Continue Shopping
                            </a>

                            <form action="{{ route('cart.clear') }}" method="POST" onsubmit="return confirm('Clear entire shopping bag?');">
                                @csrf
                                <button type="submit" class="text-xs font-bold text-slate-500 hover:text-red-600 cursor-pointer">
                                    Clear Bag
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Payment Teaser in Cart -->
                    <div class="bg-gradient-to-r from-slate-950 via-slate-900 to-slate-950 rounded-2xl p-5 text-white shadow-md border border-slate-800">
                        <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                            <div class="space-y-1 text-center sm:text-left">
                                <span class="text-xs text-[#ffdd00] font-bold uppercase tracking-wider">Fast &amp; Verified Worldwide Payments</span>
                                <h4 class="font-bold text-base">Pay via Western Union QR, Bank Wire, Cards or COD</h4>
                                <p class="text-xs text-slate-400">Live order tracking and 100% money-back guarantee.</p>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="bg-[#ffdd00] text-black font-black text-xs px-3 py-1.5 rounded-lg shadow-sm flex items-center gap-1">
                                    <i class="fa-solid fa-bolt text-xs"></i> Western Union
                                </span>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Order Summary Sidebar -->
                <div class="lg:col-span-4 space-y-6">
                    <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs space-y-4">
                        <h3 class="font-black text-slate-900 text-lg border-b border-slate-100 pb-3">Order Summary</h3>

                        <div class="space-y-2.5 text-sm">
                            <div class="flex justify-between text-slate-600">
                                <span>Bag Subtotal</span>
                                <span class="font-bold text-slate-900">${{ number_format($subtotal, 2) }}</span>
                            </div>

                            <div class="flex justify-between text-slate-600">
                                <span>Worldwide Express Shipping</span>
                                @if($effectiveShipping == 0)
                                    <span class="font-bold text-emerald-600 uppercase text-xs">FREE</span>
                                @else
                                    <span class="font-bold text-slate-900">${{ number_format($effectiveShipping, 2) }}</span>
                                @endif
                            </div>

                            <div class="pt-3 border-t border-slate-100 flex justify-between items-baseline">
                                <span class="font-extrabold text-slate-900 text-base">Estimated Total</span>
                                <span class="font-black text-2xl text-rose-600">
                                    ${{ number_format($total, 2) }} <span class="text-xs font-bold text-slate-400">USD</span>
                                </span>
                            </div>
                        </div>

                        <div class="pt-2">
                            <a href="{{ route('checkout') }}" class="w-full py-4 px-6 rounded-2xl font-black text-sm text-white bg-gradient-to-r from-rose-500 via-amber-500 to-rose-600 hover:from-rose-600 hover:to-amber-600 shadow-xl shadow-rose-500/25 transition duration-200 flex items-center justify-center gap-2 touch-press">
                                <i class="fa-solid fa-shield-halved"></i>
                                <span>Proceed to Worldwide Checkout</span>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        @else
            <div class="text-center py-16 bg-white rounded-3xl border border-slate-200 p-8 space-y-4 max-w-md mx-auto shadow-xs">
                <div class="text-6xl">🧸</div>
                <h3 class="text-xl font-bold text-slate-900">Your shopping bag is empty!</h3>
                <p class="text-xs sm:text-sm text-slate-500">Explore our charming collection of baby tracksuits and cozy outfits.</p>
                <a href="{{ route('shop') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-rose-500 to-amber-500 text-white px-6 py-3.5 rounded-2xl text-xs font-black shadow-lg shadow-rose-500/25">
                    <i class="fa-solid fa-shirt"></i>
                    <span>Browse Baby Tracksuits</span>
                </a>
            </div>
        @endif
    </div>

</x-app-layout>