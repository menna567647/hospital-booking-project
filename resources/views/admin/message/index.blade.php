@extends('admin.partials.main')
@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-10 m-auto">
            <div class="card shadow-sm">
                <div class="card-header text-center">
                    <h5 class="mb-0">{{ __('language.MESSAGES') }}</h5>
                </div>
                <div class="card-body">
                    @if ($messages->total() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>{{ __('language.TITLE') }}</th>
                                        <th>{{ __('language.MESSAGE') }}</th>
                                        <th>{{ __('language.NAME') }}</th>
                                        <th>{{ __('language.EMAIL') }}</th>
                                        <th>{{ __('language.PHONE') }}</th>
                                        <th>{{ __('language.DELETE') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($messages as $item)
                                        <tr>
                                            <td>{{ $item->title }}</td>
                                            <td>{{ $item->text }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->phone }}</td>
                                            <td>
                                                <form method="post" action="{{ route('admin.message.destroy', $item->id) }}">
                                                    @method('delete')
                                                    @csrf
                                                    <button onclick="return confirm('Are you sure you want to delete this message?')" type="submit" class="btn btn-sm btn-danger">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-3">
                            {{ $messages->links() }}
                        </div>
                    @else
                        <p class="text-center">{{ __('language.NOMESSAGES') }}</p>                     
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

