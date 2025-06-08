@extends('base')

@section('content')
<style>
    /* Use same styles as myorder page */
    body { 
        background-color: #f8f4ee;
    }
    
    .order-details-page {
        max-width: 1200px;
        margin: 0 auto;
        padding: 2rem 1rem;
    }

    .order-details-page .card {
        border-radius: 12px;
        border: none;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.05);
        margin-bottom: 1.5rem;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .order-details-page .card-header {
        background-color: #b97c50 !important;
        color: white;
        padding: 1.25rem 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .order-details-page .details-title {
        color: #38220f;
        font-size: 32px;
        font-weight: bold;
    }

    .order-badge {
        font-size: 0.9rem;
        padding: 0.8rem 1.5rem;
    }

    .order-detail-badge {
        font-size: 0.9rem;
        padding: 0.5rem 1.2rem;
        border-radius: 5px;
    }

    .order-date {
        opacity: 0.9;
        font-size: 0.9rem;
    }

    .order-number {
        font-weight: 600;
        font-size: 1.1rem;
    }
    
    .product-name {
        font-weight: 500;
    }

    .back-order-history-btn {
        background-color: #b1a59b;
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 50px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .back-order-history-btn:hover {
        background-color: #847465;
        transform: translateY(-2px);
        color:white;
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
</style>

<div class="order-details-page py-5">
        <a href="{{ route('order.history') }}" class="btn back-order-history-btn">
                <i class="fas fa-arrow-left me-2"></i> Back to Order History
        </a>
        <h2 class="mb-4 mt-2 text-center pb-2" style="font-weight: 300; color: #5c3c1d;">ORDER DETAILS</h2>

        <div class="card shadow-sm mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <span class="order-number">Order #{{ $order['order_number'] }}</span>
                    <span class="order-date ms-2">{{ $order['created_at'] }}</span>
                </div>
                <span class="badge order-badge bg-success">Completed</span>
            </div>

            <div class="card-body">
                <div class="row mb-4" style="color: #5c3c1d;">
                    <div class="col-md-6">
                        <h6>CUSTOMER INFORMATION</h6>
                        <div class="mt-3">
                            <p ><strong>Name:</strong> {{ $order['user']['name'] }}</p>
                            <p><strong>Email:</strong> {{ $order['user']['email'] }}</p>
                            <p><strong>Address:</strong> {{ $order['user']['address'] }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h6>ORDER SUMMARY</h6>
                        <div class="mt-3">
                            <p><strong>Order Date:</strong> {{ $order['created_at'] }}</p>
                            <p><strong>Items:</strong> {{ count($order['items']) }} products</p>
                            <p><strong>Status:</strong> <span class="order-detail-badge bg-success" style="color: white;"><strong>Completed</strong></span></p>
                        </div>
                    </div>
                </div>

                <h6 class="mb-3"style="color: #5c3c1d;" >ORDER ITEM</h6>
                <table class="products-table table mb-4" style="color: #5c3c1d;">
                    <thead style=" color: #5c3c1d; font-weight: 200; font-size: 15px; font-family: 'Montserrat', sans-serif;">
                        <tr>
                            <th>PRODUCT</th>
                            <th class="text-center">QUANTITY</th>
                            <th class="text-end">UNIT PRICE</th>
                            <th class="text-end">SUBTOTAL</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($order['items'] as $item)
                        <tr>
                            <td class="product-name" style="font-family: 'Playfair Display'; font-weight:bold; color: #5c3c1d;">{{ $item->product->name }}</td>
                            <td class="text-center" style="color: #5c3c1d;">{{ $item['quantity'] }}</td>
                            <td class="text-end" style="color: #5c3c1d;">Rp. {{ number_format($item['price'], 0, ',', '.') }},-</td>
                            <td class="text-end" style="color: #5c3c1d;">Rp. {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }},-</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-end" style="color: #5c3c1d;">Subtotal</td>
                            <td class="text-end" style="color: #5c3c1d;">Rp. {{ number_format($subtotal, 0, ',', '.') }},-</td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-end" style="color: #5c3c1d;">Tax (10%)</td>
                            <td class="text-end" style="color: #5c3c1d;">Rp. {{ number_format($taxAmount, 0, ',', '.') }},-</td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-end" style="color: #5c3c1d;">Shipping Cost</td>
                            <td class="text-end" style="color: #5c3c1d;">Rp. {{ number_format($shippingCost, 0, ',', '.') }},-</td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-end" style="color: #5c3c1d;">Admin Fee</td>
                            <td class="text-end" style="color: #5c3c1d;">Rp. {{ number_format($adminCost, 0, ',', '.') }},-</td>
                        </tr>
                        <tr class="fw-bold">
                            <td colspan="3" class="text-end" style="color: #5c3c1d;">Total</td>
                            <td class="text-end" style="color: #5c3c1d;">Rp. {{ number_format($total, 0, ',', '.') }},-</td>
                        </tr>
                    </tfoot>
                </table>
            </div>

    </div>
</div>
@endsection
