<x-app-layout>
    <div class="py-8 bg-slate-50 min-h-screen">
        <div class="max-w-5xl mx-auto px-6">

            <div class="flex justify-between items-center mb-8">
                <h2 class="text-3xl font-black text-slate-900">My Posts</h2>
                
                <button @click="showPostModal = true" 
                        class="bg-indigo-600 text-white px-6 py-3 rounded-2xl font-bold text-sm tracking-widest hover:bg-indigo-700 transition flex items-center gap-2">
                    <span>+</span> Create New Post
                </button>
            </div>

            <div class="space-y-6">
                @forelse($posts as $post)
                    <div class="bg-white rounded-3xl p-8 border border-slate-100 shadow-sm hover:shadow-md transition">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="text-xl font-bold text-slate-900">{{ $post->title }}</h3>
                                <p class="text-slate-500 text-sm mt-2">
                                    Posted: {{ $post->created_at->format('d M, Y \a\t h:i A') }}
                                </p>
                            </div>
                            <span class="px-5 py-2 text-xs font-bold rounded-2xl bg-emerald-100 text-emerald-700">
                                Active
                            </span>
                        </div>

                        <p class="mt-6 text-slate-600 leading-relaxed">
                            {{ $post->description }}
                        </p>

                        <div class="mt-8 flex gap-4">
                            <a href="{{ route('student.posts.edit', $post) }}" 
                               class="flex-1 text-center py-4 bg-slate-100 hover:bg-slate-200 rounded-2xl font-semibold transition">
                                Edit Post
                            </a>
                            
                            <button onclick="if(confirm('Are you sure you want to delete this post?')) document.getElementById('delete-{{ $post->id }}').submit()" 
                                    class="flex-1 text-center py-4 bg-rose-100 hover:bg-rose-200 text-rose-700 rounded-2xl font-semibold transition">
                                Delete Post
                            </button>
                        </div>

                        <form id="delete-{{ $post->id }}" action="{{ route('student.posts.destroy', $post) }}" method="POST" class="hidden">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>
                @empty
                    <div class="bg-white rounded-3xl p-20 text-center border border-dashed border-slate-200">
                        <p class="text-slate-400 text-lg italic">You haven't created any posts yet.</p>
                        <button @click="showPostModal = true" 
                                class="mt-6 bg-indigo-600 text-white px-8 py-4 rounded-2xl font-bold hover:bg-indigo-700 transition">
                            Create Your First Post
                        </button>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- ====================== POST CREATION MODAL ====================== -->
    @if(Auth::user()->role == 'student')
    <div x-data="{ showPostModal: false }" 
         x-show="showPostModal" 
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/70 backdrop-blur-sm"
         style="display: none;">
        
        <div class="bg-white w-full max-w-lg rounded-[2.5rem] p-8 shadow-2xl" 
             @click.away="showPostModal = false">
            
            <h3 class="text-2xl font-black italic mb-6 tracking-tight">Post Your Requirement</h3>
            
            <form action="{{ route('student.posts.store') }}" method="POST">
                @csrf
                
                <div class="space-y-6">
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 ml-4">
                            What do you want to learn?
                        </label>
                        <input type="text" 
                               name="title" 
                               placeholder="e.g. Need help in Laravel project"
                               class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 focus:ring-2 focus:ring-indigo-500 font-bold italic"
                               required>
                    </div>

                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 ml-4">
                            Describe in detail (Add keywords like PHP, Python etc)
                        </label>
                        <textarea name="description" 
                                  rows="5"
                                  placeholder="Mention specific topics you are struggling with..."
                                  class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 focus:ring-2 focus:ring-indigo-500 font-bold italic"
                                  required></textarea>
                    </div>
                </div>

                <div class="mt-8 flex gap-3">
                    <button type="button" 
                            @click="showPostModal = false"
                            class="flex-1 px-6 py-4 rounded-2xl font-black uppercase text-xs tracking-widest bg-slate-100 text-slate-500 hover:bg-slate-200 transition">
                        Cancel
                    </button>
                    <button type="submit"
                            class="flex-1 px-6 py-4 rounded-2xl font-black uppercase text-xs tracking-widest bg-indigo-600 text-white shadow-lg hover:bg-indigo-700 transition">
                        Post Now
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif

</x-app-layout>