<x-app-layout>

<div class="max-w-6xl mx-auto p-6">

<h1 class="text-3xl mb-6 font-bold">
Cart
</h1>

@if(session('success'))
<div class="bg-green-100 text-green-700 p-3 rounded mb-4">
    {{ session('success') }}
</div>
@endif

@if(count($cart)>0)

<table class="w-full border">

<tr class="bg-gray-200">

<th class="p-3">Name</th>
<th>Price</th>
<th>Quantity</th>
<th>Image</th>
<th>Action</th>

</tr>

@foreach($cart as $id=>$item)

<tr class="border">

<td class="p-3">
{{ $item['name'] }}
</td>

<td>
Rs {{ $item['price'] }}
</td>

<td>

<div class="flex items-center gap-3">

<a href="{{ route('cart.decrease',$id) }}"
class="bg-red-500 text-white px-3 py-1 rounded">
-
</a>

<span class="font-bold">
{{ $item['quantity'] }}
</span>

<a href="{{ route('cart.increase',$id) }}"
class="bg-green-500 text-white px-3 py-1 rounded">
+
</a>

</div>

</td>

<td>

@if(isset($item['image']) && $item['image'])

<img src="{{ asset('storage/'.$item['image']) }}"
width="80"
class="rounded">

@endif

</td>

<td>

<a href="{{ route('cart.remove',$id) }}"
class="text-red-600 font-bold"
onclick="return confirm('Remove this product?')">

Remove

</a>

</td>

</tr>

@endforeach

<tr class="bg-gray-100">

<td colspan="2"></td>

<td class="font-bold">
Total
</td>

<td class="font-bold">

Rs {{
collect($cart)->sum(function($item){
return $item['price'] * $item['quantity'];
})
}}

</td>

<td></td>

</tr>

</table>

<div class="mt-6">

<a href="{{ route('checkout') }}"
class="bg-green-600 text-white px-6 py-3 rounded">

Checkout

</a>

</div>

@else

<div class="text-center">

<h2 class="text-2xl font-bold">
Your Cart is Empty
</h2>

</div>

@endif

</div>

</x-app-layout>