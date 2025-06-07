<head>
    <link rel="stylesheet" href="{{ asset('css/product-style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/>
</head>

<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

<body>
    @extends('base')
    @section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show position-fixed top-0 end-0 m-3 shadow-lg z-3" role="alert" style="min-width: 300px;">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show position-fixed top-0 end-0 m-3 shadow-lg z-3" role="alert" style="min-width: 300px;">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

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

    const itemsPerPage = 8;
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