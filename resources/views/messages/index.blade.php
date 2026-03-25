<x-app-layout>
    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <h2 class="text-3xl font-black text-slate-900 mb-8 italic">Your Conversations</h2>
            
            <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden">
                <div class="divide-y divide-slate-50">
                    @forelse($conversations as $convo)
                        @php
                            // Chat partner dhoondo (Jo current user nahi hai)
                            $partner = ($convo->sender_id == auth()->id()) ? $convo->receiver : $convo->sender;
                        @endphp
                        
                        <a href="/conversation/{{ $partner->id }}/messages" class="flex items-center gap-4 p-6 hover:bg-slate-50 transition-all group">
                            <div class="w-14 h-14 rounded-2xl bg-indigo-100 flex items-center justify-center font-black text-indigo-600 uppercase text-xl shadow-inner">
                                {{ substr($partner->name, 0, 2) }}
                            </div>
                            
                            <div class="flex-1">
                                <div class="flex justify-between items-center">
                                    <h4 class="font-black text-slate-900 group-hover:text-indigo-600 transition-colors">{{ $partner->name }}</h4>
                                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">{{ $convo->created_at->diffForHumans() }}</span>
                                </div>
                                <p class="text-sm text-slate-500 truncate mt-1">
                                    {{ $convo->message }}
                                </p>
                            </div>
                            
                            @if($convo->receiver_id == auth()->id() && !$convo->is_read)
                                <div class="w-3 h-3 bg-indigo-600 rounded-full shadow-lg shadow-indigo-200"></div>
                            @endif
                        </a>
                    @empty
                        <div class="p-20 text-center">
                            <p class="text-slate-400 italic font-medium">No conversations yet. Start chatting with a tutor!</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>