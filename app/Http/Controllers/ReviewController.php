<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'tutor_id' => 'required|exists:users,id',
            'rating'   => 'required|integer|min:1|max:5',
            'comment'  => 'nullable|string|max:1000',
        ]);

        // Check if student already reviewed this tutor
        $existingReview = Review::where('student_id', Auth::id())
                                ->where('tutor_id', $request->tutor_id)
                                ->first();

        if ($existingReview) {
            return back()->with('error', 'You have already reviewed this tutor.');
        }

        Review::create([
            'student_id' => Auth::id(),
            'tutor_id'   => $request->tutor_id,
            'rating'     => $request->rating,
            'comment'    => $request->comment,
        ]);

        return back()->with('success', 'Thank you! Your review has been submitted successfully.');
    }
}