@extends('base')

@section('content')
    <div class="container-fluid d-flex justify-content-center align-items-center py-5"
        style="background: #f8f4ee; no-repeat center center; background-size: cover;">
        <div class="row w-100 justify-content-center">
            <div class="col-12 col-md-8 col-lg-5">

                <div class="form-wrapper p-4" style="background-color: transparent; max-width: 540px; margin: auto; font-size: 1.1rem;">
                <h2 class="text-center mb-4" style="color: #603700; font-family: 'Playfair Display'; font-size: 28px;">
                    LOGIN
                </h2>

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert" style="font-size: 1.15rem;">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form action="{{ route('login.auth') }}" method="POST" novalidate style="font-size: 1.25rem;">
                    @csrf

                    <div class="mb-4">
                        <input type="email"
                            class="form-control border-0 border-bottom rounded-0 p-3 @error('email') is-invalid @enderror"
                            id="email" name="email" value="{{ old('email') }}" placeholder="Enter your email"
                            style="background-color: transparent; border-color: #603700 !important; color: #603700; font-size: 1.25rem;">
                        @error('email')
                            <div class="invalid-feedback" style="font-size: 1rem;">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <input type="password"
                            class="form-control border-0 border-bottom rounded-0 p-3 @error('password') is-invalid @enderror"
                            id="password" name="password" placeholder="Enter your password"
                            style="background-color: transparent; border-color: #603700 !important; color: #603700; font-size: 1.25rem;">
                        @error('password')
                            <div class="invalid-feedback" style="font-size: 1rem;">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-4 text-end">
                        <a href="{{ route('forget-password.submit') }}" class="text-decoration-none fw-semibold"
                            style="color: #603700; font-size: 1rem;">
                            Forget password?
                        </a>
                    </div>

                    <div class="d-grid gap-2 mb-4">
                        <button type="submit" class="btn py-3"
                            style="background-color: #603700; color: white; font-size: 1.25rem;">
                            LOGIN NOW
                        </button>
                    </div>

                    <div class="text-center">
                        <p class="mb-0" style="color: #603700; font-size: 1.05rem;">
                            Don’t have an account?
                            <a href="{{ route('signup') }}" class="fw-bold text-decoration-none"
                                style="color: #603700;">Signup now</a>
                        </p>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
@endsection
