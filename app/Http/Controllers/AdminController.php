<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Dashboard
    public function index()
    {
        $products = Product::latest()->get();

        return view('admin.dashboard', compact('products'));
    }

    // Add Product Form
    public function create()
    {
        return view('admin.create');
    }

    // Save Product
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'image' => 'required|image'
        ]);

        $image = $request->file('image')->store('products', 'public');

        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $image,
        ]);

        return redirect()->route('admin.dashboard')
            ->with('success', 'Product Added Successfully');
    }

    // Edit Product
    public function edit($id)
    {
        $product = Product::findOrFail($id);

        return view('admin.edit', compact('product'));
    }

    // Update Product
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('products', 'public');
            $product->image = $image;
        }

        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;

        $product->save();

        return redirect()->route('admin.dashboard')
            ->with('success', 'Product Updated Successfully');
    }

    // Delete Product
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        $product->delete();

        return redirect()->route('admin.dashboard')
            ->with('success', 'Product Deleted Successfully');
    }

    // Orders
    public function orders()
    {
        $orders = Order::latest()->get();

        return view('admin.orders', compact('orders'));
    }
}