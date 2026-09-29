<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Official Invoice - #{{ $order->order_number }} - TinyChamps KidsWear</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        @media print {
            .no-print { display: none !important; }
            body { background: #fff !important; padding: 0 !important; }
            .invoice-card { border: none !important; box-shadow: none !important; max-width: 100% !important; }
        }
    </style>
</head>
<body class="bg-slate-100 p-4 sm:p-10 font-sans text-slate-800 antialiased">

    <div class="invoice-card max-w-4xl mx-auto bg-white p-8 sm:p-12 rounded-3xl shadow-sm border border-slate-200">
        
        <!-- Print Trigger Bar -->
        <div class="no-print flex items-center justify-between pb-6 mb-6 border-b border-slate-200">
            <a href="{{ route('orders.show', $order->id) }}" class="text-xs font-bold text-slate-600 hover:text-rose-600 transition flex items-center gap-1.5">
                <i class="fa-solid fa-arrow-left text-[10px]"></i>
                <span>Back to Order Tracker</span>
            </a>
            <button onclick="window.print()" class="bg-slate-900 hover:bg-rose-600 text-white text-xs font-black px-5 py-2.5 rounded-xl transition shadow flex items-center gap-2 cursor-pointer">
                <i class="fa-solid fa-print"></i>
                <span>Print Official Invoice</span>
            </button>
        </div>

        <!-- Header -->
        <div class="flex flex-col sm:flex-row justify-between sm:items-center border-b border-slate-200 pb-8 gap-6">
            <div>
                <div class="flex items-center gap-2">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-rose-500 to-amber-500 flex items-center justify-center text-white text-xl font-bold">
                        <i class="fa-solid fa-child-reaching"></i>
                    </div>
                    <span class="text-2xl font-black text-slate-900">Tiny<span class="text-rose-600">Champs</span></span>
                </div>
                <p class="text-xs text-slate-500 mt-2">Official Worldwide KidsWear &amp; Tracksuit Invoice</p>
                <p class="text-xs text-slate-500">{{ \App\Models\Setting::get('contact_phone', '+1 (800) 555-0199') }} | {{ \App\Models\Setting::get('contact_email', 'support@tinychamps.com') }}</p>
            </div>

            <!-- Dynamic Scannable QR Code on Invoice -->
            @if(isset($qrData) && $qrData)
                <div class="flex items-center gap-3 bg-slate-50 p-3 rounded-2xl border border-slate-200">
                    <img src="{{ $qrData['qr_image_url'] }}" alt="QR Code" class="w-20 h-20 object-contain">
                    <div class="text-[11px] text-slate-600">
                        <span class="bg-[#ffdd00] text-black font-black text-[9px] px-1.5 py-0.5 rounded uppercase">Verified QR</span>
                        <div class="font-bold text-slate-900 mt-0.5">{{ strtoupper($qrData['type']) }}</div>
                        <div class="font-mono text-[10px]">{{ $qrData['agent_code'] ?? ($qrData['swift'] ?? '') }}</div>
                        <div class="font-black text-rose-600 mt-0.5">${{ number_format($order->total, 2) }} USD</div>
                    </div>
                </div>
            @else
                <div class="text-right">
                    <span class="text-xs uppercase font-extrabold text-slate-400 block">Invoice Number</span>
                    <span class="text-lg font-black text-slate-900 font-mono">{{ $order->order_number }}</span>
                    <p class="text-xs text-slate-500 mt-1">Date: {{ $order->created_at->format('d M Y') }}</p>
                </div>
            @endif
        </div>

        <!-- Addresses -->
        <div class="grid grid-cols-2 gap-8 py-6 border-b border-slate-200 text-xs">
            <div>
                <h3 class="font-black text-slate-900 uppercase tracking-wider mb-2">Billed &amp; Shipped To:</h3>
                <p class="font-bold text-slate-900 text-sm">{{ $order->customer_name }}</p>
                <p class="text-slate-600 mt-0.5">{{ $order->customer_phone }}</p>
                <p class="text-slate-600">{{ $order->customer_email }}</p>
                <p class="text-slate-600 mt-1">{{ $order->shipping_address }}</p>
                <p class="text-slate-600">{{ $order->city }} {{ $order->postal_code ? '- '.$order->postal_code : '' }}, {{ $order->province }}</p>
            </div>

            <div class="text-right">
                <h3 class="font-black text-slate-900 uppercase tracking-wider mb-2">Payment Details:</h3>
                <p><span class="text-slate-500">Method:</span> <strong class="text-slate-900">{{ $order->payment_method_label }}</strong></p>
                <p class="mt-1"><span class="text-slate-500">Payment Status:</span> <strong class="text-emerald-700 bg-emerald-50 px-2.5 py-0.5 rounded-lg">{{ $order->payment_status }}</strong></p>
                @if($order->transaction_id)
                    <p class="mt-1"><span class="text-slate-500">MTCN / Transaction Ref:</span> <span class="font-mono font-bold text-rose-600">{{ $order->transaction_id }}</span></p>
                @endif
                <p class="mt-1"><span class="text-slate-500">Dispatch Status:</span> <strong class="text-rose-700 bg-rose-50 px-2.5 py-0.5 rounded-lg">{{ $order->status }}</strong></p>
            </div>
        </div>

        <!-- Itemized Table -->
        <div class="py-6">
            <table class="w-full text-left text-xs">
                <thead>
                    <tr class="border-b border-slate-200 text-slate-500 uppercase font-black">
                        <th class="py-2.5">Baby Tracksuit Description</th>
                        <th class="py-2.5 text-center">Qty</th>
                        <th class="py-2.5 text-right">Unit Price</th>
                        <th class="py-2.5 text-right">Total</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($order->items as $item)
                        <tr>
                            <td class="py-3 font-bold text-slate-900">{{ $item->product_name }}</td>
                            <td class="py-3 text-center text-slate-600 font-bold">{{ $item->quantity }}</td>
                            <td class="py-3 text-right text-slate-600">${{ number_format($item->price, 2) }}</td>
                            <td class="py-3 text-right font-black text-slate-900">${{ number_format($item->total, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Totals -->
        <div class="border-t border-slate-200 pt-4 flex justify-end">
            <div class="w-64 space-y-2 text-xs">
                <div class="flex justify-between text-slate-600">
                    <span>Subtotal:</span>
                    <span class="font-bold text-slate-900">${{ number_format($order->subtotal, 2) }}</span>
                </div>
                <div class="flex justify-between text-slate-600">
                    <span>Worldwide Shipping:</span>
                    <span class="font-bold text-slate-900">${{ number_format($order->shipping_fee, 2) }}</span>
                </div>
                <div class="flex justify-between text-sm font-black text-slate-900 pt-2 border-t border-slate-200">
                    <span>Grand Total:</span>
                    <span class="text-rose-600 text-base">${{ number_format($order->total, 2) }} USD</span>
                </div>
            </div>
        </div>

        <!-- Footer Note -->
        <div class="border-t border-slate-200 mt-8 pt-6 text-center text-[11px] text-slate-400">
            <p>Thank you for choosing TinyChamps KidsWear International. For inquiries regarding this invoice, contact support@tinychamps.com.</p>
        </div>

    </div>

</body>
</html>
