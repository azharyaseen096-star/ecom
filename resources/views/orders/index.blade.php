<x-app-layout>

    <div class="bg-rose-50/70 border-b border-rose-100 py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-extrabold text-slate-900">My Orders &amp; Tracksuits</h1>
            <p class="text-sm text-slate-500 mt-1">Track your past purchases, shipment statuses and download international invoices</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-10">
        @if($orders->count() > 0)
            <!-- Mobile Order Cards (md:hidden) -->
            <div class="md:hidden space-y-4">
                @foreach($orders as $order)
                    @php
                        $badgeColor = match($order->status) {
                            'Delivered' => 'bg-emerald-100 text-emerald-800',
                            'Shipped' => 'bg-blue-100 text-blue-800',
                            'Processing' => 'bg-purple-100 text-purple-800',
                            'Cancelled' => 'bg-red-100 text-red-800',
                            default => 'bg-amber-100 text-amber-800',
                        };
                    @endphp
                    <div class="bg-white rounded-3xl p-5 border border-slate-200/80 shadow-xs space-y-3">
                        <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                            <div>
                                <span class="text-xs font-mono font-black text-slate-900">#{{ $order->order_number }}</span>
                                <span class="text-[11px] text-slate-400 block">{{ $order->created_at->format('d M Y, h:i A') }}</span>
                            </div>
                            <span class="inline-flex items-center text-[11px] font-black px-3 py-1 rounded-full {{ $badgeColor }}">
                                {{ $order->status }}
                            </span>
                        </div>

                        <div class="flex items-center justify-between text-xs">
                            <span class="text-slate-500">{{ $order->items->count() }} {{ Str::plural('Suit', $order->items->count()) }} ({{ $order->payment_method_label }})</span>
                            <span class="text-base font-black text-slate-900">${{ number_format($order->total, 2) }} USD</span>
                        </div>

                        <div class="pt-2 flex items-center gap-2">
                            <a href="{{ route('orders.show', $order->id) }}" class="flex-1 py-2.5 bg-rose-50 hover:bg-rose-600 text-rose-600 hover:text-white font-extrabold text-xs rounded-xl border border-rose-200 text-center transition">
                                Track Order Status
                            </a>
                            <a href="{{ route('orders.invoice', $order->id) }}" target="_blank" class="p-2.5 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-xl transition" title="Print Invoice">
                                <i class="fa-solid fa-print"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Desktop Order Table (hidden md:block) -->
            <div class="hidden md:block bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-slate-600">
                        <thead class="bg-slate-50 text-xs uppercase font-extrabold text-slate-500 border-b border-slate-200">
                            <tr>
                                <th class="px-6 py-4">Order Details</th>
                                <th class="px-6 py-4">Date</th>
                                <th class="px-6 py-4">Payment</th>
                                <th class="px-6 py-4">Order Status</th>
                                <th class="px-6 py-4">Total Amount</th>
                                <th class="px-6 py-4 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach($orders as $order)
                                <tr class="hover:bg-slate-50/80 transition">
                                    <td class="px-6 py-4">
                                        <span class="font-mono font-extrabold text-slate-900 block">#{{ $order->order_number }}</span>
                                        <span class="text-xs text-slate-400">{{ $order->items->count() }} {{ Str::plural('suit', $order->items->count()) }}</span>
                                    </td>

                                    <td class="px-6 py-4 text-xs">
                                        {{ $order->created_at->format('d M Y') }}
                                        <span class="block text-[11px] text-slate-400">{{ $order->created_at->format('h:i A') }}</span>
                                    </td>

                                    <td class="px-6 py-4">
                                        <span class="font-semibold text-xs text-slate-800 block">{{ $order->payment_method_label }}</span>
                                        <span class="inline-block text-[10px] font-bold px-2 py-0.5 rounded mt-0.5 {{ $order->payment_status === 'Paid' ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }}">
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

                                    <td class="px-6 py-4 font-black text-slate-900">
                                        ${{ number_format($order->total, 2) }} USD
                                    </td>

                                    <td class="px-6 py-4 text-right space-x-2">
                                        <a href="{{ route('orders.show', $order->id) }}" class="inline-block bg-rose-50 hover:bg-rose-600 text-rose-600 hover:text-white font-bold text-xs px-3.5 py-1.5 rounded-lg border border-rose-200 transition">
                                            Track Order
                                        </a>
                                        <a href="{{ route('orders.invoice', $order->id) }}" target="_blank" class="inline-block text-slate-400 hover:text-slate-800 p-1.5" title="Print Invoice">
                                            <i class="fa-solid fa-print"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="p-4 border-t border-slate-100">
                    {{ $orders->links() }}
                </div>
            </div>
        @else
            <div class="bg-white rounded-3xl p-16 text-center border border-slate-200 shadow-sm max-w-xl mx-auto">
                <div class="w-16 h-16 bg-rose-50 text-rose-500 rounded-full flex items-center justify-center mx-auto text-2xl mb-4">
                    <i class="fa-solid fa-box-open"></i>
                </div>
                <h2 class="text-xl font-bold text-slate-900">No Orders Placed Yet</h2>
                <p class="text-sm text-slate-500 mt-1">Once you order baby tracksuits via Western Union, Cards or Bank Wire, they will appear here.</p>
                <div class="mt-6">
                    <a href="{{ route('shop') }}" class="inline-block bg-rose-600 text-white font-bold text-xs px-6 py-3 rounded-xl shadow hover:bg-rose-700 transition">
                        Shop Baby Tracksuits Now
                    </a>
                </div>
            </div>
        @endif
    </div>

</x-app-layout>
