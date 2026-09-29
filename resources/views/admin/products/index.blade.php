<x-app-layout>

    <div class="bg-gray-900 text-white py-6 border-b border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <span class="text-xs font-black uppercase tracking-widest text-amber-400">Inventory & Catalog</span>
                <h1 class="text-2xl sm:text-3xl font-black text-white mt-1">Manage Products</h1>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ route('admin.dashboard') }}" class="bg-gray-800 hover:bg-gray-700 text-white text-xs font-bold px-3.5 py-2.5 rounded-xl transition">
                    ← Dashboard
                </a>
                <a href="{{ route('admin.products.create') }}" class="bg-gradient-to-r from-orange-500 to-amber-500 hover:from-orange-600 hover:to-amber-600 text-white text-xs font-extrabold px-4 py-2.5 rounded-xl shadow-md transition flex items-center gap-1.5">
                    <i class="fa-solid fa-plus"></i>
                    <span>Add New Product</span>
                </a>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-6">
        
        <!-- Search & Category Filters -->
        <div class="bg-white rounded-2xl p-5 border border-gray-200 shadow-sm flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <form action="{{ route('admin.products.index') }}" method="GET" class="flex flex-1 items-center gap-3">
                <div class="relative flex-1">
                    <input type="text" name="query" value="{{ request('query') }}" placeholder="Search products by title or SKU..." class="w-full text-xs pl-8 pr-4 py-2 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-orange-500">
                    <i class="fa-solid fa-magnifying-glass absolute left-3 top-2.5 text-gray-400 text-xs"></i>
                </div>

                <select name="category" onchange="this.form.submit()" class="text-xs p-2 bg-gray-50 border border-gray-200 rounded-xl">
                    <option value="">All Categories</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>

                <button type="submit" class="bg-gray-900 hover:bg-orange-600 text-white text-xs font-bold px-4 py-2 rounded-xl transition">
                    Filter
                </button>
            </form>
        </div>

        <!-- Products Table -->
        <div class="bg-white rounded-3xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs text-gray-600">
                    <thead class="bg-gray-50 uppercase text-gray-400 font-black border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-4">Image</th>
                            <th class="px-6 py-4">Product Details</th>
                            <th class="px-6 py-4">Category</th>
                            <th class="px-6 py-4">Price (PKR)</th>
                            <th class="px-6 py-4">Stock</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($products as $product)
                            <tr class="hover:bg-gray-50/80 transition">
                                <td class="px-6 py-4">
                                    <div class="w-14 h-14 bg-gray-50 rounded-xl border border-gray-100 p-1 flex items-center justify-center overflow-hidden">
                                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="max-h-full max-w-full object-contain">
                                    </div>
                                </td>

                                <td class="px-6 py-4">
                                    <span class="font-bold text-gray-900 text-sm block">{{ $product->name }}</span>
                                    <span class="font-mono text-[11px] text-gray-400">SKU: {{ $product->sku }}</span>
                                    @if($product->is_featured)
                                        <span class="inline-block bg-orange-100 text-orange-800 text-[10px] font-black px-2 py-0.5 rounded mt-0.5 uppercase">Featured</span>
                                    @endif
                                </td>

                                <td class="px-6 py-4">
                                    <span class="font-semibold text-gray-700 bg-gray-100 px-2.5 py-1 rounded-lg">
                                        {{ $product->category->name ?? 'Uncategorized' }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 font-extrabold text-gray-900 text-sm">
                                    Rs {{ number_format($product->price) }}
                                    @if($product->original_price && $product->original_price > $product->price)
                                        <span class="block text-[11px] text-gray-400 line-through font-normal">Rs {{ number_format($product->original_price) }}</span>
                                    @endif
                                </td>

                                <td class="px-6 py-4">
                                    @if($product->stock > 10)
                                        <span class="font-bold text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-lg">{{ $product->stock }} units</span>
                                    @elseif($product->stock > 0)
                                        <span class="font-bold text-amber-700 bg-amber-50 px-2.5 py-1 rounded-lg">Low: {{ $product->stock }}</span>
                                    @else
                                        <span class="font-bold text-red-700 bg-red-50 px-2.5 py-1 rounded-lg">Out of stock</span>
                                    @endif
                                </td>

                                <td class="px-6 py-4">
                                    <span class="inline-block text-[10px] font-black px-2.5 py-1 rounded-full {{ $product->is_active ? 'bg-emerald-100 text-emerald-800' : 'bg-gray-100 text-gray-500' }}">
                                        {{ $product->is_active ? 'Active' : 'Disabled' }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 text-right space-x-2">
                                    <a href="{{ route('admin.products.edit', $product->id) }}" class="inline-block bg-gray-100 hover:bg-orange-50 hover:text-orange-600 text-gray-700 font-bold text-xs px-3 py-1.5 rounded-lg transition">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Delete this product permanently?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-gray-100 hover:bg-red-50 text-gray-400 hover:text-red-600 p-1.5 rounded-lg transition">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="p-12 text-center text-gray-400">
                                    No products found. <a href="{{ route('admin.products.create') }}" class="text-orange-600 font-bold hover:underline">Add your first product!</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-4 border-t border-gray-100">
                {{ $products->links() }}
            </div>
        </div>

    </div>

</x-app-layout>
