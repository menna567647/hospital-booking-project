@extends('admin.partials.main')
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 m-auto">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h5 class="mb-0">{{ __('language.UPDATE_PASSWORD') }}</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.user.password.update',Auth::user()->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            
                            <div class="mb-3">
                                <label class="form-label">{{ __('language.PASSWORD') }}</label>
                                <input type="password" name="password" class="form-control"  placeholder="Enter Password">
                                @error('password')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">{{ __('language.PASSWORDCONFIRMATION') }}</label>
                                <input type="password" class="form-control" name="password_confirmation"
                                    placeholder="Enter Password Confirmation">
                            </div>

                            <button type="submit" class="btn btn-primary w-100">{{ __('language.UPDATE') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
