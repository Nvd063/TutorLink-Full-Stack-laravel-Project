<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\StudentPost; // Yeh lazmi add karein

class TutorController extends Controller
{
    // 1. Yeh wala method missing hai, isay wapis add karein
    public function index(Request $request)
    {
        $query = User::where('role', 'tutor')
            ->where('is_verified', true)
            ->whereNull('rejection_reason');

        if ($request->filled('subject')) {
            $subject = $request->subject;
            $query->whereHas('tutorProfile', function ($q) use ($subject) {
                $q->where('expertise', 'LIKE', "%{$subject}%")
                    ->orWhere('bio', 'LIKE', "%{$subject}%")
                    ->orWhere('title', 'LIKE', "%{$subject}%");
            });
        }

        if ($request->filled('max_price')) {
            $query->whereHas('tutorProfile', function ($q) use ($request) {
                $q->where('hourly_rate', '<=', $request->max_price);
            });
        }

        $tutors = $query->with('tutorProfile')->latest()->get();

        if ($request->ajax() || $request->wantsJson()) {
            return view('tutors.partials.tutor_cards', compact('tutors'))->render();
        }

        return view('tutors.index', compact('tutors'));
    }

    // 2. Naya Dashboard Method (Jo humne Matching Posts ke liye banaya tha)
    public function dashboard()
    {
        $tutor = auth()->user();

        if ($tutor->role !== 'tutor') {
            return redirect('/dashboard');
        }

        $profile = $tutor->tutorProfile;

        // Expertise se keywords nikalna
        $keywords = collect(explode(',', $profile->expertise . ',' . $profile->title))
            ->map(fn($item) => trim(strtolower($item)))
            ->filter()
            ->unique();

        // Matching Posts fetch karna
        $matchingPosts = StudentPost::with('user')
            ->where(function ($query) use ($keywords) {
                foreach ($keywords as $keyword) {
                    $query->orWhere('description', 'LIKE', "%{$keyword}%")
                        ->orWhere('title', 'LIKE', "%{$keyword}%");
                }
            })
            ->latest()
            ->get();

        // Aapka purana logic bookings ke liye (variables check kar lein)
        $tutorBookings = $tutor->tutorBookings()->latest()->get();
        $totalEarnings = 0; // Inhein aap apne logic ke mutabik set kar lein
        $activeCount = 0;

        return view('dashboard', compact('matchingPosts', 'profile', 'tutorBookings', 'totalEarnings', 'activeCount'));
    }


    public function allMatchingJobs()
    {
        $user = auth()->user();
        $profile = $user->tutorProfile;

        $keywords = collect(explode(',', $profile->expertise . ',' . $profile->title))
            ->map(fn($item) => trim(strtolower($item)))->filter()->unique();

        // Pehle ignored posts ki IDs lein
        $ignoredPostIds = \DB::table('ignored_posts')->where('user_id', $user->id)->pluck('student_post_id');

        $matchingPosts = StudentPost::with('user')
            ->whereNotIn('id', $ignoredPostIds) // Ignore ki hui posts nikal dein
            ->where(function ($query) use ($keywords) {
                foreach ($keywords as $keyword) {
                    $query->orWhere('description', 'LIKE', "%{$keyword}%")
                        ->orWhere('title', 'LIKE', "%{$keyword}%");
                }
            })->latest()->get();

        return view('tutors.jobs', compact('matchingPosts'));
    }

    // Post ignore karne ka method
    public function ignoreJob($id)
    {
        \DB::table('ignored_posts')->insert([
            'user_id' => auth()->id(),
            'student_post_id' => $id,
            'created_at' => now()
        ]);
        return back()->with('success', 'Post removed from your list.');
    }

    public function search(Request $request)
    {
        // Dono parameters ko check karein
        $searchTerm = $request->input('search') ?? $request->input('query') ?? $request->input('subject');

        // Base Query - Sirf Verified Tutors jo reject nahi hue
        $query = User::where('role', 'tutor')
            ->where('is_verified', true)
            ->whereNull('rejection_reason');

        if (!empty($searchTerm)) {
            $query->where(function ($q) use ($searchTerm) {
                // 1. Name mein search
                $q->where('name', 'LIKE', "%{$searchTerm}%")

                    // 2. Profile ke andar multiple columns mein search
                    ->orWhereHas('tutorProfile', function ($p) use ($searchTerm) {
                        $p->where('bio', 'LIKE', "%{$searchTerm}%")
                            ->orWhere('expertise', 'LIKE', "%{$searchTerm}%") // 🔥 Expertise Search yahan hai
                            ->orWhere('title', 'LIKE', "%{$searchTerm}%");    // Title bhi check kar lo safer side pe
                    });
            });
        }

        // 3. Price Filter (Kyuki URL mein max_price=50 hai)
        if ($request->filled('max_price')) {
            $query->whereHas('tutorProfile', function ($p) use ($request) {
                $p->where('hourly_rate', '<=', $request->max_price);
            });
        }

        $tutors = $query->with('tutorProfile')->latest()->get();

        // Agar AJAX request hai (Jo aapke purane code mein tha)
        if ($request->ajax()) {
            return view('tutors.partials.tutor_cards', compact('tutors'))->render();
        }

        return view('tutors.index', compact('tutors'));
    }

    // Debugging ke liye (check karne ke liye ke data aa raha hai ya nahi)
    public function assignSubjects(Request $request)
    {

        $request->validate([
            'subjects' => 'required|array'
        ]);

        $user = auth()->user();

        $user->subjects()->sync($request->subjects);

        return response()->json(['message' => 'Subjects assigned']);

    }

}