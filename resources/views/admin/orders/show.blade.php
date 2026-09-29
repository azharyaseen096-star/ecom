<x-app-layout>

    <div class="bg-gray-900 text-white py-6 border-b border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <div class="flex items-center gap-3">
                    <h1 class="text-2xl sm:text-3xl font-black text-white">Order Details: #{{ $order->order_number }}</h1>
                    <span class="bg-orange-500 text-white text-xs font-black px-3 py-1 rounded-full uppercase">
                        {{ $order->status }}
                    </span>
                </div>
                <p class="text-xs text-gray-400 mt-1">Placed on {{ $order->created_at->format('d M Y, h:i A') }}</p>
            </div>

            <div class="flex items-center gap-2">
                <a href="{{ route('admin.orders.index') }}" class="bg-gray-800 hover:bg-gray-700 text-white text-xs font-bold px-3.5 py-2 rounded-xl transition">
                    ← Back to Orders
                </a>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-8" x-data="{ slipModal: false }">
        
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            
            <!-- Left 8 Columns: Products & Live GPS Pinpoint Map -->
            <div class="lg:col-span-8 space-y-8">
                
                <!-- Purchased Products Box -->
                <div class="bg-white rounded-3xl border border-gray-200 p-6 sm:p-8 shadow-sm space-y-6">
                    <h2 class="font-extrabold text-gray-900 text-lg border-b border-gray-100 pb-4">
                        Items Ordered ({{ $order->items->count() }})
                    </h2>

                    <div class="divide-y divide-gray-100">
                        @foreach($order->items as $item)
                            <div class="py-4 flex items-center gap-4">
                                <div class="w-16 h-16 bg-gray-50 rounded-xl border border-gray-100 p-2 overflow-hidden flex items-center justify-center shrink-0">
                                    <img src="{{ $item->product_image ?? 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=600' }}" alt="{{ $item->product_name }}" class="max-h-full max-w-full object-contain">
                                </div>

                                <div class="flex-1 min-w-0">
                                    <h4 class="font-bold text-gray-900 text-sm truncate">{{ $item->product_name }}</h4>
                                    <p class="text-xs text-gray-500">Qty: {{ $item->quantity }} × Rs {{ number_format($item->price) }}</p>
                                </div>

                                <span class="font-extrabold text-gray-900 text-sm">
                                    Rs {{ number_format($item->total) }}
                                </span>
                            </div>
                        @endforeach
                    </div>

                    <div class="pt-4 border-t border-gray-100 space-y-2 text-xs">
                        <div class="flex justify-between text-gray-600">
                            <span>Subtotal:</span>
                            <span class="font-bold text-gray-900">Rs {{ number_format($order->subtotal) }}</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Shipping / Delivery Fee:</span>
                            <span class="font-bold text-gray-900">Rs {{ number_format($order->shipping_fee) }}</span>
                        </div>
                        <div class="flex justify-between text-base font-black text-gray-900 pt-2 border-t border-gray-100">
                            <span>Grand Total:</span>
                            <span class="text-orange-600 font-black text-xl">Rs {{ number_format($order->total) }}</span>
                        </div>
                    </div>
                </div>

                <!-- Customer Live Pinpoint Map Box -->
                <div class="bg-white rounded-3xl border border-gray-200 p-6 sm:p-8 shadow-sm space-y-4">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 border-b border-gray-100 pb-4">
                        <div>
                            <h2 class="font-extrabold text-gray-900 text-lg flex items-center gap-2">
                                <i class="fa-solid fa-map-location-dot text-red-500"></i>
                                <span>Customer Pinpoint Location</span>
                            </h2>
                            <p class="text-xs text-gray-500">Exact coordinates selected by customer at checkout</p>
                        </div>

                        @if($order->latitude && $order->longitude)
                            <a href="{{ $order->google_maps_url }}" target="_blank" class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-bold text-xs px-4 py-2 rounded-xl shadow transition">
                                <i class="fa-solid fa-diamond-turn-right"></i>
                                <span>🚗 Open in Google Maps for Rider</span>
                            </a>
                        @endif
                    </div>

                    @if($order->latitude && $order->longitude)
                        <div class="space-y-3">
                            <div id="admin-order-map" class="w-full h-80 rounded-2xl border border-gray-200 overflow-hidden"></div>
                            
                            <div class="bg-gray-50 p-4 rounded-xl border border-gray-200 flex flex-wrap items-center justify-between text-xs text-gray-600 gap-2">
                                <div>
                                    <span class="font-bold text-gray-800">GPS Coordinates:</span>
                                    <span class="font-mono ml-1">{{ $order->latitude }}, {{ $order->longitude }}</span>
                                </div>
                                <div>
                                    <span class="font-bold text-gray-800">Address:</span>
                                    <span class="ml-1">{{ $order->shipping_address }}, {{ $order->city }}</span>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="p-8 text-center bg-gray-50 rounded-2xl border border-gray-200 text-xs text-gray-500">
                            <i class="fa-solid fa-map-pin text-gray-400 text-xl mb-2 block"></i>
                            Map coordinates not provided for this order. Customer address: {{ $order->shipping_address }}, {{ $order->city }}.
                        </div>
                    @endif
                </div>

            </div>

            <!-- Right 4 Columns: Payment Verification & Status Update -->
            <div class="lg:col-span-4 space-y-6">
                
                <!-- Payment Verification Box -->
                <div class="bg-white rounded-3xl border-2 border-orange-200 p-6 sm:p-8 shadow-sm space-y-5">
                    <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                        <h3 class="font-black text-gray-900 text-base flex items-center gap-2">
                            <i class="fa-solid fa-receipt text-orange-600"></i> Payment Verification
                        </h3>
                        <span class="text-xs font-black px-2.5 py-1 rounded-full {{ $order->payment_status === 'Paid' ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }}">
                            {{ $order->payment_status }}
                        </span>
                    </div>

                    <div class="space-y-3 text-xs">
                        <div class="flex justify-between">
                            <span class="text-gray-500">Payment Gateway:</span>
                            <span class="font-bold text-gray-900">{{ $order->payment_method_label }}</span>
                        </div>

                        @if($order->sender_account_number)
                            <div class="flex justify-between">
                                <span class="text-gray-500">Sender Account:</span>
                                <span class="font-mono font-bold text-gray-900">{{ $order->sender_account_number }}</span>
                            </div>
                        @endif

                        @if($order->transaction_id)
                            <div class="flex justify-between">
                                <span class="text-gray-500">Transaction ID (TID):</span>
                                <span class="font-mono font-black text-orange-600 bg-orange-50 px-2 py-0.5 rounded">{{ $order->transaction_id }}</span>
                            </div>
                        @endif

                        <!-- Payment Proof Screenshot Preview -->
                        @if($order->payment_proof_image)
                            <div class="pt-3 border-t border-gray-100">
                                <span class="text-gray-700 font-bold block mb-2">Uploaded Payment Receipt:</span>
                                <button type="button" @click="slipModal = true" class="relative group block w-full rounded-xl overflow-hidden border border-gray-200 aspect-video bg-gray-50">
                                    <img src="{{ asset('storage/' . $order->payment_proof_image) }}" alt="Payment Receipt" class="w-full h-full object-cover">
                                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition flex items-center justify-center text-white font-bold text-xs gap-1.5">
                                        <i class="fa-solid fa-magnifying-glass-plus"></i> View Full Slip
                                    </div>
                                </button>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Update Order & Payment Status Form -->
                <div class="bg-white rounded-3xl border border-gray-200 p-6 sm:p-8 shadow-sm space-y-4">
                    <h3 class="font-extrabold text-gray-900 text-base border-b border-gray-100 pb-3">
                        Update Order Status
                    </h3>

                    <form action="{{ route('admin.orders.status', $order->id) }}" method="POST" class="space-y-4">
                        @csrf

                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Order Delivery Status</label>
                            <select name="status" class="w-full text-xs p-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-orange-500 font-bold">
                                <option value="Pending" {{ $order->status === 'Pending' ? 'selected' : '' }}>Pending</option>
                                <option value="Processing" {{ $order->status === 'Processing' ? 'selected' : '' }}>Processing (Packed)</option>
                                <option value="Shipped" {{ $order->status === 'Shipped' ? 'selected' : '' }}>Shipped (Handed to Courier)</option>
                                <option value="Delivered" {{ $order->status === 'Delivered' ? 'selected' : '' }}>Delivered</option>
                                <option value="Cancelled" {{ $order->status === 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Payment Status</label>
                            <select name="payment_status" class="w-full text-xs p-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-orange-500 font-bold">
                                <option value="Pending" {{ $order->payment_status === 'Pending' ? 'selected' : '' }}>Pending</option>
                                <option value="Pending (COD)" {{ $order->payment_status === 'Pending (COD)' ? 'selected' : '' }}>Pending (COD)</option>
                                <option value="Verification Pending" {{ $order->payment_status === 'Verification Pending' ? 'selected' : '' }}>Verification Pending</option>
                                <option value="Paid" {{ $order->payment_status === 'Paid' ? 'selected' : '' }}>Paid (Verified & Received)</option>
                                <option value="Failed" {{ $order->payment_status === 'Failed' ? 'selected' : '' }}>Failed / Rejected</option>
                                <option value="Refunded" {{ $order->payment_status === 'Refunded' ? 'selected' : '' }}>Refunded</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Admin Notes (Internal)</label>
                            <textarea name="admin_notes" rows="2" placeholder="e.g. Verified JazzCash TID via merchant portal" class="w-full text-xs p-2.5 bg-gray-50 border border-gray-200 rounded-xl">{{ $order->admin_notes }}</textarea>
                        </div>

                        <button type="submit" class="w-full py-3.5 bg-orange-600 hover:bg-orange-700 text-white font-extrabold text-xs rounded-xl shadow transition">
                            Save Status Changes
                        </button>
                    </form>
                </div>

                <!-- Customer Details Card -->
                <div class="bg-white rounded-3xl border border-gray-200 p-6 shadow-sm space-y-3 text-xs">
                    <h4 class="font-extrabold text-gray-900 text-sm uppercase tracking-wider border-b border-gray-100 pb-2">
                        Customer Contact
                    </h4>
                    <p><span class="text-gray-500">Name:</span> <strong class="text-gray-900">{{ $order->customer_name }}</strong></p>
                    <p><span class="text-gray-500">Phone:</span> <a href="tel:{{ $order->customer_phone }}" class="font-bold text-orange-600 hover:underline">{{ $order->customer_phone }}</a></p>
                    <p><span class="text-gray-500">Email:</span> <span class="text-gray-900">{{ $order->customer_email }}</span></p>
                    <p><span class="text-gray-500">City:</span> <span class="text-gray-900">{{ $order->city }}</span></p>
                    @if($order->delivery_notes)
                        <p class="text-gray-600 italic bg-gray-50 p-2 rounded-lg mt-2">Notes: {{ $order->delivery_notes }}</p>
                    @endif
                </div>

            </div>

        </div>

        <!-- Slip Modal -->
        @if($order->payment_proof_image)
            <div x-show="slipModal" class="fixed inset-0 bg-black/80 z-50 flex items-center justify-center p-4" style="display: none;">
                <div class="bg-white rounded-3xl max-w-2xl w-full p-6 space-y-4 max-h-[90vh] overflow-y-auto" @click.away="slipModal = false">
                    <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                        <h3 class="font-bold text-gray-900">Payment Screenshot / Receipt</h3>
                        <button type="button" @click="slipModal = false" class="text-gray-400 hover:text-gray-600 text-xl font-bold">✕</button>
                    </div>
                    <img src="{{ asset('storage/' . $order->payment_proof_image) }}" alt="Receipt" class="w-full h-auto rounded-xl">
                </div>
            </div>
        @endif

    </div>

    @if($order->latitude && $order->longitude)
    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var lat = {{ $order->latitude }};
            var lng = {{ $order->longitude }};
            var map = L.map('admin-order-map').setView([lat, lng], 15);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap'
            }).addTo(map);
            L.marker([lat, lng]).addTo(map).bindPopup('Customer Pinpoint Location').openPopup();
        });
    </script>
    @endpush
    @endif

</x-app-layout>
