<x-app-layout>
    <div class="py-12 bg-slate-50 min-h-screen font-sans">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="text-3xl font-black text-slate-900 italic mb-8">Financial Overview 💰</h2>

            <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden">
                <table class="w-full text-left">
                    <thead class="bg-slate-50 border-b border-slate-100">
                        <tr>
                            <th class="px-6 py-4 text-[10px] font-black uppercase tracking-widest text-slate-400">Order ID</th>
                            <th class="px-6 py-4 text-[10px] font-black uppercase tracking-widest text-slate-400">Student</th>
                            <th class="px-6 py-4 text-[10px] font-black uppercase tracking-widest text-slate-400">Tutor</th>
                            <th class="px-6 py-4 text-[10px] font-black uppercase tracking-widest text-slate-400">Amount</th>
                            <th class="px-6 py-4 text-[10px] font-black uppercase tracking-widest text-slate-400">Status</th>
                            <th class="px-6 py-4 text-[10px] font-black uppercase tracking-widest text-slate-400">Date</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($payments as $payment)
                        <tr class="hover:bg-slate-50/50 transition">
                            <td class="px-6 py-4 font-bold text-slate-600">#{{ $payment->id }}</td>
                            <td class="px-6 py-4">
                                <span class="block font-black text-slate-800 text-sm">{{ $payment->student->name }}</span>
                                <span class="text-[10px] text-slate-400">{{ $payment->student->email }}</span>
                            </td>
                            <td class="px-6 py-4 text-indigo-600 font-bold italic text-sm">
                                {{ $payment->tutor->name }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="bg-emerald-100 text-emerald-700 px-3 py-1 rounded-full font-black text-xs">
                                    Rs. {{ number_format($payment->amount) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                @if($payment->status == 'completed')
                                    <span class="text-[10px] font-black text-emerald-500 uppercase">Paid ✅</span>
                                @else
                                    <span class="text-[10px] font-black text-amber-500 uppercase">Pending ⏳</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-xs text-slate-400 font-medium">
                                {{ $payment->created_at->format('M d, Y') }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-10 text-center text-slate-400 italic">No transactions found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $payments->links() }}
            </div>
        </div>
    </div>
</x-app-layout>