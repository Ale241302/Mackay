@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="flex-grow-1 text-center mb-0">Directorio</h1>
        <br />
        @if (in_array(54, $permisosUsuario))
            <div class="d-flex justify-content-end">
                <a href="{{ route('demandantes.create') }}" class="btn btn-primary"
                    style="background-color: #1814F3; border-color: #1814F3;">+ Nuevo Directorio</a>
            </div>
        @endif
        <br />
        <form id="search-form" action="{{ route('demandantes.index') }}" method="GET" class="mb-3">
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
                        <th style="text-align: center">RUT</th>
                        <th style="text-align: center">Correo</th>
                        <th style="text-align: center">Telefono</th>
                        <th style="text-align: center">Acciones</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($clientes as $cliente)
                        <tr>
                            @if (in_array(53, $permisosUsuario))
                                <td style="text-align: center">{{ $cliente->id }}</td>
                                <td style="text-align: center">{{ $cliente->empresa_demandante }}</td>
                                <td style="text-align: center">{{ $cliente->rut_demandante }}</td>
                                <td style="text-align: center">{{ $cliente->email_demandante }}</td>
                                <td style="text-align: center">{{ $cliente->telefono_demandante }}</td>
                            @endif
                            <td class="action-buttons" style="text-align: center">
                                @if (in_array(55, $permisosUsuario))
                                    <a href="{{ route('demandantes.edit', $cliente->id) }}" class="btn btn-warning me-2"
                                        style="border-color: white; background-color: white; color: #1814F3; font-size: 20px; ">
                                        <i class="fas fa-edit"></i> <!-- Ícono de lápiz -->
                                    </a>
                                @endif
                                @if (in_array(56, $permisosUsuario))
                                    <button type="button" class="btn btn-danger"
                                        style="border-color: white; background-color: white; color: red; font-size: 20px;"
                                        data-bs-toggle="modal" data-bs-target="#confirmDeleteModal"
                                        data-action="{{ route('demandantes.destroy', $cliente->id) }}">
                                        <i class="fas fa-trash"></i> <!-- Ícono de basura -->
                                    </button>
                                @endif
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
                    url: '{{ route('demandantes.index') }}',
                    method: 'GET',
                    data: {
                        search: search
                    },
                    success: function(response) {
                        $('tbody').html($(response).find('tbody').html());
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
