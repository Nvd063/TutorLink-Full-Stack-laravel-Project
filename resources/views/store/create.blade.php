<div class="bg-white p-8 rounded-[2rem] border border-slate-100 shadow-sm">
    <h3 class="text-xl font-black mb-6 italic text-slate-800">Upload Digital Product</h3>
    
    <form action="{{ route('store.upload') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-4">
                <input type="text" name="title" placeholder="Product Title (e.g. Laravel Notes)" 
                       class="w-full rounded-2xl border-slate-100 bg-slate-50 p-4 font-bold">
                
                <input type="number" name="price" placeholder="Price in PKR" 
                       class="w-full rounded-2xl border-slate-100 bg-slate-50 p-4 font-bold">
            </div>
            
            <textarea name="description" placeholder="Description..." 
                      class="w-full rounded-2xl border-slate-100 bg-slate-50 p-4 h-32"></textarea>
        </div>

        <div class="mt-6 border-2 border-dashed border-slate-200 rounded-3xl p-10 text-center">
            <input type="file" name="file" class="hidden" id="product_file">
            <label for="product_file" class="cursor-pointer text-slate-400 font-bold">
                <svg class="w-12 h-12 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" stroke-width="2"/></svg>
                Click to upload PDF, Zip or Project Files
            </label>
        </div>

        <button type="submit" class="mt-6 w-full bg-indigo-600 text-white py-4 rounded-2xl font-black uppercase tracking-widest hover:bg-slate-900 transition">
            Publish to Store
        </button>
    </form>
</div>