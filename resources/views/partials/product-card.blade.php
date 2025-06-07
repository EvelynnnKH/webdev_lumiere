<a href="{{ route('product-detil.show', $p->product_id) }}" class="product-card">
    <div class="card-image-wrapper">
        <img src="{{ asset('productimages/'.$p->image_url) }}" alt="{{ $p->name }}">
    </div>
    <p class="product-category">{{ $p->category->name }}</p>
    <p class="product-name" style="font-size: 1.1rem; font-family: 'Playfair Display'">{{ $p->name }}</p>
    <p class="card-description">{{ $p->description }}</p>
    <div class="price-rate">
        <p class="product-price">Rp. {{ number_format($p->price, 0, ',', '.') }},-</p>
    </div>
</a>
