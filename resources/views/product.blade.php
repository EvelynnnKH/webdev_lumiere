<head>
    <link rel="stylesheet" href="{{ asset('css/product-style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/>
</head>

<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

<body>
    @extends('base')
    @section('content')
    @can('insert-product')
        <div class="list-product">
    <div class="button-container">
        <a href="{{ route('createProduct.show') }}" class="btn-insert">+</a>
    </div>
    @endcan
    

    <div class="main-content" style="font-family: 'Montserrat', sans-serif;">
        <!-- Sidebar Kategori -->
        <div class="top-bar">
            <div class="category-dropdown-wrapper">
                <label for="categoryDropdown" class="category-label" style="font-family: 'Montserrat', sans-serif;">Categories:</label>
                <select class="form-select" style="font-family: 'Montserrat', sans-serif;" id="categoryDropdown" onchange="goToCategory(this.value)">
                    <option value="">-- Choose Category --</option>
                    @foreach ($products->unique('category_id') as $p)
                        <option value="{{ route('category.show', $p->category->category_id) }}">
                            {{ $p->category['name'] }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <!-- Horizontal Category Filter -->
        <div class="category-menyamping ">
            <div class="category-nav d-flex justify-content-center gap-4 py-2 shadow-sm bg-white sticky-top" style="top: 90px; z-index: 10; font-family: 'Montserrat', sans-serif;">
            <!-- OILS -->
            <div class="dropdown">
                <button class="btn btn-link dropdown-toggle text-decoration-none" style="color:#5c3c1d;" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    OILS
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" style="color:#5c3c1d;" href="{{ route('category.show', 8) }}">Essential Oils</a></li>
                </ul>
            </div>

            <!-- CANDLE -->
            <div class="dropdown">
                <button class="btn btn-link dropdown-toggle text-decoration-none" style="color:#5c3c1d;" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    CANDLE
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" style="color:#5c3c1d;" href="{{ route('category.show', 1) }}">Scented Candle</a></li>
                    <li><a class="dropdown-item" style="color:#5c3c1d;" href="{{ route('category.show', 4) }}">Decorative Candle</a></li>
                    <li><a class="dropdown-item" style="color:#5c3c1d;" href="{{ route('category.show', 7) }}">Seasonal Candle</a></li>
                    <li><a class="dropdown-item" style="color:#5c3c1d;" href="{{ route('category.show', 11) }}">Unscented Candle</a></li>
                </ul>
            </div>

            <!-- WAX & BATH -->
            <div class="dropdown">
                <button class="btn btn-link dropdown-toggle text-decoration-none" style="color:#5c3c1d;" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    WAX & BATH
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" style="color:#5c3c1d;" href="{{ route('category.show', 3) }}">Wax Melt</a></li>
                    <li><a class="dropdown-item" style="color:#5c3c1d;" href="{{ route('category.show', 5) }}">Bath Bombs</a></li>
                    <li><a class="dropdown-item" style="color:#5c3c1d;" href="{{ route('category.show', 12) }}">Handmade Soaps</a></li>
                </ul>
            </div>

            <!-- MICELLANOUS -->
            <div class="dropdown">
                <button class="btn btn-link dropdown-toggle text-decoration-none" style="color:#5c3c1d;" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    MISCELLANEOUS
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" style="color:#5c3c1d;" href="{{ route('category.show', 2) }}">Candle Accessories</a></li>
                    <li><a class="dropdown-item" style="color:#5c3c1d;" href="{{ route('category.show', 9) }}">Candle Making Kit</a></li>
                    <li><a class="dropdown-item" style="color:#5c3c1d;" href="{{ route('category.show', 13) }}">Gift Boxes & Sets</a></li>
                </ul>
            </div>
        </div>
        </div>

        <!-- Grid Produk -->
        <div id="product-container" class="product-grid">
            {{-- Semua produk dimuat di awal --}}
            @foreach ($products as $p)
                <div class="product-item d-none">
                    @include('partials.product-card', ['p' => $p])
                </div>
            @endforeach
        </div>

        <!-- Pagination controls -->
        <div class="text-center p-3 d-flex justify-content-center align-items-center gap-3 paging">
            <button id="prev-btn" class="btn btn-outline-secondary btn-outline-custom text-brown border-brown btn-sm" disabled>&lt; Previous</button>
            <span id="page-indicator">1 / 1</span>
            <button id="next-btn" class="btn btn-outline-secondary btn-outline-custom text-brown border-brown btn-sm">Next &gt;</button>
        </div>
        
    </div>

<script>
    function goToCategory(url) {
        if (url) {
            window.location.href = url;
        }
    }

    const itemsPerPage = 10;
    const items = document.querySelectorAll('.product-item');
    const totalPages = Math.ceil(items.length / itemsPerPage);

    let currentPage = 1;

    const renderPage = (page) => {
        items.forEach((item, index) => {
            item.classList.add('d-none');
            if (index >= (page - 1) * itemsPerPage && index < page * itemsPerPage) {
                item.classList.remove('d-none');
            }
        });

        document.getElementById('page-indicator').innerText = `${page} / ${totalPages}`;
        document.getElementById('prev-btn').disabled = page === 1;
        document.getElementById('next-btn').disabled = page === totalPages;
    };

    document.getElementById('prev-btn').addEventListener('click', () => {
        if (currentPage > 1) {
            currentPage--;
            renderPage(currentPage);
        }
    });

    document.getElementById('next-btn').addEventListener('click', () => {
        if (currentPage < totalPages) {
            currentPage++;
            renderPage(currentPage);
        }
    });

    // Initial render
    renderPage(currentPage);

</script>


    @endsection
</body>