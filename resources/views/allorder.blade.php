@extends('base')

@section('content')
<style>
    .btn-view {
        background-color: #7c5126;
        color:white;
        border: none;
        padding: 0.5rem 3rem;
        border-radius: 20px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .btn-view:hover {
        background-color: #5c3c1d;
        transform: translateY(-2px);
        color:white;
    }

    .table-header th {
        background-color: #f2e8df;
        color: #38220f;
        font-weight: 600;
        padding: 0.75rem;
        text-align: left;
    }
</style>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">

<div class="container my-5">
    <h2 class="mb-4 text-center pb-2" style="font-weight: 300; color: #5c3c1d;">ORDER HISTORY</h2>
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table-header table align-middle">
                    <thead>
                        <tr style="background-color: #f8f4ef;">
                            <th class="px-3 py-3">ORDER ID</th>
                            <th class="px-3 py-3">USER</th>
                            <th class="px-3 py-3">DATE</th>
                            <th class="px-3 py-3" style="text-align: right;">TOTAL PRICE</th>
                            <th class="px-3 py-3 text-center">STATUS</th>
                            <th class="px-3 py-3 text-center">DETAILS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                        <tr style="background-color: #fff; box-shadow: 0 2px 4px rgba(0,0,0,0.04); border-radius: 12px;">
                            <td class="px-3 py-3">{{ $order->order_id }}</td>
                            <td class="px-3 py-3">{{ $order->user->name ?? 'N/A' }}</td>
                            <td class="px-3 py-3">{{ $order->created_at }}</td>
                            <td class="px-3 py-3" style="text-align: right;">Rp. {{ number_format($order->total_price, 0, ',', '.') }},-</td>
                            <td class="text-center px-3 py-3">
                                <span class="badge-custom {{ 'badge-' . strtolower($order->status) }}">
                                    {{ $order->status }}
                                </span>
                            </td>
                            <td class="text-center px-3 py-3">
                                <a href="{{ route('showOrderDetails', ['orderNumber' => $order['order_number']]) }}" class="btn-view btn btn-sm">
                                    <i class="fas fa-eye me-1"></i>
                                    VIEW
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">No orders found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
body {
    background-color: #f8f4ee;
    font-family: 'Playfair Display', serif;
    color: #3d2b1f;
}

.card {
    border-radius: 16px;
    background-color: #fff;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
}

.badge-custom {
    padding: 6px 12px;
    font-size: 0.85rem;
    border-radius: 20px;
    font-weight: 600;
    min-width: 90px;
    display: inline-block;
    text-align: center;
    width: 120px;
}

.badge-completed    { background: #d4edda; color: #155724; }
.badge-pending      { background: #fff3cd; color: #856404; }
.badge-cancelled    { background: #f8d7da; color: #721c24; }
.badge-shipped,
.badge-delivered,
.badge-processing   { background: #e2e3e5; color: #383d41; }
.badge-default      { background: #eeeeee; color: #333; }

.btn-brown {
    background-color: #5d3a1a;
    color: #fff;
    padding: 6px 14px;
    border-radius: 12px;
    font-weight: 500;
    border: none;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.btn-brown:hover {
    background-color: #472e15;
    color: #fff;
}

.table {
    border-collapse: separate;
    border-spacing: 0 12px;
}
</style>
@endsection
