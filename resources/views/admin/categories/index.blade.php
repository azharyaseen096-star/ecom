<x-app-layout>

    <div class="bg-gray-900 text-white py-6 border-b border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between">
            <div>
                <span class="text-xs font-black uppercase tracking-widest text-amber-400">Store Structure</span>
                <h1 class="text-2xl sm:text-3xl font-black text-white mt-1">Manage Categories</h1>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="bg-gray-800 hover:bg-gray-700 text-white text-xs font-bold px-4 py-2.5 rounded-xl transition">
                ← Back to Dashboard
            </a>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-8">
        
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            
            <!-- Left: Add New Category Form -->
            <div class="lg:col-span-4 bg-white rounded-3xl border border-gray-200 p-6 sm:p-8 shadow-sm space-y-4">
                <h2 class="font-extrabold text-gray-900 text-base border-b border-gray-100 pb-3">
                    Add Category
                </h2>

                <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Category Name <span class="text-red-500">*</span></label>
                        <input type="text" name="name" required placeholder="e.g. Gaming & VR" class="w-full text-xs p-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-orange-500">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Icon (Emoji or symbol)</label>
                        <input type="text" name="icon" placeholder="e.g. 🎮 or 📱" class="w-full text-xs p-3 bg-gray-50 border border-gray-200 rounded-xl">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Short Description</label>
                        <textarea name="description" rows="3" placeholder="Brief description..." class="w-full text-xs p-3 bg-gray-50 border border-gray-200 rounded-xl"></textarea>
                    </div>

                    <button type="submit" class="w-full py-3.5 bg-orange-600 hover:bg-orange-700 text-white font-extrabold text-xs rounded-xl shadow transition">
                        Create Category
                    </button>
                </form>
            </div>

            <!-- Right: Categories List Table -->
            <div class="lg:col-span-8 bg-white rounded-3xl border border-gray-200 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-gray-100 flex items-center justify-between">
                    <h3 class="font-extrabold text-gray-900 text-base">Active Categories ({{ $categories->count() }})</h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs text-gray-600">
                        <thead class="bg-gray-50 uppercase text-gray-400 font-black border-b border-gray-200">
                            <tr>
                                <th class="px-6 py-4">Icon</th>
                                <th class="px-6 py-4">Name & Slug</th>
                                <th class="px-6 py-4">Products</th>
                                <th class="px-6 py-4">Status</th>
                                <th class="px-6 py-4 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($categories as $cat)
                                <tr class="hover:bg-gray-50/80">
                                    <td class="px-6 py-4 text-2xl">
                                        {{ $cat->icon ?: '📦' }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="font-bold text-gray-900 text-sm block">{{ $cat->name }}</span>
                                        <span class="font-mono text-gray-400 text-[11px]">{{ $cat->slug }}</span>
                                    </td>
                                    <td class="px-6 py-4 font-bold text-gray-800">
                                        {{ $cat->products_count }} {{ Str::plural('item', $cat->products_count) }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-block text-[10px] font-black px-2.5 py-0.5 rounded-full {{ $cat->is_active ? 'bg-emerald-100 text-emerald-800' : 'bg-gray-100 text-gray-500' }}">
                                            {{ $cat->is_active ? 'Active' : 'Disabled' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <form action="{{ route('admin.categories.destroy', $cat->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Delete this category?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-gray-400 hover:text-red-600 p-1.5 transition">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="p-8 text-center text-gray-400">No categories found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

    </div>

</x-app-layout>
