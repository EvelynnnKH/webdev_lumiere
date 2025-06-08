<head>
    <link rel="stylesheet" href="{{ asset('css/product-detil-style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    @extends('base')
    @section('content')
    
    {{-- <div class="back-container">
        <a href="{{ url()->previous() }}" class="back-button" title="Back">
             ←
        </a>
    </div> --}}
    <div class="product-detail-container">
        <a href="{{ route('product') }}" class="back-button" title="Back">
             ←
        </a>
        <div class="product-image">
            <img src="{{ asset('productimages/'.$product->image_url) }}">
        </div>

        <div class="product-info">
            <h1 class="product-name">{{ $product->name }}</h1>
            <p class="product-price">Price: Rp. {{ number_format($product->price, 0, ',', '.') }},-</p>
            <p class="product-category">Category: {{ $product->category->name ?? 'Uncategorized' }}</p>
            <p class="product-stock">Stock: {{ $product->stock }}</p>
            <p class="product-description">Description: {{ $product->description }}</p>

            <div class="quantity-selector">
                <button class="qty-btn" onclick="decreaseQty()">-</button>
                <input type="text" id="quantity" value="1" readonly>
                <button class="qty-btn" onclick="increaseQty()">+</button>
            </div>

            <div class="action-buttons">
                @can('addToCart-product')
                    <form action="{{ route('add_to_cart', ['product' => $product->product_id]) }}" method="POST">
                    @csrf
                    <input type="hidden" name="quantity" value="1" id="quantityInput">
                    <button type="submit" class="add-to-cart-btn">Add to Cart</button>
                </form>
                @endcan
                @can('wishlist-product')
                            @if (Auth::check())
                        @php
                            $wishlist = \App\Models\Wishlist::where('user_id', auth()->id())->first();
                            $isInWishlist = $wishlist
                                ? $wishlist->wishlistItems()
                                        ->where('product_id', $product->product_id)
                                        ->where('status_del', false)
                                        ->exists()
                                : false;
                        @endphp

                        <div class="align-items-center">
                            <form action="{{ route('add_to_wishlist', ['product_id' => $product->product_id]) }}" method="POST" class="m-0">
                                @csrf
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="btn border-0 bg-transparent p-0 m-0">
                                    @if ($isInWishlist)
                                        <img src="{{ asset('img/filled.png') }}" style="width: 30px; height: 30; margin:10px;">
                                    @else
                                        <img src="{{ asset('img/blank.png') }}" style="width: 30px; height: 30; margin:10px;">
                                    @endif
                                </button>
                            </form>
                        </div>
                    @endif
                @endcan
                
                @can('edit-product')
                    <form action="{{ route('edit_product_form', ['product_id' => $product->product_id]) }}"  method="GET">
                    @csrf
                    <input type="hidden" name="quantity" id="hidden-quantity" value="1">
                    <button type="submit" class="edit-product-btn">Edit Product</button>
                    </form>
                @endcan
                @can('delete-product')
                        <form action="{{ route('delete_product', ['product_id' => $product->product_id]) }}" method="POST"
                        onsubmit="return confirm('Are you sure want to delete this product?')" style="display: inline">
                        @csrf
                        @method('delete')
                        <button type="submit" class="delete-product-btn">Delete</button>
                    </form>
                @endcan
                

                {{-- @can('checkOut-product')
                    <form action="{{ route('checkout') }}" method="POST">
                    @csrf
                    <input type="hidden" name="quantity" id="hidden-quantity" value="1">
                    <button type="submit" class="buy-now-btn">Buy Now</button>
                </form>
                @endcan --}}
            </div>
        </div>
    </div>
    @endsection

    <script>
        var productStock = {{ $product->stock }};
        // Function to increase quantity
        function increaseQty() {
            var qtyInput = document.getElementById('quantity');
            var currentQty = parseInt(qtyInput.value);
            if (!isNaN(currentQty) && currentQty < productStock) {
                qtyInput.value = currentQty + 1;
                updateHiddenQuantity();
            }
        }

        // Function to decrease quantity
        function decreaseQty() {
            var qtyInput = document.getElementById('quantity');
            var currentQty = parseInt(qtyInput.value);
            if (currentQty > 1) {
                qtyInput.value = currentQty - 1;
                updateHiddenQuantity();
            }
        }

        function updateHiddenQuantity() {
            var qtyInput = document.getElementById('quantity');
            var hiddenQtyInput = document.getElementById('quantityInput');
            hiddenQtyInput.value = qtyInput.value;
        }
    </script>
</body>
