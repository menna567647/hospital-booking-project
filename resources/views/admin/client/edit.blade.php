@extends('admin.partials.main')
@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <!-- Card -->
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-light text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-user-shield me-2"></i> {{ __('language.UPDATECLIENT') }}
                        </h5>
                    </div>

                    <form method="POST" action="{{ route('admin.client.update', $client->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="card-body">

                            <!-- Status -->
                            <div>
                                <label class="form-label">{{ __('language.STATUS') }}</label>
                                <span class="text-danger">*</span>
                                <br>
                                <select name="status" class="form-select @error('status') is-invalid @enderror">
                                    <option value="active" @selected($client->status == 'active')>
                                        {{ __('language.ACTIVE') }}
                                    </option>
                                    <option value="blocked" @selected($client->status == 'blocked')>
                                        {{ __('language.BLOCKED') }}
                                    </option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                        <div class="card-footer bg-light text-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i> {{ __('language.UPDATE') }}
                            </button>
                        </div>
                    </form>
                </div>
                <!-- End Card -->
            </div>
        </div>
    </div>
@endsection
