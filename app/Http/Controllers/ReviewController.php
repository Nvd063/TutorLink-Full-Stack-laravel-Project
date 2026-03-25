<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\User;
use App\Http\Controllers\Controller;

class ReviewController extends Controller
{
    

    // Add new review
    public function store(Request $request)
    {
        $request->validate([
            'tutor_id'=>'required|exists:users,id',
            'rating'=>'required|integer|min:1|max:5',
            'comment'=>'nullable|string'
        ]);

        $review = Review::updateOrCreate(
            [
                'student_id'=>auth()->id(),
                'tutor_id'=>$request->tutor_id
            ],
            [
                'rating'=>$request->rating,
                'comment'=>$request->comment
            ]
        );

        return response()->json(['message'=>'Review added/updated','review'=>$review]);
    }

    // Fetch all reviews for a tutor
    public function tutorReviews($tutor_id)
{
    // Pehle sirf check karein ke user exist karta hai ya nahi
    $tutor = User::findOrFail($tutor_id);

    // Reviews fetch karein
    $reviews = Review::where('tutor_id', $tutor_id)->with('student')->get();

    return response()->json([
        'tutor_name' => $tutor->name,
        'reviews' => $reviews
    ]);
}

}