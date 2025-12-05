@extends('website.partials.main')
@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 mb-4">
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-header bg-primary text-white rounded-top-4">
                        <h5 class="mb-0"><i class="fa-solid fa-user-pen me-2"></i>{{ __('language.UPDATEMYPROFILE') }}</h5>
                    </div>
                    <div class="card-body bg-light">
                        <form action="{{ route('website.profile.update') }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label">{{ __('language.NAME') }}</label>
                                <input type="text" name="name" class="form-control"
                                    value="{{ old('name', auth()->user()->name) }}">
                                @error('name')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">{{ __('language.EMAIL') }}</label>
                                <input type="email" name="email" class="form-control"
                                    value="{{ old('email', auth()->user()->email) }}">
                                @error('email')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">{{ __('language.PHONE') }}</label>
                                <input type="text" name="phone" class="form-control"
                                    value="{{ old('phone', auth()->user()->phone) }}">
                                @error('phone')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">{{ __('language.AGE') }}</label>
                                <input type="text" name="age" class="form-control"
                                    value="{{ old('age', auth()->user()->age) }}">
                                @error('age')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-success w-100 fw-semibold">
                                <i class="fa-solid fa-floppy-disk me-1"></i> {{ __('language.UPDATE') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card shadow border-0 rounded-4">
                    <div class="card-header bg-danger text-white rounded-top-4">
                        <h5 class="mb-0"><i class="fa-solid fa-user-xmark me-2"></i>{{ __('language.DELETEMYACCOUNT') }}
                        </h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('website.profile.destroy', auth()->user()->id) }}" method="POST"
                            onsubmit="return confirm('هل أنت متأكد أنك تريد حذف حسابك؟ لا يمكن التراجع عن هذا!');">
                            @csrf
                            @method('delete')
                            <div class="mb-3">
                                <input type="password" name="password" class="form-control form-control-sm"
                                    placeholder="Enter Your Password">
                                @if ($errors->userDeletion->has('password'))
                                    <div class="text-danger mt-1">
                                        {{ $errors->userDeletion->first('password') }}
                                    </div>
                                @endif

                            </div>
                            <button type="submit" class="btn btn-danger btn-sm w-100">
                                <i class="fa-solid fa-trash me-1"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
