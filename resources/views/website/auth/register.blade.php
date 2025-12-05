@extends("website.partials.main")
@section('content')
<div class="container my-5">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-light p-2 rounded">
            <li class="breadcrumb-item"><a href="{{ route('website.page') }}">{{ __('language.HOME') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('language.REGISTER') }}</li>
        </ol>
    </nav>

    <!-- Card Form -->
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">{{ __('language.REGISTER') }}</h4>
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('website.register.submit') }}">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">{{ __('language.NAME') }}</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" 
                        name="name" placeholder="{{ __('language.NAME') }}" value="{{ old('name') }}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">{{ __('language.EMAIL') }}</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                        name="email" placeholder="{{ __('language.EMAIL') }}" value="{{ old('email') }}">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="age" class="form-label">{{ __('language.AGE') }}</label>
                    <input type="text" class="form-control @error('age') is-invalid @enderror" id="age"
                        name="age" placeholder="{{ __('language.AGE') }}" value="{{ old('age') }}">
                    @error('age')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">{{ __('language.PHONE') }}</label>
                    <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone"
                        name="phone" placeholder="{{ __('language.PHONE') }}" value="{{ old('phone') }}">
                    @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">{{ __('language.PASSWORD') }}</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" 
                        id="password" name="password" placeholder="{{ __('language.PASSWORD') }}">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">{{ __('language.PASSWORDCONFIRMATION') }}</label>
                    <input type="password" class="form-control" id="password_confirmation" 
                        name="password_confirmation" placeholder="{{ __('language.PASSWORDCONFIRMATION') }}">
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">{{ __('language.CREATE') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
