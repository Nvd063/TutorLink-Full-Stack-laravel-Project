<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TutorProfileController;
use App\Http\Controllers\TutorController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\BookingController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// --- PUBLIC ROUTES ---
Route::get('/subjects', [SubjectController::class, 'index']);
Route::get('/tutors', [TutorController::class, 'index']);
Route::get('/tutors/search', [TutorController::class, 'search']);

// --- PROTECTED ROUTES (Login Required) ---
Route::middleware('auth:sanctum')->group(function () {
    
    // User Info
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Tutor Profile & Subjects
    Route::post('/tutor/profile', [TutorProfileController::class, 'store']);
    Route::put('/tutor/profile', [TutorProfileController::class, 'update']);
    Route::post('/tutor/subjects', [TutorController::class, 'assignSubjects']);

    // Messaging System
    Route::get('/conversations', [MessageController::class, 'conversations']);
    Route::post('/conversation/start', [MessageController::class, 'startConversation']);
    Route::get('/conversation/{id}/messages', [MessageController::class, 'messages']);
    Route::post('/conversation/send', [MessageController::class, 'sendMessage']);

    Route::post('/store/upload', [StoreController::class, 'upload']);
    Route::get('/store', [StoreController::class, 'index']); // Sab products dekhne ke liye
    Route::get('/store/{id}', [StoreController::class, 'show']);
    Route::get('/store/{id}/download', [StoreController::class, 'download']);

    Route::post('/checkout',[PaymentController::class,'checkout']);
    Route::post('/order/update',[PaymentController::class,'updateStatus']);

    Route::post('/review/add',[ReviewController::class,'store']);
    Route::get('/tutor/{id}/reviews',[ReviewController::class,'tutorReviews']);

    Route::post('/bookings', [BookingController::class, 'store']); // Student book kare
Route::get('/tutor/bookings', [BookingController::class, 'tutorBookings']); // Tutor apni list dekhe
Route::put('/bookings/{id}/status', [BookingController::class, 'updateStatus']); // Tutor accept/reject kare

});

// Admin/System Routes
Route::post('/subjects', [SubjectController::class, 'store']);



Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);


