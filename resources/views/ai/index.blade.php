<x-app-layout>
    <div class="py-6 bg-slate-50 min-h-screen flex flex-col items-center">
        <div class="max-w-4xl w-full px-4">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-black text-slate-900 italic">TutorLink <span class="text-indigo-600">AI Assistant</span></h2>
                <p class="text-slate-500 text-sm font-medium">Ask me anything about tutors, subjects, or bookings!</p>
            </div>

            <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden flex flex-col min-h-[500px]">
                <div class="flex-1 p-8 overflow-y-auto space-y-6" id="chat-window">
                    @if(session('user_prompt'))
                        <div class="flex justify-end">
                            <div class="bg-indigo-600 text-white px-6 py-3 rounded-2xl rounded-tr-none shadow-md max-w-[80%]">
                                <p class="text-sm font-bold">{{ session('user_prompt') }}</p>
                            </div>
                        </div>
                    @else
                        <div class="text-center py-20">
                            <div class="bg-indigo-50 w-16 h-16 rounded-3xl flex items-center justify-center mx-auto mb-4">
                                <span class="text-2xl">🤖</span>
                            </div>
                            <h3 class="text-slate-400 italic font-medium">Hello! Ask me anything about tutors...</h3>
                        </div>
                    @endif

                    @if(session('ai_response'))
                        <div class="flex justify-start">
                            <div class="bg-slate-100 text-slate-800 p-6 rounded-3xl rounded-tl-none border border-slate-200 shadow-sm max-w-[90%]">
                                <div class="flex items-center gap-2 mb-2">
                                    <div class="w-6 h-6 bg-indigo-600 rounded-full flex items-center justify-center text-xs text-white font-bold">AI</div>
                                    <span class="text-[10px] font-black uppercase tracking-widest text-slate-400">TutorLink AI</span>
                                </div>
                                <div class="prose prose-indigo max-w-none text-sm leading-relaxed">
                                    {!! Str::markdown(session('ai_response')) !!}
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="p-6 bg-slate-50 border-t border-slate-100">
                    <form action="{{ route('ai.process') }}" method="POST" class="relative">
                        @csrf
                        <textarea name="user_prompt" rows="1" placeholder="Type your question here..." required
                            class="w-full rounded-2xl border-none bg-white p-4 pr-16 font-bold focus:ring-4 focus:ring-indigo-100 shadow-inner resize-none"></textarea>
                        <button type="submit" class="absolute right-3 top-2 bg-indigo-600 text-white p-2 rounded-xl hover:bg-slate-900 transition shadow-lg">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M14 5l7 7m0 0l-7 7m7-7H3" stroke-width="2.5"/></svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>