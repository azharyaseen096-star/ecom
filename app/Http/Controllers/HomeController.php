<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Setting;
use App\Services\QrCodeService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::where('is_active', true)->withCount('products')->get();
        $featuredProducts = Product::where('is_active', true)->where('is_featured', true)->latest()->take(8)->get();
        $latestProducts = Product::where('is_active', true)->latest()->take(8)->get();
        
        // Products specifically selected for the 3D Ads Banner & Featured Showcase Carousel
        $adProducts = Product::where('is_active', true)
            ->where(function($q) {
                $q->where('is_featured', true)
                  ->orWhereNotNull('original_price');
            })
            ->latest()
            ->take(6)
            ->get();

        if ($adProducts->isEmpty()) {
            $adProducts = $latestProducts->take(6);
        }

        $freeShippingThreshold = Setting::get('free_shipping_threshold', '75');
        $currencySymbol = Setting::get('currency_symbol', '$');

        // Sample Western Union dynamic QR preview for homepage 1-tap showcase
        $sampleWuQr = QrCodeService::generateWesternUnionQrUrl(35.00, 'SAMPLE-PREVIEW');

        return view('home', compact(
            'categories', 
            'featuredProducts', 
            'latestProducts', 
            'adProducts', 
            'freeShippingThreshold',
            'currencySymbol',
            'sampleWuQr'
        ));
    }
}
