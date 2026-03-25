<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TutorController;
use App\Http\Controllers\TutorProfileController;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\Booking; // Ye lazmi add karein top par
use App\Http\Controllers\AdminController;

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



    Route::get('/dashboard', function () {
        $user = Auth::user();
        $data = [];
        $totalEarnings = 0;
        $activeCount = 0;
        $recentStudents = collect();

        // --- Naye Variables (Jo humne Blade mein use kiye hain) ---
        $tutorBookings = collect();
        $studentBookings = collect();

        if ($user->role == 'tutor') {
            // 1. Aapka purana Bookings aur Earnings logic
            $bookings = $user->tutorStudents()->with('student')->latest()->get();
            $totalEarnings = $bookings->sum('amount');
            $activeCount = $bookings->where('status', 'active')->count();

            // Naya variable fill kar rahe hain jo Tutor loop ke liye chahiye
            $tutorBookings = Booking::where('tutor_id', $user->id)
                ->with('student')
                ->latest()
                ->get();

            // 2. Recent Inquiries (Messages) - Purana Logic
            $recentStudents = Message::where('receiver_id', $user->id)
                ->with('sender')
                ->latest()
                ->take(5)
                ->get();

            // 3. Profile Status Calculation - Purana Logic
            $profile = $user->tutorProfile;
            $status = 0;
            if ($profile) {
                if ($profile->bio)
                    $status += 40;
                if ($profile->hourly_rate)
                    $status += 30;
                if ($user->availabilitySlots()->count() > 0)
                    $status += 30;
            }
            $data['profile_status'] = $status;

        } else {
            // Agar role student hai, toh uski bookings nikal lo
            $studentBookings = Booking::where('student_id', $user->id)
                ->with('tutor')
                ->latest()
                ->get();
        }

        // Saare purane aur naye variables compact mein bhej diye hain
        return view('dashboard', compact(
            'totalEarnings',
            'activeCount',
            'recentStudents',
            'data',
            'tutorBookings',
            'studentBookings'
        ));
    })->middleware(['auth', 'verified'])->name('dashboard');

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