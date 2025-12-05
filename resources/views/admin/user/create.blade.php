@extends('admin.partials.main')
@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg rounded-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">{{ __('language.CREATEUSERACCOUNT') }}</h5>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('admin.user.store') }}">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">{{ __('language.USERNAME') }}</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                                @error('name')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">{{ __('language.EMAIL') }}</label>
                                <input type="text" name="email" class="form-control" value="{{ old('email') }}">
                                @error('email')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">{{ __('language.ROLE') }}</label>
                                <select name="role_name" id="role_name" class="form-control">
                                    <option selected disabled>-----Select Role-----</option>
                                    @foreach ($roles as $item)
                                        <option value="{{ $item->name }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('role_name')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">{{ __('language.PASSWORD') }}</label>
                                <input type="password" name="password" class="form-control">
                                @error('password')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">{{ __('language.PASSWORDCONFIRMATION') }}</label>
                                <input type="password" name="password_confirmation" class="form-control">
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-success fw-semibold">
                                    {{ __('language.CREATE') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
