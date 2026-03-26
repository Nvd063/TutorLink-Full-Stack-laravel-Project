<x-guest-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-slate-50">
        <div class="w-full sm:max-w-2xl mt-6 px-6 sm:px-10 py-12 bg-white shadow-2xl overflow-hidden sm:rounded-3xl border border-slate-100"
             x-data="{ role: 'student' }">

            <div class="mb-10 text-center">
                <h2 class="text-4xl font-black text-gray-900 tracking-tight">
                    Join <span class="text-indigo-600">TutorLink</span>
                </h2>
                <p class="text-slate-500 mt-3 text-lg">Create your account to get started with learning or teaching.</p>
            </div>

            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="space-y-8">
                @csrf

                {{-- Basic Info --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <x-input-label for="name" :value="__('Full Name')" class="font-bold" />
                        <x-text-input id="name" class="block mt-1 w-full rounded-2xl" 
                            type="text" name="name" :value="old('name')" required autofocus />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="email" :value="__('Email Address')" class="font-bold" />
                        <x-text-input id="email" class="block mt-1 w-full rounded-2xl" 
                            type="email" name="email" :value="old('email')" required />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                </div>

                {{-- Role Selection --}}
                <div>
                    <x-input-label for="role" :value="__('I want to join as:')" class="font-bold mb-3" />
                    <div class="grid grid-cols-2 gap-4">
                        <label class="cursor-pointer">
                            <input type="radio" name="role" value="student" x-model="role" checked 
                                   class="peer sr-only">
                            <div class="peer-checked:border-indigo-600 peer-checked:bg-indigo-50 border-2 border-slate-200 rounded-2xl p-4 text-center transition-all">
                                <div class="text-2xl mb-2"></div>
                                <div class="font-bold text-slate-800">Student</div>
                                <div class="text-xs text-slate-500">I want to learn</div>
                            </div>
                        </label>

                        <label class="cursor-pointer">
                            <input type="radio" name="role" value="tutor" x-model="role" 
                                   class="peer sr-only">
                            <div class="peer-checked:border-indigo-600 peer-checked:bg-indigo-50 border-2 border-slate-200 rounded-2xl p-4 text-center transition-all">
                                <div class="text-2xl mb-2"></div>
                                <div class="font-bold text-slate-800">Tutor</div>
                                <div class="text-xs text-slate-500">I want to teach</div>
                            </div>
                        </label>
                    </div>
                </div>

                {{-- Tutor Extra Fields --}}
                <div x-show="role == 'tutor'" 
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 -translate-y-4"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     class="mt-6 p-8 bg-gradient-to-br from-indigo-50 to-white border border-indigo-100 rounded-3xl space-y-7">

                    <h4 class="text-xl font-black text-indigo-800 flex items-center gap-3">
                        <span class="text-2xl">📋</span>
                        Tutor Profile Details
                    </h4>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-input-label for="title" :value="__('Professional Title')" />
                            <x-text-input name="title" class="block mt-1 w-full rounded-2xl" 
                                placeholder="e.g. Senior Full Stack Developer" />
                        </div>
                        <div>
                            <x-input-label for="location" :value="__('Location')" />
                            <x-text-input name="location" class="block mt-1 w-full rounded-2xl" 
                                placeholder="e.g. Gulberg, Lahore" />
                        </div>
                    </div>

                    <div>
                        <x-input-label for="expertise" :value="__('Expertise (Comma separated)')" />
                        <x-text-input name="expertise" class="block mt-1 w-full rounded-2xl" 
                            placeholder="Laravel, React, Python, Mathematics" />
                    </div>

                    {{-- Documents Section - Ab Bio se Upar --}}
                    <div class="space-y-6">
                        <h5 class="font-bold text-indigo-900 text-sm uppercase tracking-widest">Required Documents</h5>
                        
                        <!-- Degree Certificate -->
                        <div class="p-6 bg-white border-2 border-dashed border-indigo-200 rounded-3xl">
                            <x-input-label for="degree_certificate" :value="__('Latest Degree Certificate (PDF or Image)')" />
                            <input type="file" name="degree_certificate" accept=".pdf,.jpg,.jpeg,.png"
                                   class="mt-3 block w-full text-sm text-slate-500 
                                          file:mr-4 file:py-3 file:px-6 file:rounded-2xl 
                                          file:border-0 file:text-sm file:font-bold 
                                          file:bg-indigo-100 file:text-indigo-700 hover:file:bg-indigo-200" />
                        </div>

                        <!-- CV / Resume -->
                        <div class="p-6 bg-white border-2 border-dashed border-indigo-200 rounded-3xl">
                            <x-input-label for="cv_resume" :value="__('CV / Resume (PDF only)')" />
                            <input type="file" name="cv_resume" accept=".pdf"
                                   class="mt-3 block w-full text-sm text-slate-500 
                                          file:mr-4 file:py-3 file:px-6 file:rounded-2xl 
                                          file:border-0 file:text-sm file:font-bold 
                                          file:bg-indigo-100 file:text-indigo-700 hover:file:bg-indigo-200" />
                        </div>

                        <!-- Profile Picture -->
                        <div class="p-6 bg-white border-2 border-dashed border-indigo-200 rounded-3xl">
                            <x-input-label for="profile_image" :value="__('Profile Picture (Optional)')" />
                            <input type="file" name="profile_image" id="profile_image" accept="image/*"
                                   class="mt-3 block w-full text-sm text-slate-500 
                                          file:mr-4 file:py-3 file:px-6 file:rounded-2xl 
                                          file:border-0 file:text-sm file:font-bold 
                                          file:bg-indigo-100 file:text-indigo-700 hover:file:bg-indigo-200" />
                            <x-input-error :messages="$errors->get('profile_image')" class="mt-2" />
                        </div>
                    </div>

                    {{-- Bio (Ab Documents ke Neeche) --}}
                    <div>
                        <x-input-label for="bio" :value="__('Brief Bio')" />
                        <textarea name="bio" rows="4" class="block mt-1 w-full rounded-2xl" 
                            placeholder="Tell students about your teaching experience, style and achievements..."></textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-input-label for="experience" :value="__('Experience (in years)')" />
                            <x-text-input name="experience" type="number" class="block mt-1 w-full rounded-2xl" 
                                placeholder="5" />
                        </div>
                        <div>
                            <x-input-label for="hourly_rate" :value="__('Hourly Rate (PKR)')" />
                            <x-text-input name="hourly_rate" type="number" class="block mt-1 w-full rounded-2xl" 
                                placeholder="1500" />
                        </div>
                    </div>
                </div>

                {{-- Password Fields --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <x-input-label for="password" :value="__('Password')" class="font-bold" />
                        <x-text-input id="password" class="block mt-1 w-full rounded-2xl" 
                            type="password" name="password" required />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="font-bold" />
                        <x-text-input id="password_confirmation" class="block mt-1 w-full rounded-2xl" 
                            type="password" name="password_confirmation" required />
                    </div>
                </div>

                {{-- Submit Button --}}
                <div class="pt-6">
                    <x-primary-button class="w-full py-4 text-lg font-bold rounded-2xl shadow-xl shadow-indigo-200 bg-indigo-600 hover:bg-indigo-700 transition">
                        Create My Account
                    </x-primary-button>
                </div>
            </form>

            <div class="mt-8 text-center text-sm text-slate-500">
                Already have an account? 
                <a href="{{ route('login') }}" class="text-indigo-600 hover:text-indigo-700 font-semibold">Login here</a>
            </div>
        </div>
    </div>
</x-guest-layout>