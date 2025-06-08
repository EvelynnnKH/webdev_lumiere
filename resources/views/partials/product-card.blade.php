<a href="{{ route('product-detil.show', $p->product_id) }}" class="product-card">
    <div class="card-image-wrapper">
        <img src="{{ asset('productimages/'.$p->image_url) }}" alt="{{ $p->name }}">
    </div>
    <p class="product-category text-muted mb-1" style="font-style: italic; font-size: 0.9rem;">{{ $p->category->name ?? 'N/A' }}</p> 
    <h6 class="product-name mb-1 fw-bold" style="font-size: 1.1rem; font-family: 'Playfair Display'">{{ $p->name }}</h6>
    <p class="card-description text-muted mb-2" style="font-style: italic; font-size: 0.9rem; height: 70px;">
        {{ $p->description }}
    </p>
    <div class="price-rate d-flex justify-content-between" style="font-size: 0.95rem;">
        <span class="product-price fw-bold">Rp. {{ number_format($p->price, 0, ',', '.') }},-</span>
    </div>
</a>
