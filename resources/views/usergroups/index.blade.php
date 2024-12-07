@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="flex-grow-1 text-center mb-0">Roles</h1>
        <br />
        @if (in_array(6, $permisosUsuario))
            <!-- Habilita el botón de crear solo si el usuario tiene el permiso correspondiente -->
            <div class="d-flex justify-content-end">
                <a href="{{ route('usergroups.create') }}" class="btn btn-primary"
                    style="background-color: #1814F3; border-color: #1814F3;">+ Nuevo Rol</a>
            </div>
        @endif
        <br />
        <form id="search-form" action="{{ route('usergroups.index') }}" method="GET" class="mb-3">
            <br />
            <div class="input-group">
                <input type="text" id="search-input" name="search" class="form-control"
                    placeholder="Buscar por nombre..." value="{{ $search }}">
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-bordered" style="text-align: center">
                <thead>
                    <tr>
                        <th style="text-align: center">ID</th>
                        <th style="text-align: center">Nombre</th>
                        <th style="text-align: center">Acciones</th>

                    </tr>
                </thead>
                <tbody>

                    @foreach ($userGroups as $userGroup)
                        <tr>
                            @if (in_array(5, $permisosUsuario))
                                <td style="text-align: center">{{ $userGroup->id }}</td>
                                <td style="text-align: center">{{ $userGroup->nombre }}</td>
                            @endif
                            <td class="action-buttons d-flex justify-content-center align-items-center gap-2 style="text-align:
                                center"">
                                <!-- Centra el contenido de la celda -->
                                <div class="d-flex justify-content-center align-items-center gap-2">
                                    @if (in_array(5, $permisosUsuario))
                                        <!-- Botón de editar -->
                                        <a href="{{ route('usergroups.ver', $userGroup->id) }}" class="btn btn-warning"
                                            style="border-color: white; background-color: white; color: #808080; font-size: 20px;">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    @endif
                                    @if (in_array(7, $permisosUsuario))
                                        <!-- Botón de editar -->
                                        <a href="{{ route('usergroups.edit', $userGroup->id) }}"
                                            class="btn btn-warning me-2"
                                            style="border-color: white; background-color: white; color: #1814F3; font-size: 20px; ">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    @endif

                                    @if (in_array(8, $permisosUsuario))
                                        @if ($userGroup->en_uso)
                                            <!-- Mostrar "En uso" si el grupo está en uso -->
                                            <span class="text-muted"
                                                style="border: 1px solid red; background-color: red; color: white!important; font-size: 16px; padding: 10px 10px; border-radius: 16px; display: inline-block;">
                                                En uso
                                            </span>
                                        @else
                                            <!-- Botón de eliminar -->
                                            <button type="button" class="btn btn-danger"
                                                style="border-color: white; background-color: white; color: red; font-size: 20px;"
                                                data-bs-toggle="modal" data-bs-target="#confirmDeleteModal"
                                                data-action="{{ route('usergroups.destroy', $userGroup->id) }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        @endif
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal de confirmación de eliminación -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmar Eliminación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que deseas eliminar este registro?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <form id="deleteForm" action="" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            var confirmDeleteModal = document.getElementById('confirmDeleteModal');

                            confirmDeleteModal.addEventListener('show.bs.modal', function(event) {
                                var button = event.relatedTarget; // El botón que activó el modal
                                var actionUrl = button.getAttribute(
                                    'data-action'); // Obtiene la URL de acción desde el atributo data-action
                                var form = document.getElementById('deleteForm'); // El formulario de eliminación
                                form.action = actionUrl; // Establece la URL de acción en el formulario
                            });
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $('#search-input').on('input', function() {
                var search = $(this).val();
                $.ajax({
                    url: '{{ route('usergroups.index') }}',
                    method: 'GET',
                    data: {
                        search: search
                    },
                    success: function(response) {
                        // Actualiza el contenido de la tabla con los nuevos resultados
                        $('tbody').html($(response).find('tbody').html());
                    }
                });
            });


        });
    </script>
@endsection
