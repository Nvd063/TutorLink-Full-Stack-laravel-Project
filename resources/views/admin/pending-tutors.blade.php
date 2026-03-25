<x-app-layout>
    <div class="py-12 bg-slate-50 min-h-screen font-sans">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="text-3xl font-black text-slate-900 italic mb-8">Verification Requests 🛡️</h2>

            <div class="space-y-4">
                @forelse($tutors as $tutor)
                    <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm flex flex-col md:flex-row items-center gap-8"
                        x-data="{ open: false }">
                        <div class="flex-1">
                            <h3 class="text-xl font-black text-slate-800">{{ $tutor->name }}</h3>
                            <p class="text-indigo-600 font-bold italic">{{ $tutor->tutorProfile->title ?? 'Instructor' }}
                            </p>

                            <div class="flex gap-3">
                                @if($tutor->tutorProfile && $tutor->tutorProfile->degree_certificate)
                                    <a href="{{ asset('storage/' . $tutor->tutorProfile->degree_certificate) }}" target="_blank"
                                        class="...">
                                        <span class="text-xs font-bold text-indigo-600">View Degree</span>
                                    </a>
                                @endif

                                @if($tutor->tutorProfile && $tutor->tutorProfile->cv_resume)
                                    <a href="{{ asset('storage/' . $tutor->tutorProfile->cv_resume) }}" target="_blank"
                                        class="...">
                                        <span class="text-xs font-bold text-indigo-600">View CV</span>
                                    </a>
                                @endif
                            </div>

                            <p class="text-indigo-600 font-bold italic text-sm">
                                {{ $tutor->tutorProfile->title ?? 'Instructor (No Profile)' }}
                            </p>
                        </div>

                        <div class="flex gap-3">
                            <form action="{{ route('admin.tutors.approve', $tutor->id) }}" method="POST">
                                @csrf
                                <button
                                    class="bg-emerald-500 text-white px-6 py-3 rounded-xl font-black text-xs uppercase tracking-widest hover:bg-emerald-600 transition shadow-lg shadow-emerald-100">Approve</button>
                            </form>

                            <button @click="open = true"
                                class="bg-rose-100 text-rose-600 px-6 py-3 rounded-xl font-black text-xs uppercase tracking-widest hover:bg-rose-600 hover:text-white transition">Reject</button>
                        </div>

                        <div x-show="open"
                            class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/50 backdrop-blur-sm p-4">
                            <div class="bg-white p-10 rounded-[2.5rem] max-w-md w-full shadow-2xl border border-slate-100">
                                <h4 class="text-xl font-black mb-4 italic">Reason for Rejection</h4>
                                <form action="{{ route('admin.tutors.reject', $tutor->id) }}" method="POST">
                                    @csrf
                                    <textarea name="reason" required
                                        class="w-full bg-slate-50 border-none rounded-2xl p-4 h-32 focus:ring-4 focus:ring-rose-50 mb-4"
                                        placeholder="Reason likhein..."></textarea>

                                    <div class="flex gap-3">
                                        <button type="button" @click="open = false" class="...">Cancel</button>
                                        <button type="submit" class="...">Send Rejection</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-slate-400 italic py-10">No pending applications right now.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>