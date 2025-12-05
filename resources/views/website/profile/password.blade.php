@extends('website.partials.main')
@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-header bg-primary text-white rounded-top-4">
                        <h5 class="mb-0"><i class="fa-solid fa-key me-2"></i>{{ __('language.UPDATEPASSWORD') }}</h5>
                    </div>
                    <div class="card-body bg-light">
                        <form class="mt-3"
                            action="{{ route('website.profile.password.update', auth()->user()->id) }}"
                            method="post">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label">{{ __('language.PASSWORD') }}</label>
                                <input type="password" name="password" class="form-control" 
                                 placeholder="Enter Password">
                                @error('password')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">{{ __('language.PASSWORDCONFIRMATION') }}</label>
                                <input type="password" class="form-control" name="password_confirmation"
                                    placeholder="Enter Password Confirmation">
                            </div>

                            <button type="submit" class="btn btn-primary w-100 fw-semibold">
                                <i class="fa-solid fa-floppy-disk me-1"></i> {{ __('language.UPDATE') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
