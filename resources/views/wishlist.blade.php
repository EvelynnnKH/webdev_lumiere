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

    .continue-btn,
    .add-btn {
        background-color: #7c5126;
        border: none;
        padding: 0.75rem 1.2rem;
        border-radius: 5px;
        font-weight: 500;
        transition: all 0.3s ease;
        color: white;
    }

    .continue-btn:hover,
    .add-btn:hover {
        background-color: #5c3c1d;
        transform: translateY(-2px);
        color: white;
    }

    .remove-btn {
        background-color: #c82b2b;
        border: none;
        padding: 0.75rem 1.2rem;
        border-radius: 5px;
        font-weight: 500;
        transition: all 0.3s ease;
        color: white;
    }

    .remove-btn:hover {
        background-color: #970505;
        transform: translateY(-2px);
        color: white;
    }

    .order-card {
        border-radius: 12px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .order-card:hover {
        transform: translateY(-5px);
        box-shadow: 1 12px 20px rgba(0, 0, 0, 0.1);
    }

    .card-body {
        display: flex;
        flex-direction: column;
    }
</style>

<div class="container py-5" style="font-family: 'Playfair Display'; color: #5c3c1d;">
    <h2 class="mb-4 text-center pb-3" style="font-weight: 300; color: #5c3c1d;">WISHLIST</h2>

    @if($wishlist && $wishlist->wishlistItems->count() > 0)
        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-4">
            @foreach ($wishlist->wishlistItems as $item)
                <div class="col order-card">
                    <div class="card h-100 shadow-sm border-0">
                        <img src="{{ asset('productimages/'.$item->product->image_url) }}"
                             class="card-img-top" 
                             alt="{{ $item->product->name }}" 
                             style="height: 250px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title fw-semibold text-truncate" style="color: #5c3c1d;">{{ $item->product->name }}</h5>
                            <p class="card-text mb-4" style="font-family: 'Montserrat', sans-serif; color: #5c3c1d;">Rp. {{ number_format($item->product->price, 0, ',', '.') }},-</p>
                            
                            <div class="mt-auto d-flex justify-content-between">
                                {{-- Add to Cart --}}
                                <form action="{{ route('add_to_cart', ['product' => $item->product->product_id]) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="quantity" value="{{ $item->quantity }}">
                                    <button type="submit" class="add-btn btn btn-sm" style="font-size: 14px; font-family: 'Montserrat', sans-serif;">Add to Cart</button>
                                </form>

                                {{-- Remove from Wishlist --}}
                                <form action="{{ route('remove_from_wishlist', ['product_id' => $item->product->product_id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="remove-btn btn btn-sm" style="font-family: 'Montserrat', sans-serif;">Remove</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-center" style="padding-bottom: 50px; font-weight: 200; font-size: 16px; font-family: 'Montserrat', sans-serif; color: #5c3c1d;">You have no items in your wishlist.</p>
        <div class="center-container">
            <a href="{{ route('product') }}" class="continue-btn btn" style="font-size: 16px; font-family: 'Montserrat', sans-serif; padding: 20px 130px;">CONTINUE SHOPPING</a>
        </div>
    @endif
</div>
@endsection
