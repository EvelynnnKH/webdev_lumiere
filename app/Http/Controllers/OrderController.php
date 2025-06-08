<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Orders;
use App\Models\CartItem;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Midtrans\Config;
use Midtrans\Snap;


class OrderController extends Controller
{
    public function showAdmin($orderNumber)
    {
       $order = Orders::with('orderItems.product') // load relasi produk juga
        ->where('order_number', $orderNumber)
        ->firstOrFail(); // kalau nggak ketemu, lempar 404

        return view('orderdetailadmin', compact('order'));
    }
        
    public function process(Request $request)
{
    // Validate the request
    $validated = $request->validate([
        'fullname' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'address' => 'required|string',
        'cart' => 'required|array'
    ]);
    
    // Calculate totals
    $subtotal = array_reduce($validated['cart'], function($carry, $item) {
        return $carry + ($item['price'] * $item['quantity']);
    }, 0);
    
    $taxRate = 0.1; // 10%
    $taxAmount = $subtotal * $taxRate;
    $shippingCost = 10000;
    $adminCost = 3000;
    $total = $subtotal + $taxAmount + $shippingCost + $adminCost;

    // Prepare order data
    $order = [
        'customer' => [
            'fullname' => $validated['fullname'],
            'email' => $validated['email'],
            'address' => $validated['address']
        ],
        'items' => $validated['cart'],
        'order_date' => now()->format('Y-m-d H:i:s'),
        'order_number' => 'ORD-' . now()->format('YmdHis'),
        'totals' => [
            'subtotal' => $subtotal,
            'taxAmount' => $taxAmount,
            'shippingCost' => $shippingCost,
            'adminCost' => $adminCost,
            'total' => $total
        ]
    ];
    
    // Store order in session
    Session::put('latest_order', $order);
    
    // Add to order history
    $orderHistory = Session::get('order_history', []);
    array_unshift($orderHistory, $order); // Add new order to beginning
    Session::put('order_history', $orderHistory);
    
    return redirect()->route('order.show');
}

public function showHistory()
{
     if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'Silakan login untuk melihat riwayat pesanan Anda.');
    }

    $orders = Orders::where('user_id', Auth::id())
                   ->with(['orderItems.product']) // ambil order item & detail produk
                   ->orderBy('created_at', 'desc')
                   ->get();

    return view('orderhistory', [
        'orders' => $orders
    ]);
}

     public function index()
    {
        $orders = Orders::with('user')->orderBy('created_at', 'desc')->get();
        return view('allorder', compact('orders'));
    }

    public function show()
    {
        // Retrieve the latest order from session
        $order = Session::get('latest_order');
        
        if (!$order) {
            // Handle case where no order exists
            return redirect()->route('home')->with('error', 'No order found');
        }
        
        // Calculate totals (or you can store these in session too)
        $subtotal = array_reduce($order['items'], function($carry, $item) {
            return $carry + ($item['price'] * $item['quantity']);
        }, 0);
        
        $taxRate = 0.1; // 10%
        $taxAmount = $subtotal * $taxRate;
        $shippingCost = 10000; // Example shipping cost
        $adminCost = 3000;
        $total = $subtotal + $taxAmount + $shippingCost + $adminCost;
        
        return view('myorder', [
            'order' => $order,
            'subtotal' => $subtotal,
            'taxAmount' => $taxAmount,
            'shippingCost' => $shippingCost,
            'adminCost' => $adminCost, 
            'total' => $total
        ]);
    }

    public function showOrderDetails($orderNumber)
{
    $order = Orders::where('order_number', $orderNumber)->with('items')->first();

    if (!$order) {
        return redirect()->route('order.history')->with('error', 'Order not found');
    }

    // Misalnya order->items adalah relasi satu ke banyak
    $subtotal = $order->items->sum(function($item) {
        return $item->price * $item->quantity;
    });

    $taxAmount = $order->tax_amount ?? $subtotal * 0.1;
    $shippingCost = $order->shipping_cost ?? 10000;
    $adminCost = $order->admin_cost ?? 3000;
    $total = $order->total ?? $subtotal + $taxAmount + $shippingCost + $adminCost;

    return view('orderdetails', compact('order', 'subtotal', 'taxAmount', 'shippingCost', 'adminCost', 'total'));
}


