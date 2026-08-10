<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-2xl">
            Admin Dashboard
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto p-8">

        <div class="flex justify-between items-center mb-6">

            <h1 class="text-3xl font-bold">
                Products
            </h1>

            <div class="space-x-2">

                <a href="{{ route('admin.orders') }}"
                   class="bg-blue-600 text-white px-5 py-2 rounded">
                    Orders
                </a>

                <a href="{{ route('admin.products.create') }}"
                   class="bg-green-600 text-white px-5 py-2 rounded">
                    + Add Product
                </a>

            </div>

        </div>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <table class="w-full border">

            <tr class="bg-gray-100">
                <th class="p-3">Image</th>
                <th>Name</th>
                <th>Price</th>
                <th>Action</th>
            </tr>

            @foreach($products as $product)

            <tr class="border-t">

                <td class="p-3">
                    @if($product->image)
                        <img src="{{ asset('storage/'.$product->image) }}"
                             width="70">
                    @endif
                </td>

                <td>{{ $product->name }}</td>

                <td>Rs {{ $product->price }}</td>

                <td>

                    <a href="{{ route('admin.products.edit', $product->id) }}"
                       class="text-blue-600">
                        Edit
                    </a>

                    |

                    <a href="{{ route('admin.products.delete', $product->id) }}"
                       class="text-red-600"
                       onclick="return confirm('Delete this product?')">
                        Delete
                    </a>

                </td>

            </tr>

            @endforeach

        </table>

    </div>

</x-app-layout>