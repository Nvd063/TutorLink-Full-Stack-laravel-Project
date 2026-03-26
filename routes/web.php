<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\StudentPostController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TutorController;
use App\Http\Controllers\TutorProfileController;
use App\Models\Booking; // Ye lazmi add karein top par
use App\Models\Message;
use App\Models\StudentPost;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


// --- PUBLIC ROUTES (No Login Required) ---
Route::get('/subjects', [SubjectController::class, 'index']);
Route::get('/tutors', [TutorController::class, 'index']);
Route::get('/tutors/search', [TutorController::class, 'search']);

// --- PROTECTED ROUTES (Login Required via Browser Session) ---
Route::middleware(['auth', 'prevent-back'])->group(function () {
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [App\Http\Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');

    // Tutor Profile & Subjects
    Route::post('/tutor/profile', [TutorProfileController::class, 'store']);
    Route::put('/tutor/profile', [TutorProfileController::class, 'update']);
    Route::get('/tutor/profile/{id}', [TutorProfileController::class, 'show']);
    Route::post('/tutor/subjects', [TutorController::class, 'assignSubjects']);

    Route::get('/tutors/profile-edit', [TutorProfileController::class, 'edit'])->name('tutors.profile.edit');

    // Update wala route bhi aise hi hona chahiye
    Route::post('/tutors/profile-update', [TutorProfileController::class, 'update'])->name('tutors.profile.update');

    Route::get('/tutors/students', [TutorProfileController::class, 'enrolledStudents'])->name('tutors.students');


    // Messaging System
    Route::get('/conversations', [MessageController::class, 'conversations']);
    Route::post('/conversation/start', [MessageController::class, 'startConversation']);
    Route::get('/conversation/{id}/messages', [MessageController::class, 'messages']);
    Route::post('/conversation/send', [MessageController::class, 'sendMessage']);

    // Store Module
    Route::post('/store/upload', [StoreController::class, 'upload'])->name('store.upload');
    Route::get('/store', [StoreController::class, 'index'])->name('store.index');

    // YE WALI LINE MISSING HAI - Isay add karein
    Route::get('/store/{id}', [StoreController::class, 'show'])->name('store.show');

    Route::get('/store/download/{id}', [StoreController::class, 'download'])->name('store.download');


    // Payments
    Route::post('/checkout', [PaymentController::class, 'checkout']);
    Route::post('/order/update', [PaymentController::class, 'updateStatus']);

    // Bookings
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
    Route::get('/tutor/bookings', [BookingController::class, 'tutorBookings']);
    Route::patch('/bookings/{id}', [BookingController::class, 'updateStatus'])->name('bookings.update');
    Route::delete('/bookings/{id}', [BookingController::class, 'destroy'])->name('bookings.destroy');
    Route::post('/tutors/{tutor}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::post('/student/posts', [StudentPostController::class, 'store'])->name('student.posts.store');
    Route::get('/tutor/jobs', [TutorController::class, 'allMatchingJobs'])->name('tutors.jobs');
    Route::post('/tutor/jobs/ignore/{id}', [App\Http\Controllers\TutorController::class, 'ignoreJob'])->name('tutors.jobs.ignore');


    Route::get('/dashboard', function () {
        $user = Auth::user();
        $data = [];
        $totalEarnings = 0;
        $activeCount = 0;
        $recentStudents = collect();
        $tutorBookings = collect();
        $studentBookings = collect();
        $matchingPosts = collect();
        $matchingPostsCount = 0; // Default zero

        if ($user->role == 'tutor') {
            // 1. Bookings & Earnings Logic
            $bookings = $user->tutorStudents()->with('student')->latest()->get();
            $totalEarnings = $bookings->sum('amount');
            $activeCount = $bookings->where('status', 'active')->count();

            $tutorBookings = Booking::where('tutor_id', $user->id)
                ->with('student')
                ->latest()
                ->get();

            // 2. Recent Inquiries (Messages)
            $recentStudents = Message::where('receiver_id', $user->id)
                ->with('sender')
                ->latest()
                ->take(5)
                ->get();

            // 3. Profile & Matching Posts Logic
            $profile = $user->tutorProfile;
            $status = 0;

            if ($profile) {
                // Profile Status Calculation
                if ($profile->bio)
                    $status += 40;
                if ($profile->hourly_rate)
                    $status += 30;
                if ($user->availabilitySlots()->count() > 0)
                    $status += 30;

                // Keywords Extraction
                $keywords = collect(explode(',', $profile->expertise . ',' . $profile->title))
                    ->map(fn($item) => trim(strtolower($item)))
                    ->filter()
                    ->unique();

                if ($keywords->isNotEmpty()) {
                    // Pehle Ignored Posts ki IDs nikalon taake counter sahi ho jaye
                    $ignoredPostIds = DB::table('ignored_posts')
                        ->where('user_id', $user->id)
                        ->pluck('student_post_id');

                    // Naya Counter Logic (Jo ignore nahi hui unka count)
                    $matchingPostsCount = StudentPost::whereNotIn('id', $ignoredPostIds)
                        ->where(function ($query) use ($keywords) {
                            foreach ($keywords as $keyword) {
                                $query->orWhere('description', 'LIKE', "%{$keyword}%")
                                    ->orWhere('title', 'LIKE', "%{$keyword}%");
                            }
                        })->count();

                    // Dashboard ke loop ke liye posts (Agar tum loop abhi bhi dashboard pe rakhte ho)
                    $matchingPosts = StudentPost::with('user')
                        ->whereNotIn('id', $ignoredPostIds)
                        ->where(function ($query) use ($keywords) {
                            foreach ($keywords as $keyword) {
                                $query->orWhere('description', 'LIKE', "%{$keyword}%")
                                    ->orWhere('title', 'LIKE', "%{$keyword}%");
                            }
                        })
                        ->latest()
                        ->get();
                }
            }
            $data['profile_status'] = $status;

        } else {
            // 4. Student Role Logic
            $studentBookings = Booking::where('student_id', $user->id)
                ->with('tutor')
                ->latest()
                ->get();
        }

        return view('dashboard', compact(
            'totalEarnings',
            'activeCount',
            'recentStudents',
            'data',
            'tutorBookings',
            'studentBookings',
            'matchingPosts',
            'matchingPostsCount'
        ));
    })->middleware(['auth', 'verified', 'prevent-back'])->name('dashboard');

    Route::post('/subjects', [SubjectController::class, 'store']);
});

// Admin Route

require __DIR__ . '/auth.php';

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');


Route::get('/safepay/payment', [PaymentController::class, 'payWithSafepay'])->name('safepay.pay');
Route::get('/safepay/callback', [PaymentController::class, 'safepayCallback'])->name('safepay.callback');




Route::middleware(['auth', 'can:admin-access'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/tutors/pending', [AdminController::class, 'pendingTutors'])->name('tutors.pending');
    Route::post('/tutors/{user}/approve', [AdminController::class, 'approve'])->name('tutors.approve');
    Route::post('/tutors/{user}/reject', [AdminController::class, 'reject'])->name('tutors.reject');
    Route::get('/users', [AdminController::class, 'manageUsers'])->name('users.index');
    Route::delete('/users/{user}', [AdminController::class, 'deleteUser'])->name('users.delete');
});

Route::get('/payments', [AdminController::class, 'monitorPayments'])->name('admin.payments.index');