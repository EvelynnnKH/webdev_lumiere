@extends('base')

@section('content')
<style>
    .page-title:after {
        left: 46.5%;
    }
    main {
        background-color: #f8f4ee;
    }
    .form-control:focus {
        border-color: #000;
        box-shadow: 0 0 0 0.25rem rgba(0, 0, 0, 0.1);
    }
    .summary-card {
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .place-order-btn {
        background-color: #7c5126;
        color:white;
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 5px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .place-order-btn:hover {
        background-color: #5c3c1d;
        transform: translateY(-2px);
        color:white;
    }
</style>

<div class="container py-5" style="font-family: 'Montserrat', sans-serif; color: #5c3c1d">
    <h2 class="mb-4 text-center pb-3" style="font-weight: 300; color: #5c3c1d;">CHECKOUT</h2>

    <div class="row">
        <!-- Customer Information -->
        <div class="col-lg-7 pe-lg-5">
            <div class="mb-5">
                <h4 class="fw-bold mb-4">Personal Information</h4>
                <form id="checkoutForm" action="{{ route('order.place') }}" method="POST">
                    @csrf
                    <?php
                    $fullName = Auth::user()->name;;
                    $nameParts = explode(' ', $fullName);
                    $firstName = array_shift($nameParts); 
                    $lastName = implode(' ', $nameParts); 
                    ?>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="firstName" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="firstName" name="first_name" required value="{{ $firstName }}">
                        </div>
                        <div class="col-md-6">
                            <label for="lastName" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="lastName" name="last_name" required value="{{ $lastName }}">
                        </div>
                        <div class="col-12">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required value="{{ Auth::user()->email }}">
                        </div>
                        <div class="col-12">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="tel" class="form-control" id="phone" name="phone" required 
                            @if(Auth::user()->phone_number != null)
                            value="{{ Auth::user()->phone_number }}"
                            @endif>       
                        </div>
                        <div class="col-12">
                            <label for="address" class="form-label">Address</label>
                            <textarea class="form-control" id="address" name="address" rows="3" required><?php if(Auth::user()->phone_number != null)?>{{{ Auth::user()->address }}}</textarea>
                        </div>
                        {{-- <div class="col-md-6">
                            <label for="city" class="form-label">City</label>
                            <input type="text" class="form-control" id="city" name="city" required
                            @if(Auth::user()->city != null)
                            value="{{ Auth::user()->city }}"
                            @endif>       
                        </div>
                        <div class="col-md-4">
                            <label for="state" class="form-label">State/Province</label>
                            <input type="text" class="form-control" id="state" name="state" required
                            @if(Auth::user()->state != null)
                            value="{{ Auth::user()->state }}"
                            @endif>       
                        </div>
                        <div class="col-md-2">
                            <label for="zip" class="form-label">ZIP</label>
                            <input type="text" class="form-control" id="zip" name="zip" required
                            @if(Auth::user()->zip != null)
                            value="{{ Auth::user()->zip }}"
                            @endif>       
                        </div> --}}
                    </div>
                </form>
            </div>

            <!-- Payment Method -->
            <div class="mb-4">
                <h4 class="fw-bold mb-4">Payment Method</h4>
                <div class="form-check mb-3">
                    <input class="form-check-input" type="radio" name="paymentMethod" id="creditCard" value="credit_card" checked>
                    <label class="form-check-label" for="creditCard">
                        Credit Card
                    </label>
                </div>
                <div class="form-check mb-3">
                    <input class="form-check-input" type="radio" name="paymentMethod" id="bankTransfer" value="bank_transfer">
                    <label class="form-check-label" for="bankTransfer">
                        Bank Transfer
                    </label>
                </div>
            </div>
        </div>

        <!-- Order Summary -->
        <div class="col-lg-5">
            <div class="summary-card p-4" style="top: 20px;">
                <h4 class="fw-bold mb-4">Order Summary</h4>
                
                <!-- Products List -->
                <div class="mb-4">
                    @foreach ($cart->cartItems as $item)
                    <div class="d-flex justify-content-between mb-3">
                        <div>
                            <span class="fw-semibold" style="font-family: 'Playfair Display';">{{ $item->product->name }}</span><BR>
                            <span class="text-muted">x{{ $item->quantity }}</span>
                        </div>
                        <div>Rp. {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }},-</div>
                    </div>
                    @endforeach
                </div>
                
                <!-- Calculation -->
                <div class="border-top pt-3">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Subtotal</span>
                        <span>Rp. {{ number_format($total, 0, ',', '.') }},-</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Tax (10%)</span>
                        <span>Rp. {{ number_format($total * 0.1, 0, ',', '.') }},-</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Shipping</span>
                        <span>Rp. {{ number_format(20000, 0, ',', '.') }},-</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Admin Fee</span>
                        <span>Rp. {{ number_format(5000, 0, ',', '.') }},-</span>
                    </div>
                    <div class="d-flex justify-content-between fw-bold mt-3 pt-2 fs-5">
                        <span>Total</span>
                        <span>Rp. {{ number_format($total + ($total * 0.1) + 20000 + 5000, 0, ',', '.') }},-</span>
                    </div>
                </div>
                
                <!-- Place Order Button -->
                <button type="submit" form="checkoutForm" class="place-order-btn btn w-100 mt-4 padding: 15px 70px 15px 70px;">
                    PLACE ORDER
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
