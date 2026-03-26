<x-app-layout>
    <div class="py-12 bg-slate-50 min-h-screen" x-data="{ openModal: false, activePost: {} }">
        <div class="max-w-5xl mx-auto px-4">

            <div class="flex items-center gap-3 mb-8 ml-4">
                <span
                    class="bg-indigo-600 text-white p-3 rounded-2xl shadow-lg shadow-indigo-100 italic font-black">JOBS</span>
                <div>
                    <h3 class="text-2xl font-black italic text-slate-800 tracking-tight">Available Opportunities</h3>
                    <p class="text-slate-400 text-xs font-bold uppercase tracking-widest italic">Based on your expertise
                    </p>
                </div>
            </div>

            <a href="/dashboard">Go Back</a>
            <div class="space-y-3">
                @forelse($matchingPosts as $post)
                    <div @click="openModal = true; activePost = { 
                                id: '{{ $post->id }}', 
                                title: '{{ $post->title }}', 
                                desc: '{{ addslashes($post->description) }}', 
                                user: '{{ $post->user->name }}',
                                user_id: '{{ $post->user_id }}',
                                time: '{{ $post->created_at->diffForHumans() }}'
                            }"
                        class="bg-white p-5 rounded-[1.5rem] border border-slate-100 shadow-sm hover:border-indigo-400 hover:shadow-md transition-all cursor-pointer group flex justify-between items-center">
                        <div class="flex items-center gap-4">
                            <div
                                class="w-12 h-12 rounded-xl bg-slate-50 flex items-center justify-center font-black text-indigo-600 border border-slate-100 group-hover:bg-indigo-600 group-hover:text-white transition">
                                {{ substr($post->user->name, 0, 1) }}
                            </div>
                            <div>
                                <h4 class="text-lg font-black text-slate-800 italic group-hover:text-indigo-600 transition">
                                    {{ $post->title }}</h4>
                                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">
                                    By {{ $post->user->name }} • {{ $post->created_at->diffForHumans() }}
                                </p>
                            </div>
                        </div>
                        <span
                            class="text-slate-300 group-hover:text-indigo-600 transition-transform group-hover:translate-x-1">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M9 5l7 7-7 7" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </span>
                    </div>
                @empty
                    <div class="bg-white p-12 rounded-[3rem] text-center border border-dashed border-slate-200">
                        <p class="text-slate-400 italic font-bold">No matching jobs found right now.</p>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- ================= DETAIL MODAL ================= --}}
        <div x-show="openModal"
            class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100" x-cloak>

            <div class="bg-white w-full max-w-2xl rounded-[3rem] overflow-hidden shadow-2xl relative"
                @click.away="openModal = false">

                {{-- Modal Header --}}
                <div class="bg-slate-50 p-8 border-b border-slate-100">
                    <div class="flex justify-between items-start">
                        <div>
                            <span
                                class="text-[10px] font-black bg-indigo-100 text-indigo-600 px-3 py-1 rounded-full uppercase tracking-widest mb-2 inline-block">Job
                                Details</span>
                            <h2 class="text-3xl font-black text-slate-900 italic leading-tight"
                                x-text="activePost.title"></h2>
                        </div>
                        <button @click="openModal = false" class="text-slate-400 hover:text-rose-500 transition">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M6 18L18 6M6 6l12 12" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- Modal Body --}}
                <div class="p-8">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-full bg-indigo-600 flex items-center justify-center text-white font-black text-xs"
                            x-text="activePost.user ? activePost.user.substring(0,1) : ''"></div>
                        <div>
                            <p class="text-slate-900 font-black italic text-sm" x-text="activePost.user"></p>
                            <p class="text-slate-400 text-[10px] font-bold uppercase tracking-widest"
                                x-text="'Posted ' + activePost.time"></p>
                        </div>
                    </div>

                    <div class="bg-slate-50 p-6 rounded-[2rem] border border-slate-100">
                        <p class="text-slate-600 leading-relaxed italic whitespace-pre-line" x-text="activePost.desc">
                        </p>
                    </div>
                </div>

                {{-- Modal Footer --}}
                <div class="p-8 bg-slate-50 border-t border-slate-100 flex gap-4">

                    {{-- 1. Not Interested Form (POST Request) --}}
                    <form :action="'/tutor/jobs/ignore/' + activePost.id" method="POST" class="flex-1">
                        @csrf
                        <button type="submit"
                            class="w-full py-4 rounded-2xl font-black uppercase text-xs tracking-widest bg-white text-rose-500 border border-rose-100 hover:bg-rose-50 transition shadow-sm">
                            Not Interested
                        </button>
                    </form>

                    {{-- 2. Contact Student Button --}}
                    <a :href="'/conversation/' + activePost.user_id + '/messages'"
                        class="flex-[2] py-4 rounded-2xl font-black uppercase text-xs tracking-widest bg-indigo-600 text-white text-center shadow-lg shadow-indigo-100 hover:bg-slate-900 transition">
                        Contact Student Now
                    </a>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>