<x-app-layout>

<x-slot name="header">
<h2 class="font-semibold text-xl">
Cart
</h2>
</x-slot>

<div class="p-8">

@if(session('success'))
<div class="bg-green-200 p-3 mb-4 rounded">
{{ session('success') }}
</div>
@endif


@if(count($cart)>0)

<table class="w-full border">

<tr class="bg-gray-200">

<th class="p-3">Image</th>
<th>Name</th>
<th>Price</th>
<th>Qty</th>
<th>Action</th>

</tr>

@foreach($cart as $id=>$item)

<tr class="border">

<td class="p-3">

<img
src="{{ asset('storage/'.$item['image']) }}"
width="80"
>

</td>

<td>

{{ $item['name'] }}

</td>

<td>

Rs {{ $item['price'] }}

</td>

<td>

{{ $item['quantity'] ?? 1 }}

</td>

<td>

<a
href="{{ route('cart.remove',$id) }}"
class="bg-red-500 text-white px-3 py-2 rounded"
>

Remove

</a>

</td>

</tr>

@endforeach

</table>

@else

<h2 class="text-xl">

Cart Empty

</h2>

@endif

</div>

</x-app-layout>