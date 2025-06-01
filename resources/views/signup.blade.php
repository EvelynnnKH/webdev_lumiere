@extends('base')

@section('content')
    <div class="container-fluid d-flex flex-column justify-content-center align-items-center"
        style="min-height: 80vh; background: url('{{ asset('img/autumncandle.jpeg') }}') no-repeat center center; background-size: cover; position: relative;">
        <div class="row w-100 justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="text-center">
                    <h1 class="display-4" style="font-family: 'Playfair Display'; color: #ffffff;">Lumière</h1>
                    <p class="lead" style="color: #ffffff;">The Art of Subtle Scents</p>
                </div>

                <div class="card shadow-sm border-0 p-4" style="background-color: #FFF3EB; border-radius: 10px;">
                    <div class="card-body">
                        <h2 class="text-center mb-4" style="color: #603700; font-family:'Playfair Display';">Create Account!
                        </h2>

                        <form method="POST" action="{{ route('signup.store') }}">
                            @csrf

                            <div class="mb-4">
                                <input type="text" name="name"
                                    class="form-control border-0 border-bottom rounded-0 p-0"
                                    style="background-color: transparent; border-color: #603700 !important; color: #603700;"
                                    placeholder="Enter your name" value="{{ old('name') }}" required>
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <input type="email" name="email"
                                    class="form-control border-0 border-bottom rounded-0 p-0"
                                    style="background-color: transparent; border-color: #603700 !important; color: #603700;"
                                    placeholder="Enter your email" value="{{ old('email') }}" required>
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <input type="password" name="password"
                                    class="form-control border-0 border-bottom rounded-0 p-0"
                                    style="background-color: transparent; border-color: #603700 !important; color: #603700;"
                                    placeholder="Enter your password" required>
                                @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <input type="password" name="password_confirmation"
                                    class="form-control border-0 border-bottom rounded-0 p-0"
                                    style="background-color: transparent; border-color: #603700 !important; color: #603700;"
                                    placeholder="Confirm your password" required>
                            </div>

                            <div class="d-grid gap-2 mb-3">
                                <button type="submit" class="btn btn-block py-2"
                                    style="background-color: #603700; color: white;">
                                    Create →
                                </button>
                            </div>
                        </form>

                        @if (session('success'))
                            <div class="alert alert-success text-center" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger text-center" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
