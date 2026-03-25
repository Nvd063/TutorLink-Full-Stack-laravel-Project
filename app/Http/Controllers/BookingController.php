<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;
// use App\Models\User;

class BookingController extends Controller
{
    // 1. Student booking request bheje
    public function store(Request $request)
    {
        $request->validate([
            'tutor_id' => 'required|exists:users,id',
            'subject' => 'required|string',
            'booking_time' => 'required|date|after:now',
            'message' => 'nullable|string'
        ]);

        $booking = Booking::create([
            'student_id' => auth()->id(),
            'tutor_id' => $request->tutor_id,
            'subject' => $request->subject,
            'booking_time' => $request->booking_time,
            'message' => $request->message,
            'status' => 'pending'
        ]);

        // JSON ki bajaye success message ke sath wapis bhejien
        return back()->with('success', 'Booking request sent successfully!');
    }

    // 2. Tutor apni bookings dekhe
    public function tutorBookings()
    {
        $bookings = Booking::where('tutor_id', auth()->id())->with('student')->get();
        return response()->json($bookings);
    }

    // 3. Status update kare (Accept/Reject)
    public function updateStatus(Request $request, $id)
    {
        // Debug karne ke liye yahan dd laga kar check karein ke kya modal se data aa raha hai?
        // dd($request->all()); 

        $request->validate([
            'status' => 'required|in:accepted,rejected',
            'rejection_reason' => 'required_if:status,rejected|string|nullable'
        ]);

        $booking = Booking::findOrFail($id);

        $booking->update([
            'status' => $request->status,
            'rejection_reason' => $request->status == 'rejected' ? $request->rejection_reason : null,
        ]);

        return back()->with('success', 'Status updated successfully!');
    }
    public function destroy($id)
    {
        // Sirf student apni booking delete kar sakay
        $booking = Booking::where('student_id', auth()->id())->findOrFail($id);

        if ($booking->status == 'accepted') {
            return back()->with('error', 'Accepted bookings cannot be deleted directly. Contact tutor.');
        }

        $booking->delete();
        return back()->with('success', 'Booking deleted successfully!');
    }
}