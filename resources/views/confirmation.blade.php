@extends('base')

@section('content')
<style>
    main {
        background-color: #f8f4ee;
    }

    .order-history-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 2rem 1rem;
    }

    .order-card {
        border-radius: 12px;
        border: none;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.05);
        margin-bottom: 1.5rem;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        background-color:white;
    }

    .order-status {
        font-size: 0.9rem;
        padding: 0.5rem 1.2rem;
        border-radius: 5px;
    }
    
    .continue-btn {
        background-color: #7c5126;
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 5px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .continue-btn:hover {
        background-color: #5c3c1d;
        transform: translateY(-2px);
        color:white;
    }

    .table-order th {
        background-color: #f2e8df;
        color: #38220f;
        font-weight: 600;
        padding: 0.75rem;
        text-align: left;
    }
</style>
<div class="container py-5" style="font-family: 'Playfair Display'; color:#5c3c1d">
    <div class="text-center mb-4">
        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-check-circle-fill text-success mb-3" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
        </svg>
        <h2 class="fw-bold">Order Confirmed</h2>
        <p class="text-muted" style="font-family: 'Montserrat', sans-serif;">Thank you for your purchase!</p>
        <p style="font-family: 'Montserrat', sans-serif;">Order Number: #{{ $order->order_number }}</p>
    </div>

    <div class="order-history-container py-0">
        <div class="order-card" style="font-family: 'Montserrat', sans-serif;">
            <div class="card-body p-4">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5 class="fw-bold" style="font-size: 18px;">ORDER SUMMARY</h5>
                            <p class="mb-1">Date: {{ $order->order_date->format('F j, Y') }}</p>
                            <p>Status: <span class="order-status badge bg-success">{{ ucfirst($order->status) }}</span></p>
                        </div>
                        <div class="col-md-6">
                            <h5 class="fw-bold">SHIPPING ADDRESS</h5>
                            <p>{{ $order->shipping_address }}</p>
                        </div>
                    </div>

                    <div class="table-responsive mb-4">
                        <table class="table table-order">
                            <thead>
                                <tr>
                                    <th style=" color:#5c3c1d">PRODUCT</th>
                                    <th class="text-center" style=" color:#5c3c1d">QUANTITY</th>
                                    <th class="text-end" style=" color:#5c3c1d">PRICE</th>
                                    <th class="text-end" style=" color:#5c3c1d">TOTAL</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->orderItems as $item)
                                <tr>
                                    <td style=" color:#5c3c1d; font-family: 'Playfair Display'; font-weight:bold;">{{ $item->product->name }}</td>
                                    <td class="text-center" style=" color:#5c3c1d">{{ $item->quantity }}</td>
                                    <td class="text-end" style=" color:#5c3c1d">Rp. {{ number_format($item->price, 0, ',', '.') }},-</td>
                                    <td class="text-end" style=" color:#5c3c1d">Rp. {{ number_format($item->price * $item->quantity, 0, ',', '.') }},-</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="text-end" style=" color:#5c3c1d">Subtotal:</th>
                                    <td class="text-end" style=" color:#5c3c1d">Rp, {{ number_format($order->total_price - 20000 - 5000 - ($order->total_price * 0.1), 0, ',', '.') }},-</th>
                                </tr>
                                <tr>
                                    <td colspan="3" class="text-end" style=" color:#5c3c1d">Tax (10%):</th>
                                    <td class="text-end" style=" color:#5c3c1d">Rp. {{ number_format($order->total_price * 0.1, 0, ',', '.') }},-</th>
                                </tr>
                                <tr>
                                    <td colspan="3" class="text-end" style=" color:#5c3c1d">Shipping:</th>
                                    <td class="text-end" style=" color:#5c3c1d">Rp. 20.000,-</th>
                                </tr>
                                <tr>
                                    <td colspan="3" class="text-end" style=" color:#5c3c1d">Admin Fee:</th>
                                    <td class="text-end" style=" color:#5c3c1d">Rp. 5.000,-</th>
                                </tr>
                                <tr>
                                    <td colspan="3" class="text-end" style=" color:#5c3c1d; font-weight: bold;">Total:</th>
                                    <td class="text-end" style=" color:#5c3c1d; font-weight: bold;">Rp. {{ number_format($order->total_price, 0, ',', '.') }},-</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <div class="text-center">
                        <a href="{{ route('home') }}" class="continue-btn btn" style="font-size: 16px; font-family: 'Montserrat', sans-serif; color: white; padding: 20px 130px 20px 130px;">CONTINUE SHOPPING</a>
                    </div>
                </div>
        </div>
    </div>
















    {{-- <div class="order-card row justify-content-center">
        <div class="order-card col-lg-8">
            <div class="card order-card shadow-sm border-0">
                <div class="card-body p-4">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5 class="fw-bold">Order Summary</h5>
                            <p class="mb-1">Date: {{ $order->order_date->format('F j, Y') }}</p>
                            <p>Status: <span class="badge bg-primary">{{ ucfirst($order->status) }}</span></p>
                        </div>
                        <div class="col-md-6">
                            <h5 class="fw-bold">Shipping Address</h5>
                            <p>{{ $order->shipping_address }}</p>
                        </div>
                    </div>

                    <div class="table-responsive mb-4">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th class="text-center">Quantity</th>
                                    <th class="text-end">Price</th>
                                    <th class="text-end">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->orderItems as $item)
                                <tr>
                                    <td>{{ $item->product->name }}</td>
                                    <td class="text-center">{{ $item->quantity }}</td>
                                    <td class="text-end">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                    <td class="text-end">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="3" class="text-end">Subtotal:</th>
                                    <th class="text-end">Rp {{ number_format($order->total_price - 20000 - 5000 - ($order->total_price * 0.1), 0, ',', '.') }}</th>
                                </tr>
                                <tr>
                                    <th colspan="3" class="text-end">Tax (10%):</th>
                                    <th class="text-end">Rp {{ number_format($order->total_price * 0.1, 0, ',', '.') }}</th>
                                </tr>
                                <tr>
                                    <th colspan="3" class="text-end">Shipping:</th>
                                    <th class="text-end">Rp 20,000</th>
                                </tr>
                                <tr>
                                    <th colspan="3" class="text-end">Admin Fee:</th>
                                    <th class="text-end">Rp 5,000</th>
                                </tr>
                                <tr>
                                    <th colspan="3" class="text-end">Total:</th>
                                    <th class="text-end">Rp {{ number_format($order->total_price, 0, ',', '.') }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <div class="text-center">
                        <a href="{{ route('home') }}" class="btn btn-dark px-4">Continue Shopping</a>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
</div>
@endsection
