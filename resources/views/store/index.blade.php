<x-app-layout>
    <div class="py-12 bg-[#f8fafc] min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Header Section -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-10 gap-4">
                <div>
                    <span class="text-indigo-600 font-bold text-sm tracking-widest uppercase">Premium Marketplace</span>
                    <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight">Digital <span class="text-indigo-600">Library</span></h2>
                    <p class="text-slate-500 mt-1 font-medium">Explore high-quality resources curated by professionals.</p>
                </div>
                <div class="bg-white px-5 py-2.5 rounded-2xl shadow-sm border border-slate-200 flex items-center gap-3">
                    <span class="relative flex h-3 w-3">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-3 w-3 bg-indigo-500"></span>
                    </span>
                    <span class="text-slate-700 font-bold text-sm">{{ $products->count() }} items available</span>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($products as $product)
                    <div class="group bg-white rounded-3xl border border-slate-200 overflow-hidden hover:border-indigo-300 hover:shadow-2xl hover:shadow-indigo-500/10 transition-all duration-300 flex flex-col h-full">
                        
                        <!-- Product Preview Image -->
                        <div class="relative aspect-[4/3] bg-slate-100 overflow-hidden">
                            <div class="absolute inset-0 bg-gradient-to-br from-indigo-500/20 to-purple-500/20 group-hover:scale-110 transition-transform duration-500"></div>
                            
                            <!-- Category/Badge -->
                            <div class="absolute top-4 left-4 z-10">
                                <span class="bg-white/90 backdrop-blur px-3 py-1 rounded-lg text-[10px] font-bold uppercase tracking-wider text-slate-700 shadow-sm">Digital Note</span>
                            </div>

                            <!-- Icon Placeholder (Can be replaced with $product->image) -->
                            <div class="absolute inset-0 flex items-center justify-center">
                                <svg class="w-16 h-16 text-indigo-500 opacity-40 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </div>
                            
                            <!-- Price Tag -->
                            <div class="absolute bottom-4 right-4 bg-indigo-600 text-white px-3 py-1.5 rounded-xl font-bold text-sm shadow-lg group-hover:bg-slate-900 transition-colors">
                                Rs. {{ number_format($product->price) }}
                            </div>
                        </div>

                        <!-- Content Side -->
                        <div class="p-5 flex flex-col flex-1">
                            <h4 class="text-lg font-bold text-slate-800 line-clamp-1 group-hover:text-indigo-600 transition-colors">
                                {{ $product->title }}
                            </h4>
                            
                            <!-- Author Info -->
                            <div class="flex items-center gap-2 mt-2">
                                <div class="w-5 h-5 rounded-full bg-indigo-100 flex items-center justify-center text-[8px] font-bold text-indigo-600 uppercase border border-indigo-200">
                                    {{ substr($product->tutor->name, 0, 1) }}
                                </div>
                                <span class="text-xs text-slate-500 font-medium">By <span class="text-slate-700 font-semibold">{{ $product->tutor->name }}</span></span>
                            </div>

                            <p class="text-xs text-slate-500 mt-4 line-clamp-2 leading-relaxed italic">
                                {{ $product->description }}
                            </p>
                            
                            <!-- Actions -->
                            <div class="mt-auto pt-5 flex items-center justify-between gap-3">
                                <a href="{{ route('store.show', $product->id) }}" class="flex-1 bg-slate-50 hover:bg-indigo-600 hover:text-white text-slate-700 py-3 rounded-xl text-[10px] font-extrabold uppercase tracking-widest text-center transition-all border border-slate-100 active:scale-95">
                                    View Details
                                </a>
                                <button class="p-3 bg-indigo-50 text-indigo-600 rounded-xl hover:bg-indigo-100 transition active:scale-90">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if($products->isEmpty())
                <div class="text-center py-24 bg-white rounded-[3rem] border-2 border-dashed border-slate-200">
                    <div class="bg-slate-50 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                        </svg>
                    </div>
                    <p class="text-slate-500 font-bold text-lg">No products found</p>
                    <p class="text-slate-400 text-sm italic">Check back later for new academic resources.</p>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>