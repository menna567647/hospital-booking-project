@extends('admin.partials.main')
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-10 m-auto">
                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-start flex-wrap">
                        <div class="d-flex flex-column">
                            <h5 class="mb-2">{{ __('language.DOCTORS') }} ({{ $totalDoctors }})</h5>
                            <a class="btn btn-success btn-sm" href="{{ route('admin.doctor.create') }}">
                                {{ __('language.ADDDOCTOR') }}
                            </a>
                        </div>
                        <div>
                            <form method="GET" action="{{ route('admin.doctors.index') }}" class="d-grid gap-2"
                                style="max-width: 200px;">
                                <input type="text" name="name" class="form-control form-control-sm"
                                    placeholder="{{ __('language.SEARCHBYNAME') }}" value="{{ request('name') }}">
                                <button type="submit"
                                    class="btn btn-primary btn-sm w-100">{{ __('language.SEARCH') }}</button>
                            </form>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            @if ($doctors->total() > 0)
                                <table class="table table-hover align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th scope="col"></th>
                                            <th scope="col">{{ __('language.DOCTORNAME') }}</th>
                                            <th scope="col">{{ __('language.DEPARTMENT') }}</th>
                                            <th scope="col">{{ __('language.PHONE') }}</th>
                                            <th scope="col">{{ __('language.CONSULTANCYFEES') }}</th>
                                            <th scope="col">{{ __('language.ACTION') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($doctors as $item)
                                            <tr>
                                                <td>

                                                    <img src="{{ asset($item->images) }}" alt="{{ $item->name }}"
                                                        class="img-thumbnail"
                                                        style="width:80px; height:80px; object-fit:cover;">
                                                </td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->department->name }}</td>
                                                <td>{{ $item->phone }}</td>
                                                <td>{{ $item->consultancy_fees }}</td>
                                                <td>
                                                    <a href="{{ route('admin.doctor.edit', $item->id) }}"
                                                        class="btn btn-sm btn-primary">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </a>

                                                    <a class="btn btn-warning btn-sm"
                                                        href="{{ route('admin.schedule.create', $item->id) }}">
                                                        {{ __('language.ADDDOCTORSCHEDULE') }}
                                                    </a>
                                                    <form class="mt-2"
                                                        action="{{ route('admin.doctor.destroy', $item->id) }}"
                                                        method="POST" style="display:inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger"
                                                            onclick="return confirm('هل أنت متأكد من الحذف؟')">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </button>
                                                    </form>
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
                            <a href="{{ route('admin.doctors.index') }}" class="btn btn-success mt-2">Back</a>
                        @else
                            <p class="text-center">{{ __('language.NODOCTOR') }}</p>
                        @endif
                        @endif
                        <div class="mt-3">
                            {{ $doctors->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
