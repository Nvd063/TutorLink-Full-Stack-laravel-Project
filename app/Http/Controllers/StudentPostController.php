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

    // ==================== NEW METHODS ====================

    public function myPosts()
    {
        $posts = StudentPost::where('user_id', auth()->id())
                    ->latest()
                    ->get();

        return view('student.my-posts', compact('posts'));
    }

    public function edit(StudentPost $post)
    {
        if ($post->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        return view('student.posts.edit', compact('post'));
    }

    public function update(Request $request, StudentPost $post)
    {
        if ($post->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $post->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('student.my-posts')
                         ->with('success', 'Post successfully updated!');
    }

    public function destroy(StudentPost $post)
    {
        if ($post->user_id !== auth()->id()) {
            abort(403);
        }

        $post->delete();

        return redirect()->route('student.my-posts')
                         ->with('success', 'Post deleted successfully!');
    }
}