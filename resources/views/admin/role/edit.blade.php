@extends('admin.partials.main')
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 m-auto">
                <div class="card shadow-sm border rounded">
                    <div class="card-header bg-light">
                        <h4 class="mb-0">{{ __('language.UPDATEROLE') }}</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.role.update', $role->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            {{-- Role Name --}}
                            <div class="mb-3">
                                <label class="form-label">{{ __('language.NAME') }}</label>
                                <input type="text" name="name" class="form-control"
                                    value="{{ old('name', $role->name) }}" placeholder="Enter name">
                                @error('name')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Permission --}}
                            <div class="mb-3">
                                <label class="form-label fw-bold mb-3 d-flex align-items-center justify-content-between">
                                    {{ __('language.PERMISSIONS') }}
                                    <button type="button" class="btn btn-sm btn-outline-primary" id="selectAllBtn">
                                        {{ 'checkall' }}
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
                                                        {{ 'checkall' }}
                                                    </button>
                                                </div>

                                                @foreach ($permissionList as $permission)
                                                    <div class="form-check mb-2">
                                                        <input type="checkbox"
                                                            class="form-check-input permission-checkbox checkbox-group-{{ $groupSlug }} @error('permissions') is-invalid @enderror"
                                                            name="permissions[]" value="{{ $permission->name }}"
                                                            id="permission_{{ $permission->id }}"
                                                            {{ in_array($permission->name, old('permissions', $rolePermissions ?? [])) ? 'checked' : '' }}>
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

                            {{-- Submit Button --}}
                            <div class="d-grid">
                                <button type="submit" class="btn btn-success">{{ __('language.UPDATE') }}</button>
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
                const group = this.dataset.group;
                const checkboxes = document.querySelectorAll(`.checkbox-group-${group}`);
                const allChecked = Array.from(checkboxes).every(cb => cb.checked);

                checkboxes.forEach(cb => cb.checked = !allChecked);

                this.textContent = allChecked ?
                    '{{ __('language.CHECKALL') }}' :
                    '{{ __('language.UNCHECKALL') }}';

                updateGlobalSelectAllBtn();
            });
        });

        document.getElementById('selectAllBtn').addEventListener('click', function() {
            const checkboxes = document.querySelectorAll('.permission-checkbox');
            const allChecked = Array.from(checkboxes).every(cb => cb.checked);
            checkboxes.forEach(cb => cb.checked = !allChecked);

            this.textContent = allChecked ?
                '{{ __('language.CHECKALL') }}' :
                '{{ __('language.UNCHECKALL') }}';

            updateGroupButtons();
        });

        function updateGroupButtons() {
            document.querySelectorAll('.group-select-btn').forEach(button => {
                const group = button.dataset.group;
                const checkboxes = document.querySelectorAll(`.checkbox-group-${group}`);
                const allChecked = Array.from(checkboxes).every(cb => cb.checked);
                button.textContent = allChecked ?
                    '{{ __('language.UNCHECKALL') }}' :
                    '{{ __('language.CHECKALL') }}';
            });
        }

        function updateGlobalSelectAllBtn() {
            const checkboxes = document.querySelectorAll('.permission-checkbox');
            const allChecked = Array.from(checkboxes).every(cb => cb.checked);
            document.getElementById('selectAllBtn').textContent = allChecked ?
                '{{ __('language.UNCHECKALL') }}' :
                '{{ __('language.CHECKALL') }}';
        }

        updateGroupButtons();
        updateGlobalSelectAllBtn();
    </script>
@endpush
