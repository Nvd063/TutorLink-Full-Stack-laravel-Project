<x-app-layout>
    <div class="py-8 bg-slate-50 min-h-screen">
        <div class="max-w-2xl mx-auto px-6">

            <div class="mb-8">
                <a href="{{ route('student.my-posts') }}" 
                   class="inline-flex items-center gap-2 text-slate-500 hover:text-slate-700 transition">
                    ← Back to My Posts
                </a>
                <h2 class="text-3xl font-black text-slate-900 mt-4">Edit Post</h2>
                <p class="text-slate-500">Update your requirement</p>
            </div>

            <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-10">

                <form action="{{ route('student.posts.update', $post) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="space-y-8">

                        <!-- Title -->
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 ml-1">
                                What do you want to learn?
                            </label>
                            <input type="text" 
                                   name="title" 
                                   value="{{ old('title', $post->title) }}"
                                   placeholder="e.g. Need help in Laravel project"
                                   class="w-full bg-slate-50 border-none rounded-2xl px-6 py-5 focus:ring-2 focus:ring-indigo-500 font-bold italic"
                                   required>
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <!-- Description -->
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 ml-1">
                                Describe in detail (Add keywords like PHP, Python etc)
                            </label>
                            <textarea name="description" 
                                      rows="6"
                                      placeholder="Mention specific topics you are struggling with..."
                                      class="w-full bg-slate-50 border-none rounded-2xl px-6 py-5 focus:ring-2 focus:ring-indigo-500 font-bold italic"
                                      required>{{ old('description', $post->description) }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                    </div>

                    <!-- Action Buttons -->
                    <div class="mt-12 flex gap-4">
                        <a href="{{ route('student.my-posts') }}" 
                           class="flex-1 text-center py-5 bg-slate-100 hover:bg-slate-200 rounded-2xl font-bold text-slate-600 transition">
                            Cancel
                        </a>
                        
                        <button type="submit"
                                class="flex-1 py-5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-2xl font-bold tracking-widest transition shadow-lg shadow-indigo-100">
                            Update Post
                        </button>
                    </div>
                </form>

            </div>

            <!-- Optional: Delete Button -->
            <div class="mt-8 text-center">
                <button onclick="if(confirm('Are you sure you want to delete this post? This action cannot be undone.')) document.getElementById('delete-form').submit()"
                        class="text-rose-600 hover:text-rose-700 font-medium flex items-center gap-2 mx-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.595 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.595-1.858L5 7" />
                    </svg>
                    Delete this post
                </button>

                <form id="delete-form" action="{{ route('student.posts.destroy', $post) }}" method="POST" class="hidden">
                    @csrf
                    @method('DELETE')
                </form>
            </div>

        </div>
    </div>
</x-app-layout>