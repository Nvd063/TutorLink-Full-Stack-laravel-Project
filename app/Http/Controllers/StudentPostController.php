<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentPost;

class StudentPostController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        StudentPost::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return back()->with('success', 'Aapki post lag gayi hai! Relevant tutors ko show ho jayegi.');
    }
}