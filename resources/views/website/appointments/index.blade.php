@extends('website.partials.main')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow-lg border-0 rounded-4">
                    <div
                        class="card-header bg-primary text-white d-flex justify-content-between align-items-center rounded-top-4">
                        <h5 class="mb-0">
                            <i class="fa-solid fa-calendar-check me-2"></i> {{ __('language.DOCTORSCHEDULE') }}
                        </h5>
                        <a href="{{ route('website.bookings.show') }}" class="btn btn-light btn-sm fw-semibold">
                            <i class="fa-solid fa-eye me-1"></i> Show My Bookings
                        </a>
                    </div>

                    <div class="card-body bg-light">
                        @if (session('book_message'))
                            <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                                {{ session('book_message') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table class="table table-hover align-middle shadow-sm bg-white">
                                <thead class="table-primary text-center">
                                    <tr>
                                        <th></th>
                                        <th>{{ __('language.DOCTORNAME') }}</th>
                                        <th>{{ __('language.DEPARTMENT') }}</th>
                                        <th>{{ __('language.DAY') }}</th>
                                        <th>{{ __('language.STARTTIME') }}</th>
                                        <th>{{ __('language.ENDTIME') }}</th>
                                        <th>{{ __('language.CONSULTANCYFEES') }}</th>
                                        <th>{{ __('language.ACTION') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @foreach ($doctors as $doctor)
                                        <tr>
                                            <td class="fw-semibold"><img src="{{asset($doctor->images) }}"></td>
                                            <td class="fw-semibold">{{ $doctor->name }}</td>
                                            <td>{{ $doctor->department->name }}</td>
                                            <td>
                                                @foreach ($doctor->doctorschedules as $schedule)
                                                    <span class="badge bg-info text-white mb-1">
                                                        {{ $schedule->day }}</span>
                                                    <br>
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach ($doctor->doctorschedules as $schedule)
                                                    <span class="text-muted small">{{ $schedule->start_time }}</span><br>
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach ($doctor->doctorschedules as $schedule)
                                                    <span class="text-muted small">{{ $schedule->end_time }}</span><br>
                                                @endforeach
                                            </td>
                                            <td>
                                                <span class="badge bg-success text-white fs-6 px-3 py-2">
                                                    ${{ $doctor->consultancy_fees }}
                                                </span>
                                            </td>
                                            <td>
                                                @foreach ($doctor->doctorschedules as $schedule)
                                                    <form class="mb-2" method="post"
                                                        action="{{ route('website.booking.store', $schedule->id) }}">
                                                        @csrf
                                                        <button type="submit" class="btn btn-outline-danger btn-sm"
                                                            onclick="return confirm('Are you sure you want to book this appointment?');">
                                                            <i class="fa-solid fa-calendar-plus me-1"></i> Book
                                                        </button>
                                                    </form>
                                                @endforeach
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        @if ($doctors->isEmpty())
                            <div class="text-center text-muted py-4">
                                <i class="fa-solid fa-circle-exclamation fa-2x mb-2 text-secondary"></i><br>
                                No doctors available at the moment.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
