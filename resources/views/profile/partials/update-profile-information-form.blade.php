<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)"
                required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification"
                            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        @if(auth()->user()->role === 'tutor')
            <div class="mt-6 p-6 bg-slate-50 rounded-3xl border border-slate-100 space-y-4">
                <h3 class="text-sm font-black uppercase tracking-widest text-indigo-600 mb-4 italic">Tutor Professional
                    Details</h3>

                <!-- Profile Image Preview & Input -->
                <div>
                    <x-input-label for="profile_image" :value="__('Change Profile Picture')" />
                    @if($user->tutorProfile?->profile_image)
                        <img src="{{ asset('storage/' . $user->tutorProfile->profile_image) }}"
                            class="w-20 h-20 rounded-2xl mb-2 object-cover border-2 border-indigo-500">
                    @endif
                    <input type="file" name="profile_image"
                        class="block mt-1 w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-black file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" />
                </div>

                <div>
                    <x-input-label for="title" :value="__('Professional Title')" />
                    <x-text-input name="title" type="text" class="mt-1 block w-full" :value="old('title', $user->tutorProfile?->title)" required />
                </div>

                <div>
                    <x-input-label for="expertise" :value="__('Expertise (Comma separated)')" />
                    <x-text-input name="expertise" type="text" class="mt-1 block w-full" :value="old('expertise', $user->tutorProfile?->expertise)" required />
                </div>

                <div>
                    <x-input-label for="bio" :value="__('Biography')" />
                    <textarea name="bio" rows="4"
                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm mt-1 block w-full">{{ old('bio', $user->tutorProfile?->bio) }}</textarea>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <x-input-label for="experience" :value="__('Experience (Years)')" />
                        <x-text-input name="experience" type="number" class="mt-1 block w-full" :value="old('experience', $user->tutorProfile?->experience)" required />
                    </div>
                    <div>
                        <x-input-label for="hourly_rate" :value="__('Hourly Rate ($)')" />
                        <x-text-input name="hourly_rate" type="number" class="mt-1 block w-full" :value="old('hourly_rate', $user->tutorProfile?->hourly_rate)" required />
                    </div>
                </div>
            </div>

            <!-- Degree & CV -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <div>
                    <x-input-label for="degree_certificate" :value="__('Latest Degree (PDF/Image)')" />
                    <input type="file" name="degree_certificate" class="mt-1 block w-full text-xs text-slate-500"
                        accept=".pdf,.jpg,.jpeg,.png" />
                    @if($user->tutorProfile?->degree_certificate)
                        <p class="text-xs text-gray-500 mt-1">Current File: <a
                                href="{{ asset('storage/' . $user->tutorProfile->degree_certificate) }}" target="_blank"
                                class="text-indigo-600 underline">View</a></p>
                    @endif
                    <x-input-error :messages="$errors->get('degree_certificate')" class="mt-1" />
                </div>
                <div>
                    <x-input-label for="cv_resume" :value="__('Upload CV/Resume (PDF)')" />
                    <input type="file" name="cv_resume" class="mt-1 block w-full text-xs text-slate-500" accept=".pdf" />
                    @if($user->tutorProfile?->cv_resume)
                        <p class="text-xs text-gray-500 mt-1">Current File: <a
                                href="{{ asset('storage/' . $user->tutorProfile->cv_resume) }}" target="_blank"
                                class="text-indigo-600 underline">View</a></p>
                    @endif
                    <x-input-error :messages="$errors->get('cv_resume')" class="mt-1" />
                </div>
            </div>

        @endif

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>

<script>
    const profileInput = document.getElementById('profile_image');
    const profilePreview = document.getElementById('profilePreview');

    profileInput.addEventListener('change', function (e) {
        const file = e.target.files[0];
        if (file) {
            profilePreview.src = URL.createObjectURL(file);
            profilePreview.classList.remove('hidden');
        }
    });
</script>