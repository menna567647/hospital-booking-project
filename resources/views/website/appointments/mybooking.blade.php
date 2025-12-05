@extends('website.partials.main')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow-lg border-0 rounded-4">
                    <div
                        class="card-header bg-primary text-white rounded-top-4 d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">
                            <i class="fa-solid fa-notes-medical me-2"></i> {{ __('language.MYBOOKING') }}
                            <span class="badge bg-light text-primary fs-6">
                                <i class="fa-solid fa-calendar-check me-1"></i> {{ $client_booking_count }}
                            </span>
                        </h5>
                        <div class="d-flex flex-column  align-items-center">
                            <form method="post" action="{{ route('website.booking.destroy.all') }}">
                                @method('delete')
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure you want to delete all your bookings?');">
                                    Delete All<i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                            <a href="{{ route('website.bookings.index') }}" class="btn btn-light btn-sm fw-semibold mt-2">
                                <i class="fa-solid fa-arrow-left me-1"></i> Back
                            </a>
                        </div>
                    </div>

                    <div class="card-body bg-light">
                        @if (session('show_book_message'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('show_book_message') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        @if ($client_booking->isEmpty())
                            <div class="text-center text-muted py-5">
                                <i class="fa-solid fa-calendar-xmark fa-3x mb-3 text-secondary"></i>
                                <p class="mb-0 fs-5">You don’t have any bookings yet.</p>
                            </div>
                        @else
                            <div class="table-responsive">
                                <table class="table table-hover align-middle bg-white shadow-sm">
                                    <thead class="table-primary text-center">
                                        <tr>
                                            <th>{{ __('language.DOCTORNAME') }}</th>
                                            <th>{{ __('language.DEPARTMENT') }}</th>
                                            <th>{{ __('language.DAY') }}</th>
                                            <th>{{ __('language.TIME') }}</th>
                                            <th>{{ __('language.CONSULTANCYFEES') }}</th>
                                            <th>{{ __('language.DELETE') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        @foreach ($client_booking as $item)
                                            <tr>
                                                <td class="fw-semibold">{{ $item->doctor->name }}</td>
                                                <td>{{ $item->doctor->department->name }}</td>
                                                <td>
                                                    <span class="badge bg-info text-white mb-1">
                                                        {{ $item->day }}</span>
                                                    <br>
                                                </td>
                                                <td>
                                                    <span class="text-muted small">
                                                        {{ $item->start_time }} - {{ $item->end_time }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="badge bg-success text-white fs-6 px-3 py-2">
                                                        ${{ $item->doctor->consultancy_fees }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <form method="post"
                                                        action="{{ route('website.booking.destroy', $item->pivot->id) }}">
                                                        @method('delete')
                                                        @csrf
                                                        <button type="submit" class="btn btn-outline-danger btn-sm"
                                                            onclick="return confirm('Are you sure you want to delete this booking?');">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
