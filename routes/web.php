<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CheckoutController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

Route::get('/', [HomeController::class, 'show']);

Route::get('/home', [HomeController::class, 'show'])
    ->name('home');


Route::middleware(['auth'])->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

    Route::middleware(['role:user,admin'])->group(function () {
        Route::get('/product', [ShopController::class, 'show_product'])
            ->name('product');

        // Route::get('/home', [HomeController::class, 'show'])
        // ->name('home');

        Route::get('/category/{id}', [ShopController::class, 'showByCategory'])
            ->name('category.show');

        Route::get('/product-detil/{id}', [ShopController::class, 'showProductDetail'])
            ->name('product-detil.show');

        Route::post('/order/process', [OrderController::class, 'process'])->name('order.process');

        Route::get('/myorder', [OrderController::class, 'show'])->name('order.show');

        Route::get('/order-history', [OrderController::class, 'showHistory'])->name('order.history');

        Route::get('/order-details/{orderNumber}', [OrderController::class, 'showOrderDetails'])->name('order.details');
    });

    Route::middleware(['role:admin'])->group(function () {
        Route::get('/order', [OrderController::class, 'index'])->name('orders.show');

        Route::get('/orders/{order_id}', [OrderController::class, 'show']);

        Route::get('/order-information/{orderNumber}', [OrderController::class, 'showAdmin'])
            ->name('showOrderDetails');

        Route::get('/product/create-form', [ShopController::class, 'showCreateProduct'])
            ->name('createProduct.show');

        Route::post('/product/insert', [ShopController::class, 'insert_product'])
            ->name('insert_product');

        Route::get('/product/edit-form/{product_id}', [ShopController::class, 'edit_product_form'])
            ->name('edit_product_form');

        Route::put('/product/edit/{product_id}', [ShopController::class, 'edit_product'])
            ->name('edit_product');

        Route::delete('/product/delete/{product_id}', [ShopController::class, 'delete_product'])
            ->name('delete_product');
    });

    Route::middleware(['role:user'])->group(function () {
        Route::get('/view-cart', [ShopController::class, 'cart'])
            ->name('view_cart');

        Route::middleware('auth')->group(function () {
            Route::get('/cart', [ShopController::class, 'viewCart'])->name('cart.index');
        });

        Route::post('/add-to-cart/{product}', [ShopController::class, 'addToCart'])
            ->name('add_to_cart');

        Route::delete('/delete-cart/{product}', [ShopController::class, 'removeFromCart'])
            ->name('remove_from_cart');

        Route::post('/update-cart/{product}', [ShopController::class, 'updateCartItem'])
            ->name('update_cart_item');

        Route::delete('/cart/remove/{id}', [ShopController::class, 'removeItem'])
            ->name('cart.removeItem');

        Route::get('/view-wishlist', [ShopController::class, 'wishlist'])
            ->name('view_wishlist');

        Route::post('/add-to-wishlist/{product_id}', [ShopController::class, 'addToWishlist'])
            ->name('add_to_wishlist');

        Route::delete('/remove-from-wishlist/{product_id}', [ShopController::class, 'removeFromWishlist'])
            ->name('remove_from_wishlist');

        Route::get('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');

        Route::post('/order/place', [OrderController::class, 'placeOrder'])->name('order.place');

        // Orders

        Route::get('/order/confirmation/{order_id}', [OrderController::class, 'showConfirmation'])->name('order.confirmation');

        Route::get('/cart', [ShopController::class, 'index'])->name('cart');

        Route::get('/order-details/{orderNumber}', [OrderController::class, 'showOrderDetails'])->name('order.details');
    });
});

Route::get('/login', [AuthController::class, 'show'])
    ->name('login')->middleware('guest');

Route::post('/login_auth', [AuthController::class, 'login_auth'])
    ->name('login.auth');

Route::get('/product', [ShopController::class, 'show_product'])
    ->name('product');

Route::get('/products/load-more', [ShopController::class, 'loadMore'])->name('products.loadMore');


Route::get('/searched', [ShopController::class, 'showBySearch'])
    ->name('searched');

Route::get('/home', [HomeController::class, 'show'])
    ->name('home');

Route::get('/signup', function () {
    return view('signup');
})->name('signup');

// Route::get('/forget-password', function () {
//     return view('forgetpassword');
// })->name('forgetpassword');

// Route::post('/forget-password', function (Request $request) {
//     $request->validate([
//         'email' => 'required|email|exists:users,email',
//         'new_password' => 'required|string|min:6',
//         'confirm_password' => 'required|same:new_password',
//     ]);

//     $user = User::where('email', $request->email)->first();

//     $user->password = Hash::make($request->new_password);
//     $user->save();

//     return redirect()->route('login')->with('success', 'Password changed successfully!');
// })->name('passwordreset');

// Route::post('/forget-password', [AuthController::class, 'resetPassword'])->name('passwordreset');
Route::get('/forget-password', [AuthController::class, 'showForgetPasswordForm'])->name('forget-password');
Route::post('/forget-password', [AuthController::class, 'handleForgetPassword'])->name('forget-password.submit');

Route::post('/signup', [AuthController::class, 'register'])->name('signup.store');


// Route::post('/forget-password', function (\Illuminate\Http\Request $request) {
//     $request->validate([
//         'new_password' => 'required|min:6',
//         'confirm_password' => 'required|same:new_password',
//     ]);
//     return redirect()->route('login')->with('success', 'Password has been reset!');
// })->name('passwordreset');
// ----------------------------------------------------------------------------
// ABOUT US
Route::get('/aboutus', function () {
    return view('aboutus');
})->name('aboutus');

// CONTACT US
Route::get('/contactus', function () {
    return view('contactus');
})->name('contactus');

// FAQ
Route::get('/faq', function () {
    return view('faq');
})->name('faq');

// Terms of Service
Route::get('/termsofservice', function () {
    return view('termsofservice');
})->name('termsofservice');

// Privacy Policy
Route::get('/privacypolicy', function () {
    return view('privacypolicy');
})->name('privacypolicy');
