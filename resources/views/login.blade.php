@extends('base')

@section('content')
    <div class="container-fluid d-flex justify-content-center align-items-center"
        style="min-height: 80vh; background-color: #fffaf2;">
        <div class="row w-100 justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="form-wrapper p-4" style="background-color: transparent; max-width: 420px; margin: auto; font-size: 1.1rem;">
                    <h2 class="text-center mb-4" style="color: #603700; font-family: 'Playfair Display'; font-size: 26px;">LOGIN</h2>

                    <form method="GET" action="{{ route('home') }}">
                        <div class="mb-4">
                            <input type="email" class="form-control border-0 border-bottom rounded-0 p-3"
                                name="email"
                                style="background-color: transparent; border-color: #603700 !important; color: #603700; font-size: 1.1rem;"
                                placeholder="Enter your email" required>
                        </div>

                        <div class="mb-4">
                            <input type="password" class="form-control border-0 border-bottom rounded-0 p-3"
                                name="password"
                                style="background-color: transparent; border-color: #603700 !important; color: #603700; font-size: 1.1rem;"
                                placeholder="Enter your password" required>
                        </div>

                        <div class="mb-3 text-end">
                            <a href="{{ route('forget-password.submit') }}" class="text-decoration-none"
                                style="color: #603700; font-size: 0.95rem;">Forget password?</a>
                        </div>

                        <div class="d-grid gap-2 mb-4">
                            <button type="submit" class="btn btn-block py-3"
                                style="background-color: #603700; color: white; border-radius: 0; font-size: 1.1rem;">
                                LOGIN NOW
                            </button>
                        </div>

                        <div class="text-center">
                            <p class="mb-0" style="color: #603700; font-size: 1rem;">Don’t have an account?
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
