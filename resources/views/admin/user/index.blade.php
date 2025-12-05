@extends('admin.partials.main')
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-10 m-auto">
                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-start flex-wrap">
                        <div class="d-flex flex-column">
                            <h5 class="mb-2">{{ __('language.USERS') }}({{ $totalUsers }})</h5>
                            <a class="btn btn-success btn-sm" href="{{ route('admin.user.create') }}">
                                {{ __('language.ADDUSER') }}
                            </a>
                        </div>
                        <div>
                            <form method="GET" action="{{ route('admin.users.index') }}" class="d-grid gap-2"
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
                            @if ($users->total() > 0)
                                <table class="table table-striped table-hover align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th>#</th>
                                            <th>{{ __('language.NAME') }}</th>
                                            <th>{{ __('language.EMAIL') }}</th>
                                            <th>{{ __('language.ROLE') }}</th>
                                            <th>{{ __('language.ACTION') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->email }}</td>
                                                <td> <span class="badge bg-success text-white fs-6 px-3 py-2">
                                                        {{ $item->roles->pluck('name')->join(', ') }}
                                                    </span>
                                                <td>
                                                    <div class="d-flex">
                                                        <a href="{{ route('admin.user.edit', $item->id) }}"
                                                            class="btn btn-sm btn-primary mr-2">
                                                            <i class="fa-solid fa-pen-to-square"></i>
                                                        </a>
                                                        <form method="post"
                                                            action="{{ route('admin.user.destroy', $item->id) }}">
                                                            @method('delete')
                                                            @csrf
                                                            <button
                                                                onclick="return confirm('Are you sure you want to delete this user?')"
                                                                type="submit" class="btn btn-sm btn-danger">
                                                                <i class="fa-solid fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                @if (request()->filled('name'))
                                    <p><span>{{ __('language.NOUSERWITHTHENAME') }}
                                        </span> "{{ request('name') }}"</p>
                                    <a href="{{ route('admin.users.index') }}"
                                        class="btn btn-outline-success mt-2">Back</a>
                                @else
                                    <p>{{ __('language.NOUSERS') }}</p>
                                @endif
                            @endif
                        </div>

                        <div class="mt-3">
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
