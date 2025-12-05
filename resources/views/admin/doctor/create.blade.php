@extends('admin.partials.main')
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 m-auto">
                <div class="card shadow-sm border rounded">
                    <div class="card-header bg-light">
                        <h4 class="mb-0">{{ __('language.ADDDOCTOR') }}</h4>
                    </div>
                    <div class="card-body">
                        <form enctype="multipart/form-data" method="post" action="{{ route('admin.doctor.store') }}">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">{{ __('language.NAME') }}</label>
                                <input type="text" name="name" class="form-control" placeholder="Enter name"
                                    value="{{ old('name') }}">
                                @error('name')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">{{ __('language.DEPARTMENT') }}</label>
                                <select name="department_id" id="department_id" class="form-control">
                                    <option value="" selected disabled>----select department----</option>
                                    @foreach ($departments as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('department_id') == $item->id ? 'selected' : '' }}>
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('department_id')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">{{ __('language.PHONE') }}</label>
                                <input type="text" name="phone" class="form-control" placeholder="Enter Phone Number"
                                    value="{{ old('phone') }}">
                                @error('phone')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">{{ __('language.CONSULTANCYFEES') }}</label>
                                <input type="text" name="consultancy_fees" class="form-control"
                                    placeholder="Enter Consultancy Fees" value="{{ old('consultancy_fees') }}">
                                @error('consultancy_fees')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">{{ __('language.IMAGE') }}</label>
                                <input type="file" name="images" class="form-control">
                                @error('images')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-success">{{ __('language.ADD') }}</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
