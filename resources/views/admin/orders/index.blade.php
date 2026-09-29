<x-app-layout>

    <div class="bg-gray-900 text-white py-6 border-b border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <span class="text-xs font-black uppercase tracking-widest text-amber-400">Order Management</span>
                <h1 class="text-2xl sm:text-3xl font-black text-white mt-1">All Customer Orders</h1>
            </div>

            <div class="flex items-center gap-2">
                <a href="{{ route('admin.dashboard') }}" class="bg-gray-800 hover:bg-gray-700 text-white text-xs font-bold px-3.5 py-2 rounded-xl transition">
                    ← Back to Dashboard
                </a>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-6">
        
        <!-- Filters & Search Bar -->
        <div class="bg-white rounded-2xl p-5 border border-gray-200 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-4">
            <!-- Status Tabs -->
            <div class="flex flex-wrap items-center gap-2 text-xs">
                @php
                    $tabs = [
                        '' => 'All Orders',
                        'Pending' => 'Pending',
                        'Processing' => 'Processing',
                        'Shipped' => 'Shipped',
                        'Delivered' => 'Delivered',
                        'Cancelled' => 'Cancelled',
                    ];
                @endphp

                @foreach($tabs as $key => $label)
                    <a href="{{ route('admin.orders.index', array_merge(request()->except('page'), ['status' => $key])) }}" 
                       class="px-3 py-1.5 rounded-xl font-bold transition {{ request('status') === $key ? 'bg-orange-600 text-white shadow-sm' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                        {{ $label }}
                    </a>
                @endforeach
            </div>

            <!-- Search Form -->
            <form action="{{ route('admin.orders.index') }}" method="GET" class="relative min-w-[280px]">
                @if(request('status'))
                    <input type="hidden" name="status" value="{{ request('status') }}">
                @endif
                <input type="text" name="query" value="{{ request('query') }}" placeholder="Search by Order #, Name, TID..." class="w-full text-xs pl-8 pr-16 py-2 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-orange-500">
                <i class="fa-solid fa-magnifying-glass absolute left-3 top-2.5 text-gray-400 text-xs"></i>
                <button type="submit" class="absolute right-1 top-1 bottom-1 bg-gray-900 text-white text-[11px] font-bold px-3 rounded-lg">
                    Search
                </button>
            </form>
        </div>

        <!-- Orders Table -->
        <div class="bg-white rounded-3xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs text-gray-600">
                    <thead class="bg-gray-50 uppercase text-gray-400 font-black border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-4">Order Details</th>
                            <th class="px-6 py-4">Customer</th>
                            <th class="px-6 py-4">Payment Method & Status</th>
                            <th class="px-6 py-4">Delivery Status</th>
                            <th class="px-6 py-4">Total Amount</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($orders as $order)
                            <tr class="hover:bg-gray-50/80 transition">
                                <td class="px-6 py-4 font-mono">
                                    <span class="font-extrabold text-gray-900 text-sm block">#{{ $order->order_number }}</span>
                                    <span class="text-[11px] text-gray-400 font-sans">{{ $order->created_at->format('d M Y, h:i A') }}</span>
                                </td>

                                <td class="px-6 py-4">
                                    <span class="font-bold text-gray-900 text-sm block">{{ $order->customer_name ?: ($order->user->name ?? 'Guest') }}</span>
                                    <span class="text-gray-500 block">{{ $order->customer_phone }}</span>
                                    <span class="text-gray-400 text-[11px]">{{ $order->city }}</span>
                                </td>

                                <td class="px-6 py-4">
                                    <span class="font-bold text-gray-900 block">{{ $order->payment_method_label }}</span>
                                    @if($order->transaction_id)
                                        <span class="font-mono text-[11px] text-gray-500 block">TID: {{ $order->transaction_id }}</span>
                                    @endif
                                    <span class="inline-block text-[10px] font-black px-2 py-0.5 rounded mt-1 {{ $order->payment_status === 'Paid' ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }}">
                                        {{ $order->payment_status }}
                                    </span>
                                </td>

                                <td class="px-6 py-4">
                                    @php
                                        $badgeColor = match($order->status) {
                                            'Delivered' => 'bg-emerald-100 text-emerald-800',
                                            'Shipped' => 'bg-blue-100 text-blue-800',
                                            'Processing' => 'bg-purple-100 text-purple-800',
                                            'Cancelled' => 'bg-red-100 text-red-800',
                                            default => 'bg-amber-100 text-amber-800',
                                        };
                                    @endphp
                                    <span class="inline-flex items-center gap-1.5 text-xs font-black px-3 py-1 rounded-full {{ $badgeColor }}">
                                        {{ $order->status }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 font-black text-gray-900 text-sm">
                                    Rs {{ number_format($order->total) }}
                                </td>

                                <td class="px-6 py-4 text-right space-x-2">
                                    <a href="{{ route('admin.orders.show', $order->id) }}" class="inline-block bg-orange-50 hover:bg-orange-600 text-orange-600 hover:text-white font-bold text-xs px-3.5 py-1.5 rounded-lg border border-orange-200 transition">
                                        Verify & View
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="p-12 text-center text-gray-400">
                                    No orders found for this criteria.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-4 border-t border-gray-100">
                {{ $orders->links() }}
            </div>
        </div>

    </div>

</x-app-layout>
