<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\CartItem;
use App\Models\Category;
use App\Models\Wishlist;
use App\Models\WishlistItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ShopController extends Controller
{
    //
    public function show_product(){
        return view('product', [
            'products'=>Product::with(['category'])->get()
        ]);
    }

    public function showBySearch(Request $request)
    {
        $searchText = $request->input('search');
        $results = Product::where('name', 'like', '%' . $searchText . '%')
                 ->orWhere('description', 'like', '%' . $searchText . '%')
                 ->get();
        return view('searchpage', [
            'products'=>$results, 'searchText' => $searchText
        ]);
    }

    public function showByCategory($id)
    {
        $category = Category::findOrFail($id);
        return view('category', [
            'products' => Product::with('category')->where('category_id', $id)->get(),
            'category' => $category
        ]);
    }

    public function showProductDetail($id)
    {
        $product = Product::with('category')->where('product_id', $id)->firstOrFail();
        return view('product-detil', [
            'product' => $product
        ]);
    }

    public function showCreateProduct(){
        return view('product.create', [
            'category' => Category::get()
        ]);
    }

    public function insert_product(Request $request){
        $product = new Product;
        if(!Gate::allows('insert-product')){
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required',
        ], [
            'name.required' => 'Nama produk wajib diisi.',
            'name.max' => 'Nama produk maksimal 255 karakter.',
            'description.required' => 'Nama produk wajib diisi.',
            'description.max' => 'Nama produk maksimal 255 karakter.',
            'price.required' => 'Harga produk wajib diisi.',
            'price.numeric' => 'Harga harus berupa angka.',
            'price.min' => 'Harga tidak boleh negatif.',
            'stock.required' => 'Stok produk wajib diisi.',
            'stock.integer' => 'Stok harus berupa angka bulat.',
            'stock.min' => 'Stok tidak boleh negatif.',
            'category_id.required' => 'Kategori produk harus dipilih.',
        ]);

        // Handle image upload
        if ($request->hasFile('image_url')) {
            $image = $request->file('image_url');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('productimages'), $imageName);
            $product->image_url = $imageName;
        }

        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->category_id = $request->category_id;

        $product->save();

        return redirect(route('product'))
        ->with('success', 'Product inserted successfully!');
    }

    public function edit_product_form($id){
        $product = Product::where('product_id', $id)->first();
        return view ('product.edit_form', [
            'product' => $product,
            'category' => Category::get()
        ]);
    }

    public function edit_product(Request $request, $id){
        // kalau bkn admin ga bs liat tombol ini
        if(!Gate::allows('edit-product')){
            abort(403);
        }

        // Validate the input
            $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required',
        ], [
            'name.required' => 'Nama produk wajib diisi.',
            'name.max' => 'Nama produk maksimal 255 karakter.',
            'description.required' => 'Nama produk wajib diisi.',
            'description.max' => 'Nama produk maksimal 255 karakter.',
            'price.required' => 'Harga produk wajib diisi.',
            'price.numeric' => 'Harga harus berupa angka.',
            'price.min' => 'Harga tidak boleh negatif.',
            'stock.required' => 'Stok produk wajib diisi.',
            'stock.integer' => 'Stok harus berupa angka bulat.',
            'stock.min' => 'Stok tidak boleh negatif.',
            'category_id.required' => 'Kategori produk harus dipilih.',
        ]);

        $product = Product::where('product_id', $id)->first();

        // Handle image upload
        if ($request->hasFile('image_url')) {
            $image = $request->file('image_url');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('productimages'), $imageName);
            $product->image_url = $imageName;
        }

        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->category_id = $request->category_id;

        //insert into db using save method
        $product->save();

        return redirect(route('product'))
        ->with('success', 'Product Berhasil diedit! :D');
    }

    public function delete_product($id){
        // kalau bkn admin ga bs liat tombol ini
        if(!Gate::allows('delete-product')){
            abort(403);
        }
        $product = Product::where('product_id', $id)->first();
        $product->delete(); //auto soft delete based on model
        return redirect(route('product'))->with('success', 'Product berhasil dihapus!');
    }

    // ADD TO CART
    public function addToCart(Request $request, Product $product)
    {
        if (!Auth::check()) {
            return redirect()->back()->with('error', 'Anda harus login untuk menambahkan ke keranjang.');
        }

        $userId = Auth::id();
        $quantity = $request->input('quantity', 1);

        $cart = Cart::firstOrCreate(
            ['user_id' => $userId]
        );

        $cartItem = $cart->cartItems()
                         ->where('product_id', $product->product_id)
                         ->active()
                         ->first();

        if ($cartItem) {
            $cartItem->quantity += $quantity;
            $cartItem->save();
            $message = 'Successfully added more quantity!';
        } else {
            CartItem::create([
                'cart_id' => $cart->cart_id,
                'product_id' => $product->product_id,
                'quantity' => $quantity,
                'status_del' => false, 
            ]);
            $message = 'Produk berhasil ditambahkan ke keranjang!';
        }

        return redirect()->back()->with('success', $message);
    }

    // REMOVE FROM CART
    public function removeFromCart(Product $product)
    {
        if (!Auth::check()) {
            return redirect()->back()->with('error', 'Anda harus login untuk menghapus dari keranjang.');
        }

        $userId = Auth::id();
        $cart = Cart::where('user_id', $userId)->first();

        if ($cart) {
            $cartItem = $cart->cartItems()
                             ->where('product_id', $product->product_id)
                             ->active()
                             ->first();

            if ($cartItem) {
                $cartItem->status_del = true;
                $cartItem->save();

                return redirect()->back()->with('success', 'Product Successfully Added To Cart!');
            }
        }
        return redirect()->back()->with('error', 'Product Not Available In Cart.');
    }

    // VIEW FOR CART
    public function cart()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login untuk melihat keranjang Anda.');
        }

        $cart = Cart::where('user_id', Auth::id())
                    ->with(['cartItems' => function ($query) {
                        $query->active()->with('product');
                    }])
                    ->first();
        
        if (!$cart) {
            $cart = (object)['cartItems' => collect()];
        }

        return view('cart', compact('cart'));
    }

    // UPDATE CART ITEM
    public function updateCartItem(Request $request, $productId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $userId = Auth::check() ? Auth::id() : null;
        $cart = Cart::where('user_id', $userId)->first();

        if ($cart) {
            $item = CartItem::where('cart_id', $cart->cart_id)
                            ->where('product_id', $productId)
                            ->first();

            if ($item) {
                $item->quantity = $request->quantity;
                $item->save();
            }
        }

        return redirect()->back()->with('success', 'Product quantity updated.');
    }

    // REMOVE CART ITEM
    public function removeItem($id)
    {
        $cartItem = CartItem::find($id);

            if ($cartItem) {
                $cartItem->status_del = true;
                $cartItem->save();
            }

            return redirect()->back()->with('success', 'Product removed from cart successfully');
    }

    // ADD TO WISHLIST
    // ADD / REMOVE TO WISHLIST (TOGGLE)
