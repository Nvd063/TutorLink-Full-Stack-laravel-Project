<x-app-layout>
    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="flex justify-between items-end mb-12">
                <div>
                    <h2 class="text-4xl font-black text-slate-900 italic tracking-tight uppercase">Digital Library</h2>
                    <p class="text-slate-500 font-medium mt-2 italic">Premium notes, projects, and guides from expert tutors.</p>
                </div>
                <div class="bg-indigo-100 text-indigo-600 px-6 py-2 rounded-full font-black text-xs uppercase tracking-widest border border-indigo-200 shadow-sm">
                    {{ $products->count() }} Products Available
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                @foreach($products as $product)
                    <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-2xl transition-all duration-500 group overflow-hidden flex flex-col">
                        
                        <div class="h-52 bg-indigo-600 flex items-center justify-center relative group-hover:bg-slate-900 transition-colors duration-500">
                            <div class="absolute top-6 right-6 bg-white/20 backdrop-blur-md border border-white/30 px-4 py-1.5 rounded-full text-[10px] font-black uppercase text-white tracking-widest">
                                RS. {{ number_format($product->price) }}
                            </div>
                            <svg class="w-20 h-20 text-white/20 group-hover:scale-110 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" stroke-width="2"/>
                            </svg>
                        </div>

                        <div class="p-10 flex-1 flex flex-col">
                            <h4 class="text-2xl font-black text-indigo-600 italic group-hover:text-slate-900 transition-colors">{{ $product->title }}</h4>
                            
                            <div class="flex items-center gap-2 mt-2">
                                <div class="w-6 h-6 rounded-lg bg-slate-100 flex items-center justify-center text-[8px] font-black text-slate-400 uppercase">
                                    {{ substr($product->tutor->name, 0, 2) }}
                                </div>
                                <p class="text-[10px] text-slate-400 font-black uppercase tracking-widest italic">By {{ $product->tutor->name }}</p>
                            </div>

                            <p class="text-sm text-slate-500 mt-6 line-clamp-2 leading-relaxed italic font-medium">
                                {{ $product->description }}
                            </p>
                            
                            <div class="mt-auto pt-8 flex gap-2">
                                <a href="{{ route('store.show', $product->id) }}" class="flex-1 text-center bg-slate-900 text-white py-5 rounded-2xl font-black text-[10px] uppercase tracking-[0.2em] hover:bg-indigo-600 transition shadow-xl active:scale-95">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if($products->isEmpty())
                <div class="text-center py-20 bg-white rounded-[3rem] border border-dashed border-slate-200">
                    <p class="text-slate-400 italic font-bold">No products are currently available in the library.</p>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>