<head>
    <link rel="stylesheet" href="{{ asset('css/product-style.css') }}">
</head>

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
        <div class="product-grid">
            @foreach ($products as $p)
                <a href="{{ route('product-detil.show', $p->product_id) }}" class="product-card">
                    <div class="card-image-wrapper">
                        <img src="{{ asset('productimages/'.$p->image_url) }}" alt="{{ $p->name }}">
                    </div>
                    <p class="product-category">{{ $p->category->name }}</p>
                    <p class="product-name">{{ $p->name }}</p>
                    <p class="card-description">{{ $p->description }}</p>
                    <div class="price-rate">
                        <p class="product-price">Rp. {{ number_format($p->price, 0, ',', '.') }},-</p>
                        <p class="product-rate">Rate: 5/5</p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</div>
<script>
    function goToCategory(url) {
        if (url) {
            window.location.href = url;
        }
    }
</script>


    @endsection
</body>