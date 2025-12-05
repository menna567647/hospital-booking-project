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
                        <form method="post" action="{{ route('admin.schedule.store') }}">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">{{ __('language.DOCTORNAME') }}</label>
                                <input readonly class="form-control" value="{{ $doctor->name }}">
                                <input type="hidden" name="doctor_id" value="{{ $doctor->id }}">

                            </div>

                            <div class="mb-3">
                                <label class="form-label">{{ __('language.DAY') }}</label>
                                <input type="text" name="day" class="form-control" placeholder="Enter day"
                                    value="{{ old('day') }}">
                                @error('day')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label ">{{ __('language.STARTTIME') }}</label>
                                <br>
                                <input type="time" name="start_time" value="{{ old('start_time') }}">
                                @error('start_time')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">{{ __('language.ENDTIME') }}</label>
                                <br>
                                <input type="time" name="end_time" value="{{ old('end_time') }}">
                                @error('end_time')
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
