@extends('admin.partials.main')
@section('content-header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-12">
                <ol class="breadcrumb mb-0 p-2 bg-light" style="float: left;">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}">{{ __('language.dashboard') }}</a>
                    </li>
                    <li class="breadcrumb-item active">{{ __('language.clients') }}</li>
                </ol>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-6 col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"> {{ __('language.CLIENTS') }}
                        </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form method="GET" action="{{ route('admin.clients.index') }}"
                            class="mb-4 p-4 bg-light rounded shadow-sm">
                            <div class="row">
                                <div class="col-md-4 mb-2">
                                    <input type="text" name="name" class="form-control"
                                        placeholder="{{ __('language.SEARCHBYNAME') }}" value="{{ request('name') }}">
                                </div>

                                <div class="col-md-2 mb-2">
                                    <button type="submit"
                                        class="btn btn-primary w-100">{{ __('language.SEARCH') }}</button>
                                </div>
                            </div>
                        </form>

                        @if ($clients->total() > 0)
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th> {{ __('language.NAME') }} </th>
                                        <th> {{ __('language.EMAIL') }} </th>
                                        <th> {{ __('language.PHONE') }} </th>
                                        <th> {{ __('language.AGE') }} </th>
                                        <th> {{ __('language.STATUS') }} </th>
                                        <th style="width: 40px"> {{ __('language.ACTION') }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($clients as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->phone }}</td>
                                            <td>{{ $item->age }}</td>
                                            <td>{{ $item->status }}</td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <a href="{{ route('admin.client.edit', $item->id) }}"
                                                        class="btn btn-outline-primary btn-sm mr-2">
                                                        {{ __('language.EDIT') }}</a>

                                                    <form method="post"
                                                        action="{{ route('admin.client.destroy', $item->id) }}">
                                                        @method('delete')
                                                        @csrf
                                                        <button
                                                            onclick="return confirm('Are you sure you want to delete this client?')"
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
                                <p><span>{{ __('language.NOCLIENTWITHTHENAME') }}
                                    </span> "{{ request('name') }}"</p>
                                <a href="{{ route('admin.clients.index') }}" class="btn btn-success mt-2">Back</a>
                            @else
                                <p>{{ __('language.NOCLIENTS') }}</p>
                            @endif
                        @endif
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                        {{ $clients->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
