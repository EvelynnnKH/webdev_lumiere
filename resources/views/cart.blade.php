@extends('base')

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show position-fixed top-0 end-0 m-3 shadow-lg z-3" role="alert" style="min-width: 300px;">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@section('content')
<style>
    main {
        background-color: #f8f4ee;
    }
    .center-container {
    text-align: center;
    }

    .remove-btn {
        background-color: #c82b2b;
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 5px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .remove-btn:hover {
        background-color: #970505;
        transform: translateY(-2px);
        color:white;
    }

    .checkout-btn {
        background-color: #7c5126;
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 5px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .checkout-btn:hover {
        background-color: #5c3c1d;
        transform: translateY(-2px);
        color:white;
    }
</style>

<div class="container py-5" style="font-family: 'Playfair Display'; color: #5c3c1d;">
    <h2 class="mb-4 text-center pb-3" style="font-weight: 300; color: #5c3c1d;">CART</h2>

    @if ($cart && $cart->cartItems->count() > 0)
        <div class="d-none d-md-flex border-bottom pb-3" style=" color: #5c3c1d; font-weight: bold; font-size: 15px; font-family: 'Montserrat', sans-serif;">
            <div class="col-md-5">PRODUCT</div>
            <div class="col-md-2 text-center">QUANTITY</div>
            <div class="col-md-2 text-end">PRICE</div>
            <div class="col-md-2 text-end">TOTAL</div>
        </div>

        @php $total = 0; @endphp

        @foreach ($cart->cartItems as $item)
            @php 
                $price = $item->product->price;
                $qty = $item->quantity;
                $subtotal = $price * $qty;
                $total += $subtotal;
            @endphp
            <div class="row align-items-center border-bottom py-3">
                {{-- Product --}}
                <div class="col-md-5 d-flex align-items-center">
                    <img src="{{ asset('productimages/' . $item->product->image_url) }}"
                         alt="{{ $item->product->name }}"
                         style="width: 80px; height: 80px; object-fit: cover;"
                         class="me-3">
                    <div>
                        <div class="fw-semibold">{{ $item->product->name }}</div>
                        <div class="text-muted small d-md-none mt-1">Rp {{ number_format($price, 0, ',', '.') }}</div>
                    </div>
                </div>

                {{-- Quantity --}}
                <div class="col-md-2 text-center" style="font-family: 'Montserrat', sans-serif;">{{ $qty }}</div>

                {{-- Price --}}
                <div class="col-md-2 text-end d-none d-md-block" style="font-family: 'Montserrat', sans-serif;">
                    Rp. {{ number_format($price, 0, ',', '.') }},-
                </div>

                {{-- Total --}}
                <div class="col-md-2 text-end" style="font-family: 'Montserrat', sans-serif;">
                    Rp. {{ number_format($subtotal, 0, ',', '.') }},-
                </div>

                {{-- Remove --}}
                <div class="col-md-1 text-end d-flex align-items-center" style="font-family: 'Montserrat', sans-serif;">
                    <form action="{{ route('cart.removeItem', ['id' => $item->cart_item_id]) }}" method="POST" onsubmit="return confirm('Delete this item?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="remove-btn btn btn-sm btn-danger" style="padding: 10px 20px 10px 20px">Remove</button>
                    </form>
                </div>
            </div>
        @endforeach
        
        {{-- Total dan Checkout --}}
        <div class="text-end mt-4">
            <div class="fw-bold mb-3" style="font-family: 'Montserrat', sans-serif; color: #5c3c1d;">TOTAL: Rp. {{ number_format($total, 0, ',', '.') }},-</div>
            <form action="{{ route('checkout') }}" method="GET">
                @csrf
                <input type="hidden" name="cart_id" value="{{ $cart->cart_id }}">
                <button type="submit" class="checkout-btn btn btn-lg" style="color: white; font-size: 14px; font-family: 'Montserrat', sans-serif; border-radius: 5px; padding: 15px 70px 15px 70px;">C H E C K O U T</button>
            </form>
        </div>
    @else
        <p class="text-center" style="padding-bottom: 50px; font-weight: 200; font-size: 16px; font-family: 'Montserrat', sans-serif; color: #5c3c1d;">You have no items in your cart.</p>
        <div class="center-container">
            <a href="{{ route('product') }}" class="btn" style="font-size: 16px; font-family: 'Montserrat', sans-serif; background-color: #5c3c1d; color: white; padding: 20px 130px 20px 130px;">CONTINUE SHOPPING</a>
        </div>
    @endif
</div>
@endsection
