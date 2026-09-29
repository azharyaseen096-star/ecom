<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Setting;
use App\Services\QrCodeService;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart')->with('error', 'Your shopping bag is empty. Please select your favorite tracksuits.');
        }

        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        $shippingFee = (float) Setting::get('shipping_fee', 10);
        $freeShippingThreshold = (float) Setting::get('free_shipping_threshold', 75);

        $effectiveShipping = ($subtotal >= $freeShippingThreshold) ? 0 : $shippingFee;
        $total = $subtotal + $effectiveShipping;

        $tempOrderRef = 'ORD-' . strtoupper(substr(uniqid(), -6));
        $wuQr = QrCodeService::generateWesternUnionQrUrl($total, $tempOrderRef);
        $bankQr = QrCodeService::generateBankQrUrl($total, $tempOrderRef);

        $settings = [
            'site_name' => Setting::get('site_name', 'TinyChamps KidsWear'),
            'currency_symbol' => Setting::get('currency_symbol', '$'),
            
            // Western Union
            'wu_enabled' => Setting::get('wu_enabled', '1'),
            'wu_receiver_name' => Setting::get('wu_receiver_name', 'TINYCHAMPS GLOBAL LTD'),
            'wu_country' => Setting::get('wu_country', 'United States'),
            'wu_city' => Setting::get('wu_city', 'New York'),
            'wu_agent_code' => Setting::get('wu_agent_code', 'WU-GLOBAL-7789'),
            'wu_phone' => Setting::get('wu_phone', '+1 (555) 349-2810'),
            'wu_instructions' => Setting::get('wu_instructions', ''),

            // Bank Wire / SWIFT
            'bank_transfer_enabled' => Setting::get('bank_transfer_enabled', '1'),
            'bank_name' => Setting::get('bank_name', 'JPMorgan Chase Bank, N.A.'),
            'bank_account_title' => Setting::get('bank_account_title', 'TINYCHAMPS INTERNATIONAL INC'),
            'bank_account_number' => Setting::get('bank_account_number', '4400192837465'),
            'bank_iban' => Setting::get('bank_iban', 'US89CHAS0000004400192837'),
            'bank_swift' => Setting::get('bank_swift', 'CHASUS33XXX'),

            'card_enabled' => Setting::get('card_enabled', '1'),
            'cod_enabled' => Setting::get('cod_enabled', '1'),
        ];

        $user = auth()->user();

        return view('checkout', compact(
            'cart',
            'subtotal',
            'shippingFee',
            'effectiveShipping',
            'total',
            'settings',
            'wuQr',
            'bankQr',
            'tempOrderRef',
            'user'
        ));
    }

    public function placeOrder(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart')->with('error', 'Your shopping bag is empty.');
        }

        $request->validate([
            'customer_name' => 'required|string|max:150',
            'customer_phone' => 'required|string|max:30',
            'customer_email' => 'required|email|max:150',
            'country' => 'nullable|string|max:100',
            'shipping_address' => 'required|string|max:500',
            'city' => 'required|string|max:100',
            'postal_code' => 'nullable|string|max:20',
            'province' => 'nullable|string|max:100',
            'delivery_notes' => 'nullable|string|max:500',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'payment_method' => 'required|in:westernunion,bank_transfer,card,cod',
            'transaction_id' => 'nullable|string|max:100',
            'sender_account_number' => 'nullable|string|max:100',
            'payment_proof_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        $shippingFee = (float) Setting::get('shipping_fee', 10);
        $freeShippingThreshold = (float) Setting::get('free_shipping_threshold', 75);
        $effectiveShipping = ($subtotal >= $freeShippingThreshold) ? 0 : $shippingFee;
        $total = $subtotal + $effectiveShipping;

        // Handle payment proof upload
        $paymentProofPath = null;
        if ($request->hasFile('payment_proof_image')) {
            $paymentProofPath = $request->file('payment_proof_image')->store('payment_proofs', 'public');
        }

        $paymentStatus = match ($request->payment_method) {
            'cod' => 'Pending (COD)',
            'westernunion', 'bank_transfer', 'card' => 'Verification Pending',
            default => 'Pending',
        };

        DB::beginTransaction();
        try {
            $country = $request->input('country', 'United States');
            $fullAddress = $request->shipping_address . ', ' . $request->city . ($request->province ? ', ' . $request->province : '') . ' ' . $request->postal_code . ', ' . $country;

            $order = Order::create([
                'user_id' => auth()->id(),
                'order_number' => 'TC-' . strtoupper(uniqid()),
                'customer_name' => $request->customer_name,
                'customer_email' => $request->customer_email,
                'customer_phone' => $request->customer_phone,
                'shipping_address' => $fullAddress,
                'city' => $request->city,
                'province' => $request->province,
                'postal_code' => $request->postal_code,
                'delivery_notes' => $request->delivery_notes,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'payment_method' => $request->payment_method,
                'payment_status' => $paymentStatus,
                'transaction_id' => $request->transaction_id, // MTCN or Wire Reference
                'sender_account_number' => $request->sender_account_number,
                'payment_proof_image' => $paymentProofPath,
                'subtotal' => $subtotal,
                'shipping_fee' => $effectiveShipping,
                'total_amount' => $total,
                'total' => $total,
                'status' => 'pending',
            ]);

            foreach ($cart as $productId => $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $productId,
                    'product_name' => $item['name'],
                    'price' => $item['price'],
                    'quantity' => $item['quantity'],
                    'subtotal' => $item['price'] * $item['quantity'],
                ]);

                // Reduce inventory stock
                Product::where('id', $productId)->decrement('stock', $item['quantity']);
            }

            DB::commit();

            // Clear Cart Session
            session()->forget('cart');

            return redirect()->route('orders.success', $order->id)->with('success', 'Thank you! Your baby tracksuit order has been placed successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error placing order: ' . $e->getMessage())->withInput();
        }
    }
}
