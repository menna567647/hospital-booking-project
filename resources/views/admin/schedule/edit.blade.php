@extends('admin.partials.main')
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 m-auto">
                <div class="card shadow-sm border rounded">
                    <div class="card-header bg-light">
                        <h4 class="mb-0">{{ __('language.EDITDOCTOR') }}</h4>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('admin.schedule.update', $schedule->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label">{{ __('language.DOCTORNAME') }}</label>
                                <input type="hidden" name="doctor_id" value="{{ $schedule->doctor_id }}">
                                <input readonly class="form-control" value="{{ $schedule->doctor->name }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">{{ __('language.DAY') }}</label>
                                <input type="text" name="day" class="form-control" placeholder="Enter day"
                                    value="{{ old('day', $schedule->day) }}">
                                @error('day')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">{{ __('language.STARTTIME') }}</label>
                                <input type="time" name="start_time"
                                    value="{{ old('start_time', $schedule->start_time) }}">
                                @error('start_time')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">{{ __('language.ENDTIME') }}</label>
                                <input type="time" name="end_time" value="{{ old('end_time', $schedule->end_time) }}">
                                @error('end_time')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

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
