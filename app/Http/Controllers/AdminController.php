<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Sirf wo count karein jo na verified hain na rejected
        $pendingTutorsCount = User::where('role', 'tutor')
            ->where('is_verified', false)
            ->whereNull('rejection_reason')
            ->count();

        $totalStudents = User::where('role', 'student')->count();
        $verifiedTutors = User::where('role', 'tutor')->where('is_verified', true)->count();
        // AdminController.php dashboard method mein
        $totalRevenue = Order::where('payment_status', 'completed')->sum('amount');
        $totalCommission = $totalRevenue * 0.10; // Agar 10% admin ka hai

        $total = User::count();

        return view('admin.dashboard', compact('pendingTutorsCount', 'totalStudents', 'verifiedTutors', 'total','totalRevenue','totalCommission'));
    }

    // AdminController.php mein
    public function pendingTutors()
    {
        $tutors = User::where('role', 'tutor')
            ->where('is_verified', false)
            ->whereNull('rejection_reason') // Sirf wo dikhao jo abhi tak reject nahi huye
            ->has('tutorProfile')
            ->with('tutorProfile')
            ->get();

        return view('admin.pending-tutors', compact('tutors'));
    }

    public function approve(User $user)
    {
        // Debugging: Pehle check karein request yahan tak aa rahi hai ya nahi
        // dd($user); 

        $user->is_verified = true;
        $user->rejection_reason = null;
        $user->save(); // update() ki jagah save() try karein

        return redirect()->back()->with('success', 'Tutor Approved Successfully');
    }

    public function reject(Request $request, User $user)
    {
        // 1. Validation check karein (agar text chota hua toh page reload ho jayega bina bataye)
        $request->validate([
            'reason' => 'required|string|min:3'
        ]);

        // 2. Database update
        $user->is_verified = false;
        $user->rejection_reason = $request->reason;
        $user->save();

        return redirect()->back()->with('error', 'Tutor application has been rejected.');
    }
    public function manageUsers()
    {
        $tutors = User::where('role', 'tutor')->with('tutorProfile')->get();
        $students = User::where('role', 'student')->get();

        return view('admin.manage-users', compact('tutors', 'students'));
    }

    public function deleteUser(User $user)
    {
        $user->delete();
        return back()->with('success', 'User deleted successfully.');
    }

    public function monitorPayments()
    {
        // Eager loading use karein taake performance achi ho (with student and tutor)
        $payments = Order::with(['student', 'tutor'])
            ->latest()
            ->paginate(10); // Pagination zaroori hai agar data zyada ho

        return view('admin.payments.index', compact('payments'));
    }
}