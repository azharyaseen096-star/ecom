<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Setting;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Users
        $admin = User::firstOrCreate(
            ['email' => 'admin@kidswear.com'],
            [
                'name' => 'Store Admin',
                'password' => Hash::make('password'),
                'is_admin' => 1,
            ]
        );
        $admin->is_admin = 1;
        $admin->save();

        $customer = User::firstOrCreate(
            ['email' => 'customer@kidswear.com'],
            [
                'name' => 'Sarah Johnson',
                'password' => Hash::make('password'),
                'is_admin' => 0,
            ]
        );

        // 2. Settings (Western Union, Global Shipping, USD Currency)
        $settings = [
            'site_name' => 'TinyChamps KidsWear',
            'site_tagline' => 'Premium Baby & Toddler Tracksuits Worldwide',
            'contact_email' => 'support@tinychamps.com',
            'contact_phone' => '+1 (800) 555-0199',
            'store_address' => '742 Evergreen Terrace, Suite 100, New York, NY 10001, USA',
            'currency_symbol' => '$',
            'currency_code' => 'USD',
            'shipping_fee' => '10',
            'free_shipping_threshold' => '75',
            
            // Western Union Settings
            'wu_enabled' => '1',
            'wu_receiver_name' => 'TINYCHAMPS GLOBAL LTD',
            'wu_country' => 'United States',
            'wu_city' => 'New York',
            'wu_agent_code' => 'WU-GLOBAL-7789',
            'wu_phone' => '+1 (555) 349-2810',
            'wu_instructions' => "1. Open the Western Union App or visit any Western Union branch/agent.\n2. Send money to: TINYCHAMPS GLOBAL LTD (New York, United States).\n3. Enter exact Order Amount in USD.\n4. Enter your 10-digit MTCN (Money Transfer Control Number) below with optional receipt upload.",

            // Bank Wire / SWIFT Settings
            'bank_transfer_enabled' => '1',
            'bank_name' => 'JPMorgan Chase Bank, N.A.',
            'bank_account_title' => 'TINYCHAMPS INTERNATIONAL INC',
            'bank_account_number' => '4400192837465',
            'bank_iban' => 'US89CHAS0000004400192837',
            'bank_swift' => 'CHASUS33XXX',
            'bank_branch' => 'Wall Street Branch, New York, USA',

            // Credit Card & COD Settings
            'card_enabled' => '1',
            'cod_enabled' => '1',
        ];

        foreach ($settings as $key => $val) {
            Setting::updateOrCreate(['key' => $key], ['value' => $val, 'group' => 'general']);
        }

        // 3. Categories (Baby & Kids Tracksuit Specific)
        $categoriesData = [
            [
                'name' => 'Baby Boy Tracksuits',
                'slug' => 'baby-boy-tracksuits',
                'icon' => '👶',
                'description' => 'Sporty hooded sweat sets, zipper track jackets, and jogger pants for little gentlemen.',
            ],
            [
                'name' => 'Baby Girl Tracksuits',
                'slug' => 'baby-girl-tracksuits',
                'icon' => '🎀',
                'description' => 'Pastel fleece suits, floral cozy jogger sets, and cute bow-accented track ensembles.',
            ],
            [
                'name' => 'Toddler Fleece & Velvet Sets',
                'slug' => 'toddler-fleece-velvet',
                'icon' => '🧸',
                'description' => 'Ultra-soft thermal polar fleece and luxury velvet winter tracksuits for active toddlers.',
            ],
            [
                'name' => 'Organic Cotton 2-Piece Suits',
                'slug' => 'organic-cotton-suits',
                'icon' => '🌱',
                'description' => '100% GOTS certified hypoallergenic breathable organic cotton loungewear and play sets.',
            ],
            [
                'name' => 'Newborn Romper Tracksuits',
                'slug' => 'newborn-romper-tracksuits',
                'icon' => '🍼',
                'description' => 'Cozy button-up fleece hooded romper suits designed for maximum comfort and diaper ease.',
            ],
            [
                'name' => 'Summer Lightweight Activewear',
                'slug' => 'summer-activewear',
                'icon' => '☀️',
                'description' => 'Breathable short-sleeve athletic play sets and lightweight French terry track outfits.',
            ],
        ];

        $categories = [];

        // 4. Products (High-Resolution Curated Baby Tracksuits)
        $productsData = [
            [
                'category_slug' => 'baby-boy-tracksuits',
                'name' => 'Dino Champ 2-Piece Fleece Tracksuit Set',
                'description' => 'Adorable dinosaur spine hoodie with matching elasticated jogger pants. Crafted from ultra-soft cotton blend fleece to keep your little adventurer cozy and stylish.',
                'price' => 35,
                'original_price' => 50,
                'stock' => 50,
                'sku' => 'KIDS-DINO-01',
                'image' => 'images/baby_tracksuit_hero.jpg',
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'category_slug' => 'baby-boy-tracksuits',
                'name' => 'Royal Velvet Bear Ear Toddler Tracksuit',
                'description' => 'Ultra-luxurious royal plush velvet hooded jacket with adorable bear ears and tailored matching jogger pants. Gold-accent zipper with soft cotton lining.',
                'price' => 45,
                'original_price' => 60,
                'stock' => 40,
                'sku' => 'KIDS-ROYAL-02',
                'image' => 'images/baby_tracksuit_blue.jpg',
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'category_slug' => 'baby-girl-tracksuits',
                'name' => 'Pastel Peach Floral Cozy Tracksuit Duo',
                'description' => 'Delightful floral printed pullover sweatshirt with matching ruffled jogger pants. Ultra-gentle on delicate baby skin, 100% combed organic cotton.',
                'price' => 30,
                'original_price' => 42,
                'stock' => 60,
                'sku' => 'KIDS-PEACH-03',
                'image' => 'images/baby_tracksuit_pink.jpg',
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'category_slug' => 'baby-girl-tracksuits',
                'name' => 'Rose Pink Velvet Luxury Loungewear Suit',
                'description' => 'Shimmering plush velvet hooded jacket and pants with cute satin bow details. Perfect for holiday family photos, outings, and chilly evenings.',
                'price' => 45,
                'original_price' => 65,
                'stock' => 35,
                'sku' => 'KIDS-VELVET-04',
                'image' => 'images/baby_tracksuit_velvet.jpg',
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'category_slug' => 'toddler-fleece-velvet',
                'name' => 'Polar Bear Thermal Sherpa Fleece Suit',
                'description' => 'Heavyweight winter polar fleece set with bear ears on the hood. Full front zip for easy dressing, elastic cuffs to lock in warmth.',
                'price' => 48,
                'original_price' => 70,
                'stock' => 45,
                'sku' => 'KIDS-SHERPA-05',
                'image' => 'images/baby_tracksuit_sherpa.jpg',
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'category_slug' => 'toddler-fleece-velvet',
                'name' => 'Midnight Navy Velvet Sports Tracksuit',
                'description' => 'Rich royal navy velvet tracksuit with white sporty side stripes. Stretchable waistband, soft inner cotton lining for active playtime.',
                'price' => 42,
                'original_price' => 60,
                'stock' => 50,
                'sku' => 'KIDS-NAVY-06',
                'image' => 'https://images.unsplash.com/photo-1514090458221-65bb69cf63e6?w=800&auto=format&fit=crop&q=80',
                'is_featured' => false,
                'is_active' => true,
            ],
            [
                'category_slug' => 'organic-cotton-suits',
                'name' => 'Pure Harmony Organic Cotton 2-Piece Set',
                'description' => 'Undyed natural beige organic cotton crewneck sweatshirt and ribbed joggers. Hypoallergenic, chemical-free, ultra-soft for sensitive baby skin.',
                'price' => 36,
                'original_price' => 48,
                'stock' => 70,
                'sku' => 'KIDS-ORGANIC-07',
                'image' => 'https://images.unsplash.com/photo-1544816155-12df9643f363?w=800&auto=format&fit=crop&q=80',
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'category_slug' => 'organic-cotton-suits',
                'name' => 'Sage Green Waffle Knit Tracksuit Set',
                'description' => 'Textured waffle weave organic cotton hoodie and matching harem joggers. Breathable yet cozy, perfect for all-season everyday wear.',
                'price' => 33,
                'original_price' => 45,
                'stock' => 55,
                'sku' => 'KIDS-SAGE-08',
                'image' => 'https://images.unsplash.com/photo-1508214751196-bcfd4ca60f91?w=800&auto=format&fit=crop&q=80',
                'is_featured' => false,
                'is_active' => true,
            ],
            [
                'category_slug' => 'newborn-romper-tracksuits',
                'name' => 'Little Teddy Bear Fleece Hooded Romper Suit',
                'description' => 'All-in-one one-piece baby tracksuit with adorable bear ears, double front zipper for quick diaper changes, and foldover mittens.',
                'price' => 35,
                'original_price' => 50,
                'stock' => 65,
                'sku' => 'KIDS-ROMPER-09',
                'image' => 'https://images.unsplash.com/photo-1519689680058-324335c77eba?w=800&auto=format&fit=crop&q=80',
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'category_slug' => 'summer-activewear',
                'name' => 'Sunny Sunshine Short-Sleeve Terry Track Set',
                'description' => 'Lightweight French terry t-shirt with matching drawstring shorts. Vibrant summer yellow and heather grey contrast for park days.',
                'price' => 25,
                'original_price' => 35,
                'stock' => 80,
                'sku' => 'KIDS-SUMMER-10',
                'image' => 'https://images.unsplash.com/photo-1522771930-78848d9293e8?w=800&auto=format&fit=crop&q=80',
                'is_featured' => false,
                'is_active' => true,
            ],
            [
                'category_slug' => 'baby-boy-tracksuits',
                'name' => 'Aero Jet Blue Windbreaker Tracksuit',
                'description' => 'Water-resistant lightweight nylon shell with breathable cotton mesh lining. Features reflective piping for safety during evening strolls.',
                'price' => 42,
                'original_price' => 58,
                'stock' => 38,
                'sku' => 'KIDS-AERO-11',
                'image' => 'https://images.unsplash.com/photo-1514090458221-65bb69cf63e6?w=800&auto=format&fit=crop&q=80',
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'category_slug' => 'baby-girl-tracksuits',
                'name' => 'Lavender Blossom Quilted Sweat Suit',
                'description' => 'Diamond quilted sweatshirt and elasticated ankle pants in sweet lavender. Double-stitched seams for active toddlers on the move.',
                'price' => 38,
                'original_price' => 52,
                'stock' => 42,
                'sku' => 'KIDS-LAVENDER-12',
                'image' => 'https://images.unsplash.com/photo-1515488042361-ee00e0ddd4e4?w=800&auto=format&fit=crop&q=80',
                'is_featured' => true,
                'is_active' => true,
            ],
        ];

        // Clean out old products and categories safely with disabled FK checks
        Schema::disableForeignKeyConstraints();
        Product::truncate();
        Category::truncate();
        Schema::enableForeignKeyConstraints();

        // Re-create categories
        foreach ($categoriesData as $c) {
            $categories[$c['slug']] = Category::create($c);
        }

        foreach ($productsData as $p) {
            $catSlug = $p['category_slug'];
            unset($p['category_slug']);
            
            $category = $categories[$catSlug] ?? null;
            if ($category) {
                $p['category_id'] = $category->id;
            }
            Product::create($p);
        }
    }
}