public function addToWishlist(Request $request, $product_id)
{
    if (!Auth::check()) {
        return redirect()->back()->with('error', 'Please login before adding product to wishlist!');
    }

    $product = Product::findOrFail($product_id);
    $userId = Auth::id();
    $quantity = $request->input('quantity', 1);

    // Cari atau buat wishlist user
    $wishlist = Wishlist::firstOrCreate(
        ['user_id' => $userId],
        ['status_del' => false]
    );

    // Cek apakah produk sudah ada dan belum dihapus (status_del = false)
    $existingWishlistItem = $wishlist->wishlistItems()
                                     ->where('product_id', $product->product_id)
                                     ->where('status_del', false)
                                     ->first();

    if ($existingWishlistItem) {
        // Kalau sudah ada → soft delete (hapus)
        $existingWishlistItem->status_del = true;
        $existingWishlistItem->save();

        return redirect()->back()->with('success', 'Product removed from wishlist successfully!');
    } else {
        // Kalau belum ada → tambahkan
        WishlistItem::create([
            'wishlist_id' => $wishlist->wishlist_id,
            'product_id' => $product->product_id,
            'quantity' => $quantity,
            'status_del' => false,
        ]);

        return redirect()->back()->with('success', 'Product successfully added to wishlist!');
    }
}

    // REMOVE FROM WISHLIST
    public function removeFromWishlist($product_id)
    {
        if (!Auth::check()) {
            return redirect()->back()->with('error', 'Please login before adding product to wishlist.');
        }

        $userId = Auth::id();
        $wishlist = Wishlist::where('user_id', $userId)->first();

        if ($wishlist) {
            $wishlistItem = $wishlist->wishlistItems()
                                        ->where('product_id', $product_id)
                                        ->first();
            if ($wishlistItem) {
                $wishlistItem->status_del = true;
                $wishlistItem->save();
                return redirect()->back()->with('success', 'Product removed from wishlist successfully!');
            }
        }
        return redirect()->back()->with('error', 'Product not found on wishlist.');
    }

    // VIEW FOR WISHLIST
    public function wishlist()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login untuk melihat wishlist Anda.');
        }

        $wishlist = Wishlist::where('user_id', Auth::id())
                            ->with(['wishlistItems.product'])
                            ->first();

        if (!$wishlist) {
            $wishlist = (object)['wishlistItems' => collect()];
        }

        return view('wishlist', compact('wishlist'));
    }

    public function index()
{
    $cart = Cart::where('user_id', auth()->id())
                ->with('cartItems.product')
                ->first();
    
    $total = $cart ? $cart->cartItems->sum(function($item) {
        return $item->product->price * $item->quantity;
    }) : 0;

    return view('cart', compact('cart', 'total'));
}

    public function loadMore(Request $request)
    {
        $offset = $request->input('offset', 0);
        $limit = 24;

        $products = Product::with('category')
                    ->skip($offset)
                    ->take($limit)
                    ->get();

        return response()->json([
            'products' => $products
        ]);
    }

}
