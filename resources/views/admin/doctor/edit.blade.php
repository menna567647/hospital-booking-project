@extends('admin.partials.main')
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 m-auto">
                <div class="card shadow-sm border rounded">
                    <div class="card-header bg-light">
                        <h4 class="mb-0">{{ __('language.UPDATEDOCTOR') }}</h4>
                    </div>
                    <div class="card-body">
                        <form enctype="multipart/form-data" action="{{ route('admin.doctor.update', $doctor->id) }}"
                            method="POST">
                            @csrf
                            @method('PUT')

                            {{-- Doctor Name --}}
                            <div class="mb-3">
                                <label class="form-label">{{ __('language.DOCTORNAME') }}</label>
                                <input type="text" name="name" class="form-control"
                                    value="{{ old('name', $doctor->name) }}" placeholder="Enter doctor name">
                                @error('name')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Department --}}
                            <div class="mb-3">
                                <label class="form-label">{{ __('language.DEPARTMENT') }}</label>
                                <select name="department_id" class="form-control">
                                    <option value="" disabled>-- {{ __('Select Department') }} --</option>
                                    @foreach ($departments as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('department_id', $doctor->department_id) == $item->id ? 'selected' : '' }}>
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('department_id')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Phone --}}
                            <div class="mb-3">
                                <label class="form-label">{{ __('language.PHONE') }}</label>
                                <input type="text" name="phone" class="form-control"
                                    value="{{ old('phone', $doctor->phone) }}" placeholder="Enter phone number">
                                @error('phone')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Consultancy Fees --}}
                            <div class="mb-3">
                                <label class="form-label">{{ __('language.CONSULTANCYFEES') }}</label>
                                <input type="text" name="consultancy_fees" class="form-control"
                                    value="{{ old('consultancy_fees', $doctor->consultancy_fees) }}"
                                    placeholder="Enter consultancy fees">
                                @error('consultancy_fees')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Image --}}
                            <div class="mb-3">
                                <label class="form-label">{{ __('language.IMAGE') }}</label>
                                <input type="file" name="images" class="form-control">
                                @error('images')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Submit Button --}}
                            <div class="d-grid">
                                <button type="submit" class="btn btn-success">{{ __('language.UPDATE') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
