<x-app-layout>

    <div class="bg-gray-900 text-white py-6 border-b border-gray-800">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between">
            <div>
                <span class="text-xs font-black uppercase tracking-widest text-amber-400">Inventory</span>
                <h1 class="text-2xl sm:text-3xl font-black text-white mt-1">Add New Product</h1>
            </div>
            <a href="{{ route('admin.products.index') }}" class="bg-gray-800 hover:bg-gray-700 text-white text-xs font-bold px-4 py-2.5 rounded-xl transition">
                ← Back to Products
            </a>
        </div>
    </div>

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-3xl border border-gray-200 p-6 sm:p-10 shadow-sm space-y-6">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                
                <div class="sm:col-span-2">
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Product Title / Name <span class="text-red-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name') }}" required placeholder="e.g. Pro Wireless ANC Earbuds" class="w-full text-sm p-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-orange-500">
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Category</label>
                    <select name="category_id" class="w-full text-sm p-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-orange-500">
                        <option value="">Select Category</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Product SKU (Auto generated if blank)</label>
                    <input type="text" name="sku" value="{{ old('sku') }}" placeholder="e.g. EAR-PRO-001" class="w-full text-sm p-3 bg-gray-50 border border-gray-200 rounded-xl">
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Sale Price (PKR Rs) <span class="text-red-500">*</span></label>
                    <input type="number" name="price" value="{{ old('price') }}" required min="0" placeholder="e.g. 4500" class="w-full text-sm p-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-orange-500">
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Original / Strike Price (PKR Rs - Optional for Discount)</label>
                    <input type="number" name="original_price" value="{{ old('original_price') }}" min="0" placeholder="e.g. 6500" class="w-full text-sm p-3 bg-gray-50 border border-gray-200 rounded-xl">
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Stock Quantity <span class="text-red-500">*</span></label>
                    <input type="number" name="stock" value="{{ old('stock', 50) }}" required min="0" class="w-full text-sm p-3 bg-gray-50 border border-gray-200 rounded-xl">
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Upload Product Image</label>
                    <input type="file" name="image" accept="image/*" class="w-full text-xs p-2 bg-gray-50 border border-gray-200 rounded-xl">
                </div>

                <div class="sm:col-span-2">
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Or Direct Image URL (CDN / Web link)</label>
                    <input type="url" name="image_url" value="{{ old('image_url') }}" placeholder="https://images.unsplash.com/photo-..." class="w-full text-xs p-3 bg-gray-50 border border-gray-200 rounded-xl">
                </div>

                <div class="sm:col-span-2">
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Product Description</label>
                    <textarea name="description" rows="4" placeholder="Detailed product specifications, warranty info, and features..." class="w-full text-sm p-3 bg-gray-50 border border-gray-200 rounded-xl">{{ old('description') }}</textarea>
                </div>

                <div class="sm:col-span-2 flex items-center gap-6 pt-2">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }} class="rounded border-gray-300 text-orange-600 focus:ring-orange-500">
                        <span class="text-xs font-bold text-gray-800">Feature on Homepage Banner Deals</span>
                    </label>

                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" checked class="rounded border-gray-300 text-orange-600 focus:ring-orange-500">
                        <span class="text-xs font-bold text-gray-800">Publish Immediately (Active in Store)</span>
                    </label>
                </div>

            </div>

            <div class="pt-6 border-t border-gray-100 flex items-center justify-end gap-3">
                <a href="{{ route('admin.products.index') }}" class="px-5 py-3 rounded-xl border border-gray-200 text-xs font-bold text-gray-600 hover:bg-gray-50">
                    Cancel
                </a>
                <button type="submit" class="px-6 py-3 rounded-xl bg-orange-600 hover:bg-orange-700 text-white text-xs font-extrabold shadow-md transition">
                    Save Product
                </button>
            </div>
        </form>
    </div>

</x-app-layout>
