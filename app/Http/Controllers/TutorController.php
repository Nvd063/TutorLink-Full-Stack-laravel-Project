<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class TutorController extends Controller
{

    public function index(Request $request)
    {
        // 1. Base Query: Only verified and not rejected tutors
        $query = User::where('role', 'tutor')
            ->where('is_verified', true)
            ->whereNull('rejection_reason');

        // 2. Search by Subject (Matches Expertise OR Bio)
        if ($request->filled('subject')) {
            $subject = $request->subject;

            $query->whereHas('tutorProfile', function ($q) use ($subject) {
                $q->where(function ($inner) use ($subject) {
                    $inner->where('expertise', 'LIKE', "%{$subject}%")
                        ->orWhere('bio', 'LIKE', "%{$subject}%")
                        ->orWhere('title', 'LIKE', "%{$subject}%");
                });
            });
        }

        // 3. Filter by Price
        if ($request->filled('max_price')) {
            $query->whereHas('tutorProfile', function ($q) use ($request) {
                $q->where('hourly_rate', '<=', $request->max_price);
            });
        }

        // Final execution
        $tutors = $query->with('tutorProfile')->latest()->get();

        // AJAX request ke liye partial return karein (aapka existing setup)
        if ($request->ajax()) {
            return view('tutors.partials.tutor_cards', compact('tutors'))->render();
        }

        return view('tutors.index', compact('tutors'));
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