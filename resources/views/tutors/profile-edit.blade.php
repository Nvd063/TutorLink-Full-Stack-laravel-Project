<x-app-layout>
    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('tutors.profile.update') }}" method="POST" class="space-y-8">
                @csrf

                <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100">
                    <h3 class="text-2xl font-black text-slate-900 mb-6 italic underline decoration-indigo-500">Step 1:
                        Professional Details</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-black text-slate-700 uppercase mb-2">Hourly Rate
                                ($)</label>
                            <input type="number" name="hourly_rate" value="{{ $profile->hourly_rate }}"
                                class="w-full rounded-2xl border-slate-200 p-4 focus:ring-4 focus:ring-indigo-50">
                        </div>
                        <div>
                            <label class="block text-sm font-black text-slate-700 uppercase mb-2">Years of
                                Experience</label>
                            <input type="number" name="experience" value="{{ $profile->experience }}"
                                class="w-full rounded-2xl border-slate-200 p-4 focus:ring-4 focus:ring-indigo-50">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-black text-slate-700 uppercase mb-2">Short Bio /
                                Introduction</label>
                            <textarea name="bio" rows="4"
                                class="w-full rounded-2xl border-slate-200 p-4 focus:ring-4 focus:ring-indigo-50">{{ $profile->bio }}</textarea>
                        </div>
                        <div class="mb-10 text-center" x-data="{ photoPreview: null }">
                            <div class="relative inline-block">
                                <div
                                    class="relative w-40 h-40 rounded-[2rem] border-4 border-white shadow-xl overflow-hidden bg-slate-100 group">
                                    <template x-if="!photoPreview">
                                        <img src="{{ $profile->profile_image ? asset('storage/' . $profile->profile_image) : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) . '&size=200&background=f8fafc&color=6366f1&bold=true' }}"
                                            class="w-full h-full object-cover">
                                    </template>

                                    <template x-if="photoPreview">
                                        <img :src="photoPreview" class="w-full h-full object-cover">
                                    </template>

                                    <label for="profile_image"
                                        class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition cursor-pointer">
                                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path
                                                d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"
                                                stroke-width="2" />
                                            <path d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" stroke-width="2" />
                                        </svg>
                                    </label>
                                </div>

                                <input type="file" name="profile_image" id="profile_image" class="hidden"
                                    accept="image/*" @change="
                    const file = $event.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = (e) => { photoPreview = e.target.result; };
                        reader.readAsDataURL(file);
                    }
               ">
                            </div>
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mt-3 italic">Click
                                image to change profile photo</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100">
                    <h3 class="text-2xl font-black text-slate-900 mb-6 italic underline decoration-green-500">Step 2:
                        Manage Your Timings</h3>

                    <div id="slots-container" class="space-y-4">
                        @if($slots && count($slots) > 0)
                            @foreach($slots as $slot)
                                <div class="flex items-center gap-4 bg-slate-50 p-4 rounded-2xl border border-slate-100">
                                    <select name="days[]" class="rounded-xl border-none shadow-sm">
                                        <option selected>{{ $slot->day_of_week }}</option>
                                        <option>Monday</option>
                                        <option>Tuesday</option>
                                        <option>Wednesday</option>
                                        <option>Thursday</option>
                                        <option>Friday</option>
                                        <option>Saturday</option>
                                        <option>Sunday</option>
                                    </select>
                                    <input type="time" name="start_times[]" value="{{ $slot->start_time }}"
                                        class="rounded-xl border-none shadow-sm">
                                    <span class="font-bold text-slate-400">to</span>
                                    <input type="time" name="end_times[]" value="{{ $slot->end_time }}"
                                        class="rounded-xl border-none shadow-sm">
                                    <button type="button" onclick="this.parentElement.remove()"
                                        class="text-red-500 font-bold px-2 hover:scale-125 transition">×</button>
                                </div>
                            @endforeach
                        @else
                            <p class="text-sm text-slate-400 italic">No slots added yet. Click below to add your first slot.
                            </p>
                        @endif
                    </div>

                    <button type="button" onclick="addSlot()"
                        class="mt-6 text-indigo-600 font-black uppercase tracking-widest text-xs flex items-center gap-2 hover:underline">
                        + Add Another Slot
                    </button>
                </div>

                <button type="submit"
                    class="w-full bg-slate-900 text-white py-5 rounded-[2rem] font-black text-xl hover:bg-indigo-600 shadow-2xl transition-all active:scale-95">
                    Save Professional Profile
                </button>
            </form>
        </div>
    </div>

    <script>
        function addSlot() {
            const container = document.getElementById('slots-container');
            const html = `
                <div class="flex items-center gap-4 bg-slate-50 p-4 rounded-2xl border border-slate-100 animate-slide-in">
                    <select name="days[]" class="rounded-xl border-none shadow-sm">
                        <option>Monday</option><option>Tuesday</option><option>Wednesday</option>
                        <option>Thursday</option><option>Friday</option><option>Saturday</option><option>Sunday</option>
                    </select>
                    <input type="time" name="start_times[]" class="rounded-xl border-none shadow-sm">
                    <span class="font-bold text-slate-400">to</span>
                    <input type="time" name="end_times[]" class="rounded-xl border-none shadow-sm">
                    <button type="button" onclick="this.parentElement.remove()" class="text-red-500 font-bold px-2">×</button>
                </div>`;
            container.insertAdjacentHTML('beforeend', html);
        }
    </script>
</x-app-layout>