@extends('admin.partials.main')
@section('content')
    <div class="container my-5">
        <div class="row">
            <div class="col-md-10 m-auto">
                <div class="card shadow-sm border rounded">
                    <div class="card-header bg-primary text-white">
                        <div class="d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">{{ __('language.DEPARTMENTS') }}</h5>
                            <a href="{{ route('admin.department.create') }}" class="btn btn-success fw-semibold">
                                <i class="fa-solid fa-plus me-1"></i> {{ __('language.CREATEDEPARTMENT') }}
                            </a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover align-middle text-center">
                                <thead class="table-light">
                                    <tr>
                                        <th>{{ __('language.NAME') }}</th>
                                        <th>{{ __('language.DOCTOR') }}</th>
                                        <th>{{ __('language.ACTION') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($departments as $item)
                                        <tr>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->doctors_count }}</td>
                                            <td>
                                               <form method="post" action="{{ route('admin.department.destroy', $item->id) }}">
                                                    @method('delete')
                                                    @csrf
                                                    <button onclick="return confirm('Are you sure you want to delete this department?')" type="submit" class="btn btn-sm btn-danger">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-3 d-flex justify-content-center">
                            {{ $departments->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
