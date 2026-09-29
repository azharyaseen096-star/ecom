<x-app-layout>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs p-8 sm:p-12 text-center space-y-6">
            
            <div class="w-20 h-20 bg-emerald-100 text-emerald-600 rounded-3xl flex items-center justify-center mx-auto text-4xl shadow-inner animate-bounce">
                <i class="fa-solid fa-circle-check"></i>
            </div>

            <div class="space-y-2">
                <span class="text-xs font-black uppercase tracking-widest text-emerald-600 bg-emerald-50 px-3.5 py-1 rounded-full border border-emerald-200">
                    Order Received Successfully
                </span>
                <h1 class="text-3xl sm:text-4xl font-black text-slate-900">
                    Thank You for Your Order!
                </h1>
                <p class="text-sm text-slate-500 max-w-lg mx-auto">
                    Your baby tracksuit order <strong class="text-slate-900 font-mono">#{{ $order->order_number }}</strong> has been placed. We are preparing it for worldwide express dispatch.
                </p>
            </div>

            <!-- Dynamic QR Code Box (If Western Union or Bank) -->
            @if(isset($qrData) && $qrData)
                <div class="p-6 bg-slate-950 text-white rounded-3xl max-w-lg mx-auto border border-slate-800 shadow-2xl space-y-4 text-center">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#ffdd00] text-black text-xs font-black">
                        <i class="fa-solid fa-bolt"></i> {{ strtoupper($qrData['type']) }} PAYMENT QR
                    </div>

                    <div class="bg-white p-3 rounded-2xl inline-block shadow-inner">
                        <img src="{{ $qrData['qr_image_url'] }}" alt="Payment QR" class="w-40 h-40 object-contain">
                    </div>

                    <div class="text-xs text-slate-300">
                        <span>Receiver: <strong class="text-white uppercase">{{ $qrData['receiver_name'] ?? ($qrData['account_title'] ?? '') }}</strong></span><br>
                        <span>Country: <strong class="text-white">{{ $qrData['country'] ?? '' }}</strong></span>
                    </div>

                    <div class="text-sm font-black text-amber-400">
                        Exact Amount: {{ $qrData['formatted_amount'] }} USD
                    </div>
                </div>
            @endif

            <!-- Order Summary Card -->
            <div class="bg-slate-50 rounded-3xl p-6 border border-slate-200/80 text-left max-w-xl mx-auto space-y-4">
                <div class="flex items-center justify-between border-b border-slate-200 pb-3">
                    <div>
                        <span class="text-xs text-slate-400 block">Order Number</span>
                        <span class="text-base font-black text-slate-900 font-mono">{{ $order->order_number }}</span>
                    </div>
                    <div class="text-right">
                        <span class="text-xs text-slate-400 block">Total Amount</span>
                        <span class="text-lg font-black text-rose-600">${{ number_format($order->total, 2) }} USD</span>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4 text-xs">
                    <div>
                        <span class="text-slate-500 block">Payment Method:</span>
                        <span class="font-extrabold text-slate-900">{{ $order->payment_method_label }}</span>
                    </div>
                    <div>
                        <span class="text-slate-500 block">Payment Status:</span>
                        <span class="inline-block font-bold text-emerald-700 bg-emerald-100 px-2.5 py-0.5 rounded-lg">{{ $order->payment_status }}</span>
                    </div>
                    <div class="col-span-2">
                        <span class="text-slate-500 block">Delivery Address:</span>
                        <span class="font-bold text-slate-800">{{ $order->shipping_address }}, {{ $order->city }}</span>
                    </div>
                    @if($order->transaction_id)
                        <div class="col-span-2">
                            <span class="text-slate-500 block">MTCN / Transaction Ref:</span>
                            <span class="font-mono font-bold text-rose-600">{{ $order->transaction_id }}</span>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-wrap items-center justify-center gap-4 pt-4">
                <a href="{{ route('orders.show', $order->id) }}" class="bg-slate-900 hover:bg-rose-600 text-white font-extrabold text-xs px-6 py-3.5 rounded-2xl transition shadow flex items-center gap-2">
                    <i class="fa-solid fa-timeline"></i>
                    <span>Track Live Dispatch</span>
                </a>
                <a href="{{ route('orders.invoice', $order->id) }}" target="_blank" class="bg-white hover:bg-slate-50 text-slate-800 font-extrabold text-xs px-6 py-3.5 rounded-2xl border border-slate-200 transition flex items-center gap-2">
                    <i class="fa-solid fa-file-invoice"></i>
                    <span>Print Invoice</span>
                </a>
                <a href="{{ route('shop') }}" class="text-rose-600 hover:text-rose-700 font-extrabold text-xs px-6 py-3.5 transition">
                    Continue Shopping →
                </a>
            </div>

        </div>
    </div>

</x-app-layout>
