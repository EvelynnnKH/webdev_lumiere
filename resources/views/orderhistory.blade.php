@extends('base')

@section('content')
<style>
    body {
        background-color: #f8f4ee;
        font-family: 'Monserrat', sans-serif;
        color: #5c3c1d;
    }
    
    .order-history-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 2rem 1rem;
    }

    .page-title {
        color: #38220f;
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 2rem;
        position: relative;
        padding-bottom: 0.5rem;
    }

    .page-title:after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 80px;
        height: 4px;
        background: #b97c50;
        border-radius: 2px;
    }

    .order-card {
        border-radius: 12px;
        border: none;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.05);
        margin-bottom: 1.5rem;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .order-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 20px rgba(0, 0, 0, 0.1);
    }

    .order-card-header {
        background-color: #b97c50 !important;
        color: white;
        padding: 1.25rem 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .order-number {
        font-weight: 600;
        font-size: 1.1rem;
    }

    .order-badge {
        font-size: 0.9rem;
        padding: 0.8rem 1.5rem;
    }

    .order-date {
        opacity: 0.9;
        font-size: 0.9rem;
    }

    .order-card-body {
        padding: 1.5rem;
        background-color: #fff;
    }

    .customer-info {
        margin-bottom: 1.5rem;
    }

    .customer-name {
        font-weight: 600;
        color: #38220f;
        margin-bottom: 0.25rem;
    }

    .order-summary {
        background-color: #f9f5f0;
        border-radius: 8px;
        padding: 1rem;
        margin-bottom: 1.5rem;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 0.5rem;
    }

    .summary-label {
        color: #6c757d;
    }

    .summary-value {
        font-weight: 500;
        color: #38220f;
    }

    .order-total {
        font-size: 1.1rem;
        font-weight: 600;
    }

    .products-table {
        width: 100%;
        margin-bottom: 1.5rem;
    }

    .products-table th {
        background-color: #f2e8df;
        color: #38220f;
        font-weight: 600;
        padding: 0.75rem;
        text-align: left;
    }

    .products-table td {
        padding: 0.75rem;
        border-bottom: 1px solid #eee;
        vertical-align: middle;
    }

    .product-name {
        font-weight: 500;
    }

    .product-qty {
        text-align: center;
        color: #6c757d;
    }

    .product-price {
        text-align: right;
        font-weight: 500;
    }

    .view-details-btn {
        background-color: #d4af7f;
        border: none;
        color: white;
        padding: 0.5rem 1.25rem;
        border-radius: 40px;
        font-weight: 500;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
    }

    .view-details-btn:hover {
        background-color: #b58855;
        color: white;
        transform: translateY(-2px);
    }

    .view-details-btn i {
        margin-right: 0.5rem;
    }

    .empty-state {
        text-align: center;
        padding: 3rem;
        background-color: white;
        border-radius: 12px;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.05);
    }

    .empty-icon {
        font-size: 3rem;
        color: #b97c50;
        margin-bottom: 1rem;
    }

    .empty-text {
        color: #6c757d;
        font-size: 1.1rem;
        margin-bottom: 1.5rem;
    }

    .back-home-btn {
        background-color: #c7baaf;
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 40px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .back-home-btn:hover {
        background-color: #847465;
        transform: translateY(-2px);
        color: white;
    }

    .more-items {
        text-align: center;
        color: #b97c50;
        font-style: italic;
        padding: 0.5rem;
    }
    .badge-completed    { background: #d4edda; color: #155724; }
.badge-pending      { background: #fff3cd; color: #856404; }
.badge-cancelled    { background: #f8d7da; color: #721c24; }
.badge-shipped,
.badge-delivered,
.badge-processing   { background: #e2e3e5; color: #383d41; }
.badge-default      { background: #eeeeee; color: #333; }
</style>

<div class="order-history-container py-5">
    <a href="{{ url('home') }}" class="btn back-home-btn">
                <i class="fas fa-arrow-left me-2"></i> Back to Home
    </a>
    <h2 class="mb-4 mt-2 text-center pb-2" style="font-weight: 300; color: #5c3c1d;">YOUR ORDER HISTORY</h2>

    @if(count($orders) === 0)
        <div class="empty-state">
            <div class="empty-icon">
                <i class="fas fa-box-open"></i>
            </div>
            <h3>No Orders Yet</h3>
            <p class="empty-text">You haven't placed any orders yet. Start shopping to see your order history here.</p>
        </div>
    @else
        @foreach($orders as $order)
        <div class="order-card">
            <div class="order-card-header">
                <div>
                    <span class="order-number">Order #{{ $order->order_number }}</span>
                    <span class="order-date ms-2">{{ $order->created_at }}</span>
                </div>
                <span class="badge order-badge badge-custom {{ 'badge-' . strtolower($order->status) }}" style="width: 120px;">{{ $order->status }}</span>
            </div>
            
            <div class="order-card-body">
                <div class="customer-info">
                    <h5 class="customer-name">{{ $order->name }}</h5>
                </div>
                
                <div class="order-summary">
                    <div class="summary-row">
                        <span class="summary-label">Total Item:</span>
                        <span class="summary-value">{{ count($order->items) }} products</span>
                    </div>
                    <div class="summary-row">
                        <span class="summary-label">Order Total:</span>
                        <span class="summary-value order-total">Rp. {{ number_format($order->total_price, 0, ',', '.') }},-</span>
                    </div>
                </div>
                
                <table class="products-table">
                    <thead style=" color: #5c3c1d; font-weight: 200; font-size: 15px; font-family: 'Montserrat', sans-serif;">
                        <tr>
                            <th>PRODUCT</th>
                            <th class="text-center">QUANTITY</th>
                            <th class="text-end">PRICE</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items->take(3) as $item)
                            <tr>
                                <td class="product-name" style="font-family: 'Playfair Display'; font-weight:bold;">{{ $item->product->name }}</td>
                                <td class="product-qty" style="color: #5c3c1d;">{{ $item->quantity }}</td>
                                <td class="product-price">Rp. {{ number_format($item->price, 0, ',', '.') }},-</td>
                            </tr>
                        @endforeach
                        @if($order->items->count() > 3)
                            <tr>
                                <td colspan="3" class="more-items">+ {{ $order->items->count() - 3 }} more items</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                
                <div class="text-end">
                    <a href="{{ route('order.details', ['orderNumber' => $order->order_number]) }}" 
                       class="btn view-details-btn">
                        <i class="fas fa-eye me-1"></i> View Full Details
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    @endif
</div>
@endsection
