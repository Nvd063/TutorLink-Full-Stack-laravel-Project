<x-app-layout>
    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <h2 class="text-3xl font-black text-slate-800 mb-10 italic">Admin Command Center 🕹️</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                {{-- Card 1: Pending Verifications --}}
                <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 flex flex-col justify-between h-full">
                    <div>
                        <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Pending Verifications</p>
                        <h3 class="text-4xl font-black text-indigo-600 mt-2">{{ $pendingTutorsCount ?? 0 }}</h3>
                    </div>
                    <a href="{{ route('admin.tutors.pending') }}" 
                       class="mt-8 bg-indigo-600 text-white text-center py-3.5 rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-slate-900 transition shadow-lg">
                        Review Now →
                    </a>
                </div>

                {{-- Card 2: Total Users --}}
                <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 flex flex-col justify-between h-full">
                    <div>
                        <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Total Users</p>
                        <h3 class="text-4xl font-black text-slate-800 mt-2">{{ $total ?? 0 }}</h3>
                    </div>
                    <a href="{{ route('admin.users.index') }}" 
                       class="mt-8 bg-slate-100 text-slate-700 text-center py-3.5 rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-slate-200 transition">
                        Manage Users →
                    </a>
                </div>

                {{-- Card 3: Revenue & Commission --}}
                <div class="bg-slate-900 p-8 rounded-[2.5rem] shadow-sm flex flex-col justify-between h-full text-white">
                    <div>
                        <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Total Revenue</p>
                        <h3 class="text-4xl font-black text-emerald-400 mt-2">
                            Rs. {{ number_format($totalRevenue ?? 0, 0) }}
                        </h3>
                        <p class="text-sm text-emerald-300 mt-1">
                            Platform Commission: <span class="font-bold">Rs. {{ number_format($totalCommission ?? 0, 0) }}</span>
                        </p>
                    </div>
                    
                    <a href="{{ route('admin.payments.index') }}" 
                       class="mt-8 bg-emerald-500 text-white text-center py-3.5 rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-emerald-600 transition shadow-lg shadow-emerald-900/30">
                        Monitor Payments →
                    </a>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>