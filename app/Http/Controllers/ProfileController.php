<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $user->fill($request->validated());

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        // --- TUTOR PROFILE UPDATE LOGIC ---
        if ($user->role === 'tutor') {
            $imagePath = $user->tutorProfile->profile_image;

            // Agar nayi image upload hui hai
            if ($request->hasFile('profile_image')) {
                // Purani image delete karna chaho toh Storage::delete use kar sakte ho
                $imagePath = $request->file('profile_image')->store('tutors', 'public');
            }

            $user->tutorProfile()->updateOrCreate(
                ['user_id' => $user->id],
                [
                    'title' => $request->title,
                    'expertise' => $request->expertise,
                    'bio' => $request->bio,
                    'experience' => $request->experience,
                    'hourly_rate' => $request->hourly_rate,
                    'profile_image' => $imagePath,
                ]
            );
        }

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
