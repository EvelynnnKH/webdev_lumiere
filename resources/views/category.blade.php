<head>
        <link rel="stylesheet" href="{{ asset('css/category-style.css') }}">
    </head>
    <body>
        @extends('base')

        @section('content')
        <div class="full-content">
            <a href={{ url()->previous() }} class="back-button" title="Back">
                ←
            </a>
            @php
                $descriptions = [
                    'Scented Candle' => 'Scented candles offer a calming and inviting aroma, ideal for relaxation, meditation, or setting the mood in your home. Made with premium wax and fragrance oils, they can enhance the ambiance of any space.',
                    'Candle Accessories' => 'Discover a variety of candle accessories designed to enhance your candle experience, including wick trimmers, snuffers, holders, and safety tools. These items ensure longer burn times and better presentation.',
                    'Wax Melt' => 'Wax melts provide flameless fragrance for your home. Simply place a piece in a warmer or burner to release long-lasting aromas without the need for an open flame, making them a safe and effective option.',
                    'Decorative Candle' => 'Beautifully crafted decorative candles serve as both lighting and art. They come in unique shapes, colors, and textures, perfect for centerpieces, gifts, or adding a touch of elegance to any décor.',
                    'Bath Bombs' => 'Bath bombs dissolve in water to release fragrance, essential oils, and skin-soothing ingredients. Ideal for a spa-like experience at home, they add color, fizz, and fun to every bath session.',
                    'Aromaterapi' => 'Aromatherapy products are designed to promote emotional well-being, reduce stress, and improve mood. These include essential oils, diffusers, and candles infused with therapeutic fragrances.',
                    'Seasonal Candle' => 'Celebrate each season with themed candles featuring festive scents like pumpkin spice, peppermint, cinnamon, or pine. Great for holidays, special occasions, or simply embracing the spirit of the season.',
                    'Essential Oils' => 'Pure essential oils extracted from natural sources can be used in diffusers, skincare, massage, or baths. Known for their therapeutic properties, each oil offers unique health and mood benefits.',
                    'Candle Making Kit' => 'A complete DIY set for creating your own candles at home. Includes wax, wicks, containers, fragrances, and instructions—perfect for beginners, hobbyists, or as a creative gift.',
                    'Diffuser' => 'Diffusers disperse essential oils into the air, filling your space with soothing scents. Whether ultrasonic, reed, or nebulizing, diffusers are a natural way to improve air quality and ambiance.',
                    'Unscented Candle' => 'Unscented candles are perfect for formal events, rituals, or when fragrance isn’t desired. Often used in ceremonies or minimalist designs, they offer a clean and classic lighting option.',
                    'Handmade Soaps' => 'Crafted in small batches using natural ingredients, handmade soaps are gentle on the skin and free of harsh chemicals. Available in a range of scents, colors, and moisturizing formulas.',
                    'Gift Boxes & Sets' => 'Curated gift sets featuring candles, soaps, essential oils, and more—thoughtfully packaged for birthdays, holidays, or self-care moments. A perfect way to show appreciation with elegance.',
                ];
            @endphp

            <h1>{{ $category->name }}</h1>
            @if (array_key_exists($category->name, $descriptions))
                <h3 class="category-description">{{ $descriptions[$category->name] }}</h3>
            @endif
            <div class="product-grid justify-content-center">
                @forelse ($products as $p)
                    <a href="{{ route('product-detil.show', $p->product_id) }}" class="product-card">
                        <div class="card-image-wrapper">
                            <img src="{{ asset('productimages/'.$p->image_url) }}" alt="{{ $p->name }}">
                        </div>
                        <p class="product-name">{{ $p->name }}</p>
                        <p class="card-description">{{ $p->description }}</p>
                        <div class="price-rate">
                            <p class="product-price">Rp. {{ number_format($p->price, 0, ',', '.') }},-</p>
                            <p class="product-rate">Rate: 5/5</p>
                        </div>
                    </a>
                @empty
                    <p>Tidak ada produk dalam kategori ini.</p>
                @endforelse
            </div>
        </div>
        @endsection
    </body>