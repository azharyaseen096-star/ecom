<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Setting;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        $shippingFee = (int) Setting::get('shipping_fee', 250);
        $freeShippingThreshold = (int) Setting::get('free_shipping_threshold', 3500);

        if ($subtotal >= $freeShippingThreshold || $subtotal === 0) {
            $effectiveShipping = 0;
        } else {
            $effectiveShipping = $shippingFee;
        }

        $total = $subtotal + $effectiveShipping;

        $jazzcashNumber = Setting::get('jazzcash_account_number', '03001234567');
        $easypaisaNumber = Setting::get('easypaisa_account_number', '03451234567');

        return view('cart.index', compact('cart', 'subtotal', 'shippingFee', 'freeShippingThreshold', 'effectiveShipping', 'total', 'jazzcashNumber', 'easypaisaNumber'));
    }

    public function add(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $quantity = max(1, (int)$request->input('quantity', 1));

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $quantity;
        } else {
            $cart[$id] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'original_price' => $product->original_price,
                'image' => $product->image_url,
                'quantity' => $quantity,
            ];
        }

        session()->put('cart', $cart);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Product added to cart!',
                'cart_count' => count($cart),
            ]);
        }

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function increase($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
            session()->put('cart', $cart);
        }

        return back()->with('success', 'Cart updated!');
    }

    public function decrease($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            if ($cart[$id]['quantity'] > 1) {
                $cart[$id]['quantity']--;
            } else {
                unset($cart[$id]);
            }
            session()->put('cart', $cart);
        }

        return back()->with('success', 'Cart updated!');
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return back()->with('success', 'Item removed from cart!');
    }

    public function clear()
    {
        session()->forget('cart');
        return back()->with('success', 'Cart cleared!');
    }
}