public function showAllOrderDetails($orderNumber)
{
    $orders = Session::get('order_history', []);
    
    // Find the specific order
    $order = collect($orders)->firstWhere('order_number', $orderNumber);
    
    if (!$order) {
        return redirect()->route('order.history')->with('error', 'Order not found');
    }
    
    // Calculate totals (if not already stored in the order)
    $subtotal = array_reduce($order['items'], function($carry, $item) {
        return $carry + ($item['price'] * $item['quantity']);
    }, 0);
    
    $taxAmount = $order['totals']['taxAmount'] ?? $subtotal * 0.1;
    $shippingCost = $order['totals']['shippingCost'] ?? 10000;
    $adminCost = $order['totals']['adminCost'] ?? 3000;
    $total = $order['totals']['total'] ?? $subtotal + $taxAmount + $shippingCost + $adminCost;
    
    return view('orderdetails', [
        'order' => $order,
        'subtotal' => $subtotal,
        'taxAmount' => $taxAmount,
        'shippingCost' => $shippingCost,
        'adminCost' => $adminCost,
        'total' => $total
    ]);
}

   public function placeOrder(Request $request)
    {
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->user_id)->with('cartItems.product')->first();

        // Validate if cart exists and has items
        if (!$cart || $cart->cartItems->isEmpty()) {
            return redirect()->route('cart')->with('error', 'Your cart is empty');
        }

        // Validate form data
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            // 'city' => 'required|string|max:255',
            // 'state' => 'required|string|max:255',
            // 'zip' => 'required|string|max:10',
        ],[
            'address.required' => 'Please fill your address.',
            'description.max' => 'Address max 255 characters.',
            'phone.required' => 'Phone number must be filler.',
            'phone.numeric' => 'Harga harus berupa angka.',
        ]);

        // Calculate totals
        $user->address = $request->address;
        $user->phone_number = $request->phone;

        $user->save();
        
        $subtotal = $cart->cartItems->sum(function($item) {
             Log::info($item->product); 
            return $item->product->price * $item->quantity;
        });

        $tax = $subtotal * 0.1; // 10% tax
        $shipping = 20000;
        $adminFee = 5000;
        $total = $subtotal + $tax + $shipping + $adminFee;

        // Create full shipping address
        $shippingAddress = implode(', ', [
            $validated['address'],
            // $validated['city'],
            // $validated['state'],
            // $validated['zip']
        ]);

        // Start transaction
        DB::beginTransaction();
        
        try {
            // Create order
            $order = Orders::create([
                'user_id' => $user->user_id,
                'order_date' => now(),
                'status' => 'pending',
                'total_price' => $total,
                'shipping_address' => $shippingAddress,
                'status_del' => false,
                'order_number' => 'ORD-' . now()->format('YmdHis'),
                'subtotal' => $subtotal,
                'taxAmount' => $tax,
                'shippingCost' => $shipping,
                'adminCost' => $adminFee
            ]);

            
            // Create order items
            foreach ($cart->cartItems as $cartItem) {
                OrderItem::create([
                    'order_id' => $order->order_id,
                    'product_id' => $cartItem->product_id,
                    'quantity' => $cartItem->quantity,
                    'price' => $cartItem->product->price,
                    'rating' => 0, // Default rating
                    'status_del' => false
                ]);
            }

            // Clear the cart
            CartItem::where('cart_id', $cart->cart_id)->delete();

            // Midtrans Config
            Config::$serverKey = config('midtrans.server_key'); // HARUS server key
            Config::$isProduction = config('midtrans.is_production');
            Config::$isSanitized = config('midtrans.is_sanitized');
            Config::$is3ds = config('midtrans.is_3ds');
 
            // Create Midtrans Transaction
            $params = [
                'transaction_details' => [
                    'order_id' => $order->order_id,
                    'gross_amount' => (int) $total,
                ],
                'customer_details' => [
                    'name' => Auth::user()->name,
                    'email' => Auth::user()->email,
                    'phone' => $request->phone,
                ],
				'callbacks' => [
                    'finish' => route('order.confirmation', ['order_id' => $order->order_id]),
                ]
            ];
            
            $snapUrl = Snap::createTransaction($params)->redirect_url;
            // Save Payment URL
            $order->payment_url = $snapUrl;
            $order->save();
            
            DB::commit();

            return redirect($snapUrl);

            return redirect()->route('order.confirmation', ['order_id' => $order->order_id])
                ->with('success', 'Order placed successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            return redirect()->back()->with('error', 'Failed to place order. Please try again.');
        }
    }

     public function updatePayment($orderNumber){
        $order = Orders::where('order_number', $orderNumber)->first();
        $newOrderId = $order->order_id . '-' . now()->timestamp;

         Config::$serverKey = config('midtrans.server_key'); // HARUS server key
            Config::$isProduction = config('midtrans.is_production');
            Config::$isSanitized = config('midtrans.is_sanitized');
            Config::$is3ds = config('midtrans.is_3ds');
 
            // Create Midtrans Transaction
            $params = [
                'transaction_details' => [
                    'order_id' => $order->order_id,
                    'gross_amount' => (int) $order->total_price,
                ],
                'customer_details' => [
                    'name' => Auth::user()->name,
                    'email' => Auth::user()->email,
                    'phone' => Auth::user()->phone,
                ],
				'callbacks' => [
                    'finish' => route('order.confirmation', ['order_id' => $order->order_id]),
                ]
            ];
            
            $snapUrl = Snap::createTransaction($params)->redirect_url;
            // Save Payment URL
            $order->payment_url = $snapUrl;
            $order->status = 'Completed';
            $order->save();
            return redirect($snapUrl);

            // return redirect()->route('order.confirmation', ['order_id' => $order->order_id])
            //     ->with('success', 'Order placed successfully!');
    }

    public function showConfirmation($order_id)
{
    $order = Orders::with('orderItems.product')->findOrFail($order_id);
    $varorder = $order->user_id;
    // Verify the order belongs to the authenticated user
    if ((int) $varorder !== (int) Auth::id()) {
        abort(403);
    }

    // Midtrans Config
    \Midtrans\Config::$serverKey = config('midtrans.server_key');
    \Midtrans\Config::$isProduction = config('midtrans.is_production');
    \Midtrans\Config::$isSanitized = true;
    \Midtrans\Config::$is3ds = true;

    try {
        // Get the payment status from Midtrans
        $midtransStatus = \Midtrans\Transaction::status($order->order_id);
        $transactionStatus = $midtransStatus->transaction_status;

        // Update status based on Midtrans response
        if (in_array($transactionStatus, ['capture', 'settlement'])) {
            $order->status = 'Completed';
        } elseif ($transactionStatus === 'pending') {
            $order->status = 'Pending';
        } elseif (in_array($transactionStatus, ['deny', 'cancel', 'expire', 'failure'])) {
            $order->status = 'Failed';
        }

        $order->save();
    } catch (\Exception $e) {
        // Optional: log error
        \Log::error('Midtrans transaction status error: ' . $e->getMessage());
        return redirect()->route('home')->with('error', 'Failed to retrieve transaction status.');
    }

    return view('confirmation', compact('order', 'transactionStatus'));
}

    }  


