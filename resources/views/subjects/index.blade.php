<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            <h2 class="font-black text-3xl text-slate-800 leading-tight">
                {{ __('Explore Subjects') }}
            </h2>
            
            <div class="relative w-full md:w-96">
                <input type="text" id="subjectSearch" placeholder="Search subjects (e.g. Physics...)" 
                       class="w-full pl-12 pr-4 py-3 rounded-2xl border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-50 shadow-sm transition-all outline-none">
                <svg class="absolute left-4 top-3.5 h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
            <a href="/"
                    class="bg-indigo-500 text-white font-semibold px-5 py-2 rounded-lg hover:bg-indigo-600 transition shadow">
                    Home
                </a>
        </div>
    </x-slot>

    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div id="subjectsGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @forelse($subjects as $subject)
                    <div class="subject-card bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 text-center group">
                        <div class="w-20 h-20 rounded-3xl bg-indigo-50 flex items-center justify-center mx-auto mb-6 text-indigo-600 font-black text-2xl group-hover:bg-indigo-600 group-hover:text-white transition-all duration-500 shadow-inner">
                            {{ substr($subject->name, 0, 1) }}
                        </div>

                        <h3 class="text-xl font-black text-slate-900 mb-2 group-hover:text-indigo-600 transition-colors">{{ $subject->name }}</h3>
                        <p class="text-slate-500 text-sm mb-8 leading-relaxed italic">Find the best expert tutors for {{ $subject->name }} lessons.</p>
                        
                        <a href="{{ url('/tutors?subject=' . $subject->name) }}" 
                           class="inline-flex items-center justify-center w-full py-4 bg-slate-900 text-white rounded-2xl font-black hover:bg-indigo-600 shadow-lg shadow-slate-200 hover:shadow-indigo-200 transition-all active:scale-95">
                            Explore Tutors
                        </a>
                    </div>
                @empty
                    <div class="col-span-full py-20 text-center">
                        <img src="https://illustrations.popsy.co/gray/searching.svg" class="w-48 mx-auto mb-6 opacity-50" alt="Not found">
                        <p class="text-slate-400 text-lg font-medium">No subjects found at the moment.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <script>
        document.getElementById('subjectSearch').addEventListener('input', function(e) {
            let searchTerm = e.target.value.toLowerCase();
            let cards = document.querySelectorAll('.subject-card');
            
            cards.forEach(card => {
                let subjectName = card.querySelector('h3').innerText.toLowerCase();
                if (subjectName.includes(searchTerm)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    </script>
</x-app-layout>