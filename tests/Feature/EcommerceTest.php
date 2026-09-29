<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\Setting;

class EcommerceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test_home_page_loads_successfully()
    {
        $response = $this->get(route('home'));
        $response->assertStatus(200);
        $response->assertSee('Bazaar');
    }

    public function test_shop_page_displays_products_and_categories()
    {
        $category = Category::first() ?? Category::create(['name' => 'Tech Test', 'slug' => 'tech-test']);
        $product = Product::first() ?? Product::create([
            'category_id' => $category->id,
            'name' => 'Testing Smartphone Pro',
            'sku' => 'TEST-001',
            'price' => 50000,
            'stock' => 10,
            'image' => 'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9',
            'is_active' => true,
        ]);

        $response = $this->get(route('shop'));
        $response->assertStatus(200);
        $response->assertSee($product->name);

        // Filter by category
        $responseCat = $this->get(route('shop', ['category' => $category->slug]));
        $responseCat->assertStatus(200);
    }

    public function test_product_detail_page_loads()
    {
        $product = Product::first();
        if ($product) {
            $response = $this->get(route('product.show', $product->id));
            $response->assertStatus(200);
            $response->assertSee($product->name);
        }
    }

    public function test_cart_operations()
    {
        $product = Product::first();
        if ($product) {
            // Add to Cart
            $response = $this->post(route('cart.add', $product->id), ['quantity' => 2]);
            $response->assertRedirect();
            $this->assertNotEmpty(session('cart'));

            // View Cart
            $cartView = $this->get(route('cart'));
            $cartView->assertStatus(200);
            $cartView->assertSee($product->name);

            // Increase Cart
            $incResponse = $this->get(route('cart.increase', $product->id));
            $incResponse->assertRedirect();

            // Decrease Cart
            $decResponse = $this->get(route('cart.decrease', $product->id));
            $decResponse->assertRedirect();

            // Remove Cart
            $remResponse = $this->get(route('cart.remove', $product->id));
            $remResponse->assertRedirect();
        }
    }

    public function test_checkout_and_order_placement_with_jazzcash_and_gps_location()
    {
        $user = User::firstOrCreate(
            ['email' => 'testuser@example.com'],
            ['name' => 'Test Customer', 'password' => bcrypt('password'), 'is_admin' => 0]
        );

        $product = Product::first();

        // Put item in cart
        $this->actingAs($user)->post(route('cart.add', $product->id), ['quantity' => 1]);

        // Visit checkout
        $checkoutResponse = $this->actingAs($user)->get(route('checkout'));
        $checkoutResponse->assertStatus(200);
        $checkoutResponse->assertSee('Pinpoint Delivery Location');
        $checkoutResponse->assertSee('JazzCash');
        $checkoutResponse->assertSee('EasyPaisa');

        // Place Order with JazzCash and GPS coordinates
        $orderData = [
            'customer_name' => 'Hamza Tariq',
            'customer_phone' => '03009876543',
            'customer_email' => 'hamza@example.com',
            'shipping_address' => 'House 45, Street 12, Gulberg 3',
            'city' => 'Lahore',
            'province' => 'Punjab',
            'postal_code' => '54000',
            'delivery_notes' => 'Ring the bell twice',
            'latitude' => 31.520370,
            'longitude' => 74.358747,
            'payment_method' => 'jazzcash',
            'sender_account_number' => '03009876543',
            'transaction_id' => 'JC998877665544',
        ];

        $placeOrderResponse = $this->actingAs($user)->post(route('place.order'), $orderData);
        $placeOrderResponse->assertRedirect();

        // Verify Order in Database
        $this->assertDatabaseHas('orders', [
            'customer_phone' => '03009876543',
            'payment_method' => 'jazzcash',
            'transaction_id' => 'JC998877665544',
            'city' => 'Lahore',
        ]);

        $createdOrder = Order::where('transaction_id', 'JC998877665544')->first();
        $this->assertNotNull($createdOrder);

        // Verify Customer can view order tracking
        $orderShowResponse = $this->actingAs($user)->get(route('orders.show', $createdOrder->id));
        $orderShowResponse->assertStatus(200);
        $orderShowResponse->assertSee($createdOrder->order_number);
    }

    public function test_admin_dashboard_and_order_verification()
    {
        $admin = User::firstOrCreate(
            ['email' => 'admin_test@ecom.pk'],
            ['name' => 'Admin Boss', 'password' => bcrypt('password'), 'is_admin' => 1]
        );
        $admin->is_admin = 1;
        $admin->save();

        // Admin Dashboard
        $adminDash = $this->actingAs($admin)->get(route('admin.dashboard'));
        $adminDash->assertStatus(200);
        $adminDash->assertSee('Admin Dashboard');

        // Admin Orders List
        $adminOrders = $this->actingAs($admin)->get(route('admin.orders.index'));
        $adminOrders->assertStatus(200);

        // Admin View Order Details & Verify Payment
        $order = Order::latest()->first();
        if ($order) {
            $adminOrderShow = $this->actingAs($admin)->get(route('admin.orders.show', $order->id));
            $adminOrderShow->assertStatus(200);
            $adminOrderShow->assertSee($order->order_number);

            // Update status to Paid & Shipped
            $updateResponse = $this->actingAs($admin)->post(route('admin.orders.status', $order->id), [
                'status' => 'Shipped',
                'payment_status' => 'Paid',
                'admin_notes' => 'Payment verified with JazzCash gateway TID',
            ]);
            $updateResponse->assertRedirect();

            $this->assertDatabaseHas('orders', [
                'id' => $order->id,
                'status' => 'Shipped',
                'payment_status' => 'Paid',
            ]);
        }
    }

    public function test_admin_payment_settings_update()
    {
        $admin = User::where('is_admin', 1)->first();

        $settingsData = [
            'jazzcash_account_number' => '03009998888',
            'jazzcash_account_title' => 'UPDATED JAZZCASH STORE',
            'easypaisa_account_number' => '03459998888',
            'easypaisa_account_title' => 'UPDATED EASYPAISA STORE',
            'shipping_fee' => '300',
            'free_shipping_threshold' => '4000',
            'contact_phone' => '0300-9998888',
        ];

        $response = $this->actingAs($admin)->post(route('admin.settings.update'), $settingsData);
        $response->assertRedirect(route('admin.settings.index'));

        $this->assertEquals('03009998888', Setting::get('jazzcash_account_number'));
        $this->assertEquals('UPDATED JAZZCASH STORE', Setting::get('jazzcash_account_title'));
        $this->assertEquals('300', Setting::get('shipping_fee'));
    }
}
