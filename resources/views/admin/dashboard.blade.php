<x-app-layout>

    <!-- Admin Header Bar -->
    <div class="bg-slate-900 text-white py-8 border-b border-slate-800 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-96 h-96 bg-amber-500/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4 relative z-10">
            <div>
                <span class="text-xs font-black uppercase tracking-widest text-amber-400">TinyChamps Control Center</span>
                <h1 class="text-3xl font-black text-white mt-1">Admin Management Dashboard</h1>
            </div>

            <div class="flex flex-wrap items-center gap-2">
                <a href="{{ route('admin.orders.index') }}" class="bg-slate-800 hover:bg-amber-600 text-white text-xs font-bold px-3.5 py-2.5 rounded-xl border border-slate-700 transition flex items-center gap-1.5">
                    <i class="fa-solid fa-box-open"></i> Orders
                </a>
                <a href="{{ route('admin.products.index') }}" class="bg-slate-800 hover:bg-amber-600 text-white text-xs font-bold px-3.5 py-2.5 rounded-xl border border-slate-700 transition flex items-center gap-1.5">
                    <i class="fa-solid fa-vest-patches"></i> Tracksuits
                </a>
                <a href="{{ route('admin.categories.index') }}" class="bg-slate-800 hover:bg-amber-600 text-white text-xs font-bold px-3.5 py-2.5 rounded-xl border border-slate-700 transition flex items-center gap-1.5">
                    <i class="fa-solid fa-list"></i> Categories
                </a>
                <a href="{{ route('admin.settings.index') }}" class="bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-600 hover:to-orange-600 text-slate-950 font-black text-xs px-4 py-2.5 rounded-xl shadow-lg shadow-amber-500/20 transition flex items-center gap-1.5">
                    <i class="fa-solid fa-qrcode"></i> Western Union &amp; Rates
                </a>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-10">
        
        <!-- Metrics Cards Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            
            <!-- Total Revenue -->
            <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs flex items-center justify-between hover:shadow-xl hover:border-emerald-300 transition-all duration-300">
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Total Global Revenue</span>
                    <h3 class="text-2xl font-black text-slate-900 mt-1">${{ number_format($totalRevenue, 2) }}</h3>
                    <p class="text-[11px] text-emerald-600 font-bold mt-1"><i class="fa-solid fa-arrow-trend-up"></i> Lifetime sales (USD)</p>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-2xl shadow-xs">
                    <i class="fa-solid fa-sack-dollar"></i>
                </div>
            </div>

            <!-- Total Orders -->
            <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs flex items-center justify-between hover:shadow-xl hover:border-blue-300 transition-all duration-300">
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Worldwide Orders</span>
                    <h3 class="text-2xl font-black text-slate-900 mt-1">{{ number_format($totalOrders) }}</h3>
                    <p class="text-[11px] text-blue-600 font-bold mt-1">{{ $pendingOrders }} Pending Verification</p>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center text-2xl shadow-xs">
                    <i class="fa-solid fa-cart-shopping"></i>
                </div>
            </div>

            <!-- Products in Stock -->
            <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs flex items-center justify-between hover:shadow-xl hover:border-amber-300 transition-all duration-300">
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Live Tracksuits</span>
                    <h3 class="text-2xl font-black text-slate-900 mt-1">{{ number_format($totalProducts) }}</h3>
                    <a href="{{ route('admin.products.create') }}" class="text-[11px] text-amber-600 font-black hover:underline mt-1 inline-block">+ Add Tracksuit</a>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center text-2xl shadow-xs">
                    <i class="fa-solid fa-vest"></i>
                </div>
            </div>

            <!-- Registered Customers -->
            <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs flex items-center justify-between hover:shadow-xl hover:border-purple-300 transition-all duration-300">
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Global Customers</span>
                    <h3 class="text-2xl font-black text-slate-900 mt-1">{{ number_format($totalCustomers) }}</h3>
                    <p class="text-[11px] text-purple-600 font-bold mt-1">Verified Accounts</p>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-purple-50 text-purple-600 flex items-center justify-center text-2xl shadow-xs">
                    <i class="fa-solid fa-users"></i>
                </div>
            </div>

        </div>

        <!-- Recent Orders & Fast Actions -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            
            <!-- Recent Orders Table -->
            <div class="lg:col-span-8 bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-8 shadow-xs space-y-6">
                <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                    <div>
                        <h2 class="font-black text-slate-900 text-lg">Incoming Customer Orders</h2>
                        <p class="text-xs text-slate-500">Live orders with Western Union MTCN, proof receipt &amp; address</p>
                    </div>
                    <a href="{{ route('admin.orders.index') }}" class="text-xs font-bold text-amber-600 hover:underline">
                        View All Orders ({{ $totalOrders }}) →
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs">
                        <thead class="bg-slate-50 uppercase text-slate-400 font-black border-b border-slate-100">
                            <tr>
                                <th class="p-3">Order</th>
                                <th class="p-3">Customer</th>
                                <th class="p-3">Payment</th>
                                <th class="p-3">Status</th>
                                <th class="p-3">Total</th>
                                <th class="p-3 text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($recentOrders as $order)
                                <tr class="hover:bg-slate-50/80 transition">
                                    <td class="p-3 font-mono font-black text-slate-900">
                                        #{{ $order->order_number }}
                                        <span class="block text-[10px] text-slate-400 font-sans font-normal">{{ $order->created_at->diffForHumans() }}</span>
                                    </td>
                                    <td class="p-3">
                                        <span class="font-bold text-slate-900 block">{{ $order->customer_name ?: ($order->user->name ?? 'User') }}</span>
                                        <span class="text-slate-400 font-mono">{{ $order->customer_phone }}</span>
                                    </td>
                                    <td class="p-3">
                                        <span class="font-bold text-slate-800">{{ $order->payment_method_label }}</span>
                                        <span class="block text-[10px] font-bold {{ $order->payment_status === 'Paid' ? 'text-emerald-600' : 'text-amber-600' }}">
                                            {{ $order->payment_status }}
                                        </span>
                                    </td>
                                    <td class="p-3">
                                        @php
                                            $badgeColor = match($order->status) {
                                                'Delivered' => 'bg-emerald-100 text-emerald-800',
                                                'Shipped' => 'bg-blue-100 text-blue-800',
                                                'Processing' => 'bg-purple-100 text-purple-800',
                                                'Cancelled' => 'bg-rose-100 text-rose-800',
                                                default => 'bg-amber-100 text-amber-800',
                                            };
                                        @endphp
                                        <span class="px-2.5 py-1 rounded-full text-[10px] font-black {{ $badgeColor }}">
                                            {{ $order->status }}
                                        </span>
                                    </td>
                                    <td class="p-3 font-black text-slate-900">
                                        ${{ number_format($order->total, 2) }}
                                    </td>
                                    <td class="p-3 text-right">
                                        <a href="{{ route('admin.orders.show', $order->id) }}" class="bg-amber-50 hover:bg-amber-600 text-amber-700 hover:text-white font-black text-[11px] px-3.5 py-1.5 rounded-xl border border-amber-200 transition inline-block">
                                            Verify &amp; Manage
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="p-8 text-center text-slate-400">No orders received yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Quick Management Tools Sidebar -->
            <div class="lg:col-span-4 space-y-6">
                
                <!-- Payment Gateways Quick Box -->
                <div class="bg-gradient-to-br from-slate-950 via-slate-900 to-slate-950 rounded-3xl p-6 text-white space-y-4 shadow-xl border border-slate-800">
                    <div class="flex items-center justify-between">
                        <h3 class="font-black text-base flex items-center gap-2">
                            <i class="fa-solid fa-qrcode text-amber-400"></i> Active Global Receiver
                        </h3>
                        <a href="{{ route('admin.settings.index') }}" class="text-xs text-amber-400 font-bold hover:underline">Edit</a>
                    </div>
                    <div class="space-y-3 text-xs">
                        <div class="bg-slate-900/90 p-3.5 rounded-2xl border border-slate-800 flex items-center justify-between">
                            <div class="flex items-center gap-2.5">
                                <span class="w-3 h-3 rounded-full bg-amber-500 animate-pulse"></span>
                                <span class="font-bold">Western Union:</span>
                            </div>
                            <span class="font-bold text-amber-400 text-[11px]">{{ \App\Models\Setting::get('wu_receiver_name', 'TINYCHAMPS KIDSWEAR LLC') }}</span>
                        </div>
                        <div class="bg-slate-900/90 p-3.5 rounded-2xl border border-slate-800 flex items-center justify-between">
                            <div class="flex items-center gap-2.5">
                                <span class="w-3 h-3 rounded-full bg-blue-500 animate-pulse"></span>
                                <span class="font-bold">Bank Wire:</span>
                            </div>
                            <span class="font-mono text-blue-400 font-bold text-[11px]">{{ \App\Models\Setting::get('bank_name', 'JP Morgan Chase Bank') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Shortcuts -->
                <div class="bg-white rounded-3xl border border-slate-200/80 p-6 shadow-xs space-y-3">
                    <h3 class="font-black text-slate-900 text-xs uppercase tracking-wider mb-2">Management Shortcuts</h3>
                    <a href="{{ route('admin.products.create') }}" class="flex items-center justify-between p-3.5 rounded-2xl bg-slate-50 hover:bg-amber-50 hover:text-amber-600 transition text-xs font-bold text-slate-700">
                        <span class="flex items-center gap-2"><i class="fa-solid fa-circle-plus text-amber-600"></i> Add Baby Tracksuit</span>
                        <i class="fa-solid fa-chevron-right text-[10px] text-slate-400"></i>
                    </a>
                    <a href="{{ route('admin.categories.index') }}" class="flex items-center justify-between p-3.5 rounded-2xl bg-slate-50 hover:bg-amber-50 hover:text-amber-600 transition text-xs font-bold text-slate-700">
                        <span class="flex items-center gap-2"><i class="fa-solid fa-list text-amber-600"></i> Manage Categories</span>
                        <i class="fa-solid fa-chevron-right text-[10px] text-slate-400"></i>
                    </a>
                    <a href="{{ route('admin.settings.index') }}" class="flex items-center justify-between p-3.5 rounded-2xl bg-slate-50 hover:bg-amber-50 hover:text-amber-600 transition text-xs font-bold text-slate-700">
                        <span class="flex items-center gap-2"><i class="fa-solid fa-gear text-amber-600"></i> Payment &amp; Store Settings</span>
                        <i class="fa-solid fa-chevron-right text-[10px] text-slate-400"></i>
                    </a>
                </div>

            </div>

        </div>

    </div>

</x-app-layout>