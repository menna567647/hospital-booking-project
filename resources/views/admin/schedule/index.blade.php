@extends('admin.partials.main')
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-10 m-auto">
                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-start flex-wrap">
                        <div class="d-flex flex-column">
                            <h5 class="mb-2">{{ __('language.DOCTORSCHEDULE') }}</h5>
                            <a href="{{ route('admin.doctors.index') }}" class="btn btn-outline-success">Back To Doctors
                                Table</a>
                        </div>
                        <div>
                            <form method="GET" action="{{ route('admin.schedules.index') }}" class="d-grid gap-2"
                                style="max-width: 200px;">
                                <input type="text" name="name" class="form-control form-control-sm"
                                    placeholder="{{ __('language.SEARCHBYNAME') }}" value="{{ request('name') }}">

                                <button type="submit" class="btn btn-primary btn-sm w-100">
                                    {{ __('language.SEARCH') }}
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            @if ($schedules->total() > 0)
                                <table class="table table-hover align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th scope="col">{{ __('language.DOCTORNAME') }}</th>
                                            <th scope="col">{{ __('language.DAY') }}</th>
                                            <th scope="col">{{ __('language.STARTTIME') }}</th>
                                            <th scope="col">{{ __('language.ENDTIME') }}</th>
                                            <th scope="col">{{ __('language.ACTION') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($schedules as $item)
                                            <tr>
                                                <td>{{ $item->doctor->name }}</td>
                                                <td>{{ $item->day }}</td>
                                                <td>{{ $item->start_time }}</td>
                                                <td>{{ $item->end_time }}</td>
                                                <td>
                                                    <a href="{{ route('admin.schedule.edit', $item->id) }}"
                                                        class="btn btn-sm btn-primary">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                        </div>
                    @else
                        @if (request()->filled('name'))
                            <p><span>{{ __('language.NODOCTORWITHTHENAME') }}
                                </span> "{{ request('name') }}"</p>
                                <a href="{{route('admin.schedules.index')}}" class="btn btn-success mt-2">Back</a>
                        @else
                            <p class="text-center">{{ __('language.NOAPPOINTMENTS') }}</p>
                        @endif
                        @endif

                    </div>
                    <div class="mt-3">
                        {{ $schedules->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
