@extends('website.partials.main')
@section('content')
    <div class="container my-5">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-light p-2 rounded">
                <li class="breadcrumb-item"><a href="{{ route('website.page') }}">{{ __('language.HOME') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('language.SIGNIN') }}</li>
            </ol>
        </nav>

        <!-- Card Signin Form -->
        <div class="card shadow-sm mx-auto" style="max-width: 500px;">
            <div class="card-header bg-primary text-white text-center">
                <h4 class="mb-0">{{ __('language.SIGNIN') }}</h4>
            </div>
            <div class="card-body">
                @if (session('message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('message') }}
                    </div>
                @endif
                <form method="post" action="{{ route('website.login.submit') }}">
                    @csrf
                    <!-- Email -->
                    <div class="mb-3">
                        <label for="Email" class="form-label">{{ __('language.EMAIL') }}</label>
                        <input type="text" class="form-control @error('email') is-invalid @enderror" name="email"
                            id="Email" placeholder="{{ __('language.EMAIL') }}" value="{{ old('email') }}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label for="Password" class="form-label">{{ __('language.PASSWORD') }}</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                            id="Password" placeholder="{{ __('language.PASSWORD') }}">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Options -->
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="remember" id="remember">
                            <label class="form-check-label" for="remember">{{ 'Remember' }}</label>
                        </div>
                        <a href="{{ route('website.password.request') }}"
                            class="text-decoration-none">{{ 'Forget Your Password' }}</a>
                    </div>

                    <!-- Buttons -->
                    <div class="d-grid mb-2">
                        <button type="submit" class="btn btn-primary">{{ __('language.SIGNIN') }}</button>
                    </div>
                    <div class="text-center">
                        <small>{{ 'Don’t Have Account?' }} <a
                                href="{{ route('website.register') }}">{{ __('language.REGISTER') }}</a></small>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
