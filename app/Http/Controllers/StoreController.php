<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StoreProduct;
// use App\Models\Download;
// use Illuminate\Support\Facades\Storage;
// use Illuminate\Support\Str;

class StoreController extends Controller
{
    /**
     * Store Dashboard ya Explore Page dikhane ke liye
     */
    public function index()
    {
        // Saare products tutors ke sath load karein
        $products = StoreProduct::with('tutor')->latest()->get();
        return view('store.index', compact('products'));
    }

    /**
     * Tutor ke liye product upload karne ka logic
     */
    public function upload(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'price' => 'required|integer|min:0',
            'file' => 'required|file|mimes:pdf,zip,rar,docx|max:20480', // 20MB Max
        ]);

        try {
            // File ko 'private' folder mein store karna zyada secure hota hai
            // Lekin agar aapne storage:link chalaya hai toh 'public/products' theek hai
            $path = $request->file('file')->store('products', 'public');

            StoreProduct::create([
                'tutor_id' => auth()->id(),
                'title' => $request->title,
                'description' => $request->description,
                'price' => $request->price,
                'file_path' => $path
            ]);

            return back()->with('success', 'Product Added');
        } catch (\Exception $e) {
            return back()->with('error', 'Opps! Failed to add Product' . $e->getMessage());
        }
    }

    /**
     * Single product ki details (Modal ya Page ke liye)
     */
    public function show($id)
    {
        $product = StoreProduct::with('tutor')->findOrFail($id);

        // Agar aap modal use kar rahe hain toh shayad iski zaroorat na paray
        return view('store.show', compact('product'));
    }

    /**
     * Secure Download Logic
     */
    public function download($id)
    {
        $product = StoreProduct::findOrFail($id);
        $user = auth()->user();

        // Check if user has a 'paid' order for this product
        $hasPurchased = \App\Models\Order::where('user_id', $user->id)
            ->where('product_id', $id)
            ->where('payment_status', 'paid')
            ->exists();

        if (!$hasPurchased) {
            return back()->with('error', 'Pehle payment karein phir download hoga!');
        }

        // Baaki download logic wahi rahegi...
    }
}