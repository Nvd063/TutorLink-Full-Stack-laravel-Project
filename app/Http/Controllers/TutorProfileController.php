<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\TutorProfile;
use App\Models\User;
use Illuminate\Http\Request;

class TutorProfileController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'bio' => 'required',
            'experience' => 'required|integer',
            'hourly_rate' => 'required|integer'
        ]);

        TutorProfile::create([
            'user_id' => auth()->id(),
            'bio' => $request->bio,
            'experience' => $request->experience,
            'hourly_rate' => $request->hourly_rate,
            'is_online' => true
        ]);

        return response()->json(['message' => 'Profile created']);
    }


    // public function update(Request $request)
    // {

    //     $profile = TutorProfile::where('user_id', auth()->id())->first();

    //     $request->validate([
    //         'bio' => 'required',
    //         'experience' => 'required|integer',
    //         'hourly_rate' => 'required|integer'
    //     ]);

    //     $profile->update([
    //         'bio' => $request->bio,
    //         'experience' => $request->experience,
    //         'hourly_rate' => $request->hourly_rate
    //     ]);

    //     return response()->json(['message' => 'Profile updated']);
    // }


    public function show($id)
    {
        // Eager load 'products' relation
        $tutor = User::with(['tutorProfile', 'availabilitySlots', 'products'])->findOrFail($id);
        return view('tutors.show', compact('tutor'));
    }
    public function edit()
    {
        $user = auth()->user();
        $profile = $user->tutorProfile ?? new TutorProfile();

        // Yahan check karein: agar relationship nahi mil rahi toh empty collection bhejen
        $slots = $user->availabilitySlots ?? collect();
        $subjects = Subject::all();

        return view('tutors.profile-edit', compact('user', 'profile', 'slots', 'subjects'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        // Pehle purani image ka path nikal lein
        $profile = $user->tutorProfile;
        $imagePath = $profile ? $profile->profile_image : null;

        // Check karein ke kya nayi file aayi hai?
        if ($request->hasFile('profile_image')) {
            // Purani file delete karein (agar mojud ho)
            if ($imagePath && \Storage::disk('public')->exists($imagePath)) {
                \Storage::disk('public')->delete($imagePath);
            }
            // Nayi file store karein
            $imagePath = $request->file('profile_image')->store('profile_pics', 'public');
        }

        // Ab updateOrCreate chalaein
        $user->tutorProfile()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'bio' => $request->bio,
                'hourly_rate' => $request->hourly_rate,
                'experience' => $request->experience,
                // AGAR $imagePath null nahi hai tabhi update hoga, warna purana rahega
                'profile_image' => $imagePath,
            ]
        );

        // ... baki availability slots wala code ...

        return redirect()->route('dashboard')->with('success', 'Profile Updated!');
    }

    public function enrolledStudents()
    {
        $bookings = auth()->user()->tutorStudents()->with('student')->latest()->get();

        // Earnings calculate karne ke liye
        $totalEarnings = $bookings->sum('amount');
        $activeCount = $bookings->where('status', 'active')->count();

        return view('tutors.students', compact('bookings', 'totalEarnings', 'activeCount'));
    }


}