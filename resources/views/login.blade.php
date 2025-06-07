@extends('base')

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show position-fixed top-0 end-0 m-3 shadow-lg z-3"
            role="alert" style="min-width: 300px;">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show position-fixed top-0 end-0 m-3 shadow-lg z-3"
            role="alert" style="min-width: 300px;">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="container-fluid d-flex justify-content-center align-items-center"
        style="min-height: 80vh; background-color: #fffaf2;">
        <div class="row w-100 justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="p-4" style="background-color: transparent;">
                    <div class="card-body">
                        <h2 class="text-center mb-4"
                            style="color: #603700; font-family: 'Playfair Display'; font-size: 28px;">LOGIN</h2>

                        <form method="GET" action="{{ route('home') }}">
                            <div class="mb-4">
                                <input type="email" class="form-control border-0 border-bottom rounded-0 p-0"
                                    name="email"
                                    style="background-color: transparent; border-bottom: 1px solid #603700; color: #603700;"
                                    placeholder="Enter your email">
                            </div>

                            <div class="mb-4">
                                <input type="password" class="form-control border-0 border-bottom rounded-0 p-0"
                                    name="password"
                                    style="background-color: transparent; border-bottom: 1px solid #603700; color: #603700;"
                                    placeholder="Enter your password">
                            </div>

                            <div class="mb-3 text-end">
                                <a href="{{ route('forget-password.submit') }}" class="text-decoration-none"
                                    style="color: #603700; font-size: 14px;">Forget password?</a>
                            </div>

                            <div class="d-grid gap-2 mb-3">
                                <button type="submit" class="btn btn-block py-2"
                                    style="background-color: #603700; color: white; border-radius: 0;">LOGIN NOW</button>
                            </div>

                            <div class="text-center">
                                <p class="mb-0" style="color: #603700; font-size: 14px;">Don’t have an account?
                                    <a href="{{ route('signup') }}" class="fw-bold text-decoration-none"
                                        style="color: #603700;">Signup now</a>
                                </p>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
