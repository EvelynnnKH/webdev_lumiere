@extends('base')

@section('content')
    <div class="container-fluid d-flex justify-content-center align-items-center py-5"
        style="background: #f8f4ee; no-repeat center center; background-size: cover;">
        <div class="row w-100 justify-content-center">
            <div class="col-12 col-md-8 col-lg-5"> <!-- Sedikit lebih besar -->

                <div class="form-wrapper p-4" style="background-color: transparent; max-width: 540px; margin: auto; font-size: 1.1rem;">
                    <h2 class="text-center mb-4" style="color: #603700; font-family: 'Playfair Display'; font-size: 28px;">RESET PASSWORD</h2>

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert" style="font-size: 1.1rem;">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('forget-password.submit') }}" id="resetPasswordForm">
                        @csrf

                        <div class="mb-4">
                            <input type="email"
                                class="form-control border-0 border-bottom rounded-0 p-3 @error('email') is-invalid @enderror"
                                name="email"
                                style="background-color: transparent; border-color: #603700 !important; color: #603700; font-size: 1.1rem;"
                                placeholder="Enter email address" required value="{{ old('email') }}">
                            @error('email')
                                <div class="invalid-feedback" style="font-size: 1rem;">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <input type="password"
                                class="form-control border-0 border-bottom rounded-0 p-3 @error('new_password') is-invalid @enderror"
                                name="new_password"
                                style="background-color: transparent; border-color: #603700 !important; color: #603700; font-size: 1.1rem;"
                                placeholder="Enter new password" required>
                            @error('new_password')
                                <div class="invalid-feedback" style="font-size: 1rem;">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <input type="password"
                                class="form-control border-0 border-bottom rounded-0 p-3 @error('new_password_confirmation') is-invalid @enderror"
                                name="new_password_confirmation"
                                style="background-color: transparent; border-color: #603700 !important; color: #603700; font-size: 1.1rem;"
                                placeholder="Confirm new password" required>
                            @error('new_password_confirmation')
                                <div class="invalid-feedback" style="font-size: 1rem;">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2 mb-4">
                            <button type="submit" class="btn py-3"
                                style="background-color: #603700; color: white; font-size: 1.2rem;">
                                RESET PASSWORD
                            </button>
                        </div>

                        <div class="text-center">
                            <p class="mb-0" style="color: #603700; font-size: 1rem;">
                                Remembered your password?
                                <a href="{{ route('login') }}" class="fw-bold text-decoration-none"
                                    style="color: #603700;">Login now</a>
                            </p>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
