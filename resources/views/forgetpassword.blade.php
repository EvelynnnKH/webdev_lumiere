@extends('base')

@section('content')
    <div class="container-fluid d-flex justify-content-center align-items-center"
        style="min-height: 80vh; background: url('{{ asset('img/autumncandle.jpeg') }}') no-repeat center center; background-size: cover;">
        <div class="row w-100 justify-content-center">
            <div class="col-md-6 col-lg-4">

                <div class="card shadow-sm border-0 p-4" style="background-color: #FFF3EB; border-radius: 10px;">
                    <div class="card-body">
                        <h2 class="text-center mb-4" style="color: #603700;">Reset Password</h2>

                        {{-- Show success message --}}
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        {{-- Show validation errors --}}
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('forget-password.submit') }}" id="resetPasswordForm">
                            @csrf
                            <div class="mb-4">
                                <input type="email" class="form-control border-0 border-bottom rounded-0 p-0"
                                    name="email"
                                    style="background-color: transparent; border-color: #603700 !important; color: #603700;"
                                    placeholder="Enter email address" required value="{{ old('email') }}">
                            </div>

                            <div class="mb-4">
                                <input type="password" class="form-control border-0 border-bottom rounded-0 p-0"
                                    name="new_password"
                                    style="background-color: transparent; border-color: #603700 !important; color: #603700;"
                                    placeholder="Enter new password" required>
                            </div>

                            <div class="mb-4">
                                <input type="password" class="form-control border-0 border-bottom rounded-0 p-0"
                                    name="new_password_confirmation"
                                    style="background-color: transparent; border-color: #603700 !important; color: #603700;"
                                    placeholder="Confirm new password" required>
                            </div>

                            <div class="d-grid gap-2 mb-3">
                                <button type="submit" class="btn btn-block py-2"
                                    style="background-color: #603700; color: white;">Reset Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
