<x-guest-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-slate-50">
        <div class="w-full sm:max-w-xl mt-6 px-10 py-12 bg-white shadow-2xl overflow-hidden sm:rounded-3xl border border-slate-100"
            x-data="{ role: 'student' }">

            <div class="mb-8 text-center">
                <h2 class="text-4xl font-black text-gray-900">Join <span class="text-indigo-600">TutorLink</span></h2>
                <p class="text-gray-500 mt-2">Create your account to get started.</p>
            </div>

            <form method="POST" action="{{ route('register') }} " enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <x-input-label for="name" :value="__('Full Name')" class="font-bold" />
                        <x-text-input id="name" class="block mt-1 w-full border-slate-200 rounded-xl p-3" type="text"
                            name="name" :value="old('name')" required autofocus />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="email" :value="__('Email')" class="font-bold" />
                        <x-text-input id="email" class="block mt-1 w-full border-slate-200 rounded-xl p-3" type="email"
                            name="email" :value="old('email')" required />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                </div>

                <div class="mt-6">
                    <x-input-label for="role" :value="__('I am a:')" class="font-bold mb-2" />
                    <select name="role" x-model="role"
                        class="w-full border-slate-200 rounded-xl p-3 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm font-bold text-slate-700">
                        <option value="student">Student (Want to Learn)</option>
                        <option value="tutor">Tutor (Want to Teach)</option>
                    </select>
                </div>

                <div x-show="role == 'tutor'" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform -translate-y-4"
                    x-transition:enter-end="opacity-100 transform translate-y-0"
                    class="mt-6 p-6 bg-indigo-50 rounded-2xl border border-indigo-100 space-y-4">

                    <h4 class="text-indigo-700 font-bold mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        Tutor Profile Details
                    </h4>

                    <div>
                        <x-input-label for="title" :value="__('Professional Title')"
                            class="font-semibold text-indigo-900" />
                        <x-text-input name="title" class="block mt-1 w-full border-slate-200 rounded-xl p-3" type="text"
                            placeholder="e.g. Full Stack Developer" />
                    </div>

                    <div>
                        <x-input-label for="expertise" :value="__('Expertise (Comma separated)')"
                            class="font-semibold text-indigo-900" />
                        <x-text-input name="expertise" class="block mt-1 w-full border-slate-200 rounded-xl p-3"
                            type="text" placeholder="e.g. Laravel, React, Python" />
                    </div>

                    <div>
                        <x-input-label for="bio" :value="__('Brief Bio')" class="font-semibold text-indigo-900" />
                        <textarea id="bio" name="bio" rows="3"
                            class="w-full border-slate-200 rounded-xl p-3 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm"
                            placeholder="Tell students about your teaching style..."></textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="experience" :value="__('Experience (Years)')"
                                class="font-semibold text-indigo-900" />
                            <x-text-input id="experience" type="number" name="experience"
                                class="block mt-1 w-full border-slate-200 rounded-xl p-3" placeholder="e.g. 5" />
                        </div>
                        <div>
                            <x-input-label for="hourly_rate" :value="__('Hourly Rate ($)')"
                                class="font-semibold text-indigo-900" />
                            <x-text-input id="hourly_rate" type="number" name="hourly_rate"
                                class="block mt-1 w-full border-slate-200 rounded-xl p-3" placeholder="e.g. 20" />
                        </div>
                    </div>
                </div>
                <div x-show="role == 'tutor'" class="mt-4">
                    <x-input-label for="profile_image" :value="__('Profile Picture (Optional)')"
                        class="font-semibold text-indigo-900" />
                    <div
                        class="mt-2 flex items-center gap-4 p-4 bg-white rounded-2xl border border-dashed border-indigo-200">
                        <input type="file" name="profile_image" id="profile_image" accept="image/*"
                            class="text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-black file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 cursor-pointer" />
                    </div>
                    <x-input-error :messages="$errors->get('profile_image')" class="mt-2" />
                </div>

                <div x-show="role == 'tutor'" class="mt-4">

                    <div class="mt-4">
                        <x-input-label for="location" :value="__('Location (City, Area)')"
                            class="font-semibold text-indigo-900" />
                        <x-text-input name="location" type="text"
                            class="block mt-1 w-full border-slate-200 rounded-xl p-3"
                            placeholder="e.g. Gulberg, Lahore" />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                        <div>
                            <x-input-label for="degree_certificate" :value="__('Latest Degree (PDF/Image)')"
                                class="font-semibold text-indigo-900" />
                            <input type="file" name="degree_certificate"
                                class="mt-1 block w-full text-xs text-slate-500" accept=".pdf,.jpg,.jpeg,.png" />
                        </div>
                        <div>
                            <x-input-label for="cv_resume" :value="__('Upload CV/Resume (PDF)')"
                                class="font-semibold text-indigo-900" />
                            <input type="file" name="cv_resume" class="mt-1 block w-full text-xs text-slate-500"
                                accept=".pdf" />
                        </div>
                    </div>

                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                    <div>
                        <x-input-label for="password" :value="__('Password')" class="font-bold" />
                        <x-text-input id="password" class="block mt-1 w-full border-slate-200 rounded-xl p-3"
                            type="password" name="password" required />
                    </div>
                    <div>
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="font-bold" />
                        <x-text-input id="password_confirmation"
                            class="block mt-1 w-full border-slate-200 rounded-xl p-3" type="password"
                            name="password_confirmation" required />
                    </div>
                </div>

                <div class="mt-8">
                    <x-primary-button
                        class="w-full justify-center py-4 bg-indigo-600 hover:bg-indigo-700 text-lg rounded-xl shadow-xl shadow-indigo-100 transition duration-300">
                        {{ __('Create Account') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>