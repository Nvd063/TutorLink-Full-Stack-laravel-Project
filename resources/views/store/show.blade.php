<x-app-layout>
    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-12 rounded-[3rem] shadow-xl border border-slate-100 overflow-hidden relative">
                <div class="flex flex-col md:flex-row gap-10 items-center">
                    <div class="w-48 h-48 bg-indigo-600 rounded-[2rem] flex items-center justify-center text-white shadow-2xl shadow-indigo-200">
                        <svg class="w-20 h-20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" stroke-width="2"/></svg>
                    </div>

                    <div class="flex-1">
                        <span class="text-indigo-600 font-black text-xs uppercase tracking-[0.3em]">Premium Digital Asset</span>
                        <h1 class="text-4xl font-black text-slate-900 mt-2 mb-4">{{ $product->title }}</h1>
                        <p class="text-slate-500 italic mb-6 leading-relaxed text-lg">{{ $product->description }}</p>
                        
                        <div class="flex items-center gap-6">
                            <div class="text-3xl font-black text-slate-900">Rs. {{ number_format($product->price) }}</div>
                            
                            <form action="{{ route('safepay.pay') }}" method="GET">
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <button type="submit" class="bg-slate-900 text-white px-10 py-4 rounded-2xl font-black uppercase text-xs tracking-widest hover:bg-indigo-600 transition-all shadow-xl active:scale-95">
                                    Unlock & Download
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>