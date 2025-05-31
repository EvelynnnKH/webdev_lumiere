@extends('base')

@section('content')
<div class="container py-5" style="font-family: 'Playfair Display';">
    <div class="text-center mb-5">
        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-check-circle-fill text-success mb-3" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
        </svg>
        <h2 class="fw-bold">Order Confirmed</h2>
        <p class="text-muted">Thank you for your purchase!</p>
        <p>Order ID: #{{ $order->order_id }}</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0">
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
    </div>
</div>
@endsection
