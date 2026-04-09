<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl text-slate-800 leading-tight">
            Welcome back, {{ Auth::user()->name }} 👋
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 min-h-screen" x-data="{
            showUploadModal: false,
            showDeclineModal: false,
            showPostModal: false,
            selectedBooking: null,
            showDetailModal: false,
            activeBooking: { id: '', subject: '', booking_time: '', status: '', rejection_reason: '' }
         }">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- ========================= STUDENT SECTION ========================= --}}
            @if(Auth::user()->role == 'student')
            

                {{-- Student Hero Banner --}}
                <div class="max-w-5xl mx-auto mb-10">
                    <div
                        class="bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 rounded-[3rem] p-10 text-white shadow-2xl hover:shadow-3xl transition-all duration-300 flex justify-between items-center backdrop-blur-sm">
                        <div>
                            <h3 class="text-3xl font-black italic mb-3 bg-clip-text text-transparent bg-gradient-to-r from-white to-blue-100">Need a Personal Tutor?</h3>
                            <p class="opacity-90 text-lg font-medium">Post your requirements. Tutor will contact you soon.</p>
                        </div>
                        <button @click="showPostModal = true"
                            class="bg-white/20 backdrop-blur-md text-white px-8 py-4 rounded-2xl font-black uppercase text-xs tracking-widest hover:bg-white/30 hover:scale-105 transition-all duration-300 shadow-xl border border-white/20">
                            + Create a Post
                        </button>
                    </div>
                </div>

                {{-- Student Bookings + Store --}}
                <div class="grid md:grid-cols-2 gap-8">
                    <div class="bg-white/80 backdrop-blur-sm p-10 rounded-[3rem] shadow-xl border border-white/50 hover:shadow-2xl transition-all duration-300">
                        <div class="flex justify-between items-center mb-8">
                            <h3 class="text-3xl font-black text-slate-900 italic tracking-tight bg-gradient-to-r from-slate-900 to-indigo-600 bg-clip-text text-transparent">My Bookings</h3>
                            <a href="/tutors"
                                class="text-indigo-600 font-black text-sm uppercase tracking-widest hover:text-indigo-700 hover:scale-105 transition-all duration-300 flex items-center gap-2">
                                Find Tutors →
                            </a>
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
                                    class="p-6 bg-gradient-to-r from-slate-50 to-blue-50 rounded-[2.5rem] flex items-center justify-between border border-transparent hover:border-indigo-200 hover:shadow-lg transition-all duration-300 cursor-pointer group hover:scale-[1.02]">
                                    <div class="flex items-center gap-4">
                                        <div
                                            class="w-14 h-14 rounded-2xl bg-gradient-to-r from-indigo-500 to-purple-600 flex items-center justify-center text-white font-black text-sm uppercase group-hover:rotate-12 group-hover:scale-110 transition-all duration-300 shadow-lg">
                                            {{ substr($booking->tutor?->name ?? 'T', 0, 1) }}
                                        </div>
                                        <div>
                                            <p
                                                class="font-black text-slate-900 text-lg italic group-hover:text-indigo-600 transition-all duration-300">
                                                {{ $booking->subject }}
                                            </p>
                                            <p class="text-xs text-slate-500 font-bold uppercase tracking-widest mt-1">
                                                With {{ $booking->tutor?->name }}</p>
                                        </div>
                                    </div>
                                    <div class="text-right flex flex-col items-end gap-2">
                                        <p class="text-xs font-black text-slate-700">
                                            {{ \Carbon\Carbon::parse($booking->booking_time)->format('d M, h:i A') }}
                                        </p>
                                        <span
                                            class="text-xs px-4 py-2 rounded-full font-black uppercase tracking-widest shadow-sm
                                                                            {{ $booking->status == 'pending' ? 'bg-gradient-to-r from-amber-100 to-yellow-100 text-amber-700 border border-amber-200' : '' }}
                                                                            {{ $booking->status == 'accepted' ? 'bg-gradient-to-r from-emerald-100 to-green-100 text-emerald-700 border border-emerald-200' : '' }}
                                                                            {{ $booking->status == 'rejected' ? 'bg-gradient-to-r from-rose-100 to-red-100 text-rose-700 border border-rose-200' : '' }}">
                                            {{ $booking->status }}
                                        </span>
                                    </div>
                                </div>
                            @empty
                                <div
                                    class="text-center py-20 bg-gradient-to-r from-slate-50/50 to-blue-50/50 rounded-[2.5rem] border-2 border-dashed border-slate-200">
                                    <p class="text-slate-400 italic text-lg font-medium">No bookings found in your history.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <div
                        class="bg-white/80 backdrop-blur-sm p-12 rounded-[3rem] shadow-xl border border-white/50 flex flex-col justify-center items-center text-center hover:shadow-2xl transition-all duration-300">
                        <h3 class="text-3xl font-black text-slate-900 mb-6 italic tracking-tight bg-gradient-to-r from-slate-900 to-indigo-600 bg-clip-text text-transparent">Digital Library</h3>
                        <div class="bg-gradient-to-r from-indigo-50 to-purple-50 p-10 rounded-[3rem] w-full border border-indigo-100 shadow-inner">
                            <p class="text-indigo-600 text-base font-bold mb-8 italic">Looking for premium notes or FYP
                                projects?</p>
                            <a href="{{ route('store.index') }}"
                                class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-12 py-5 rounded-2xl font-black uppercase text-sm tracking-[0.2em] inline-block shadow-2xl hover:shadow-3xl hover:scale-105 transition-all duration-300 active:scale-95">
                                Visit Store
                            </a>
                        </div>
                    </div>
                </div>

            @endif

            {{-- ========================= TUTOR SECTION ========================= --}}
            @if(Auth::user()->role == 'tutor')

                {{-- Warning Banner (Unverified) --}}
                @if(!auth()->user()->is_verified)
                    <div class="bg-gradient-to-r from-rose-50 to-red-50 border-l-4 border-rose-500 p-8 rounded-3xl mb-8 max-w-5xl mx-auto shadow-lg backdrop-blur-sm">
                        <div class="flex items-center">
                            <span class="text-3xl mr-5">⚠️</span>
                            <div>
                                <h3 class="text-rose-800 font-black uppercase text-sm tracking-widest">Application Status:
                                    Rejected / Pending</h3>
                                @if(auth()->user()->rejection_reason)
                                    <p class="text-rose-600 mt-3 font-bold italic text-lg">"{{ auth()->user()->rejection_reason }}"</p>
                                    <p class="text-rose-500 text-sm mt-5">Kindly read the instructions carefully and create your
                                        profile again. Thank you!</p>
                                @else
                                    <p class="text-rose-600 mt-2 text-base font-medium">Your application is under review. Please wait!</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif

                @if(!auth()->user()->is_verified)

                    {{-- Full Waiting / Rejected Screen --}}
                    <div class="max-w-4xl mx-auto mt-10">
                        <div class="bg-white/90 backdrop-blur-sm p-16 rounded-[3rem] shadow-2xl border border-white/50 text-center">
                            @if(auth()->user()->rejection_reason)
                                <div
                                    class="w-24 h-24 bg-gradient-to-r from-rose-100 to-red-100 text-rose-600 rounded-3xl flex items-center justify-center mx-auto mb-8 shadow-lg">
                                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="M6 18L18 6M6 6l12 12" stroke-width="3" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </div>
                                <h2 class="text-4xl font-black text-slate-900 italic mb-6 bg-gradient-to-r from-slate-900 to-rose-600 bg-clip-text text-transparent">Application Declined</h2>
                                <div class="bg-gradient-to-r from-rose-50 to-red-50 p-8 rounded-3xl border border-rose-100 mb-8 shadow-inner">
                                    <p class="text-rose-600 text-sm font-black uppercase tracking-widest mb-3">Reason from
                                        Admin:</p>
                                    <p class="text-rose-800 font-bold italic text-xl leading-relaxed">{{ auth()->user()->rejection_reason }}</p>
                                </div>
                                <p class="text-slate-500 text-lg font-medium">Please update your profile from settings and try again.</p>
                            @else
                                <div
                                    class="w-24 h-24 bg-gradient-to-r from-amber-100 to-yellow-100 text-amber-600 rounded-3xl flex items-center justify-center mx-auto mb-8 animate-pulse shadow-lg">
                                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                                <h2 class="text-4xl font-black text-slate-900 italic mb-6 bg-gradient-to-r from-slate-900 to-amber-600 bg-clip-text text-transparent">Waiting for Approval</h2>
                                <p class="text-slate-500 leading-relaxed max-w-2xl mx-auto text-lg font-medium">
                                    Dear Tutor, Your application is send to Admin for verification. After verification your
                                    dashboard will unlock. Thank you for your patience!
                                </p>
                            @endif
                            <div class="mt-10">
                                <a href="{{ route('profile.edit') }}"
                                    class="inline-block bg-gradient-to-r from-slate-900 to-indigo-600 text-white px-10 py-5 rounded-2xl font-black text-sm uppercase tracking-widest hover:from-indigo-600 hover:to-purple-600 transition-all duration-300 shadow-xl hover:shadow-2xl hover:scale-105">
                                    Update Profile Info
                                </a>
                            </div>
                        </div>
                    </div>

                @else

                        {{-- ===== Verified Tutor Dashboard ===== --}}
                        <div class="max-w-5xl mx-auto">

                            {{-- Stats Row --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-5 gap-6 mb-10">
                                <div class="bg-white/80 backdrop-blur-sm p-6 rounded-3xl shadow-xl border border-white/50 hover:shadow-2xl hover:scale-105 transition-all duration-300">
                                    <p class="text-sm font-bold uppercase text-slate-400 tracking-widest">Total Earnings</p>
                                    <h3 class="text-3xl font-black bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent mt-2">Rs.
                                        {{ number_format($totalEarnings ?? 0, 2) }}
                                    </h3>
                                </div>

                                <div class="bg-white/80 backdrop-blur-sm p-6 rounded-3xl shadow-xl border border-white/50 hover:shadow-2xl hover:scale-105 transition-all duration-300">
                                    <p class="text-sm font-bold uppercase text-slate-400 tracking-widest">Active Students</p>
                                    <h3 class="text-3xl font-black text-slate-800 mt-2">{{ $activeCount ?? 0 }}</h3>
                                </div>

                                <div
                                    class="bg-gradient-to-r from-indigo-600 to-purple-600 p-6 rounded-3xl text-white flex flex-col justify-between shadow-2xl hover:shadow-3xl hover:scale-105 transition-all duration-300">
                                    <p class="text-sm font-bold uppercase tracking-widest opacity-90">Profile Status:
                                        {{ $data['profile_status'] ?? 0 }}%
                                    </p>
                                    <a href="{{ route('tutors.profile.edit') }}"
                                        class="mt-4 bg-white/20 backdrop-blur-md text-white text-center py-3 rounded-2xl text-sm font-black uppercase tracking-widest hover:bg-white/30 transition-all duration-300 border border-white/20">
                                        Complete Profile
                                    </a>
                                </div>

                                <div
                                    class="bg-white/80 backdrop-blur-sm p-6 rounded-3xl border border-white/50 flex flex-col justify-between shadow-xl hover:shadow-2xl hover:scale-105 transition-all duration-300">
                                    <h2 class="font-black text-slate-800 italic text-base">Digital Store</h2>
                                    <button @click="showUploadModal = true"
                                        class="mt-4 bg-gradient-to-r from-slate-900 to-indigo-600 text-white py-3 rounded-2xl text-sm font-black uppercase tracking-widest hover:from-indigo-600 hover:to-purple-600 transition-all duration-300 shadow-lg hover:shadow-xl active:scale-95">
                                        + Add Product
                                    </button>
                                </div>
                                <div
                                    class="bg-white/80 backdrop-blur-sm p-6 rounded-3xl border border-white/50 flex flex-col justify-between shadow-xl hover:shadow-2xl hover:scale-105 transition-all duration-300 relative overflow-hidden group">
                                    <div class="absolute inset-0 bg-gradient-to-r from-indigo-500/10 to-purple-500/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-3xl"></div>
                                    <div class="relative flex justify-between items-start">
                                        <div>
                                            <p class="text-xs font-black uppercase text-slate-400 tracking-widest italic">New
                                                Opportunities</p>
                                            <h3 class="text-3xl font-black text-slate-800 mt-2 italic italic">Jobs</h3>
                                        </div>
                                        <div class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white text-sm font-black px-3 py-2 rounded-xl shadow-lg">
                                            {{ $matchingPostsCount }}
                                        </div>
                                    </div>
                                    <a href="{{ route('tutors.jobs') }}"
                                        class="mt-4 relative bg-gradient-to-r from-indigo-600 to-purple-600 text-white text-center py-3 rounded-2xl text-sm font-black uppercase tracking-widest hover:from-slate-900 hover:to-indigo-600 transition-all duration-300 shadow-xl hover:shadow-2xl">
                                        View All Jobs
                                    </a>
                                </div>
                            </div>
                        </div>


                        {{-- Direct Booking Requests --}}
                        <div class="bg-white/80 backdrop-blur-sm rounded-[3rem] border border-white/50 overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-300">
                            <div class="p-10 border-b border-slate-100 flex justify-between items-center bg-gradient-to-r from-slate-50 to-blue-50">
                                <h3 class="text-2xl font-black italic text-slate-800 tracking-tight">Direct Booking Requests</h3>
                                <span
                                    class="text-sm font-black bg-gradient-to-r from-indigo-100 to-purple-100 text-indigo-700 px-6 py-3 rounded-full uppercase tracking-[0.1em] shadow-lg border border-indigo-200">
                                    {{ $tutorBookings->where('status', 'pending')->count() }} New Requests
                                </span>
                            </div>

                            <div class="p-10 space-y-6">
                                @forelse($tutorBookings as $booking)
                                    <div
                                        class="flex justify-between items-center p-8 bg-gradient-to-r from-slate-50 to-blue-50 rounded-[2.5rem] border border-transparent hover:border-indigo-200 hover:shadow-xl transition-all duration-300 group hover:scale-[1.02]">
                                        <div class="flex items-center gap-6">
                                            <div
                                                class="w-16 h-16 rounded-2xl bg-white border border-slate-100 flex items-center justify-center font-black text-indigo-600 uppercase shadow-lg group-hover:scale-110 group-hover:rotate-6 transition-all duration-300">
                                                {{ substr($booking->student?->name ?? 'S', 0, 2) }}
                                            </div>
                                            <div>
                                                <p class="font-black text-slate-900 text-xl italic tracking-tight">
                                                    {{ $booking->subject }}
                                                </p>
                                                <p class="text-sm text-slate-500 font-bold uppercase tracking-[0.15em] mt-2">
                                                    By {{ $booking->student?->name }} •
                                                    {{ \Carbon\Carbon::parse($booking->booking_time)->format('d M, h:i A') }}
                                                </p>
                                            </div>
                                        </div>

                                        <div class="flex items-center gap-4">
                                            @if($booking->status == 'pending')
                                                <form action="{{ route('bookings.update', $booking->id) }}" method="POST">
                                                    @csrf @method('PATCH')
                                                    <input type="hidden" name="status" value="accepted">
                                                    <button type="submit"
                                                        class="bg-gradient-to-r from-emerald-500 to-green-600 text-white px-8 py-3 rounded-2xl font-black text-sm uppercase tracking-widest hover:from-emerald-600 hover:to-green-700 transition-all duration-300 shadow-xl hover:shadow-2xl hover:scale-105">
                                                        Accept
                                                    </button>
                                                </form>
                                                <button @click="showDeclineModal = true; selectedBooking = {{ $booking->id }}"
                                                    class="bg-gradient-to-r from-rose-100 to-red-100 text-rose-600 px-8 py-3 rounded-2xl font-black text-sm uppercase tracking-widest hover:from-rose-600 hover:to-red-700 hover:text-white transition-all duration-300 shadow-lg hover:shadow-xl hover:scale-105">
                                                    Decline
                                                </button>
                                            @else
                                                <span
                                                    class="px-6 py-3 rounded-2xl font-black text-sm uppercase tracking-widest shadow-sm
                                                                                                                                {{ $booking->status == 'accepted' ? 'bg-gradient-to-r from-emerald-50 to-green-50 text-emerald-600 border border-emerald-200' : 'bg-gradient-to-r from-rose-50 to-red-50 text-rose-500 border border-rose-200' }}">
                                                    {{ $booking->status }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                @empty
                                    <div class="text-center py-16">
                                        <p class="text-slate-400 italic text-lg font-medium">No direct bookings yet.</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>

                    </div>
                @endif

            @endif
    </div>

    {{-- ========================= MODALS ========================= --}}

    {{-- Student Post Modal --}}
    @if(Auth::user()->role == 'student')
        <div x-show="showPostModal" x-cloak
            class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm">
            <div class="bg-white/95 backdrop-blur-md w-full max-w-lg rounded-[3rem] p-10 shadow-2xl border border-white/50" @click.away="showPostModal = false">
                <h3 class="text-3xl font-black italic mb-8 tracking-tight bg-gradient-to-r from-slate-900 to-indigo-600 bg-clip-text text-transparent">Post Your Requirement</h3>
                <form action="{{ route('student.posts.store') }}" method="POST">
                    @csrf
                    <div class="space-y-6">
                        <div>
                            <label
                                class="block text-sm font-black uppercase tracking-widest text-slate-400 mb-3 ml-4">What
                                do you want to learn?</label>
                            <input type="text" name="title" placeholder="e.g. Need help in Laravel project"
                                class="w-full bg-gradient-to-r from-slate-50 to-blue-50 border-none rounded-2xl px-6 py-4 focus:ring-4 focus:ring-indigo-100 font-bold italic text-lg" required>
                        </div>
                        <div>
                            <label
                                class="block text-sm font-black uppercase tracking-widest text-slate-400 mb-3 ml-4">Describe
                                in detail (Add keywords like PHP, Python etc)</label>
                            <textarea name="description" rows="5"
                                placeholder="Mention specific topics you are struggling with..."
                                class="w-full bg-gradient-to-r from-slate-50 to-blue-50 border-none rounded-2xl px-6 py-4 focus:ring-4 focus:ring-indigo-100 font-bold italic resize-y" required></textarea>
                        </div>
                    </div>
                    <div class="mt-10 flex gap-4">
                        <button type="button" @click="showPostModal = false"
                            class="flex-1 px-6 py-4 rounded-2xl font-black uppercase text-sm tracking-widest bg-slate-100 text-slate-500 hover:bg-slate-200 transition-all duration-300">
                            Cancel
                        </button>
                        <button type="submit"
                            class="flex-1 px-6 py-4 rounded-2xl font-black uppercase text-sm tracking-widest bg-gradient-to-r from-indigo-600 to-purple-600 text-white shadow-xl hover:shadow-2xl hover:scale-105 transition-all duration-300">
                            Post Now
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    {{-- Tutor Modals (Verified only) --}}
    @if(Auth::user()->role == 'tutor' && Auth::user()->is_verified)
        {{-- FIXED DECLINE MODAL --}}
        @if(Auth::user()->role == 'tutor' && Auth::user()->is_verified)
            <div x-show="showDeclineModal" x-cloak
                class="fixed inset-0 z-[160] flex items-center justify-center bg-black/70 backdrop-blur-sm p-4"
                style="display: none;">

                <div class="bg-white/95 backdrop-blur-md p-12 rounded-[3rem] shadow-2xl max-w-md w-full border border-white/50"
                    @click.away="showDeclineModal = false">

                    <h3 class="text-3xl font-black text-slate-900 mb-8 italic text-center tracking-tight bg-gradient-to-r from-slate-900 to-rose-600 bg-clip-text text-transparent">
                        Decline Booking Request
                    </h3>

                    <form :action="`/bookings/${selectedBooking}`" method="POST" class="space-y-8">
                        @csrf
                        @method('PATCH')

                        <input type="hidden" name="status" value="rejected">

                        <div>
                            <label class="block text-base font-semibold text-slate-700 mb-4">
                                Why are you declining this booking?
                            </label>
                            <textarea name="rejection_reason" required rows="5"
                                placeholder="Please explain the reason (Student will see this message)..."
                                class="w-full rounded-2xl border border-slate-200 p-6 focus:ring-4 focus:ring-rose-100 resize-y font-medium bg-gradient-to-r from-rose-50 to-red-50"></textarea>
                        </div>

                        <div class="flex gap-4 pt-4">
                            <button type="button" @click="showDeclineModal = false"
                                class="flex-1 bg-slate-100 hover:bg-slate-200 py-4 rounded-2xl font-semibold text-slate-600 transition-all duration-300">
                                Cancel
                            </button>

                            <button type="submit"
                                class="flex-1 bg-gradient-to-r from-rose-600 to-red-700 hover:from-rose-700 hover:to-red-800 text-white py-4 rounded-2xl font-semibold shadow-xl hover:shadow-2xl transition-all duration-300">
                                Confirm Decline
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @endif



        {{-- Upload Modal --}}
        <div x-show="showUploadModal" x-cloak
            class="fixed inset-0 z-[100] flex items-center justify-center bg-black/60 backdrop-blur-sm p-4">
            <div class="bg-white/95 backdrop-blur-md p-14 rounded-[3.5rem] shadow-2xl max-w-xl w-full border border-white/50 relative">
                <h2 class="text-4xl font-black mb-10 text-slate-900 italic text-center tracking-tight bg-gradient-to-r from-slate-900 to-indigo-600 bg-clip-text text-transparent">Upload Digital
                    Asset</h2>
                <form action="{{ route('store.upload') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                    @csrf
                    <input type="text" name="title" placeholder="Product Title" required
                        class="w-full rounded-2xl border-none bg-gradient-to-r from-slate-50 to-blue-50 p-6 font-bold text-lg focus:ring-4 focus:ring-indigo-100">
                    <input type="number" name="price" placeholder="Price (PKR)" required
                        class="w-full rounded-2xl border-none bg-gradient-to-r from-slate-50 to-blue-50 p-6 font-bold text-lg focus:ring-4 focus:ring-indigo-100">
                    <textarea name="description" placeholder="Short description..."
                        class="w-full rounded-2xl border-none bg-gradient-to-r from-slate-50 to-blue-50 p-6 h-32 font-bold text-lg focus:ring-4 focus:ring-indigo-100 resize-y"></textarea>
                    <div class="p-8 border-4 border-dashed border-slate-200 rounded-[2rem] text-center bg-gradient-to-r from-slate-50 to-blue-50">
                        <input type="file" name="file" required class="text-base font-bold text-slate-400">
                    </div>
                    <div class="flex gap-4 pt-6">
                        <button type="button" @click="showUploadModal = false"
                            class="flex-1 bg-slate-100 py-6 rounded-2xl font-black uppercase text-sm tracking-widest text-slate-500 hover:bg-slate-200 transition-all duration-300">Cancel</button>
                        <button
                            class="flex-1 bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-6 px-12 rounded-2xl font-black uppercase text-sm tracking-widest shadow-xl hover:shadow-2xl hover:scale-105 transition-all duration-300">Upload
                            Now</button>
                    </div>
                </form>
            </div>
        </div>

    @endif

    {{-- Student Detail Modal --}}
    @if(Auth::user()->role == 'student')
        <div x-show="showDetailModal" x-cloak
            class="fixed inset-0 z-[200] flex items-center justify-center bg-black/60 backdrop-blur-sm p-4">
            <div class="bg-white/95 backdrop-blur-md rounded-[3rem] shadow-2xl max-w-lg w-full p-12 border border-white/50">
                <div class="flex justify-between items-center mb-10">
                    <h3 class="text-3xl font-black text-slate-900 italic tracking-tight bg-gradient-to-r from-slate-900 to-indigo-600 bg-clip-text text-transparent">Booking Details</h3>
                    <button @click="showDetailModal = false"
                        class="bg-slate-100 text-slate-400 p-3 rounded-full hover:bg-rose-50 hover:text-rose-500 transition-all duration-300 hover:scale-110">✕</button>
                </div>

                <template x-if="activeBooking.status === 'rejected'">
                    <div class="bg-gradient-to-r from-rose-50 to-red-50 border border-rose-100 p-8 rounded-[2.5rem] mb-8">
                        <p class="text-rose-600 text-sm font-black uppercase tracking-[0.2em] mb-3">Tutor's
                            Feedback:</p>
                        <p class="text-rose-800 italic font-bold text-xl leading-snug"
                            x-text="activeBooking.rejection_reason || 'No specific reason provided.'"></p>
                    </div>
                </template>

                <form :action="'/bookings/' + activeBooking.id" method="POST" class="space-y-6">
                    @csrf @method('PATCH')
                    <input type="hidden" name="status" value="pending">

                    <div>
                        <label
                            class="block text-sm font-black text-slate-400 uppercase tracking-widest mb-3 ml-4">Subject</label>
                        <input type="text" name="subject" x-model="activeBooking.subject"
                            class="w-full rounded-2xl border-none bg-gradient-to-r from-slate-50 to-blue-50 p-6 font-bold text-lg focus:ring-4 focus:ring-indigo-100">
                    </div>

                    <div>
                        <label
                            class="block text-sm font-black text-slate-400 uppercase tracking-widest mb-3 ml-4">Preferred
                            Date & Time</label>
                        <input type="datetime-local" name="booking_time"
                            :value="activeBooking.booking_time ? activeBooking.booking_time.replace(' ', 'T').substring(0, 16) : ''"
                            @input="activeBooking.booking_time = $event.target.value"
                            class="w-full rounded-2xl border-none bg-gradient-to-r from-slate-50 to-blue-50 p-6 font-bold text-lg focus:ring-4 focus:ring-indigo-100">
                    </div>

                    <div class="flex gap-4 pt-8">
                        <button type="button"
                            @click="if(confirm('Delete this booking request?')) { $refs.deleteForm.submit() }"
                            class="flex-1 bg-gradient-to-r from-rose-50 to-red-50 text-rose-600 py-5 rounded-2xl font-black uppercase text-sm tracking-[0.15em] hover:from-rose-600 hover:to-red-700 hover:text-white transition-all duration-300 shadow-lg hover:shadow-xl hover:scale-105">
                            Delete
                        </button>
                    </div>
                </form>

                <form x-ref="deleteForm" :action="'/bookings/' + activeBooking.id" method="POST" class="hidden">
                    @csrf @method('DELETE')
                </form>
            </div>
        </div>
    @endif

    </div>

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</x-app-layout>