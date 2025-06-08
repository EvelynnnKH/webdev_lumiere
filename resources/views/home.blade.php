@extends('base')

@section('content')
<div class="relative w-full main-page" style="margin: auto; max-margin: 150px; background: url('{{ asset('img/cover.png') }}') no-repeat center center/cover;">
    {{-- Overlay hitam transparan, mek agak ga ketok gtw knp --}}
    <div class="bg-white bg-opacity-30"></div>
    
    {{-- main content  --}}
    <div class="flex items-center justify-center pt-5 pb-5 lg:py-10">
        <div class="text-center px-4">
            <p class="tracking-wider m-3" style="line-height: 1.6; color: #ffffff; text-shadow: 1px 1px 2px rgba(0,0,0,0.2); font-family: 'Montserrat', sans-serif;">
                <i># Autumn Festival</i>
            </p>
            <h2 class="font-bold italic" style="font-size: 3.75rem; font-family: 'Playfair Display', serif; color: #ffffff; text-shadow: 1px 1px 3px rgba(153,123,82,0.42);">
                Autumn Package Deals
            </h2>
            <p class="tracking-wider m-3" style="line-height: 1.6; color: #ffffff; text-shadow: 1px 1px 2px rgba(0,0,0,0.2); font-family: 'Montserrat', sans-serif;">
                get your aromatic, woody, and musk comfort through the delightful candles
            </p>
            <a href="{{ route('product') }}" class="btn btn-light m-4 px-5 p-3" style="letter-spacing: 1.5px;">
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


<div class="container-fluid py-5" style="background-color: #f8f4ee;">
    <div class="text-center mb-5">
        <h2 style="font-size: 2.25rem; font-family: 'Playfair Display'; font-weight: 400; color: #5c3c1d;">
            RECOMMENDATION
        </h2>
    </div>

    <div class="position-relative">
        @php
    $chunks = $products->chunk(4); // 4 produk per halaman
@endphp

<div class="recommendation-slider text-center">
    <div id="recommendationPages">
        @foreach ($chunks as $index => $chunk)
            <div class="recommendation-page" style="{{ $index === 0 ? '' : 'display:none;' }}">
                <div class="d-flex justify-content-center flex-wrap gap-4">
                    @foreach ($chunk as $item)
                        <a href="{{ route('product-detil.show', $item->product_id) }}" class="product-card">
                            <div class="card-image-wrapper">
                                <img src="{{ asset('productimages/'.$item->image_url) }}" alt="{{ $item->name }}">
                            </div>

                            <p class="product-category text-muted mb-1" style="font-style: italic; font-size: 0.9rem;">
                                {{ $item->category->name ?? 'N/A' }}
                            </p> 

                            <h6 class="product-name mb-1 fw-bold" style="font-size: 1.1rem; font-family: 'Playfair Display'">
                                {{ $item->name }}
                            </h6>

                            <p class="card-description text-muted mb-2">
                                {{ $item->description }}
                            </p>

                            <div class="price-rate d-flex justify-content-between" style="font-size: 0.95rem;">
                                <span class="product-price fw-bold">Rp. {{ number_format($item->price, 0, ',', '.') }},-</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-center align-items-center gap-3 mt-4">
        <button id="prevBtn" class="btn btn-outline-secondary btn-outline-custom text-brown border-brown btn-sm">&lt; Previous</button>
        <span id="pageIndicator">1 / {{ $chunks->count() }}</span>
        <button id="nextBtn" class="btn btn-outline-secondary btn-outline-custom text-brown border-brown btn-sm">Next &gt;</button>
    </div>
</div>


        {{-- Gradient overlay kiri-kanan --}}
        <div style="position: absolute; top: 0; left: 0; bottom: 0; width: 50px; background: linear-gradient(to right, #f8f4ee, transparent); z-index: 1;"></div>
        <div style="position: absolute; top: 0; right: 0; bottom: 0; width: 50px; background: linear-gradient(to left, #f8f4ee, transparent); z-index: 1;"></div>
    </div>
</div>






<style>
    .paging {
    background-color: #f8f4ee;
    justify-content: center; /* Tengahin tombol */
    padding: 1rem 0;
}

.text-brown {
    color: #5c3c1d !important;
}

.border-brown {
    border-color: #5c3c1d !important;
}

.btn-outline-custom {
    font-weight: 500;
    border-radius: 6px;
    padding: 0.3rem 0.75rem;
    font-size: 0.9rem;
    border-width: 1.5px;
}

.btn-outline-custom:hover {
    color: #fff !important;
    background-color: #5c3c1d !important;
    border-color: #5c3c1d !important;
}

#pageIndicator {
    font-weight: 500;
    font-size: 0.95rem;
    color: #5c3c1d;
}

    .product-card {
    display: block;
    width: 250px;
    border-radius: 12px;
    background: white;
    padding: 1rem;
    color: #5c3c1d;
    text-decoration: none;
    transition: transform 0.3s ease;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    text-align: left;
}

.product-card:hover {
    transform: translateY(-5px);
}

.card-image-wrapper {
    width: 100%;
    height: 200px;
    overflow: hidden;
    border-radius: 8px;
    margin-bottom: 0.5rem;
}

.card-image-wrapper img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

.card-description {
    font-style: italic;
    font-size: 0.9rem;
    display: -webkit-box;
    -webkit-line-clamp: 2; /* max 2 lines */
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
    height: 2.8em;
}


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
<script>
    let currentPage = 0;
    const pages = document.querySelectorAll('.recommendation-page');
    const pageIndicator = document.getElementById('pageIndicator');

    document.getElementById('prevBtn').addEventListener('click', () => {
        if (currentPage > 0) {
            pages[currentPage].style.display = 'none';
            currentPage--;
            pages[currentPage].style.display = '';
            updateIndicator();
        }
    });

    document.getElementById('nextBtn').addEventListener('click', () => {
        if (currentPage < pages.length - 1) {
            pages[currentPage].style.display = 'none';
            currentPage++;
            pages[currentPage].style.display = '';
            updateIndicator();
        }
    });

    function updateIndicator() {
        pageIndicator.textContent = `${currentPage + 1} / ${pages.length}`;
    }
</script>


@endsection