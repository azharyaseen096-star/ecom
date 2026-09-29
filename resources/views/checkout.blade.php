<x-app-layout>

    <div class="bg-slate-900 text-white py-8 border-b border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-wrap items-center justify-between gap-4">
                <div>
                    <span class="text-xs font-black uppercase tracking-widest text-rose-400">Step 2 of 2</span>
                    <h1 class="text-2xl sm:text-3xl font-black text-white mt-1">Worldwide Checkout &amp; Payment</h1>
                    <p class="text-xs sm:text-sm text-slate-400 mt-1">Express delivery to 200+ countries with Western Union, Bank Wire, Cards, or Cash on Delivery</p>
                </div>
                <div class="flex items-center gap-2 text-xs text-slate-300 bg-slate-800/80 px-4 py-2 rounded-2xl border border-slate-700 shadow-sm">
                    <i class="fa-solid fa-shield-halved text-emerald-400"></i>
                    <span>256-Bit SSL Encrypted &amp; Verified</span>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-10" x-data="{ 
        paymentMethod: 'westernunion', 
        copying: false,
        wuShowAmount: true,
        getWuQrUrl() {
            let baseUrl = 'https://api.qrserver.com/v1/create-qr-code/?size=260x260&margin=10&data=';
            let payload = 'WESTERN UNION GLOBAL TRANSFER\nReceiver: {{ $settings['wu_receiver_name'] }}\nCountry: {{ $settings['wu_country'] }}\nCity: {{ $settings['wu_city'] }}\nAgent: {{ $settings['wu_agent_code'] }}\nOrder: {{ $tempOrderRef }}';
            if (this.wuShowAmount) {
                payload += '\nAmount: ${{ number_format($total, 2) }} USD';
            }
            return baseUrl + encodeURIComponent(payload);
        },
        copyText(text) {
            navigator.clipboard.writeText(text);
            this.copying = true;
            setTimeout(() => this.copying = false, 2000);
        }
    }">
        <form action="{{ route('place.order') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                
                <!-- Left Column: Shipping & Payment Details -->
                <div class="lg:col-span-8 space-y-8">
                    
                    <!-- 1. Customer Contact & Delivery Info -->
                    <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-8 shadow-xs space-y-6">
                        <div class="flex items-center gap-3 border-b border-slate-100 pb-4">
                            <div class="w-10 h-10 rounded-2xl bg-gradient-to-tr from-rose-500 to-amber-500 text-white flex items-center justify-center font-black text-base shadow-md shadow-rose-500/30">
                                1
                            </div>
                            <div>
                                <h2 class="font-black text-slate-900 text-lg">Customer &amp; Worldwide Shipping Details</h2>
                                <p class="text-xs text-slate-500">Recipient information for international courier delivery</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-1.5">Full Name <span class="text-red-500">*</span></label>
                                <input type="text" name="customer_name" value="{{ old('customer_name', $user->name ?? '') }}" required placeholder="e.g. Sarah Johnson" class="w-full text-sm p-3.5 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-rose-500 focus:bg-white transition">
                            </div>

                            <div>
                                <label class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-1.5">WhatsApp / Phone Number <span class="text-red-500">*</span></label>
                                <input type="tel" name="customer_phone" value="{{ old('customer_phone', $user->phone ?? '') }}" required placeholder="+1 (555) 019-2834" class="w-full text-sm p-3.5 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-rose-500 focus:bg-white transition">
                            </div>

                            <div>
                                <label class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-1.5">Email Address <span class="text-red-500">*</span></label>
                                <input type="email" name="customer_email" value="{{ old('customer_email', $user->email ?? '') }}" required placeholder="sarah@example.com" class="w-full text-sm p-3.5 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-rose-500 focus:bg-white transition">
                            </div>

                            <div>
                                <label class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-1.5">Destination Country <span class="text-red-500">*</span></label>
                                <select name="country" class="w-full text-sm p-3.5 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-rose-500 focus:bg-white transition font-bold text-slate-800">
                                    <option value="United States">United States (USA)</option>
                                    <option value="United Kingdom">United Kingdom (UK)</option>
                                    <option value="Canada">Canada</option>
                                    <option value="Australia">Australia</option>
                                    <option value="United Arab Emirates">United Arab Emirates (UAE)</option>
                                    <option value="Saudi Arabia">Saudi Arabia (KSA)</option>
                                    <option value="Germany">Germany</option>
                                    <option value="France">France</option>
                                    <option value="Pakistan">Pakistan</option>
                                    <option value="Worldwide Other">Other Country (Worldwide)</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-1.5">City <span class="text-red-500">*</span></label>
                                <input type="text" id="city_input" name="city" value="{{ old('city', $user->city ?? 'New York') }}" required placeholder="e.g. New York, London, Toronto, Dubai" class="w-full text-sm p-3.5 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-rose-500 focus:bg-white transition">
                            </div>

                            <div>
                                <label class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-1.5">State / Province</label>
                                <input type="text" id="province_input" name="province" value="{{ old('province', 'NY') }}" placeholder="e.g. New York, California, Ontario" class="w-full text-sm p-3.5 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-rose-500 focus:bg-white transition">
                            </div>

                            <div class="sm:col-span-2">
                                <label class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-1.5">Street Address / Apartment / Suite <span class="text-red-500">*</span></label>
                                <input type="text" id="address_input" name="shipping_address" value="{{ old('shipping_address', $user->address ?? '') }}" required placeholder="e.g. 742 Evergreen Terrace, Apt 4B" class="w-full text-sm p-3.5 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-rose-500 focus:bg-white transition">
                            </div>

                            <div>
                                <label class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-1.5">Postal / ZIP Code</label>
                                <input type="text" id="postal_code_input" name="postal_code" value="{{ old('postal_code') }}" placeholder="e.g. 10001" class="w-full text-sm p-3.5 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-rose-500 focus:bg-white transition">
                            </div>

                            <div>
                                <label class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-1.5">Delivery Notes (Optional)</label>
                                <input type="text" name="delivery_notes" value="{{ old('delivery_notes') }}" placeholder="e.g. Leave at front door with concierge" class="w-full text-sm p-3.5 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-rose-500 focus:bg-white transition">
                            </div>
                        </div>
                    </div>

                    <!-- 2. Exact GPS Pinpoint Live Map Section -->
                    <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-8 shadow-xs space-y-4">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 border-b border-slate-100 pb-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-2xl bg-gradient-to-tr from-rose-500 to-amber-500 text-white flex items-center justify-center font-black text-base shadow-md shadow-rose-500/30">
                                    2
                                </div>
                                <div>
                                    <h2 class="font-black text-slate-900 text-lg flex items-center gap-2">
                                        <span>Pinpoint Exact GPS Location</span>
                                        <span class="bg-emerald-100 text-emerald-800 text-[10px] font-black px-2.5 py-0.5 rounded-full uppercase">Live Map</span>
                                    </h2>
                                    <p class="text-xs text-slate-500">Detect or drag pin for accurate express delivery courier dispatch</p>
                                </div>
                            </div>

                            <button type="button" id="btn-detect-gps" class="inline-flex items-center justify-center gap-2 bg-gradient-to-r from-rose-500 to-amber-500 hover:from-rose-600 hover:to-amber-600 text-white font-extrabold text-xs px-4 py-2.5 rounded-2xl shadow-md transition transform active:scale-95 cursor-pointer">
                                <i class="fa-solid fa-location-crosshairs text-sm"></i>
                                <span>📍 Detect My Location</span>
                            </button>
                        </div>

                        <div class="relative rounded-2xl overflow-hidden border border-slate-200">
                            <div id="checkout-map" class="w-full h-72 sm:h-80 bg-slate-100"></div>
                            
                            <div class="absolute top-3 right-3 bg-slate-950/85 text-white backdrop-blur-md border border-slate-800 rounded-xl px-3 py-2 text-xs shadow-lg pointer-events-none z-20">
                                <div class="font-bold flex items-center gap-1.5 text-amber-400">
                                    <i class="fa-solid fa-hand-pointer"></i> Drag Pin to Destination
                                </div>
                                <div class="text-[11px] text-slate-400 font-mono mt-0.5" id="coords-display">
                                    Lat: 40.7128, Lng: -74.0060
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="latitude" id="latitude_input" value="40.7128">
                        <input type="hidden" name="longitude" id="longitude_input" value="-74.0060">
                    </div>

                    <!-- 3. Payment Method Selection (Western Union, Bank Wire, Card, COD) -->
                    <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-8 shadow-xs space-y-6">
                        <div class="flex items-center gap-3 border-b border-slate-100 pb-4">
                            <div class="w-10 h-10 rounded-2xl bg-gradient-to-tr from-rose-500 to-amber-500 text-white flex items-center justify-center font-black text-base shadow-md shadow-rose-500/30">
                                3
                            </div>
                            <div>
                                <h2 class="font-black text-slate-900 text-lg">Choose Payment Method</h2>
                                <p class="text-xs text-slate-500">Instant verification with Western Union Dynamic QR Code</p>
                            </div>
                        </div>

                        <!-- Payment Method Radios -->
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3.5">
                            
                            <!-- Western Union -->
                            <label class="cursor-pointer border-2 rounded-2xl p-4 text-center transition flex flex-col items-center justify-between"
                                   :class="paymentMethod === 'westernunion' ? 'border-amber-400 bg-amber-50/70 shadow-md ring-2 ring-amber-400/40' : 'border-slate-200 hover:border-slate-300 bg-white'">
                                <input type="radio" name="payment_method" value="westernunion" x-model="paymentMethod" class="sr-only">
                                <div class="w-12 h-12 rounded-2xl bg-[#ffdd00] text-black flex items-center justify-center text-xl mb-2 shadow-md">
                                    <i class="fa-solid fa-bolt"></i>
                                </div>
                                <span class="font-black text-slate-900 text-sm block">Western Union</span>
                                <span class="text-[10px] text-amber-700 font-extrabold uppercase mt-1">⚡ Dynamic QR</span>
                            </label>

                            <!-- Bank Wire -->
                            <label class="cursor-pointer border-2 rounded-2xl p-4 text-center transition flex flex-col items-center justify-between"
                                   :class="paymentMethod === 'bank_transfer' ? 'border-blue-600 bg-blue-50/70 shadow-md ring-2 ring-blue-500/30' : 'border-slate-200 hover:border-slate-300 bg-white'">
                                <input type="radio" name="payment_method" value="bank_transfer" x-model="paymentMethod" class="sr-only">
                                <div class="w-12 h-12 rounded-2xl bg-blue-600 text-white flex items-center justify-center text-xl mb-2 shadow-md">
                                    <i class="fa-solid fa-building-columns"></i>
                                </div>
                                <span class="font-black text-slate-900 text-sm block">Bank Wire</span>
                                <span class="text-[10px] text-blue-700 font-extrabold uppercase mt-1">SWIFT &bull; IBAN</span>
                            </label>

                            <!-- Card -->
                            <label class="cursor-pointer border-2 rounded-2xl p-4 text-center transition flex flex-col items-center justify-between"
                                   :class="paymentMethod === 'card' ? 'border-emerald-600 bg-emerald-50/70 shadow-md ring-2 ring-emerald-500/30' : 'border-slate-200 hover:border-slate-300 bg-white'">
                                <input type="radio" name="payment_method" value="card" x-model="paymentMethod" class="sr-only">
                                <div class="w-12 h-12 rounded-2xl bg-emerald-600 text-white flex items-center justify-center text-xl mb-2 shadow-md">
                                    <i class="fa-solid fa-credit-card"></i>
                                </div>
                                <span class="font-black text-slate-900 text-sm block">Cards</span>
                                <span class="text-[10px] text-emerald-700 font-extrabold uppercase mt-1">Visa &bull; MC</span>
                            </label>

                            <!-- COD -->
                            <label class="cursor-pointer border-2 rounded-2xl p-4 text-center transition flex flex-col items-center justify-between"
                                   :class="paymentMethod === 'cod' ? 'border-slate-900 bg-slate-100 shadow-md ring-2 ring-slate-800/30' : 'border-slate-200 hover:border-slate-300 bg-white'">
                                <input type="radio" name="payment_method" value="cod" x-model="paymentMethod" class="sr-only">
                                <div class="w-12 h-12 rounded-2xl bg-slate-900 text-white flex items-center justify-center text-xl mb-2 shadow-md">
                                    <i class="fa-solid fa-hand-holding-dollar"></i>
                                </div>
                                <span class="font-black text-slate-900 text-sm block">Cash on Deliv</span>
                                <span class="text-[10px] text-slate-600 font-extrabold uppercase mt-1">Pay on Arrival</span>
                            </label>
                        </div>

                        <!-- Western Union Payment Details & Dynamic QR Box -->
                        <div x-show="paymentMethod === 'westernunion'" class="bg-gradient-to-br from-slate-950 via-slate-900 to-slate-950 rounded-3xl p-6 sm:p-8 text-white border border-slate-800 space-y-6">
                            
                            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 border-b border-slate-800 pb-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-2xl bg-[#ffdd00] text-black flex items-center justify-center text-xl font-black shadow-md">
                                        <i class="fa-solid fa-bolt"></i>
                                    </div>
                                    <div>
                                        <h3 class="font-black text-white text-base">Western Union Dynamic QR Pay</h3>
                                        <p class="text-xs text-amber-300 font-medium">Scan with Western Union Mobile App or visit any Agent</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2">
                                    <label class="flex items-center gap-2 cursor-pointer text-xs font-bold text-slate-300">
                                        <input type="checkbox" x-model="wuShowAmount" class="rounded border-slate-700 text-rose-500 focus:ring-0">
                                        <span>Lock ${{ number_format($total, 2) }} in QR</span>
                                    </label>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-12 gap-6 items-center">
                                <!-- QR Display -->
                                <div class="md:col-span-5 flex flex-col items-center text-center">
                                    <div class="bg-white p-4 rounded-3xl shadow-xl inline-block border-2 border-slate-700">
                                        <img :src="getWuQrUrl()" alt="Western Union Receiver QR" class="w-44 h-44 sm:w-48 sm:h-48 object-contain rounded-xl">
                                    </div>
                                    <span class="text-[11px] text-slate-400 mt-2 font-mono" x-text="wuShowAmount ? 'Fixed Amount: ${{ number_format($total, 2) }} USD' : 'General Receiver QR'"></span>
                                </div>

                                <!-- Instructions & Receiver Details -->
                                <div class="md:col-span-7 space-y-3">
                                    <div class="bg-slate-900/90 rounded-2xl p-4 border border-slate-800 space-y-2 text-xs">
                                        <div class="flex justify-between items-center py-1 border-b border-slate-800">
                                            <span class="text-slate-400">Receiver Name:</span>
                                            <span class="font-mono font-bold text-white">{{ $settings['wu_receiver_name'] }}</span>
                                        </div>
                                        <div class="flex justify-between items-center py-1 border-b border-slate-800">
                                            <span class="text-slate-400">Payout Country:</span>
                                            <span class="font-bold text-white">{{ $settings['wu_country'] }}</span>
                                        </div>
                                        <div class="flex justify-between items-center py-1 border-b border-slate-800">
                                            <span class="text-slate-400">Payout City:</span>
                                            <span class="font-bold text-white">{{ $settings['wu_city'] }}</span>
                                        </div>
                                        <div class="flex justify-between items-center py-1">
                                            <span class="text-slate-400">Agent Code:</span>
                                            <span class="font-mono font-bold text-amber-300">{{ $settings['wu_agent_code'] }}</span>
                                        </div>
                                    </div>

                                    <!-- Step by Step -->
                                    <div class="text-[11px] text-slate-300 space-y-1">
                                        <p>1. Open Western Union app or visit any local agent location.</p>
                                        <p>2. Send <strong>${{ number_format($total, 2) }} USD</strong> to receiver <strong>{{ $settings['wu_receiver_name'] }}</strong>.</p>
                                        <p>3. Enter your <strong>10-Digit MTCN number</strong> below to verify your baby tracksuit order.</p>
                                    </div>
                                </div>
                            </div>

                            <!-- MTCN Input & Receipt Upload -->
                            <div class="pt-4 border-t border-slate-800 grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-extrabold text-amber-300 uppercase tracking-wider mb-1.5">Western Union MTCN Number (10 Digits) <span class="text-red-400">*</span></label>
                                    <input type="text" name="transaction_id" placeholder="e.g. 123-456-7890" class="w-full text-sm p-3.5 bg-slate-900 border border-slate-700 rounded-2xl text-white placeholder-slate-500 focus:ring-2 focus:ring-amber-400">
                                </div>
                                <div>
                                    <label class="block text-xs font-extrabold text-slate-300 uppercase tracking-wider mb-1.5">Upload Transfer Receipt (Optional)</label>
                                    <input type="file" name="payment_proof_image" accept="image/*" class="w-full text-xs p-2.5 bg-slate-900 border border-slate-700 rounded-2xl text-slate-300 file:mr-3 file:py-1 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-amber-400 file:text-slate-950 cursor-pointer">
                                </div>
                            </div>

                        </div>

                        <!-- Bank Wire Details Box -->
                        <div x-show="paymentMethod === 'bank_transfer'" class="bg-blue-50 border border-blue-200 rounded-3xl p-6 text-slate-900 space-y-4">
                            <h3 class="font-black text-blue-900 text-base flex items-center gap-2">
                                <i class="fa-solid fa-building-columns"></i> Global Bank Wire &bull; SWIFT Transfer Details
                            </h3>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs bg-white p-4 rounded-2xl border border-blue-100 font-medium">
                                <div><span class="text-slate-500">Bank Name:</span> <strong class="block text-slate-900">{{ $settings['bank_name'] }}</strong></div>
                                <div><span class="text-slate-500">Account Title:</span> <strong class="block text-slate-900">{{ $settings['bank_account_title'] }}</strong></div>
                                <div><span class="text-slate-500">Account / IBAN:</span> <strong class="block font-mono text-slate-900">{{ $settings['bank_iban'] }}</strong></div>
                                <div><span class="text-slate-500">SWIFT / BIC:</span> <strong class="block font-mono text-slate-900">{{ $settings['bank_swift'] }}</strong></div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 mb-1">Bank Wire Reference / Transaction ID</label>
                                    <input type="text" name="transaction_id" placeholder="e.g. WIRE-882910" class="w-full text-sm p-3 bg-white border border-slate-300 rounded-xl">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 mb-1">Upload Wire Slip / Receipt</label>
                                    <input type="file" name="payment_proof_image" accept="image/*" class="w-full text-xs p-2 bg-white border border-slate-300 rounded-xl">
                                </div>
                            </div>
                        </div>

                        <!-- Card Details Box -->
                        <div x-show="paymentMethod === 'card'" class="bg-emerald-50 border border-emerald-200 rounded-3xl p-6 text-slate-900 space-y-3">
                            <h3 class="font-black text-emerald-900 text-base flex items-center gap-2">
                                <i class="fa-solid fa-credit-card"></i> Credit / Debit Card Payment
                            </h3>
                            <p class="text-xs text-slate-600">
                                You will be redirected to the secure 3D Visa/MasterCard payment portal upon placing your order.
                            </p>
                        </div>

                        <!-- COD Details Box -->
                        <div x-show="paymentMethod === 'cod'" class="bg-slate-100 border border-slate-200 rounded-3xl p-6 text-slate-900 space-y-2">
                            <h3 class="font-black text-slate-900 text-base flex items-center gap-2">
                                <i class="fa-solid fa-hand-holding-dollar"></i> Cash on Delivery (COD)
                            </h3>
                            <p class="text-xs text-slate-600">
                                Pay the total amount in cash to the delivery rider upon receiving your package at your doorstep.
                            </p>
                        </div>

                    </div>

                </div>

                <!-- Right Column: Order Summary Card -->
                <div class="lg:col-span-4 space-y-6">
                    <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-xs space-y-6 sticky top-24">
                        
                        <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                            <h3 class="font-black text-slate-900 text-lg">Order Summary</h3>
                            <span class="bg-rose-50 text-rose-600 text-xs font-extrabold px-2.5 py-1 rounded-xl">
                                {{ count($cart) }} Outfits
                            </span>
                        </div>

                        <!-- Items List -->
                        <div class="space-y-3 max-h-60 overflow-y-auto pr-1">
                            @foreach($cart as $item)
                                <div class="flex items-center gap-3 py-1">
                                    <div class="w-12 h-12 rounded-xl bg-slate-50 border border-slate-200 overflow-hidden flex items-center justify-center p-1 shrink-0">
                                        <img src="{{ $item['image'] ?? 'https://images.unsplash.com/photo-1522771930-78848d9293e8?w=800' }}" alt="{{ $item['name'] }}" class="max-h-full max-w-full object-cover rounded-lg">
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h4 class="font-bold text-slate-900 text-xs truncate">{{ $item['name'] }}</h4>
                                        <p class="text-[11px] text-slate-500">Qty: {{ $item['quantity'] }} &bull; ${{ number_format($item['price'], 2) }}</p>
                                    </div>
                                    <span class="font-extrabold text-slate-900 text-xs">
                                        ${{ number_format($item['price'] * $item['quantity'], 2) }}
                                    </span>
                                </div>
                            @endforeach
                        </div>

                        <!-- Cost Breakdown -->
                        <div class="space-y-2.5 pt-4 border-t border-slate-100 text-xs">
                            <div class="flex justify-between text-slate-600">
                                <span>Bag Subtotal</span>
                                <span class="font-bold text-slate-900">${{ number_format($subtotal, 2) }}</span>
                            </div>

                            <div class="flex justify-between text-slate-600">
                                <span>Worldwide Express Shipping</span>
                                @if($effectiveShipping == 0)
                                    <span class="font-bold text-emerald-600 uppercase">FREE</span>
                                @else
                                    <span class="font-bold text-slate-900">${{ number_format($effectiveShipping, 2) }}</span>
                                @endif
                            </div>

                            <div class="pt-3 border-t border-slate-100 flex justify-between items-baseline">
                                <span class="font-black text-slate-900 text-sm">Total Payable</span>
                                <span class="font-black text-2xl text-rose-600">
                                    ${{ number_format($total, 2) }} <span class="text-xs font-bold text-slate-400">USD</span>
                                </span>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-2">
                            <button type="submit" class="w-full py-4 px-6 rounded-2xl font-black text-sm text-white bg-gradient-to-r from-rose-500 via-amber-500 to-rose-600 hover:from-rose-600 hover:to-amber-600 shadow-xl shadow-rose-500/25 transition duration-200 flex items-center justify-center gap-2 touch-press cursor-pointer">
                                <i class="fa-solid fa-lock"></i>
                                <span>Place Order ($<span x-text="'{{ number_format($total, 2) }}'"></span> USD)</span>
                            </button>
                        </div>

                        <div class="text-[11px] text-slate-400 text-center space-y-1">
                            <p class="flex items-center justify-center gap-1">
                                <i class="fa-solid fa-shield-halved text-emerald-500"></i> 100% Secure Checkout Guarantee
                            </p>
                            <p>Shipped via DHL / FedEx Express with Live Tracking</p>
                        </div>

                    </div>
                </div>

            </div>
        </form>
    </div>

    <!-- Leaflet Script for GPS Location Detector -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let defaultLat = 40.7128;
            let defaultLng = -74.0060;

            let map = L.map('checkout-map').setView([defaultLat, defaultLng], 12);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; OpenStreetMap'
            }).addTo(map);

            let marker = L.marker([defaultLat, defaultLng], { draggable: true }).addTo(map);

            function updateCoords(lat, lng) {
                document.getElementById('latitude_input').value = lat.toFixed(6);
                document.getElementById('longitude_input').value = lng.toFixed(6);
                document.getElementById('coords-display').innerText = 'Lat: ' + lat.toFixed(4) + ', Lng: ' + lng.toFixed(4);
            }

            marker.on('dragend', function(e) {
                let position = marker.getLatLng();
                updateCoords(position.lat, position.lng);
            });

            map.on('click', function(e) {
                marker.setLatLng(e.latlng);
                updateCoords(e.latlng.lat, e.latlng.lng);
            });

            document.getElementById('btn-detect-gps').addEventListener('click', function() {
                if (navigator.geolocation) {
                    this.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Detecting...';
                    navigator.geolocation.getCurrentPosition(
                        (position) => {
                            let lat = position.coords.latitude;
                            let lng = position.coords.longitude;
                            map.setView([lat, lng], 15);
                            marker.setLatLng([lat, lng]);
                            updateCoords(lat, lng);
                            this.innerHTML = '<i class="fa-solid fa-check"></i> Location Detected!';
                            setTimeout(() => {
                                this.innerHTML = '<i class="fa-solid fa-location-crosshairs text-sm"></i> <span>📍 Detect My Location</span>';
                            }, 3000);
                        },
                        (error) => {
                            alert('Could not auto-detect location. Please drag the pin on map manually.');
                            this.innerHTML = '<i class="fa-solid fa-location-crosshairs text-sm"></i> <span>📍 Detect My Location</span>';
                        }
                    );
                } else {
                    alert('Geolocation is not supported by your browser.');
                }
            });
        });
    </script>

</x-app-layout>