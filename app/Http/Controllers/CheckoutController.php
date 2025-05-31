<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $cart = Cart::with('cartItems.product')
                  ->where('user_id', $user->user_id)
                  ->first();

        if (!$cart || $cart->cartItems->count() == 0) {
            return redirect()->route('view-cart')->with('error', 'Your cart is empty');
        }

        // Calculate totals
        $subtotal = $cart->cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        $taxRate = 0.10; // 10% tax
        $taxAmount = $subtotal * $taxRate;
        $shippingCost = 10000; // Rp 10,000 shipping
        $adminFee = 5000; // Rp 5,000 admin fee
        $total = $subtotal + $taxAmount + $shippingCost + $adminFee;

        return view('checkout', [
            'user' => $user,
            'cart' => $cart,
            'subtotal' => $subtotal,
            'taxRate' => $taxRate,
            'taxAmount' => $taxAmount,
            'shippingCost' => $shippingCost,
            'adminFee' => $adminFee,
            'total' => $total
        ]);
    }

    public function process(Request $request)
    {
        // Order processing logic will go here
        // This will handle the actual order creation
    }

    public function checkout()
{
    $cart = Cart::where('user_id', auth()->id())->with('cartItems.product')->first();
    
    if (!$cart || $cart->cartItems->count() == 0) {
        return redirect()->route('cart')->with('error', 'Your cart is empty');
    }

    $total = $cart->cartItems->sum(function($item) {
        return $item->product->price * $item->quantity;
    });

    return view('checkout', compact('cart', 'total'));
}
}
