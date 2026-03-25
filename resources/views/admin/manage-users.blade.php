<x-app-layout>
    <div class="py-12 bg-slate-50 min-h-screen" x-data="{ tutorSearch: '', studentSearch: '' }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="text-3xl font-black text-slate-800 mb-10 italic text-center md:text-left">Manage Ecosystem 🌍</h2>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
                
                <div class="bg-white p-8 rounded-[3rem] shadow-sm border border-slate-100">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-black italic">Tutors</h3>
                        <input type="text" x-model="tutorSearch" placeholder="Search tutors..." 
                               class="text-xs border-none bg-slate-100 rounded-xl px-4 py-2 focus:ring-2 focus:ring-indigo-400 w-1/2">
                    </div>

                    <div class="space-y-4">
                        @foreach($tutors as $tutor)
                        <div x-show="tutorSearch === '' || '{{ strtolower($tutor->name) }}'.includes(tutorSearch.toLowerCase())" 
                             class="flex items-center justify-between p-4 bg-slate-50 rounded-2xl hover:bg-white hover:shadow-md transition border border-transparent hover:border-slate-100">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-xl bg-indigo-100 flex items-center justify-center font-black text-indigo-600">
                                    {{ substr($tutor->name, 0, 1) }}
                                </div>
                                <div>
                                    <p class="text-sm font-black text-slate-800">{{ $tutor->name }}</p>
                                    <p class="text-[10px] text-slate-400">{{ $tutor->email }}</p>
                                </div>
                            </div>
                            <div class="flex gap-2">
                                <a href="#" class="p-2 text-indigo-600 hover:bg-indigo-50 rounded-lg">⚙️</a>
                                <form action="{{ route('admin.users.delete', $tutor->id) }}" method="POST" onsubmit="return confirm('Pakka delete karna hai?')">
                                    @csrf @method('DELETE')
                                    <button class="p-2 text-rose-600 hover:bg-rose-50 rounded-lg">🗑️</button>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="bg-white p-8 rounded-[3rem] shadow-sm border border-slate-100">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-black italic">Students</h3>
                        <input type="text" x-model="studentSearch" placeholder="Search students..." 
                               class="text-xs border-none bg-slate-100 rounded-xl px-4 py-2 focus:ring-2 focus:ring-indigo-400 w-1/2">
                    </div>

                    <div class="space-y-4">
                        @foreach($students as $student)
                        <div x-show="studentSearch === '' || '{{ strtolower($student->name) }}'.includes(studentSearch.toLowerCase())" 
                             class="flex items-center justify-between p-4 bg-slate-50 rounded-2xl hover:bg-white hover:shadow-md transition border border-transparent hover:border-slate-100">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-xl bg-emerald-100 flex items-center justify-center font-black text-emerald-600">
                                    {{ substr($student->name, 0, 1) }}
                                </div>
                                <div>
                                    <p class="text-sm font-black text-slate-800">{{ $student->name }}</p>
                                    <p class="text-[10px] text-slate-400">{{ $student->email }}</p>
                                </div>
                            </div>
                            <div class="flex gap-2">
                                <form action="{{ route('admin.users.delete', $student->id) }}" method="POST" onsubmit="return confirm('Student ko remove karna hai?')">
                                    @csrf @method('DELETE')
                                    <button class="p-2 text-rose-600 hover:bg-rose-50 rounded-lg">🗑️</button>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>