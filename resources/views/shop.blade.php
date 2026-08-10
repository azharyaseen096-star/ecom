<x-app-layout>

<x-slot name="header">
    <div class="flex items-center justify-between">
        <h2 class="text-2xl font-bold tracking-tight" style="color: #1a1a1a;">Shop</h2>
        <p class="text-sm" style="color: #9a9590;">{{ $products->count() }} products</p>
    </div>
</x-slot>

<style>
    .shop-bg { background-color: #f7f5f0; }

    .product-card {
        background: #ffffff;
        border: 1px solid #ebe7e1;
        border-radius: 16px;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .product-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 20px 40px rgba(26, 26, 26, 0.08);
    }

    .product-img-wrap {
        background: #f2efea;
        overflow: hidden;
        position: relative;
    }
    .product-img-wrap img {
        transition: transform 0.5s ease;
    }
    .product-card:hover .product-img-wrap img {
        transform: scale(1.05);
    }

    .add-btn {
        background: #1a1a1a;
        color: #ffffff;
        border: none;
        border-radius: 10px;
        padding: 12px 0;
        width: 100%;
        font-size: 14px;
        font-weight: 600;
        letter-spacing: 0.5px;
        cursor: pointer;
        transition: background 0.3s ease;
    }
    .add-btn:hover {
        background: #c8956c;
    }

    .price-tag {
        color: #c8956c;
        font-weight: 700;
        font-size: 18px;
    }

    .product-name {
        color: #1a1a1a;
        font-weight: 600;
        font-size: 16px;
        line-height: 1.4;
    }

    .product-desc {
        color: #9a9590;
        font-size: 13px;
        line-height: 1.6;
    }

    .badge-stock {
        position: absolute;
        top: 12px;
        left: 12px;
        background: #1a1a1a;
        color: #ffffff;
        font-size: 11px;
        font-weight: 600;
        padding: 4px 10px;
        border-radius: 6px;
        letter-spacing: 0.3px;
    }
</style>

<div class="shop-bg min-h-screen">

    <div class="max-w-7xl mx-auto px-6 py-10">

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-7">

            @foreach($products as $product)

            <div class="product-card">

                <div class="product-img-wrap" style="height: 260px; display: flex; align-items: center; justify-content: center;">
                    <span class="badge-stock">NEW</span>
                    <img
                        src="{{ $product->image ? asset('storage/'.$product->image) : 'https://picsum.photos/seed/'.$product->id.'/400/300' }}"
                        style="max-height: 100%; max-width: 90%; object-fit: contain;"
                        alt="{{ $product->name }}"
                    >
                </div>

                <div style="padding: 20px 22px 22px;">

                    <h3 class="product-name" style="margin: 0 0 6px;">
                        {{ $product->name }}
                    </h3>

                    <p class="product-desc" style="margin: 0 0 14px;">
                        {{ Str::limit($product->description, 60) }}
                    </p>

                    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 16px;">
                        <span class="price-tag">Rs {{ number_format($product->price) }}</span>
                        <div style="display: flex; gap: 3px;">
                            <span style="width: 8px; height: 8px; border-radius: 50%; background: #1a1a1a; display: inline-block;"></span>
                            <span style="width: 8px; height: 8px; border-radius: 50%; background: #c8956c; display: inline-block;"></span>
                            <span style="width: 8px; height: 8px; border-radius: 50%; background: #ebe7e1; display: inline-block;"></span>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('cart.add', $product->id) }}">
                        @csrf
                        <button type="submit" class="add-btn">
                            Add To Cart
                        </button>
                    </form>

                </div>

            </div>

            @endforeach

        </div>

        @if($products->isEmpty())
            <div style="text-align: center; padding: 80px 20px;">
                <p style="color: #9a9590; font-size: 16px;">No products found.</p>
            </div>
        @endif

    </div>

</div>

</x-app-layout>