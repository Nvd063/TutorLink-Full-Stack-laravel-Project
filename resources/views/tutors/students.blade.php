<x-app-layout>
    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-3xl font-black text-slate-900 italic">Enrolled Students & Earnings</h2>
                <div class="bg-indigo-600 text-white px-6 py-2 rounded-2xl font-bold shadow-lg">
                    Total: ${{ number_format($totalEarnings, 2) }}
                </div>
            </div>

            <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-50 border-b border-slate-100">
                        <tr>
                            <th class="p-6 text-sm font-black text-slate-500 uppercase tracking-widest">Student</th>
                            <th class="p-6 text-sm font-black text-slate-500 uppercase tracking-widest">Fee Paid</th>
                            <th class="p-6 text-sm font-black text-slate-500 uppercase tracking-widest">Joined Date</th>
                            <th class="p-6 text-sm font-black text-slate-500 uppercase tracking-widest">Status</th>
                            <th class="p-6 text-sm font-black text-slate-500 uppercase tracking-widest text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($bookings as $booking)
                        <tr class="hover:bg-slate-50/50 transition-colors group">
                            <td class="p-6">
                                <div class="flex items-center gap-4">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($booking->student->name) }}&background=6366f1&color=fff" class="w-12 h-12 rounded-xl shadow-sm">
                                    <span class="font-bold text-slate-900">{{ $booking->student->name }}</span>
                                </div>
                            </td>
                            <td class="p-6 font-black text-indigo-600 text-lg italic">${{ $booking->amount }}</td>
                            <td class="p-6 text-slate-500 font-medium">{{ $booking->created_at->format('M d, Y') }}</td>
                            <td class="p-6">
                                <span class="px-4 py-1 rounded-full text-[10px] font-black uppercase tracking-widest bg-green-100 text-green-600">
                                    {{ $booking->status }}
                                </span>
                            </td>
                            <td class="p-6 text-center">
                                <a href="/chat/{{ $booking->student->id }}" class="inline-flex items-center justify-center w-10 h-10 bg-slate-900 text-white rounded-xl hover:bg-indigo-600 transition shadow-lg shadow-slate-200">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="p-20 text-center italic text-slate-400 font-medium">No students enrolled yet.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>