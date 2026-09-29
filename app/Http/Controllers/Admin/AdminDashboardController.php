<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\Category;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalRevenue = Order::where('status', '!=', 'Cancelled')->sum('total');
        $totalOrders = Order::count();
        $pendingOrders = Order::where('status', 'Pending')->count();
        $deliveredOrders = Order::where('status', 'Delivered')->count();
        $totalProducts = Product::count();
        $totalCustomers = User::where('is_admin', 0)->count();

        $recentOrders = Order::with('user')->latest()->take(6)->get();
        $popularProducts = Product::with('category')->where('is_active', true)->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalRevenue',
            'totalOrders',
            'pendingOrders',
            'deliveredOrders',
            'totalProducts',
            'totalCustomers',
            'recentOrders',
            'popularProducts'
        ));
    }
}
