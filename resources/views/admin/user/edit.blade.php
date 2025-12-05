@extends('admin.partials.main')
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-user-edit me-2"></i> {{ __('language.UPDATEUSER') }}
                    </h5>
                </div>

                <form method="POST" action="{{ route('admin.user.update', $user->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="card-body">

                        <div class="mb-3">
                            <label class="form-label">{{ __('language.NAME') }}</label>
                            <input type="text" name="name"
                                class="form-control @error('name') is-invalid @enderror"
                                placeholder="{{ __('language.NAME') }}" value="{{ old('name', $user->name) }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">{{ __('language.EMAIL') }}</label>
                            <input type="email" name="email"
                                class="form-control @error('email') is-invalid @enderror"
                                placeholder="{{ __('language.EMAIL') }}" value="{{ old('email', $user->email) }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Role -->
                        <div class="mb-3">
                            <label class="form-label">{{ __('language.ROLE') }}</label>
                            <span class="text-danger">*</span>
                            <select name="role_name" class="form-control @error('role_name') is-invalid @enderror">
                                <option disabled hidden>— {{ __('language.SELECTROLE') }} —</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}" 
                                        {{ $user->roles->first()?->name === $role->name ? 'selected' : '' }}>
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('role_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <input type="hidden" name="password" value="{{ $user->password }}">
                        <input type="hidden" name="password_confirmation" value="{{ $user->password }}">

                    </div>

                    <div class="card-footer bg-light text-end">
                        <button type="submit" class="btn btn-success fw-semibold">
                            <i class="fas fa-save me-1"></i> {{ __('language.UPDATE') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
