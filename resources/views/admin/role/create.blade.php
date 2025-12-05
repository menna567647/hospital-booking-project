@extends('admin.partials.main')
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 m-auto">
                <div class="card shadow-sm border rounded">
                    <div class="card-header bg-light">
                        <h4 class="mb-0">{{ __('language.ADDROLE') }}</h4>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('admin.role.store') }}">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">{{ __('language.NAME') }}</label>
                                <input type="text" name="name" class="form-control" placeholder="Enter role name"
                                    value="{{ old('name') }}">
                                @error('name')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold mb-3 d-flex align-items-center justify-content-between">
                                    {{ __('language.PERMISSIONS') }}
                                    <button type="button" class="btn btn-sm btn-outline-primary" id="selectAllBtn">
                                         {{ __('language.CHECKALL') }}
                                    </button>
                                </label>
                                @error('permissions')
                                    <div class="invalid-feedback d-block mb-3">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="row">
                                    @foreach ($permissions->groupBy('group') as $group => $permissionList)
                                        @php
                                            $groupSlug = Str::slug($group);
                                        @endphp
                                        <div class="col-md-6 col-lg-4 mb-4">
                                            <div class="border rounded p-3 h-100">
                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                    <h5 class="mb-0 text-primary">{{ $group }}</h5>
                                                    <button type="button"
                                                        class="btn btn-sm btn-outline-primary group-select-btn"
                                                        data-group="{{ $groupSlug }}">
                                                         {{ __('language.CHECKALL') }}
                                                    </button>
                                                </div>

                                                @foreach ($permissionList as $permission)
                                                    <div class="form-check mb-2">
                                                        <input type="checkbox"
                                                            class="form-check-input permission-checkbox checkbox-group-{{ $groupSlug }} @error('permissions') is-invalid @enderror"
                                                            name="permissions[]" value="{{ $permission->name }}"
                                                            id="permission_{{ $permission->id }}"
                                                            {{ in_array($permission->name, old('permissions', [])) ? 'checked' : '' }}>
                                                        <label class="form-check-label"
                                                            for="permission_{{ $permission->id }}">
                                                            {{ $permission->name }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-success">{{ __('language.ADD') }}</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
        <script>
            document.querySelectorAll('.group-select-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const group = this.dataset.groupF;
                    const checkboxes = document.querySelectorAll(`.checkbox-group-${group}`);
                    const allChecked = Array.from(checkboxes).every(cb => cb.checked);

                    checkboxes.forEach(cb => cb.checked = !allChecked);

                    this.textContent = allChecked ?
                        {{ __('language.CHECKALL') }} :
                        '{{ __('language.UNCHECKALL') }}';
                });
            });

            let allSelected = false;

            document.getElementById('selectAllBtn').addEventListener('click', function() {
                const checkboxes = document.querySelectorAll('.permission-checkbox');

                checkboxes.forEach(cb => cb.checked = !allSelected);

                this.textContent = allSelected ?
                    {{ __('language.CHECKALL') }} :
                    '{{ __('language.UNCHECKALL') }}';

                document.querySelectorAll('.group-select-btn').forEach(button => {
                    button.textContent = allSelected ?
                        {{ __('language.CHECKALL') }} :
                        '{{ __('language.UNCHECKALL') }}';
                });

                allSelected = !allSelected;
            });
        </script>
    @endpush