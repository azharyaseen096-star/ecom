<x-app-layout>

    <div class="bg-slate-900 text-white py-6 border-b border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <div class="flex items-center gap-3">
                    <h1 class="text-2xl sm:text-3xl font-black text-white font-mono">Order #{{ $order->order_number }}</h1>
                    <span class="text-xs font-black px-3 py-1 rounded-full uppercase {{ $order->status === 'Delivered' ? 'bg-emerald-500 text-white' : ($order->status === 'Pending' ? 'bg-amber-500 text-slate-950' : 'bg-blue-500 text-white') }}">
                        {{ $order->status }}
                    </span>
                </div>
                <p class="text-xs text-slate-400 mt-1">Placed on {{ $order->created_at->format('d M Y, h:i A') }}</p>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ route('orders.invoice', $order->id) }}" target="_blank" class="bg-white hover:bg-slate-100 text-slate-900 font-extrabold text-xs px-4 py-2.5 rounded-xl border border-slate-200 shadow-sm transition flex items-center gap-1.5">
                    <i class="fa-solid fa-file-invoice text-rose-600"></i> Print Invoice
                </a>
                <a href="{{ route('orders.index') }}" class="bg-slate-800 hover:bg-slate-700 text-white font-bold text-xs px-4 py-2.5 rounded-xl border border-slate-700 transition">
                    ← All Orders
                </a>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-10 space-y-8">
        
        <!-- Live Order Status Stepper -->
        <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-8 shadow-xs">
            <h3 class="text-base font-black text-slate-900 mb-6">Order Status &amp; Worldwide Dispatch Timeline</h3>

            @php
                $statuses = ['Pending', 'Processing', 'Shipped', 'Delivered'];
                $currentIdx = array_search($order->status, $statuses);
                if ($currentIdx === false && $order->status === 'Cancelled') {
                    $isCancelled = true;
                } else {
                    $isCancelled = false;
                }
            @endphp

            @if($isCancelled)
                <div class="p-4 bg-red-50 text-red-700 border border-red-200 rounded-2xl font-bold text-sm text-center">
                    <i class="fa-solid fa-ban text-red-600 mr-2"></i> This order has been Cancelled.
                </div>
            @else
                <div class="relative">
                    <div class="hidden sm:block absolute top-1/2 left-0 right-0 h-1 bg-slate-200 -translate-y-1/2 z-0"></div>
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-6 relative z-10">
                        
                        @foreach($statuses as $index => $step)
                            @php
                                $isDone = ($currentIdx !== false && $index <= $currentIdx);
                                $isCurrent = ($currentIdx !== false && $index === $currentIdx);
                            @endphp
                            <div class="flex flex-col items-center text-center">
                                <div class="w-12 h-12 rounded-2xl flex items-center justify-center text-lg font-black transition shadow-md {{ $isDone ? 'bg-rose-600 text-white' : 'bg-slate-100 text-slate-400 border-2 border-slate-200' }}">
                                    @if($isDone)
                                        <i class="fa-solid fa-check"></i>
                                    @else
                                        <span>{{ $index + 1 }}</span>
                                    @endif
                                </div>
                                <span class="font-extrabold text-xs mt-3 {{ $isDone ? 'text-slate-900' : 'text-slate-400' }}">{{ $step }}</span>
                                @if($isCurrent)
                                    <span class="text-[10px] text-rose-600 font-black uppercase mt-0.5 bg-rose-50 px-2 py-0.5 rounded-full">Current State</span>
                                @endif
                            </div>
                        @endforeach

                    </div>
                </div>
            @endif
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            
            <!-- Items Table -->
            <div class="lg:col-span-8 bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-8 shadow-xs space-y-6">
                <h3 class="font-black text-slate-900 text-lg border-b border-slate-100 pb-4">
                    Baby Tracksuits ({{ $order->items->count() }})
                </h3>

                <div class="divide-y divide-slate-100">
                    @foreach($order->items as $item)
                        <div class="py-4 flex items-center gap-4">
                            <div class="w-16 h-16 bg-slate-50 rounded-2xl border border-slate-100 p-2 overflow-hidden flex items-center justify-center shrink-0">
                                <img src="{{ $item->product_image ?? 'https://images.unsplash.com/photo-1522771930-78848d9293e8?w=800' }}" alt="{{ $item->product_name }}" class="max-h-full max-w-full object-cover rounded-xl">
                            </div>

                            <div class="flex-1 min-w-0">
                                <h4 class="font-extrabold text-slate-900 text-sm truncate">{{ $item->product_name }}</h4>
                                <p class="text-xs text-slate-500">Qty: {{ $item->quantity }} × ${{ number_format($item->price, 2) }} USD</p>
                            </div>

                            <span class="font-black text-slate-900 text-sm">
                                ${{ number_format($item->total, 2) }} USD
                            </span>
                        </div>
                    @endforeach
                </div>

                <div class="pt-4 border-t border-slate-100 space-y-2 text-xs">
                    <div class="flex justify-between text-slate-600">
                        <span>Bag Subtotal</span>
                        <span class="font-bold text-slate-900">${{ number_format($order->subtotal, 2) }}</span>
                    </div>
                    <div class="flex justify-between text-slate-600">
                        <span>Worldwide Express Shipping</span>
                        <span class="font-bold text-slate-900">${{ number_format($order->shipping_fee, 2) }}</span>
                    </div>
                    <div class="flex justify-between text-sm font-black text-slate-900 pt-2 border-t border-slate-100">
                        <span>Grand Total</span>
                        <span class="text-rose-600 font-black text-lg">${{ number_format($order->total, 2) }} USD</span>
                    </div>
                </div>
            </div>

            <!-- Payment & QR Code Sidebar -->
            <div class="lg:col-span-4 space-y-6">
                
                <!-- Dynamic QR Card if Western Union / Bank -->
                @if(isset($qrData) && $qrData)
                    <div class="bg-slate-950 text-white rounded-3xl p-6 border border-slate-800 shadow-2xl text-center space-y-3">
                        <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-amber-400 text-black text-xs font-black">
                            <i class="fa-solid fa-bolt"></i> {{ strtoupper($qrData['type']) }} PAYMENT QR
                        </div>
                        <div class="bg-white p-3 rounded-2xl inline-block shadow-inner">
                            <img src="{{ $qrData['qr_image_url'] }}" alt="Payment QR" class="w-36 h-36 object-contain">
                        </div>
                        <div class="text-xs text-slate-300">
                            <p>Payable: <strong class="text-amber-300 text-sm font-bold">{{ $qrData['formatted_amount'] }} USD</strong></p>
                            <p class="text-slate-400 mt-1 font-mono">Ref: {{ $order->order_number }}</p>
                        </div>
                    </div>
                @endif

                <!-- Payment Verification Box -->
                <div class="bg-white rounded-3xl border border-slate-200/80 p-6 shadow-xs space-y-4">
                    <h4 class="font-black text-slate-900 text-sm border-b border-slate-100 pb-2">Payment Details</h4>
                    <div class="space-y-2 text-xs">
                        <div class="flex justify-between">
                            <span class="text-slate-500">Method:</span>
                            <strong class="text-slate-900">{{ $order->payment_method_label }}</strong>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-slate-500">Payment Status:</span>
                            <span class="font-bold px-2 py-0.5 rounded text-[11px] {{ $order->payment_status === 'Paid' ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }}">
                                {{ $order->payment_status }}
                            </span>
                        </div>
                        @if($order->transaction_id)
                            <div class="flex justify-between">
                                <span class="text-slate-500">MTCN / Ref ID:</span>
                                <strong class="font-mono text-rose-600">{{ $order->transaction_id }}</strong>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Shipping Destination -->
                <div class="bg-white rounded-3xl border border-slate-200/80 p-6 shadow-xs space-y-3 text-xs">
                    <h4 class="font-black text-slate-900 text-sm border-b border-slate-100 pb-2">Shipping Destination</h4>
                    <p class="font-bold text-slate-900">{{ $order->customer_name }}</p>
                    <p class="text-slate-600">{{ $order->shipping_address }}</p>
                    <p class="text-slate-600">{{ $order->city }}, {{ $order->province }} {{ $order->postal_code }}</p>
                    <p class="text-slate-500 font-mono"><i class="fa-solid fa-phone mr-1"></i> {{ $order->customer_phone }}</p>
                </div>

            </div>

        </div>
    </div>

</x-app-layout>
