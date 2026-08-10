<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);

        return view('cart.index', compact('cart'));
    }

    public function add($id)
    {
        $product = Product::findOrFail($id);

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {

            $cart[$id]['quantity']++;

        } else {

            $cart[$id] = [
                'name' => $product->name,
                'price' => $product->price,
                'image' => $product->image,
                'quantity' => 1
            ];
        }

        session()->put('cart', $cart);

        return redirect()->route('cart') ->with('success', 'Product Added Successfully');
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {

            unset($cart[$id]);

            session()->put('cart', $cart);
        }

        return back();
    }

    public function checkout()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return back()->with('error', 'Cart is Empty');
        }

        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        Order::create([
            'user_id' => auth()->id(),
            'products' => json_encode($cart),
            'total' => $total,
            'status' => 'Pending',
        ]);

        session()->forget('cart');

        return redirect()->route('success')
            ->with('success', 'Order Placed Successfully');
    }
    public function increase($id)
{
    $cart = session()->get('cart', []);

    if (isset($cart[$id])) {

        $cart[$id]['quantity']++;

        session()->put('cart', $cart);
    }

    return back();
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

    return back();
}
}