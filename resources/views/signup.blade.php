@extends('base')

@section('content')
    <div class="container-fluid d-flex justify-content-center align-items-center"
        style="min-height: 100vh; background: white; no-repeat center center; background-size: cover;">
        <div class="row w-100 justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">

                <h2 class="text-center mb-5 display-3" style="color: #603700;">CREATE ACCOUNT</h2>

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert" style="font-size: 1.25rem;">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert" style="font-size: 1.25rem;">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form action="{{ route('signup.store') }}" method="POST" style="font-size: 1.5rem;">
                    @csrf

                    <div class="mb-5">
                        <input type="text"
                            class="form-control border-0 border-bottom rounded-0 p-3 @error('name') is-invalid @enderror"
                            name="name"
                            style="background-color: transparent; border-color: #603700 !important; color: #603700; font-size: 1.5rem;"
                            placeholder="Full Name" required value="{{ old('name') }}">
                        @error('name')
                            <div class="invalid-feedback" style="font-size: 1.1rem;">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <input type="email"
                            class="form-control border-0 border-bottom rounded-0 p-3 @error('email') is-invalid @enderror"
                            name="email"
                            style="background-color: transparent; border-color: #603700 !important; color: #603700; font-size: 1.5rem;"
                            placeholder="Email Address" required value="{{ old('email') }}">
                        @error('email')
                            <div class="invalid-feedback" style="font-size: 1.1rem;">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <input type="password"
                            class="form-control border-0 border-bottom rounded-0 p-3 @error('password') is-invalid @enderror"
                            name="password"
                            style="background-color: transparent; border-color: #603700 !important; color: #603700; font-size: 1.5rem;"
                            placeholder="Password" required>
                        @error('password')
                            <div class="invalid-feedback" style="font-size: 1.1rem;">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <input type="password" class="form-control border-0 border-bottom rounded-0 p-3"
                            name="password_confirmation"
                            style="background-color: transparent; border-color: #603700 !important; color: #603700; font-size: 1.5rem;"
                            placeholder="Confirm Password" required>
                    </div>

                    <div class="d-grid gap-2 mb-5">
                        <button type="submit" class="btn py-3"
                            style="background-color: #603700; color: white; font-size: 1.5rem;">
                            CREATE ACCOUNT
                        </button>
                    </div>

                    <div class="text-center">
                        <p class="mb-0" style="color: #603700; font-size: 1.2rem;">
                            Already have an account?
                            <a href="{{ route('login') }}" class="fw-bold text-decoration-none"
                                style="color: #603700;">Login now</a>
                        </p>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
