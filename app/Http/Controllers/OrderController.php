<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\QrCodeService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = auth()->user()->orders()->with('items')->latest()->paginate(10);
        return view('orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with('items')->where('user_id', auth()->id())->findOrFail($id);
        
        $qrData = match ($order->payment_method) {
            'westernunion' => QrCodeService::generateWesternUnionQrUrl($order->total, $order->order_number),
            'bank_transfer' => QrCodeService::generateBankQrUrl($order->total, $order->order_number),
            default => null,
        };

        return view('orders.show', compact('order', 'qrData'));
    }

    public function success($id)
    {
        $order = Order::with('items')->where('user_id', auth()->id())->findOrFail($id);
        
        $qrData = match ($order->payment_method) {
            'westernunion' => QrCodeService::generateWesternUnionQrUrl($order->total, $order->order_number),
            'bank_transfer' => QrCodeService::generateBankQrUrl($order->total, $order->order_number),
            default => null,
        };

        return view('orders.success', compact('order', 'qrData'));
    }

    public function invoice($id)
    {
        $order = Order::with('items')->where('user_id', auth()->id())->findOrFail($id);
        
        $qrData = match ($order->payment_method) {
            'westernunion' => QrCodeService::generateWesternUnionQrUrl($order->total, $order->order_number),
            'bank_transfer' => QrCodeService::generateBankQrUrl($order->total, $order->order_number),
            default => null,
        };

        return view('orders.invoice', compact('order', 'qrData'));
    }
}
