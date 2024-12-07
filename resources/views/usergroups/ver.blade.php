@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center mb-4">Rol</h1>
        <form action="" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Nombre</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Ingresar Nombre"
                    value="{{ old('name', $userGroup->nombre) }}" readonly maxlength="30" />
                @error('name')
                    <div class="error-message text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="permissions" class="form-label">Permisos</label>
                @if (isset($tipospermisos) && $tipospermisos->isNotEmpty())
                    @foreach ($tipospermisos->groupBy('modulo') as $modulo => $permisos)
                        @php
                            $modulePermissions = $permisos->pluck('id')->toArray();
                            $allPermissionsChecked = !array_diff($modulePermissions, $selectedPermissions);
                        @endphp
                        <div class="mb-3">
                            <div class="d-flex align-items-center">
                                <div class="form-check me-3">
                                    <input class="form-check-input select_all_module" type="checkbox"
                                        id="select_all_{{ $modulo }}" data-module="{{ $modulo }}"
                                        {{ $allPermissionsChecked ? 'checked' : '' }} disabled>
                                    <label class="form-check-label" for="select_all_{{ $modulo }}">Módulo
                                        {{ $modulo }}</label>
                                </div>
                                <div class="arrow ms-2" data-module="{{ $modulo }}">
                                    <i class="bi bi-chevron-down" id="chevron_{{ $modulo }}"></i>
                                </div>
                            </div>
                            <div class="mt-2 hidden permissions-list" data-module="{{ $modulo }}">
                                <div class="row g-3">
                                    @foreach ($permisos as $permission)
                                        <div class="col-md-4">
                                            <div class="form-check">
                                                <input class="form-check-input permission-checkbox" type="checkbox"
                                                    name="permissions[]" value="{{ $permission->id }}"
                                                    data-module="{{ $modulo }}"
                                                    id="permission_{{ $permission->id }}"
                                                    {{ in_array($permission->id, $selectedPermissions) ? 'checked' : '' }}
                                                    disabled>
                                                <label class="form-check-label"
                                                    for="permission_{{ $permission->id }}">{{ $permission->nombre }}</label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p>No hay permisos disponibles.</p>
                @endif
            </div>

            <div class="text-center pt-1 mb-5 pb-1">
                <button type="button" class="btn btn-secondary btn-block fs-lg mb-3"
                    onclick="window.history.back();">Volver</button>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var selectAllModuleCheckboxes = document.querySelectorAll('.select_all_module');

            selectAllModuleCheckboxes.forEach(function(moduleCheckbox) {
                moduleCheckbox.addEventListener('change', function() {
                    var module = this.dataset.module;
                    var isChecked = this.checked;
                    document.querySelectorAll(`.permission-checkbox[data-module='${module}']`)
                        .forEach(function(permissionCheckbox) {
                            permissionCheckbox.checked = isChecked;
                        });
                });
            });

            var permissionCheckboxes = document.querySelectorAll('.permission-checkbox');

            permissionCheckboxes.forEach(function(checkbox) {
                checkbox.addEventListener('change', function() {
                    var module = this.dataset.module;
                    var moduleCheckbox = document.querySelector(
                        `.select_all_module[data-module='${module}']`);
                    var allChecked = Array.from(document.querySelectorAll(
                        `.permission-checkbox[data-module='${module}']`)).every(function(c) {
                        return c.checked;
                    });
                    moduleCheckbox.checked = allChecked;
                });
            });

            const arrows = document.querySelectorAll('.arrow');

            arrows.forEach((arrow) => {
                arrow.addEventListener('click', function() {
                    const module = arrow.getAttribute('data-module');
                    const permissionsList = document.querySelector(
                        `.permissions-list[data-module="${module}"]`);
                    const chevronIcon = document.getElementById(`chevron_${module}`);

                    if (permissionsList.classList.contains('hidden')) {
                        permissionsList.classList.remove('hidden');
                        chevronIcon.classList.add('bi-chevron-up');
                        chevronIcon.classList.remove('bi-chevron-down');
                    } else {
                        permissionsList.classList.add('hidden');
                        chevronIcon.classList.add('bi-chevron-down');
                        chevronIcon.classList.remove('bi-chevron-up');
                    }
                });
            });
        });
    </script>
@endsection
