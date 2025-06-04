@extends('base')

@section('content')
<div class="relative w-full main-page" style="margin: auto; max-margin: 150px; background: url('{{ asset('img/cover.jpg') }}') no-repeat center center/cover;">
    {{-- Overlay hitam transparan, mek agak ga ketok gtw knp --}}
    <div class="bg-white bg-opacity-30"></div>
    
    {{-- main content  --}}
    <div class="flex items-center justify-center pt-5 pb-5 lg:py-10">
        <div class="text-center px-4">
            <p class="tracking-wider m-3" style="line-height: 1.6; color: #ffffff; text-shadow: 1px 1px 2px rgba(0,0,0,0.2); font-family: 'Montserrat', sans-serif;">
                <i>#Autumn Festival</i>
            </p>
            <h2 class="font-bold italic" style="font-size: 3.75rem; font-family: 'Playfair Display', serif; color: #ffffff; text-shadow: 1px 1px 3px rgba(153,123,82,0.42);">
                Autumn Package Deals
            </h2>
            <p class="tracking-wider m-3" style="line-height: 1.6; color: #ffffff; text-shadow: 1px 1px 2px rgba(0,0,0,0.2); font-family: 'Montserrat', sans-serif;">
                get your aromatic, woody, and musk comfort through the delightful candles
            </p>
            <a href="{{ route('product') }}" class="btn btn-light m-4 px-5 p-2" style="letter-spacing: 1.5px;">
                SHOP NOW
            </a>
        </div>
    </div>
</div>



{{-- buat card yang ada 4 itu --}}
@php
    $categoryProducts = [
        [
            'image_url' => 'vanillascentedcandle.jpeg',
            'category_name' => 'SCENTED CANDLES',
            'category_id' => 1
        ],
        [
            'image_url' => 'eucalyptusbathbomb.jpeg', 
            'category_name' => 'BATH BOMBS',
            'category_id' => 5
        ],
        [
            'image_url' => 'lemonessentialoil.jpeg', 
            'category_name' => 'ESSENTIAL OILS',
            'category_id' => 8
        ],
        [
            'image_url' => 'autumncandle.jpeg', 
            'category_name' => 'SEASONAL CANDLES',
            'category_id' => 7
        ],
    ];
@endphp

<div class="container-fluid p-0">
    <div class="row g-0">
        @foreach ($categoryProducts as $productShow) 
            <div class="col-sm-3 col-md-6 col-lg-3">
                    <div class="category-card" style="background: url('{{ asset('productimages/' . $productShow['image_url']) }}') no-repeat center center/cover; height: 250px;">
                        <div class="category-overlay flex-column align-items-center">
                        <div class="category-label text-center py-3 bg-white">
                            <a href="{{ route('category.show', $productShow['category_id']) }}" class="text-decoration-none">
                                <h5 class="m-0 text-dark">{{ strtoupper($productShow['category_name']) }}</h5>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>


{{-- best seller --}}
@php
    $placeholder = [
        [
            'id' => 1,
            'productName' => 'Lavender Essential Oil',
            'description' => 'Calming yet aromatic Lavender essense. Best for sleep.',
            'price' => 75000,
            'image_url' => 'lavenderscentedcandle.jpeg',
            'category_name' => 'Essential Oils'
        ],
        [
            'id' => 5,
            'productName' => 'Flake Soy Wax Melt',
            'description' => 'Easier to melt soy based wax.',
            'price' => 45000,
            'image_url' => 'flakesoywaxmelt.jpeg',
            'category_name' => 'Wax Melt'
        ],
        [
            'id' => 8,
            'productName' => 'Eucalyptus Bath Bomb',
            'description' => 'Homemade eucalyptus bath bombs perfect for at-home wellness.',
            'price' => 60000,
            'image_url' => 'eucalyptusbathbomb.jpeg',
            'category_name' => 'Bath Bombs'
        ]
    ];
@endphp

<div class="container-fluid py-5" style="background-color: #f8f4ee;">
    <div class="text-center mb-5">
        <h2 style="font-size: 2.75rem; font-family: 'Playfair Display'; font-weight: 400; color: #5c3c1d;">BEST SELLER</h2>
    </div>

    <div class="row justify-content-center">
        @foreach ($placeholder as $item)
            <div class="col-sm-6 col-md-4 col-lg-3 mb-5" style="color: #5c3c1d;">
                <div class="text-start h-100">
                    <img src="{{ asset('productimages/'.$item['image_url']) }}" alt="Product" class="img-fluid mb-1" style="object-fit: cover; height: 240px; width: 100%;">

                    <p class="text-muted mb-1" style="font-style: italic; font-size: 0.9rem;">{{ $item['category_name'] }}</p>
                    <h6 class="mb-1 fw-bold" style="font-size: 1rem;">{{ $item['productName'] }}</h6>
                    <p class="text-muted mb-2" style="font-style: italic; font-size: 0.9rem; height: 70px;">
                        {{ $item['description'] }}
                    </p>

                    <div class="d-flex justify-content-between" style="font-size: 0.95rem;">
                        <span class="fw-bold">Rp. {{ number_format($item['price'], 0, ',', '.') }},-</span>
                        <span class="text-muted" style="font-style: italic;">Rate: 5/5</span>
                    </div>
                        <a href="{{ route('product-detil.show', $item['id']) }}" class="btn w-100 mt-3" style="background-color: #5c3c1d; color: white; font-weight: 500;">
                            SEE MORE
                        </a>
                    </div>
            </div>
        @endforeach
    </div>
</div>




<style>
    .category-card {
    position: relative;
    overflow: hidden;
}

.category-overlay {
    position: absolute;
    inset: 0; /* shorthand utk top/right/bottom/left = 0 */
    background-color: rgba(0, 0, 0, 0.25);
    transition: background-color 0.3s ease;
    display: flex;
    flex-direction: column;
    justify-content: flex-end; /* label turun ke bawah */
    align-items: center;
}

.category-card:hover .category-overlay {
    background-color: rgba(0, 0, 0, 0.4);
}

.category-label {
    font-weight: 600;
    letter-spacing: 1px;
    width: 80%;
    margin-bottom: 20px;
}
.bg-opacity-30{
    position: absolute;
    background-color: rgba(0, 0, 0, 0.25);
    transition: background-color 0.3s ease;
    display: flex;
    flex-direction: column;
    justify-content: flex-end; /* label turun ke bawah */
    align-items: center;
}

    
@media (min-width: 1400px) {
    .main-page{
        height: 90vh;
        padding: 5rem;
    }
}
/* Responsif untuk tablet */
@media (min-width: 1185px) {
    .main-page{
        height: 86vh;
        padding: 5rem;
    }
}

/* Responsif untuk mobile */
@media (min-width: 995px) {
    .main-page{
        margin: auto; 
        flex items-center 
        justify-content: center;
        padding-top: 5;
        padding-bottom: 5;
    }
}
</style>

@endsection