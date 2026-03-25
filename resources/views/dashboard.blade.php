<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl text-slate-800 leading-tight">
            Welcome back, {{ Auth::user()->name }} 👋
        </h2>
    </x-slot>

    <div class="py-12 bg-slate-50 min-h-screen"
         x-data="{ 
            showUploadModal: false, 
            showDeclineModal: false, 
            selectedBooking: null,
            showDetailModal: false,
            activeBooking: { id: '', subject: '', booking_time: '', status: '', rejection_reason: '' }
         }">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- ========================= TUTOR SECTION ========================= --}}
            @if(Auth::user()->role == 'tutor')
                
                {{-- New Small Warning Banner (Top pe) --}}
                @if(!auth()->user()->is_verified)
                    <div class="bg-rose-50 border-l-4 border-rose-500 p-6 rounded-2xl mb-8 max-w-5xl mx-auto">
                        <div class="flex items-center">
                            <span class="text-2xl mr-4">⚠️</span>
                            <div>
                                <h3 class="text-rose-800 font-black uppercase text-xs tracking-widest">Application Status: Rejected / Pending</h3>
                               
                                @if(auth()->user()->rejection_reason)
                                    <p class="text-rose-600 mt-2 font-bold italic">
                                        "{{ auth()->user()->rejection_reason }}"
                                    </p>
                                    <p class="text-rose-500 text-xs mt-4">Piyara bhai, upar di gayi wajah ko theek karein aur dobara profile update karein.</p>
                                @else
                                    <p class="text-rose-600 mt-1">Aapki application review ho rahi hai. Thora intezar karein.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Main Tutor Content --}}
                @if(!auth()->user()->is_verified)
                    
                    {{-- Full Waiting / Rejected Big Screen --}}
                    <div class="max-w-4xl mx-auto mt-10">
                        <div class="bg-white p-12 rounded-[3rem] shadow-xl border border-slate-100 text-center">
                            @if(auth()->user()->rejection_reason)
                                <div class="w-20 h-20 bg-rose-100 text-rose-600 rounded-3xl flex items-center justify-center mx-auto mb-6">
                                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="M6 18L18 6M6 6l12 12" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>
                                <h2 class="text-3xl font-black text-slate-900 italic mb-4">Application Declined</h2>
                                <div class="bg-rose-50 p-6 rounded-2xl border border-rose-100 mb-6">
                                    <p class="text-rose-600 text-[10px] font-black uppercase tracking-widest mb-2">Reason from Admin:</p>
                                    <p class="text-rose-800 font-bold italic">{{ auth()->user()->rejection_reason }}</p>
                                </div>
                                <p class="text-slate-500 text-sm">Please update your profile from settings and try again.</p>
                            @else
                                <div class="w-20 h-20 bg-amber-100 text-amber-600 rounded-3xl flex items-center justify-center mx-auto mb-6 animate-pulse">
                                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>
                                <h2 class="text-3xl font-black text-slate-900 italic mb-4">Waiting for Approval</h2>
                                <p class="text-slate-500 leading-relaxed max-w-md mx-auto">
                                    Bhai, aapki application Admin ko bhej di gayi hai. Hum aapki Degree aur CV verify kar rahe hain. 
                                    Jald hi aapka dashboard unlock ho jayega!
                                </p>
                            @endif
                           
                            <div class="mt-8">
                                <a href="{{ route('profile.edit') }}" 
                                   class="inline-block bg-slate-900 text-white px-8 py-4 rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-indigo-600 transition">
                                    Update Profile Info
                                </a>
                            </div>
                        </div>
                    </div>

                @else
                    {{-- Verified Tutor Dashboard --}}
                    <div class="max-w-5xl mx-auto">
                        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">
                            <div class="bg-white p-5 rounded-2xl shadow-sm border border-slate-100">
                                <p class="text-xs font-bold uppercase text-slate-400 tracking-widest">Total Earnings</p>
                                <h3 class="text-2xl font-black text-indigo-600 mt-1">Rs. {{ number_format($totalEarnings ?? 0, 2) }}</h3>
                            </div>

                            <div class="bg-white p-5 rounded-2xl shadow-sm border border-slate-100">
                                <p class="text-xs font-bold uppercase text-slate-400 tracking-widest">Active Students</p>
                                <h3 class="text-2xl font-black text-slate-800 mt-1">{{ $activeCount ?? 0 }}</h3>
                            </div>

                            <div class="bg-indigo-600 p-5 rounded-2xl text-white flex flex-col justify-between shadow-lg shadow-indigo-100">
                                <p class="text-xs font-bold uppercase tracking-widest opacity-80">Profile Status: {{ $data['profile_status'] ?? 0 }}%</p>
                                <a href="{{ route('tutors.profile.edit') }}" 
                                   class="mt-3 bg-white text-indigo-600 text-center py-2 rounded-xl text-xs font-black uppercase tracking-widest hover:bg-indigo-50 transition">
                                    Complete Profile
                                </a>
                            </div>

                            <div class="bg-white p-5 rounded-2xl border border-slate-100 flex flex-col justify-between shadow-sm">
                                <h2 class="font-black text-slate-800 italic text-sm">Digital Store</h2>
                                <button @click="showUploadModal = true" 
                                        class="mt-3 bg-slate-900 text-white py-2 rounded-xl text-xs font-black uppercase tracking-widest hover:bg-indigo-600 transition shadow-md active:scale-95">
                                    + Add Product
                                </button>
                            </div>
                        </div>

                        <div class="bg-white rounded-[2.5rem] border border-slate-100 overflow-hidden shadow-sm">
                            <div class="p-8 border-b border-slate-50 flex justify-between items-center bg-slate-50/50">
                                <h3 class="text-xl font-black italic text-slate-800 tracking-tight">Student Booking Requests</h3>
                                <span class="text-[10px] font-black bg-indigo-100 text-indigo-600 px-4 py-1.5 rounded-full uppercase tracking-[0.1em]">
                                    {{ $tutorBookings->where('status','pending')->count() }} New Requests
                                </span>
                            </div>

                            <div class="p-8 space-y-4">
                                @forelse($tutorBookings as $booking)
                                    <div class="flex justify-between items-center p-6 bg-slate-50 rounded-[2rem] border border-transparent hover:border-indigo-100 transition shadow-sm group">
                                        <div class="flex items-center gap-5">
                                            <div class="w-14 h-14 rounded-2xl bg-white border border-slate-100 flex items-center justify-center font-black text-indigo-600 uppercase shadow-sm group-hover:scale-105 transition">
                                                {{ substr($booking->student?->name ?? 'S', 0, 2) }}
                                            </div>
                                            <div>
                                                <p class="font-black text-slate-900 text-lg italic tracking-tight">{{ $booking->subject }}</p>
                                                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-[0.15em] mt-1">
                                                    By {{ $booking->student?->name }} • {{ \Carbon\Carbon::parse($booking->booking_time)->format('d M, h:i A') }}
                                                </p>
                                            </div>
                                        </div>

                                        <div class="flex items-center gap-3">
                                            @if($booking->status == 'pending')
                                                <form action="{{ route('bookings.update', $booking->id) }}" method="POST">
                                                    @csrf @method('PATCH')
                                                    <input type="hidden" name="status" value="accepted">
                                                    <button type="submit" class="bg-emerald-500 text-white px-6 py-2.5 rounded-xl font-black text-[10px] uppercase tracking-widest hover:bg-emerald-600 transition shadow-lg shadow-emerald-100">
                                                        Accept
                                                    </button>
                                                </form>
                                                <button @click="showDeclineModal = true; selectedBooking = {{ $booking->id }}" 
                                                        class="bg-rose-100 text-rose-600 px-6 py-2.5 rounded-xl font-black text-[10px] uppercase tracking-widest hover:bg-rose-600 hover:text-white transition">
                                                    Decline
                                                </button>
                                            @else
                                                <span class="px-5 py-2.5 rounded-xl font-black text-[10px] uppercase tracking-widest 
                                                    {{ $booking->status == 'accepted' ? 'bg-emerald-50 text-emerald-500' : 'bg-rose-50 text-rose-400' }}">
                                                    {{ $booking->status }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                @empty
                                    <div class="text-center py-12">
                                        <p class="text-slate-400 italic font-medium">No recent inquiries or bookings yet.</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                @endif

            {{-- ========================= STUDENT DASHBOARD ========================= --}}
            @else
                <div class="grid md:grid-cols-2 gap-8">
                    <div class="bg-white p-10 rounded-[3rem] shadow-sm border border-slate-100">
                        <div class="flex justify-between items-center mb-8">
                            <h3 class="text-2xl font-black text-slate-900 italic tracking-tight">My Bookings</h3>
                            <a href="/tutors" class="text-indigo-600 font-black text-xs uppercase tracking-widest hover:underline">Find Tutors →</a>
                        </div>

                        <div class="space-y-4">
                            @forelse($studentBookings as $booking)
                                <div @click="showDetailModal = true; 
                                            activeBooking = { 
                                                id: '{{ $booking->id }}', 
                                                subject: '{{ addslashes($booking->subject) }}', 
                                                booking_time: '{{ $booking->booking_time }}', 
                                                status: '{{ $booking->status }}', 
                                                rejection_reason: '{{ addslashes($booking->rejection_reason ?? '') }}' 
                                            }" 
                                     class="p-5 bg-slate-50 rounded-[2rem] flex items-center justify-between border border-transparent hover:border-indigo-100 transition shadow-sm cursor-pointer group">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 rounded-xl bg-indigo-600 flex items-center justify-center text-white font-black text-xs uppercase group-hover:rotate-6 transition">
                                            {{ substr($booking->tutor?->name ?? 'T', 0, 1) }}
                                        </div>
                                        <div>
                                            <p class="font-black text-slate-900 text-base italic group-hover:text-indigo-600 transition">{{ $booking->subject }}</p>
                                            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mt-0.5">With {{ $booking->tutor?->name }}</p>
                                        </div>
                                    </div>
                                    <div class="text-right flex flex-col items-end gap-2">
                                        <p class="text-[10px] font-black text-slate-800">{{ \Carbon\Carbon::parse($booking->booking_time)->format('d M, h:i A') }}</p>
                                        <span class="text-[9px] px-3 py-1 rounded-full font-black uppercase tracking-widest
                                            {{ $booking->status == 'pending' ? 'bg-amber-100 text-amber-600' : '' }}
                                            {{ $booking->status == 'accepted' ? 'bg-emerald-100 text-emerald-600' : '' }}
                                            {{ $booking->status == 'rejected' ? 'bg-rose-100 text-rose-600' : '' }}">
                                            {{ $booking->status }}
                                        </span>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-16 bg-slate-50/50 rounded-[2rem] border border-dashed border-slate-200">
                                    <p class="text-slate-400 italic text-sm">No bookings found in your history.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <div class="bg-white p-10 rounded-[3rem] shadow-sm border border-slate-100 flex flex-col justify-center items-center text-center">
                        <h3 class="text-2xl font-black text-slate-900 mb-4 italic tracking-tight">Digital Library</h3>
                        <div class="bg-indigo-50 p-8 rounded-[2.5rem] w-full border border-indigo-100">
                            <p class="text-indigo-600 text-sm font-bold mb-6 italic">Looking for premium notes or FYP projects?</p>
                            <a href="{{ route('store.index') }}" 
                               class="bg-indigo-600 text-white px-10 py-4 rounded-2xl font-black uppercase text-xs tracking-[0.2em] inline-block shadow-xl shadow-indigo-100 hover:bg-slate-900 transition active:scale-95">
                                Visit Store
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        {{-- ========================= MODALS ========================= --}}
        {{-- Tutor Modals (Only for Verified Tutors) --}}
        @if(Auth::user()->role == 'tutor' && Auth::user()->is_verified)
            <!-- Decline Modal -->
            <div x-show="showDeclineModal" x-cloak class="fixed inset-0 z-[150] flex items-center justify-center bg-black/60 backdrop-blur-sm p-4">
                <div class="bg-white p-10 rounded-[3rem] shadow-2xl max-w-md w-full border border-slate-100" @click.away="showDeclineModal = false">
                    <h3 class="text-2xl font-black text-slate-900 mb-6 italic text-center tracking-tight">Decline Booking</h3>
                    <form :action="`/bookings/${selectedBooking}`" method="POST" class="space-y-5">
                        @csrf @method('PATCH')
                        <input type="hidden" name="status" value="rejected">
                        <textarea name="rejection_reason" required placeholder="Briefly explain why... (e.g. Schedule conflict)" 
                                  class="w-full rounded-[2rem] border-none bg-slate-50 p-6 h-40 font-bold focus:ring-4 focus:ring-rose-50 text-slate-700"></textarea>
                        <div class="flex gap-4">
                            <button type="button" @click="showDeclineModal=false" 
                                    class="flex-1 bg-slate-100 py-4 rounded-2xl font-black text-[10px] uppercase tracking-widest text-slate-500">Cancel</button>
                            <button type="submit" 
                                    class="flex-1 bg-rose-600 text-white py-4 rounded-2xl font-black text-[10px] uppercase tracking-widest shadow-xl hover:bg-rose-700 transition">Confirm Decline</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Upload Modal -->
            <div x-show="showUploadModal" x-cloak class="fixed inset-0 z-[100] flex items-center justify-center bg-black/50 backdrop-blur-sm p-4">
                <div class="bg-white p-12 rounded-[3.5rem] shadow-2xl max-w-xl w-full border border-slate-100 relative">
                    <h2 class="text-3xl font-black mb-8 text-slate-900 italic text-center tracking-tight">Upload Digital Asset</h2>
                    <form action="{{ route('store.upload') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        <input type="text" name="title" placeholder="Product Title" required class="w-full rounded-2xl border-none bg-slate-50 p-5 font-bold focus:ring-4 focus:ring-indigo-50">
                        <input type="number" name="price" placeholder="Price (PKR)" required class="w-full rounded-2xl border-none bg-slate-50 p-5 font-bold focus:ring-4 focus:ring-indigo-50">
                        <textarea name="description" placeholder="Short description..." class="w-full rounded-2xl border-none bg-slate-50 p-5 h-32 font-bold focus:ring-4 focus:ring-indigo-50"></textarea>
                        <div class="p-6 border-4 border-dashed border-slate-100 rounded-[2rem] text-center bg-slate-50/50">
                            <input type="file" name="file" required class="text-sm font-bold text-slate-400">
                        </div>
                        <div class="flex gap-4 pt-4">
                            <button type="button" @click="showUploadModal=false" 
                                    class="flex-1 bg-slate-100 py-5 rounded-2xl font-black uppercase text-xs tracking-widest text-slate-500">Cancel</button>
                            <button class="flex-1 bg-indigo-600 text-white py-5 px-10 rounded-2xl font-black uppercase text-xs tracking-widest shadow-xl hover:bg-slate-900 transition">Upload Now</button>
                        </div>
                    </form>
                </div>
            </div>
        @endif

        {{-- Student Detail Modal --}}
        @if(Auth::user()->role != 'tutor')
            <div x-show="showDetailModal" x-cloak class="fixed inset-0 z-[200] flex items-center justify-center bg-black/60 backdrop-blur-sm p-4">
                <div class="bg-white rounded-[3rem] shadow-2xl max-w-lg w-full p-10 border border-slate-100">
                    <div class="flex justify-between items-center mb-8">
                        <h3 class="text-2xl font-black text-slate-900 italic tracking-tight">Booking Details</h3>
                        <button @click="showDetailModal = false" class="bg-slate-100 text-slate-400 p-2 rounded-full hover:bg-rose-50 hover:text-rose-500 transition">✕</button>
                    </div>

                    <template x-if="activeBooking.status === 'rejected'">
                        <div class="bg-rose-50 border border-rose-100 p-6 rounded-[2rem] mb-8">
                            <p class="text-rose-600 text-[10px] font-black uppercase tracking-[0.2em] mb-2">Tutor's Feedback:</p>
                            <p class="text-rose-800 italic font-bold text-lg leading-snug" x-text="activeBooking.rejection_reason || 'No specific reason provided.'"></p>
                        </div>
                    </template>

                    <form :action="'/bookings/' + activeBooking.id" method="POST" class="space-y-5">
                        @csrf @method('PATCH')
                        <input type="hidden" name="status" value="pending">
                        
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-4">Subject</label>
                            <input type="text" name="subject" x-model="activeBooking.subject" 
                                   class="w-full rounded-2xl border-none bg-slate-50 p-5 font-bold focus:ring-4 focus:ring-indigo-50">
                        </div>

                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-4">Preferred Date & Time</label>
                            <input type="datetime-local" name="booking_time" 
                                   :value="activeBooking.booking_time ? activeBooking.booking_time.replace(' ', 'T').substring(0, 16) : ''" 
                                   @input="activeBooking.booking_time = $event.target.value"
                                   class="w-full rounded-2xl border-none bg-slate-50 p-5 font-bold focus:ring-4 focus:ring-indigo-50">
                        </div>

                        <div class="flex gap-4 pt-6">
                            <button type="button" @click="if(confirm('Delete this booking request?')) { $refs.deleteForm.submit() }" 
                                    class="flex-1 bg-rose-50 text-rose-600 py-5 rounded-2xl font-black uppercase text-[10px] tracking-[0.15em] hover:bg-rose-600 hover:text-white transition">Delete</button>
                        </div>
                    </form>
                    
                    <form x-ref="deleteForm" :action="'/bookings/' + activeBooking.id" method="POST" class="hidden">
                        @csrf @method('DELETE')
                    </form>
                </div>
            </div>
        @endif

    </div>

    <style>[x-cloak]{display:none !important}</style>
</x-app-layout>