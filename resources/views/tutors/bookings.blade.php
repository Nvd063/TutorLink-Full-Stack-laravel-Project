<div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-slate-100">
    <h3 class="text-xl font-black mb-6 italic">Pending Bookings</h3>
    
    <div class="space-y-4">
        @forelse($bookings->where('status', 'pending') as $booking)
            <div class="flex items-center justify-between p-6 bg-slate-50 rounded-3xl border border-slate-100">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-indigo-600 flex items-center justify-center text-white font-bold">
                        {{ substr($booking->student->name, 0, 2) }}
                    </div>
                    <div>
                        <p class="font-black text-slate-900">{{ $booking->student->name }}</p>
                        <p class="text-xs text-slate-500 italic">{{ date('D, d M - h:i A', strtotime($booking->booking_time)) }}</p>
                        <p class="text-xs font-bold text-indigo-600 uppercase tracking-widest mt-1">{{ $booking->subject }}</p>
                    </div>
                </div>

                <div class="flex gap-2">
                    <form action="{{ route('bookings.update', $booking->id) }}" method="POST">
                        @csrf @method('PATCH')
                        <input type="hidden" name="status" value="accepted">
                        <button class="bg-green-500 text-white px-6 py-2 rounded-xl font-bold text-xs hover:bg-green-600 transition shadow-lg shadow-green-100">
                            ACCEPT
                        </button>
                    </form>

                    <form action="{{ route('bookings.update', $booking->id) }}" method="POST">
                        @csrf @method('PATCH')
                        <input type="hidden" name="status" value="rejected">
                        <button class="bg-red-50 text-red-500 px-6 py-2 rounded-xl font-bold text-xs hover:bg-red-500 hover:text-white transition">
                            REJECT
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <p class="text-slate-400 text-center py-10 italic">No pending requests.</p>
        @endforelse
    </div>
</div>