@extends('admin.partials.main')
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-10 m-auto">
                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-start flex-wrap">
                        <div class="d-flex flex-column">
                            <h5 class="mb-2">{{ __('language.ROLES') }} </h5>
                            <a class="btn btn-success btn-sm" href="{{ route('admin.role.create') }}">
                                {{ __('language.ADDROLE') }}
                            </a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            @if ($roles->total() > 0)
                                <table class="table table-hover align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th scope="col"></th>
                                            <th scope="col">{{ __('language.NAME') }}</th>
                                            <th scope="col">{{ __('language.PERMISSIONS') }}</th>
                                            <th scope="col">{{ __('language.ACTION') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($roles as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->permissions_count }}</td>
                                                <td>
                                                    <a href="{{ route('admin.role.edit', $item->id) }}"
                                                        class="btn btn-sm btn-primary">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </a>
                                                    <form class="mt-2"
                                                        action="{{ route('admin.role.destroy', $item->id) }}"
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
                        <p class="text-center">{{ __('language.NOROLE') }}</p>
                        @endif
                        <div class="mt-3">
                            {{ $roles->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
