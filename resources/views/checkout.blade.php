<x-app-layout>

<x-slot name="header">
    <h2 class="font-semibold text-xl">
        Checkout
    </h2>
</x-slot>

<div class="p-8">

    <h1 class="text-2xl mb-6">
        Order Summary
    </h1>

    @php
        $total = collect(session('cart', []))->sum(function ($item) {
            return $item['price'] * ($item['quantity'] ?? 1);
        });
    @endphp

    <p class="text-xl mb-6">
        Total: <strong>Rs {{ $total }}</strong>
    </p>

    <form action="{{ route('place.order') }}" method="POST">
        @csrf

        <button
            type="submit"
            class="bg-green-600 text-white px-6 py-3 rounded hover:bg-green-700">
            Place Order
        </button>
    </form>

</div>

</x-app-layout>