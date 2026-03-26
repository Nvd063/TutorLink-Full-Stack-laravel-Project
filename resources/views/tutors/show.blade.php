<x-app-layout>
    <style>
        html { scroll-behavior: smooth; }
    </style>

    <div class="py-12 bg-slate-50 min-h-screen font-sans">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Header Section --}}
            <div class="bg-white shadow-sm rounded-3xl overflow-hidden mb-6 border border-slate-100">
                <div class="p-10 text-center">
                    <h1 class="text-4xl font-black text-slate-900">{{ $tutor->name }}</h1>
                    <p class="text-indigo-600 font-bold italic text-lg mt-1">
                        {{ $tutor->tutorProfile->title ?? 'Professional Instructor' }}
                    </p>

                    <div class="flex items-center justify-center mt-4 text-slate-400">
                        <svg class="w-5 h-5 text-yellow-400 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        <a href="#all-reviews" 
                           class="text-sm font-black uppercase tracking-widest hover:text-indigo-600 transition">
                            {{ $tutor->reviews->count() > 0 ? $tutor->reviews->count() . ' Reviews' : 'No reviews yet' }}
                        </a>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8" x-data="{ openStore: false }">

                <div class="lg:col-span-2 space-y-6">

                    {{-- Introduction Section --}}
                    <div class="bg-white p-10 rounded-3xl shadow-sm border border-slate-100">
                        <div class="flex flex-col md:flex-row gap-10">
                            <div class="flex-1">
                                <h3 class="text-lg font-black text-slate-800 mb-4 flex items-center gap-2">
                                    <span class="bg-indigo-600 w-2 h-6 rounded-full"></span> Introduction
                                </h3>
                                <div class="text-slate-600 leading-relaxed space-y-4 text-lg italic">
                                    {!! nl2br(e($tutor->tutorProfile->bio ?? 'No biography provided.')) !!}
                                </div>
                            </div>

                            <div class="md:w-72 shrink-0">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($tutor->name) }}&size=400&background=f8fafc&color=6366f1&bold=true"
                                    class="w-full h-72 object-cover rounded-2xl border border-slate-100 shadow-lg"
                                    alt="Default Avatar">
                            </div>
                        </div>
                    </div>

                    

                    {{-- Expertise & Subjects --}}
                    <div class="bg-white p-10 rounded-3xl shadow-sm border border-slate-100 mb-12">
                        <h3 class="text-lg font-black text-slate-800 mb-6 flex items-center gap-2">
                            <span class="bg-indigo-600 w-2 h-6 rounded-full"></span> Expertise & Subjects
                        </h3>
                        <div class="flex flex-wrap gap-3">
                            @php
                                $skills = $tutor->tutorProfile->expertise
                                    ? explode(',', $tutor->tutorProfile->expertise)
                                    : [];
                            @endphp
                            @forelse($skills as $skill)
                                @if(trim($skill))
                                    <span class="px-5 py-2.5 bg-indigo-50 text-indigo-700 rounded-2xl text-sm font-black border border-indigo-100 italic hover:bg-indigo-600 hover:text-white transition-colors duration-300">
                                        {{ trim($skill) }}
                                    </span>
                                @endif
                            @empty
                                <p class="text-slate-400 italic text-sm">General subjects and mentoring.</p>
                            @endforelse
                        </div>
                    </div>

                    {{-- ALL REVIEWS SECTION (Last mein) --}}
                    <div id="all-reviews" class="bg-white p-10 rounded-3xl shadow-sm border border-slate-100 scroll-mt-24">
                        <h2 class="text-2xl font-black text-slate-900 mb-8">All Student Reviews</h2>
                        <div class="space-y-8">
                            @forelse($tutor->reviews as $review)
                                <div class="flex gap-5">
                                    <div class="w-11 h-11 bg-indigo-100 rounded-2xl flex-shrink-0 flex items-center justify-center font-bold text-indigo-600 text-xl">
                                        {{ substr($review->student->name ?? 'S', 0, 1) }}
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex justify-between items-start">
                                            <div>
                                                <p class="font-bold text-slate-900">{{ $review->student->name }}</p>
                                                <p class="text-xs text-slate-400">{{ $review->created_at->diffForHumans() }}</p>
                                            </div>
                                            <div class="text-yellow-400 text-2xl flex">
                                                @for($i = 1; $i <= 5; $i++)
                                                    {{ $i <= $review->rating ? '★' : '☆' }}
                                                @endfor
                                            </div>
                                        </div>
                                        @if($review->comment)
                                            <p class="mt-3 text-slate-700 italic">"{{ $review->comment }}"</p>
                                        @endif
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-12 text-slate-400 italic">No reviews yet.</div>
                            @endforelse
                        </div>
                    </div>

                </div>

                {{-- Sidebar Section --}}
                <div class="space-y-6 lg:-mt-24 relative z-10">
                    <div class="grid grid-cols-2 gap-3">
                        <a href="{{ url('/conversation/' . $tutor->id . '/messages') }}" class="flex items-center justify-center gap-2 bg-[#10b981] text-white py-4 rounded-lg font-bold text-sm hover:bg-[#059669] transition shadow-md group">
                            <svg class="w-5 h-5 text-white/70 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" stroke-width="2" />
                            </svg> Message
                        </a>
                        <button class="flex items-center justify-center gap-2 bg-[#0ea5e9] text-white py-4 rounded-lg font-bold text-sm hover:bg-[#0284c7] transition shadow-md group">
                            <svg class="w-5 h-5 text-white/70 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" stroke-width="2" />
                            </svg> Phone
                        </button>
                        <button class="flex items-center justify-center gap-2 bg-[#a855f7] text-white py-4 rounded-lg font-bold text-sm hover:bg-[#9333ea] transition shadow-md group">
                            <svg class="w-5 h-5 text-white/70 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" stroke-width="2" />
                            </svg> Pay
                        </button>
                        <button onclick="openReviewModal()" 
                            class="flex items-center justify-center gap-2 bg-[#fb923c] text-white py-4 rounded-lg font-bold text-sm hover:bg-[#f97316] transition shadow-md group">
                            <svg class="w-5 h-5 text-white/70 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" stroke-width="2" />
                            </svg> Review
                        </button>
                    </div>

                    <button @click="openStore = true" class="w-full bg-slate-900 text-white py-4 rounded-lg font-bold text-sm hover:bg-indigo-600 transition shadow-lg group flex items-center justify-center gap-3">
                        <svg class="w-5 h-5 text-indigo-300 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" stroke-width="2" />
                        </svg> Digital Store
                    </button>

                    {{-- Booking Modal --}}
                    <div x-data="{ showBookingModal: false }">
                        <button @click="showBookingModal = true" class="w-full bg-indigo-600 text-white py-4 rounded-xl font-black text-sm uppercase tracking-widest hover:bg-slate-900 transition shadow-lg flex items-center justify-center gap-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" stroke-width="2" />
                            </svg>
                            Book a Session
                        </button>

                        <div x-show="showBookingModal" x-cloak class="fixed inset-0 z-[100] overflow-y-auto">
                            <div class="flex items-center justify-center min-h-screen px-4">
                                <div @click="showBookingModal = false" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm"></div>
                                <div class="relative bg-white rounded-[3rem] shadow-2xl max-w-lg w-full p-10 border border-slate-100 z-[110]">
                                    <h3 class="text-2xl font-black text-slate-900 mb-6 italic text-center">Request a Booking</h3>
                                    <form action="{{ route('bookings.store') }}" method="POST" class="space-y-5">
                                        @csrf
                                        <input type="hidden" name="tutor_id" value="{{ $tutor->id }}">
                                        <div>
                                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-2">Subject</label>
                                            <input type="text" name="subject" placeholder="e.g. Python for Beginners" required class="w-full rounded-2xl border-none bg-slate-50 p-4 font-bold focus:ring-4 focus:ring-indigo-50">
                                        </div>
                                        <div>
                                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-2">Date & Time</label>
                                            <input type="datetime-local" name="booking_time" required class="w-full rounded-2xl border-none bg-slate-50 p-4 font-bold focus:ring-4 focus:ring-indigo-50">
                                        </div>
                                        <div>
                                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-2">Message (Optional)</label>
                                            <textarea name="message" placeholder="Any specific topics you want to cover?" class="w-full rounded-2xl border-none bg-slate-50 p-4 h-24 focus:ring-4 focus:ring-indigo-50"></textarea>
                                        </div>
                                        <div class="flex gap-4 pt-4">
                                            <button type="button" @click="showBookingModal = false" class="flex-1 bg-slate-100 text-slate-500 py-4 rounded-2xl font-black uppercase text-xs tracking-widest">Cancel</button>
                                            <button type="submit" class="flex-[2] bg-indigo-600 text-white py-4 px-10 rounded-2xl font-black uppercase text-xs tracking-widest shadow-xl">Send Request</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
                        <div class="p-8 space-y-5 text-sm font-medium">
                            <div class="flex items-center gap-4 text-slate-600">
                                <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" stroke-width="2" />
                                    <path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" stroke-width="2" />
                                </svg>
                                Lahore, Pakistan
                            </div>
                            <div class="flex items-center gap-4 text-slate-600">
                                <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" stroke-width="2" />
                                </svg>
                                Joined: {{ $tutor->created_at->format('M d, Y') }}
                            </div>
                            <div class="flex items-center gap-4 text-slate-600">
                                <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" stroke-width="2" />
                                </svg>
                                Exp: {{ $tutor->tutorProfile->experience ?? 0 }} yrs
                            </div>
                            <div class="flex items-center justify-between pt-4 border-t border-slate-50">
                                <span class="text-slate-400 font-bold uppercase tracking-widest text-[10px]">Hourly Rate</span>
                                <span class="text-2xl font-black text-indigo-600 italic">${{ $tutor->tutorProfile->hourly_rate ?? 0 }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Digital Store Modal (unchanged) --}}
                <div x-show="openStore" x-cloak class="fixed inset-0 z-50 overflow-y-auto" x-transition.opacity>
                    <!-- Your existing digital store modal code here -->
                </div>

            </div>
        </div>
    </div>

    <!-- ==================== REVIEW MODAL ==================== -->
    <div id="reviewModal" class="hidden fixed inset-0 z-[200] flex items-center justify-center bg-black/70 backdrop-blur">
        <div class="bg-white rounded-3xl shadow-2xl w-full max-w-2xl mx-4 max-h-[92vh] flex flex-col">
            <div class="p-6 border-b flex items-center justify-between bg-slate-50 rounded-t-3xl">
                <h3 class="text-xl font-black">Reviews • {{ $tutor->name }}</h3>
                <button onclick="closeReviewModal()" class="text-3xl text-slate-400 hover:text-slate-600">×</button>
            </div>

            <div class="flex-1 p-8 overflow-y-auto">
                @forelse($tutor->reviews as $review)
                    <div class="mb-9 last:mb-0">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 bg-indigo-100 rounded-2xl flex items-center justify-center font-bold text-indigo-600">
                                {{ substr($review->student->name ?? 'S', 0, 1) }}
                            </div>
                            <div class="flex-1">
                                <p class="font-bold">{{ $review->student->name }}</p>
                                <p class="text-xs text-slate-400">{{ $review->created_at->diffForHumans() }}</p>
                            </div>
                            <div class="text-yellow-400 text-2xl">
                                @for($i = 1; $i <= 5; $i++)
                                    {{ $i <= $review->rating ? '★' : '☆' }}
                                @endfor
                            </div>
                        </div>
                        @if($review->comment)
                            <p class="mt-4 italic text-slate-700">"{{ $review->comment }}"</p>
                        @endif
                    </div>
                @empty
                    <p class="text-center py-16 text-slate-400">No reviews yet.</p>
                @endforelse
            </div>

            {{-- Write Review Form in Modal --}}
            @auth
                @if(auth()->user()->role === 'student')
                    @php
                        $alreadyReviewed = $tutor->reviews->where('student_id', auth()->id())->isNotEmpty();
                    @endphp

                    @if(!$alreadyReviewed)
                        <div class="border-t p-8 bg-slate-50 rounded-b-3xl">
                            <h4 class="font-bold mb-4">Write Your Review</h4>
                            <form action="{{ route('reviews.store', $tutor->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="tutor_id" value="{{ $tutor->id }}">

                                <div class="mb-6">
                                    <div class="flex gap-3 text-4xl" id="modal-star-rating">
                                        @for($i = 1; $i <= 5; $i++)
                                            <span class="cursor-pointer text-gray-300 hover:text-yellow-400 transition star" data-value="{{ $i }}">★</span>
                                        @endfor
                                    </div>
                                    <input type="hidden" name="rating" id="modal-hidden-rating" required>
                                </div>

                                <textarea name="comment" rows="3" class="w-full rounded-2xl border border-slate-200 p-5" placeholder="Share your honest experience..."></textarea>

                                <button type="submit" class="mt-5 w-full bg-orange-500 hover:bg-orange-600 text-white font-bold py-4 rounded-2xl">
                                    Submit Review
                                </button>
                            </form>
                        </div>
                    @endif
                @endif
            @endauth
        </div>
    </div>
