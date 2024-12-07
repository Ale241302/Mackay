@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="flex-grow-1 text-center mb-0">Subcasos</h1>
        <br />
        @if (in_array(38, $permisosUsuario))
            <div class="d-flex justify-content-end">
                {{-- <a href="{{ route('subcasos.create') }}" class="btn btn-primary"
                    style="background-color: #1814F3; border-color: #1814F3;">+ Nuevo Subcaso</a> --}}
            </div>
        @endif
        <br />
        <form id="search-form" action="{{ route('subcasos.index') }}" method="GET" class="mb-3">
            <div class="input-group">
                <input type="text" id="search-input" name="search" class="form-control" placeholder="Buscar por nombre..."
                    value="{{ $search }}">
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-bordered" style="text-align: center; white-space: nowrap;">
                <thead>
                    <tr>

                        <th style="text-align: center; white-space: nowrap;">Referencia</th>
                        <th style="text-align: center; white-space: nowrap;">Caso</th>
                        <th style="text-align: center; white-space: nowrap;">Cliente</th>
                        <th style="text-align: center; white-space: nowrap; max-width: 200px;">Nave</th>
                        <th style="text-align: center; white-space: nowrap;">Role</th>

                        <th style="text-align: center; white-space: nowrap;">Tribunal</th>
                        <th style="text-align: center; white-space: nowrap;">Activo</th>
                        <th style="text-align: center; white-space: nowrap;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clientes as $cliente)
                        <tr>
                            @if (in_array(37, $permisosUsuario))
                                <td style="white-space: nowrap; text-align: center;">{{ $cliente->refsub }}</td>
                                <td style="white-space: nowrap; text-align: center;">
                                    {{ $caso[$cliente->caso]->id ?? 'No disponible' }}
                                </td>
                                <td style="white-space: nowrap; text-align: center;">
                                    {{ $caso[$cliente->caso]->cliente->empresa ?? 'No disponible' }}
                                </td>

                                <td
                                    style="white-space: nowrap; max-width: 200px; overflow: hidden; text-overflow: ellipsis; text-align: center;">
                                    {{ $cliente->descripcion_caso }}
                                </td>
                                <td style="white-space: nowrap; text-align: center;">
                                    {{ implode(', ', json_decode($cliente->rol_caso)) }}</td>

                                <td style="white-space: nowrap; text-align: center;">
                                    @php
                                        // Comprobamos que $cliente->tribunal no esté vacío o nulo antes de decodificar
                                        $tribunalIds = !empty($cliente->tribunal)
                                            ? json_decode($cliente->tribunal, true)
                                            : [];

                                        $tribunalName = 'No disponible'; // Valor predeterminado

                                        // Si $tribunalIds es un array y tiene al menos un elemento
                                        if (is_array($tribunalIds) && !empty($tribunalIds)) {
                                            $firstId = $tribunalIds[0]; // Tomar el primer ID del array

                                            // Verificar si el tribunal existe en la colección $tribunal y obtener el nombre
                                            if (isset($tribunal[$firstId])) {
                                                $tribunalName = $tribunal[$firstId]->nombre; // Cambia 'nombre' por el nombre del campo correcto
                                            }
                                        }
                                    @endphp

                                    {{ $tribunalName }}
                                    <!-- Imprime el nombre del primer tribunal o muestra 'No disponible' -->
                                </td>

                                <td style="white-space: nowrap; text-align: center;">
                                    <div class="d-flex justify-content-center align-items-center form-check form-switch">
                                        <input class="form-check-input" type="checkbox" data-id="{{ $cliente->id }}"
                                            {{ $cliente->estado === 'Activo' ? 'checked' : '' }}>
                                    </div>
                                </td>
                            @endif
                            <td class="action-buttons" style="white-space: nowrap;">
                                <div class="d-inline-flex">
                                    @if (in_array(37, $permisosUsuario))
                                        <a href="{{ route('subcasos.ver', $cliente->id) }}" class="btn btn-warning me-2"
                                            style="border-color: white; background-color: white; color: #808080; font-size: 20px;">
                                            <i class="fas fa-eye"></i> <!-- Ícono de lápiz -->
                                        </a>
                                    @endif
                                    @if (in_array(39, $permisosUsuario))
                                        <a href="{{ route('subcasos.edit', $cliente->id) }}" class="btn btn-warning me-2"
                                            style="border-color: white; background-color: white; color: #1814F3; font-size: 20px;">
                                            <i class="fas fa-edit"></i> <!-- Ícono de lápiz -->
                                        </a>
                                    @endif
                                    @if (in_array(40, $permisosUsuario))
                                        <button type="button" class="btn btn-danger"
                                            style="border-color: white; background-color: white; color: red; font-size: 20px;"
                                            data-bs-toggle="modal" data-bs-target="#confirmDeleteModal"
                                            data-action="{{ route('subcasos.destroy', $cliente->id) }}">
                                            <i class="fas fa-trash"></i> <!-- Ícono de basura -->
                                        </button>
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
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $('#search-input').on('input', function() {
                var search = $(this).val();
                $.ajax({
                    url: '{{ route('subcasos.index') }}',
                    method: 'GET',
                    data: {
                        search: search
                    },
                    success: function(response) {
                        $('tbody').html($(response).find('tbody').html());
                    }
                });
            });

            $('tbody').on('change', '.form-check-input', function() {
                var userId = $(this).data('id');
                var isChecked = $(this).is(':checked');
                var status = isChecked ? 'Activo' : 'Desactivado';

                $.ajax({
                    url: '{{ route('subcasos.updateStatus') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: userId,
                        estado: status
                    },
                    success: function(response) {
                        console.log('Estado actualizado');
                    },
                    error: function(response) {
                        console.error('Error al actualizar el estado');
                    }
                });
            });

            var confirmDeleteModal = document.getElementById('confirmDeleteModal');
            confirmDeleteModal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget;
                var actionUrl = button.getAttribute('data-action');
                var form = document.getElementById('deleteForm');
                form.action = actionUrl;
            });
        });
    </script>
@endsection
