@forelse($tutors as $tutor)
    <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-sm hover:shadow-xl transition-all duration-300">
        <div class="flex items-start gap-4">
            <img src="https://ui-avatars.com/api/?name={{ urlencode($tutor->name) }}&background=6366f1&color=fff"
                class="w-16 h-16 rounded-2xl">
            <div class="flex-1">
                <h4 class="text-lg font-bold text-slate-900">{{ $tutor->name }}</h4>
                <p class="text-sm text-slate-500 line-clamp-2 mt-1 italic">
                    {{ $tutor->tutorProfile->bio ?? 'No bio available for this tutor.' }}
                </p>

                <div class="mt-4 flex justify-between items-center">
                    <span class="text-indigo-600 font-black italic text-xl">
                        ${{ $tutor->tutorProfile->hourly_rate ?? '0' }}<small class="text-xs text-slate-400">/hr</small>
                    </span>
                    <a href="/tutor/profile/{{ $tutor->id }}"
                        class="bg-indigo-600 text-white px-5 py-2 rounded-xl font-bold text-sm hover:bg-indigo-700 transition shadow-lg shadow-indigo-100">
                        View Profile
                    </a>
                </div>
            </div>
        </div>
    </div>
@empty
    <div class="col-span-full text-center py-20">
        <h3 class="text-xl text-slate-400 italic">No tutors found matching your filters.</h3>
    </div>
@endforelse