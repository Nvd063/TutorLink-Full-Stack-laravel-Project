<x-app-layout>
    <div class="py-12 bg-slate-100 min-h-screen">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-2xl rounded-[3rem] overflow-hidden flex flex-col h-[700px]">
                
                <div class="p-6 border-b border-slate-100 flex items-center justify-between bg-white/50 backdrop-blur-md">
                    <div class="flex items-center gap-4">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($chatPartner->name) }}&background=6366f1&color=fff" class="w-12 h-12 rounded-2xl shadow-sm">
                        <div>
                            <h3 class="font-black text-slate-900 text-lg leading-tight">{{ $chatPartner->name }}</h3>
                            <p class="text-xs text-green-500 font-bold uppercase tracking-widest italic">● Online</p>
                        </div>
                        <div class="bg-indigo-50/80 px-8 py-3 border-b border-indigo-100 flex items-center justify-between">
    <div class="flex items-center gap-2">
        <span class="bg-indigo-600 text-white p-1 rounded-md">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
        </span>
        <p class="text-sm font-bold text-indigo-900 italic">
            @if(auth()->user()->role == 'student')
                Discussing your learning goals with <strong>{{ $chatPartner->name }}</strong>
            @else
                Inquiry from <strong>{{ $chatPartner->name }}</strong> about your tutoring services
            @endif
        </p>
    </div>
    <a href="/tutors" class="text-xs font-black uppercase tracking-widest text-indigo-600 hover:underline">View Subjects</a>
</div>
                    </div>
                </div>

                <div class="flex-1 overflow-y-auto p-8 space-y-6 bg-slate-50/50" id="message-container">
                    @foreach($messages as $msg)
                        <div class="flex {{ $msg->sender_id == auth()->id() ? 'justify-end' : 'justify-start' }}">
                            <div class="max-w-[70%] {{ $msg->sender_id == auth()->id() ? 'bg-indigo-600 text-white rounded-t-3xl rounded-l-3xl shadow-lg shadow-indigo-100' : 'bg-white text-slate-700 rounded-t-3xl rounded-r-3xl border border-slate-100 shadow-sm' }} p-5">
                                <p class="text-md leading-relaxed font-medium">{{ $msg->message }}</p>
                                <span class="text-[10px] opacity-70 mt-2 block font-bold uppercase tracking-tighter text-right">
                                    {{ $msg->created_at->format('h:i A') }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="p-6 bg-white border-t border-slate-100">
                    <form action="/conversation/send" method="POST" class="flex items-center gap-4 relative">
                        @csrf
                        <input type="hidden" name="receiver_id" value="{{ $chatPartner->id }}">
                        <input type="text" name="message" placeholder="Type your message here..." required
                               class="w-full pl-6 pr-20 py-5 rounded-2xl border-none bg-slate-100 focus:ring-4 focus:ring-indigo-100 transition-all outline-none font-medium">
                        <button type="submit" class="absolute right-2 top-2 bottom-2 bg-indigo-600 text-white px-8 rounded-xl font-bold hover:bg-indigo-700 transition shadow-lg active:scale-95">
                            Send
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>

{{-- AJAX --}}

<script>
    const container = document.getElementById('message-container');
    container.scrollTop = container.scrollHeight;

    // AJAX Message Sending
    const chatForm = document.querySelector('form');
    chatForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        const messageInput = this.querySelector('input[name="message"]');
        const originalMessage = messageInput.value;

        // Foran UI par message dikhayen (Optimistic UI)
        const newMessageHtml = `
            <div class="flex justify-end animate-pulse">
                <div class="max-w-[70%] bg-indigo-600 text-white rounded-t-3xl rounded-l-3xl p-5 shadow-lg">
                    <p class="text-md font-medium">${originalMessage}</p>
                    <span class="text-[10px] opacity-70 mt-2 block font-bold text-right italic uppercase">Sending...</span>
                </div>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', newMessageHtml);
        container.scrollTop = container.scrollHeight;
        messageInput.value = ''; // Input clear karein

        fetch(this.action, {
            method: 'POST',
            body: formData,
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(res => res.json())
        .then(data => {
            // Pulse effect hatane ke liye container refresh logic (Optional)
            location.reload(); // Filhal refresh hi rehne dein agar Pusher set nahi hai
        });
    });
</script>