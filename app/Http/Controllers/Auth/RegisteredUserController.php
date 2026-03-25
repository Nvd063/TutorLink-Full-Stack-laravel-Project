<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'string', 'in:student,tutor'],

            // Tutor fields
            'title' => ['required_if:role,tutor', 'nullable', 'string', 'max:255'],
            'expertise' => ['required_if:role,tutor', 'nullable', 'string'],
            'bio' => ['required_if:role,tutor', 'nullable', 'string'],
            'experience' => ['required_if:role,tutor', 'nullable', 'integer'],
            'hourly_rate' => ['required_if:role,tutor', 'nullable', 'integer'],
            'profile_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);

        // 1. Create user (common for student & tutor)
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        // 2. If tutor, create profile
        if ($request->role === 'tutor') {

            $imagePath = $request->hasFile('profile_image')
                ? $request->file('profile_image')->store('tutors', 'public')
                : null;

            $degreePath = $request->hasFile('degree_certificate')
                ? $request->file('degree_certificate')->store('verification/degrees', 'public')
                : null;

            $cvPath = $request->hasFile('cv_resume')
                ? $request->file('cv_resume')->store('verification/cvs', 'public')
                : null;

            $user->tutorProfile()->create([
                'title' => $request->title,
                'expertise' => $request->expertise,
                'bio' => $request->bio,
                'experience' => $request->experience,
                'hourly_rate' => $request->hourly_rate,
                'location' => $request->location,
                'degree_certificate' => $degreePath,
                'cv_resume' => $cvPath,
                'profile_image' => $imagePath,
            ]);
        }

        // 3. Event & login (works for both student & tutor)
        event(new Registered($user));
        Auth::login($user);

        return redirect(route('dashboard'));
    }
}
