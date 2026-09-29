<x-app-layout>

    <div class="bg-rose-50/70 border-b border-rose-100 py-6 sm:py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 sm:gap-4">
                <div>
                    <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900">Baby &amp; Kids Tracksuits Collection</h1>
                    <p class="text-xs sm:text-sm text-slate-500 mt-0.5 sm:mt-1">Showing {{ $products->total() }} cozy, premium outfits with worldwide express delivery</p>
                </div>

                <!-- Breadcrumb -->
                <div class="flex items-center gap-2 text-xs font-semibold text-slate-500">
                    <a href="{{ route('home') }}" class="hover:text-rose-600">Home</a>
                    <i class="fa-solid fa-chevron-right text-[10px]"></i>
                    <span class="text-rose-600 font-bold">Tracksuits</span>
                    @if(request('category'))
                        <i class="fa-solid fa-chevron-right text-[10px]"></i>
                        <span class="text-slate-800 font-bold">{{ ucfirst(str_replace('-', ' ', request('category'))) }}</span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-10" x-data="{ mobileFiltersOpen: false }">
        
        <!-- Mobile Filter Trigger Button -->
        <div class="lg:hidden mb-4 flex items-center justify-between gap-3">
            <button 
                type="button" 
                @click="mobileFiltersOpen = !mobileFiltersOpen" 
                class="flex-1 py-3 px-4 bg-white border border-slate-200 rounded-2xl font-black text-xs text-slate-800 shadow-xs flex items-center justify-center gap-2 active:scale-95 transition"
            >
                <i class="fa-solid fa-sliders text-rose-600"></i>
                <span x-text="mobileFiltersOpen ? 'Hide Filters' : 'Filter Collections'"></span>
                @if(request()->anyFilled(['query', 'category', 'min_price', 'max_price', 'sort']))
                    <span class="w-2 h-2 rounded-full bg-rose-500"></span>
                @endif
            </button>

            @if(request()->anyFilled(['query', 'category', 'min_price', 'max_price', 'sort']))
                <a href="{{ route('shop') }}" class="py-3 px-4 bg-red-50 text-red-600 rounded-2xl text-xs font-black border border-red-200 shrink-0">
                    Reset
                </a>
            @endif
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 sm:gap-8">
            
            <!-- Left Filter Sidebar (Collapsible on Mobile) -->
            <div class="lg:col-span-1" :class="mobileFiltersOpen ? 'block mb-4' : 'hidden lg:block'">
                <div class="bg-white rounded-3xl p-5 sm:p-6 border border-slate-200/80 shadow-xs space-y-6">
                    
                    <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                        <h3 class="font-extrabold text-slate-900 text-base flex items-center gap-2">
                            <i class="fa-solid fa-sliders text-rose-600"></i> Filter Tracksuits
                        </h3>
                        @if(request()->anyFilled(['query', 'category', 'min_price', 'max_price', 'sort']))
                            <a href="{{ route('shop') }}" class="text-xs font-bold text-red-600 hover:underline">
                                Reset All
                            </a>
                        @endif
                    </div>

                    <form action="{{ route('shop') }}" method="GET" class="space-y-6">
                        @if(request('query'))
                            <input type="hidden" name="query" value="{{ request('query') }}">
                        @endif

                        <!-- Categories Filter -->
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-3">Styles &amp; Types</label>
                            <div class="space-y-1.5 max-h-64 overflow-y-auto pr-1">
                                <a href="{{ route('shop', array_merge(request()->except('category', 'page'))) }}" 
                                   class="flex items-center justify-between text-xs sm:text-sm py-2 px-3 rounded-xl transition {{ !request('category') ? 'bg-rose-50 font-black text-rose-600' : 'text-slate-600 hover:bg-slate-50' }}">
                                    <span>All Styles</span>
                                    <span class="text-[11px] bg-slate-100 px-2 py-0.5 rounded-full text-slate-500 font-bold">{{ \App\Models\Product::where('is_active', true)->count() }}</span>
                                </a>

                                @foreach($categories as $cat)
                                    <a href="{{ route('shop', array_merge(request()->except('page'), ['category' => $cat->slug])) }}" 
                                       class="flex items-center justify-between text-xs sm:text-sm py-2 px-3 rounded-xl transition {{ request('category') === $cat->slug ? 'bg-rose-50 font-black text-rose-600' : 'text-slate-600 hover:bg-slate-50' }}">
                                        <span class="flex items-center gap-2 truncate mr-2">
                                            <span>{{ $cat->icon }}</span>
                                            <span class="truncate">{{ $cat->name }}</span>
                                        </span>
                                        <span class="text-[11px] bg-slate-100 px-2 py-0.5 rounded-full text-slate-500 font-bold shrink-0">{{ $cat->products_count }}</span>
                                    </a>
                                @endforeach
                            </div>
                        </div>

                        <!-- Price Filter -->
                        <div class="pt-4 border-t border-slate-100">
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-3">Price Range (USD $)</label>
                            <div class="grid grid-cols-2 gap-2 mb-3">
                                <div>
                                    <span class="text-[10px] text-slate-400 uppercase font-bold">Min ($)</span>
                                    <input type="number" name="min_price" value="{{ request('min_price', 0) }}" min="0" step="5" class="w-full text-xs p-2 bg-slate-50 border border-slate-200 rounded-xl">
                                </div>
                                <div>
                                    <span class="text-[10px] text-slate-400 uppercase font-bold">Max ($)</span>
                                    <input type="number" name="max_price" value="{{ request('max_price', $maxProductPrice) }}" min="0" step="10" class="w-full text-xs p-2 bg-slate-50 border border-slate-200 rounded-xl">
                                </div>
                            </div>
                            <button type="submit" class="w-full py-2.5 bg-slate-900 hover:bg-rose-600 text-white font-extrabold text-xs rounded-xl transition shadow-xs cursor-pointer">
                                Apply Filter
                            </button>
                        </div>

                        <!-- Sorting -->
                        <div class="pt-4 border-t border-slate-100">
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-2">Sort Outfits</label>
                            <select name="sort" onchange="this.form.submit()" class="w-full text-xs p-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-rose-500 font-bold">
                                <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Newest Outfits</option>
                                <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                                <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                                <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Alphabetical (A-Z)</option>
                            </select>
                        </div>
                    </form>

                </div>
            </div>

            <!-- Right Product Grid Area -->
            <div class="lg:col-span-3 space-y-6">
                
                @if(request('query'))
                    <div class="bg-rose-50 border border-rose-200 rounded-2xl p-4 flex items-center justify-between">
                        <span class="text-xs sm:text-sm text-rose-950 font-medium">
                            Search results for "<strong class="font-bold">{{ request('query') }}</strong>"
                        </span>
                        <a href="{{ route('shop', request()->except('query')) }}" class="text-xs font-bold text-rose-600 hover:underline">
                            Clear Search
                        </a>
                    </div>
                @endif

                <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-6">
                    @forelse($products as $product)
                        <div class="bg-white rounded-3xl border border-slate-200/80 overflow-hidden shadow-xs hover:shadow-xl transition-all duration-300 flex flex-col group touch-press">
                            
                            <!-- Product Image -->
                            <div class="relative bg-slate-50 h-44 sm:h-60 p-2 sm:p-4 flex items-center justify-center overflow-hidden">
                                @if($product->discount_percentage > 0)
                                    <span class="absolute top-2.5 left-2.5 bg-rose-600 text-white text-[9px] sm:text-[10px] font-black px-2.5 py-1 rounded-xl shadow-sm z-10">
                                        -{{ $product->discount_percentage }}% OFF
                                    </span>
                                @endif

                                <a href="{{ route('product.show', $product->id) }}" class="w-full h-full flex items-center justify-center">
                                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="max-h-full max-w-full object-cover rounded-2xl group-hover:scale-105 transition-transform duration-500">
                                </a>
                            </div>

                            <!-- Content -->
                            <div class="p-3.5 sm:p-5 flex-1 flex flex-col justify-between space-y-3">
                                <div>
                                    <span class="text-[9px] sm:text-[10px] uppercase font-black text-rose-500 block truncate">
                                        {{ $product->category->name ?? 'Baby Tracksuit' }}
                                    </span>
                                    <h3 class="font-extrabold text-slate-900 text-xs sm:text-sm line-clamp-2 leading-tight group-hover:text-rose-600 transition mt-0.5">
                                        <a href="{{ route('product.show', $product->id) }}">{{ $product->name }}</a>
                                    </h3>
                                </div>

                                <div>
                                    <div class="flex items-baseline gap-2">
                                        <span class="text-base sm:text-lg font-black text-slate-900">
                                            ${{ number_format($product->price, 2) }}
                                        </span>
                                        @if($product->original_price && $product->original_price > $product->price)
                                            <span class="text-xs line-through text-slate-400">
                                                ${{ number_format($product->original_price, 2) }}
                                            </span>
                                        @endif
                                    </div>

                                    <div class="pt-3 flex items-center gap-2">
                                        <form method="POST" action="{{ route('cart.add', $product->id) }}" class="flex-1">
                                            @csrf
                                            <button type="submit" class="w-full bg-slate-900 hover:bg-rose-600 text-white font-black py-2.5 rounded-xl text-xs transition flex items-center justify-center gap-1.5 touch-press cursor-pointer">
                                                <i class="fa-solid fa-cart-shopping text-xs"></i>
                                                <span>Add to Bag</span>
                                            </button>
                                        </form>
                                        <a href="{{ route('product.show', $product->id) }}" class="w-9 h-9 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 flex items-center justify-center text-xs shrink-0 transition">
                                            <i class="fa-solid fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full py-16 text-center bg-white rounded-3xl border border-slate-200 p-8 space-y-4">
                            <div class="text-5xl">🧸</div>
                            <h3 class="text-lg font-bold text-slate-900">No baby tracksuits match your filter.</h3>
                            <p class="text-xs text-slate-500">Try changing your price range or selected style category.</p>
                            <a href="{{ route('shop') }}" class="inline-block bg-rose-600 text-white px-5 py-2.5 rounded-2xl text-xs font-black">
                                Reset Filters
                            </a>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                @if($products->hasPages())
                    <div class="pt-6">
                        {{ $products->links() }}
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>