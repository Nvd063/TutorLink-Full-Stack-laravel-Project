<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\StoreProduct;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{
    /**
     * 1. Safepay Checkout: Order create karna aur Redirect karna
     */
    public function payWithSafepay(Request $request)
{
    $request->validate(['product_id' => 'required|exists:store_products,id']);
    $product = StoreProduct::findOrFail($request->product_id);

    $order = Order::create([
        'user_id' => auth()->id(),
        'product_id' => $product->id,
        'amount' => $product->price,
        'payment_status' => 'pending'
    ]);

    // Sandbox vs Production URL Logic
    $host = env('SAFEPAY_SANDBOX', true) 
            ? 'https://sandbox.api.getsafepay.com/checkout/render' 
            : 'https://api.getsafepay.com/checkout/render';

    // In parameters ko isi order mein rehne dein
    $query = http_build_query([
        'env'            => env('SAFEPAY_SANDBOX', true) ? 'sandbox' : 'production',
        'beacon'         => env('SAFEPAY_PUBLIC_KEY'),
        'amount'         => $order->amount,
        'currency'       => 'PKR',
        'transaction_id' => $order->id,
        'redirect_url'   => route('safepay.callback'),
        'source'         => 'custom',
    ]);

    return redirect()->away($host . '?' . $query);
}

    /**
     * 2. Safepay Callback: Payment ke baad wapas aana aur DB update karna
     */
    public function safepayCallback(Request $request)
    {
        $status = $request->query('status');
        $order_id = $request->query('transaction_id'); // Ye wahi order ID hai jo humne bheji thi
        $tracker = $request->query('tracker'); // Safepay ka unique reference ID

        // Agar payment successful hai
        if ($status === 'completed' || $status === 'success') {
            
            if ($order_id) {
                $order = Order::find($order_id);
                if ($order) {
                    $order->update([
                        'payment_status' => 'paid',
                        'transaction_id' => $tracker // Safepay tracker ID save kar rahe hain
                    ]);
                }
            }

            return view('payments.status', [
                'status' => 'Success',
                'message' => 'Mubarak ho! Aapki payment kamyab rahi aur order update ho gaya hai.',
            ]);
        }

        // Agar payment fail ya cancel ho jaye
        return view('payments.status', [
            'status' => 'Failed',
            'message' => 'Payment cancel ya fail ho gayi hai. Dubara koshish karein.',
        ]);
    }
}