</x-app-layout>

<script>
    // Star Rating for Main Form (agar aapne preview mein form rakha hai)
    document.addEventListener('DOMContentLoaded', function () {
        const stars = document.querySelectorAll('#star-rating .star');
        const hiddenInput = document.getElementById('hidden-rating');

        if (stars.length > 0) {
            stars.forEach(star => {
                star.addEventListener('click', function () {
                    const value = this.dataset.value;
                    hiddenInput.value = value;
                    stars.forEach(s => {
                        if (parseInt(s.dataset.value) <= value) {
                            s.classList.add('text-yellow-400');
                            s.classList.remove('text-gray-300');
                        } else {
                            s.classList.remove('text-yellow-400');
                            s.classList.add('text-gray-300');
                        }
                    });
                });
            });
        }
    });

    // Modal Functions
    function openReviewModal() {
        document.getElementById('reviewModal').classList.remove('hidden');
        document.getElementById('reviewModal').classList.add('flex');
    }

    function closeReviewModal() {
        document.getElementById('reviewModal').classList.add('hidden');
        document.getElementById('reviewModal').classList.remove('flex');
    }

    // Modal Star Rating
    document.addEventListener('DOMContentLoaded', function () {
        const modalStars = document.querySelectorAll('#modal-star-rating .star');
        const modalHidden = document.getElementById('modal-hidden-rating');

        modalStars.forEach(star => {
            star.addEventListener('click', function () {
                const value = this.dataset.value;
                modalHidden.value = value;
                modalStars.forEach(s => {
                    s.classList.toggle('text-yellow-400', parseInt(s.dataset.value) <= value);
                });
            });
        });
    });
</script>