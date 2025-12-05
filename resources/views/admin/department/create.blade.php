

@extends("admin.partials.main")
@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-md-6 col-lg-5 m-auto">
            <div class="card shadow-sm border rounded">
                <div class="card-body">
                    <form method="post" action="{{ route('admin.department.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-semibold">{{ __('language.DEPARTMENTNAME') }}</label>
                            <input type="text" name="name" class="form-control" placeholder="ENTER DEPARTMENT NAME">
                            @error('name')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-success fw-semibold">
                                {{ __('language.CREATEDEPARTMENT') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection