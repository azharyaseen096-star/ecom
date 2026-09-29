<x-app-layout>

    <!-- User Profile Header Banner -->
    <div class="bg-gradient-to-r from-slate-950 via-slate-900 to-amber-950 text-white py-10 border-b border-slate-800 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-96 h-96 bg-amber-500/15 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-0 left-1/3 w-80 h-80 bg-rose-500/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                
                <div class="flex items-center gap-4">
                    <div class="w-20 h-20 rounded-3xl bg-gradient-to-tr from-amber-400 via-orange-500 to-rose-500 text-white flex items-center justify-center text-3xl font-black shadow-xl shadow-amber-500/20 border-2 border-amber-300/40">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <div>
                        <div class="flex items-center gap-2">
                            <h1 class="text-2xl sm:text-3xl font-black text-white">{{ $user->name }}</h1>
                            @if($user->email_verified_at)
                                <span class="bg-emerald-500/20 text-emerald-400 border border-emerald-500/30 text-[11px] font-extrabold px-2.5 py-0.5 rounded-full flex items-center gap-1">
                                    <i class="fa-solid fa-circle-check"></i> Verified Member
                                </span>
                            @endif
                        </div>
                        <p class="text-xs sm:text-sm text-slate-400 mt-1 flex items-center gap-2">
                            <span><i class="fa-solid fa-envelope text-xs text-amber-400"></i> {{ $user->email }}</span>
                            @if($user->phone)
                                <span>•</span>
                                <span><i class="fa-solid fa-phone text-xs text-emerald-400"></i> {{ $user->phone }}</span>
                            @endif
                        </p>
                    </div>
                </div>

                <div class="flex flex-wrap items-center gap-3">
                    <a href="{{ route('shop') }}" class="bg-gradient-to-r from-amber-500 via-orange-500 to-rose-500 hover:from-amber-600 hover:to-rose-600 text-white font-black text-xs px-5 py-3 rounded-2xl shadow-lg shadow-amber-500/20 transition flex items-center gap-2">
                        <i class="fa-solid fa-vest"></i>
                        <span>Shop Tracksuits</span>
                    </a>
                    <a href="{{ route('profile.edit') }}" class="bg-slate-800 hover:bg-slate-700 text-slate-200 hover:text-white font-bold text-xs px-4 py-3 rounded-2xl border border-slate-700 transition flex items-center gap-1.5">
                        <i class="fa-solid fa-gear text-amber-400"></i>
                        <span>Settings</span>
                    </a>
                </div>

            </div>
        </div>
    </div>

    <!-- Dashboard Content Area -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-8">
        
        <!-- 4 Animated KPI Metric Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            
            <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs flex items-center justify-between hover:shadow-xl hover:border-amber-300 transition-all duration-300">
                <div>
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block">Total Orders</span>
                    <span class="text-3xl font-black text-slate-900 mt-1 block">{{ $totalOrdersCount }}</span>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center text-2xl">
                    <i class="fa-solid fa-box"></i>
                </div>
            </div>

            <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs flex items-center justify-between hover:shadow-xl hover:border-amber-300 transition-all duration-300">
                <div>
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block">In Progress</span>
                    <span class="text-3xl font-black text-amber-600 mt-1 block">{{ $pendingOrdersCount }}</span>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center text-2xl">
                    <i class="fa-solid fa-clock-rotate-left"></i>
                </div>
            </div>

            <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs flex items-center justify-between hover:shadow-xl hover:border-emerald-300 transition-all duration-300">
                <div>
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block">Delivered</span>
                    <span class="text-3xl font-black text-emerald-600 mt-1 block">{{ $deliveredOrdersCount }}</span>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-2xl">
                    <i class="fa-solid fa-circle-check"></i>
                </div>
            </div>

            <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs flex items-center justify-between hover:shadow-xl hover:border-blue-300 transition-all duration-300">
                <div>
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block">Total Spent</span>
                    <span class="text-2xl font-black text-slate-900 mt-1 block">${{ number_format($totalSpent, 2) }}</span>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center text-2xl">
                    <i class="fa-solid fa-wallet"></i>
                </div>
            </div>

        </div>

        <!-- Recent Orders & Profile Quick Actions -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            
            <!-- Left: Recent Orders List -->
            <div class="lg:col-span-8 bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-8 shadow-xs space-y-6">
                <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                    <div>
                        <h2 class="font-black text-slate-900 text-lg">Recent Orders</h2>
                        <p class="text-xs text-slate-500">Track and view your baby tracksuit orders</p>
                    </div>
                    <a href="{{ route('orders.index') }}" class="text-xs font-black text-amber-600 hover:text-amber-700 flex items-center gap-1">
                        <span>View All ({{ $totalOrdersCount }})</span>
                        <i class="fa-solid fa-arrow-right text-[10px]"></i>
                    </a>
                </div>

                @if($orders->isEmpty())
                    <div class="text-center py-12">
                        <div class="w-16 h-16 rounded-3xl bg-amber-50 text-amber-600 flex items-center justify-center text-2xl mx-auto mb-4">
                            <i class="fa-solid fa-baby"></i>
                        </div>
                        <h3 class="font-black text-slate-900 text-base">No Orders Placed Yet</h3>
                        <p class="text-xs text-slate-500 max-w-sm mx-auto mt-1 mb-6">Explore our adorable baby tracksuit collections with instant Western Union QR checkout.</p>
                        <a href="{{ route('shop') }}" class="inline-flex items-center gap-2 bg-slate-950 hover:bg-amber-600 text-white font-black text-xs px-6 py-3 rounded-2xl transition shadow">
                            Shop Baby Tracksuits
                        </a>
                    </div>
                @else
                    <div class="space-y-4">
                        @foreach($orders as $order)
                            <div class="p-4 sm:p-5 rounded-2xl border border-slate-200/90 hover:border-amber-300 hover:shadow-md transition-all duration-200 bg-slate-50/50 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                                <div class="space-y-1">
                                    <div class="flex items-center gap-2">
                                        <span class="font-mono font-black text-sm text-slate-900">{{ $order->order_number ?: 'ORD-'.$order->id }}</span>
                                        <span class="text-[11px] font-black px-2.5 py-0.5 rounded-full {{ $order->status === 'Delivered' ? 'bg-emerald-100 text-emerald-800' : ($order->status === 'Pending' ? 'bg-amber-100 text-amber-800' : 'bg-blue-100 text-blue-800') }}">
                                            {{ $order->status }}
                                        </span>
                                    </div>
                                    <p class="text-xs text-slate-500">
                                        Placed on {{ $order->created_at->format('d M Y, h:i A') }} • {{ count($order->items) }} {{ Str::plural('Item', count($order->items)) }}
                                    </p>
                                    <div class="text-xs text-slate-700 font-semibold flex items-center gap-2 pt-1">
                                        <span>Payment: <strong>{{ $order->payment_method_label }}</strong></span>
                                        <span>•</span>
                                        <span class="text-amber-600 font-black">${{ number_format($order->total, 2) }}</span>
                                    </div>
                                </div>

                                <div class="flex items-center gap-2 self-end sm:self-center">
                                    <a href="{{ route('orders.show', $order->id) }}" class="bg-white hover:bg-amber-50 text-slate-800 hover:text-amber-600 font-black text-xs px-4 py-2 rounded-xl border border-slate-200 transition shadow-xs flex items-center gap-1.5">
                                        <i class="fa-solid fa-eye text-xs"></i> Details
                                    </a>
                                    <a href="{{ route('orders.invoice', $order->id) }}" class="bg-slate-900 hover:bg-slate-800 text-white font-black text-xs px-4 py-2 rounded-xl transition shadow-xs flex items-center gap-1.5">
                                        <i class="fa-solid fa-file-invoice text-xs"></i> Invoice
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Right: Account Overview & Fast Help -->
            <div class="lg:col-span-4 space-y-6">
                
                <!-- Account Info Box -->
                <div class="bg-white rounded-3xl border border-slate-200/80 p-6 shadow-xs space-y-4">
                    <h3 class="font-black text-slate-900 text-base border-b border-slate-100 pb-3">Delivery Address</h3>
                    <div class="space-y-2 text-xs text-slate-600">
                        <p class="font-bold text-slate-900 text-sm">{{ $user->name }}</p>
                        <p><i class="fa-solid fa-location-dot text-amber-500 mr-1.5"></i> {{ $user->address ?: 'No street address saved yet' }}</p>
                        <p><i class="fa-solid fa-city text-amber-500 mr-1.5"></i> {{ $user->city ?: 'City not specified' }}</p>
                        <p><i class="fa-solid fa-phone text-emerald-500 mr-1.5"></i> {{ $user->phone ?: 'No phone added' }}</p>
                    </div>
                    <div class="pt-2">
                        <a href="{{ route('profile.edit') }}" class="block text-center w-full py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-800 font-black text-xs rounded-xl transition">
                            Edit Profile &amp; Address
                        </a>
                    </div>
                </div>

                <!-- Support & Help -->
                <div class="bg-gradient-to-br from-slate-900 to-slate-800 text-white rounded-3xl p-6 shadow-xl space-y-3">
                    <div class="flex items-center gap-2 text-amber-400 font-black text-xs uppercase tracking-wider">
                        <i class="fa-solid fa-headset"></i> Worldwide Support
                    </div>
                    <h4 class="font-black text-base text-white">24/7 VIP Customer Care</h4>
                    <p class="text-xs text-slate-300 leading-relaxed">
                        Have queries regarding your baby tracksuit sizing, DHL/FedEx worldwide tracking, or Western Union payment?
                    </p>
                    <a href="mailto:support@tinychamps.com" class="block text-center w-full py-3 bg-amber-500 hover:bg-amber-400 text-slate-950 font-black text-xs rounded-xl shadow-lg shadow-amber-500/20 transition">
                        <i class="fa-solid fa-envelope mr-1 text-sm"></i> Email Support Desk
                    </a>
                </div>

            </div>

        </div>

    </div>

</x-app-layout>