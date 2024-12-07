@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center mb-4">Crear Actividad</h1>
        <form action="{{ route('tipoactividad.store') }}" method="POST">
            @csrf
            <div class="row mb-4">
                <div class="col">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Ingresar Nombre"
                        required maxlength="30" />
                    <div class="error-message text-danger" id="nameError"></div>
                </div>
                <div class="col">
                    <label for="tipo" class="form-label">Tipo</label>
                    <select name="tipo" id="tipo" class="form-control" required>
                        <option value="" disabled selected>Seleccione un tipo</option>
                        <option value="Presencial" {{ old('tipo') == 'Presencial' ? 'selected' : '' }}>Presencial</option>
                        <option value="Oficina Virtual" {{ old('tipo') == 'Oficina Virtual' ? 'selected' : '' }}>Oficina
                            Virtual</option>
                        <option value="Correo" {{ old('tipo') == 'Correo' ? 'selected' : '' }}>Correo</option>
                        <option value="Oficina Interna" {{ old('tipo') == 'Oficina Interna' ? 'selected' : '' }}>Oficina
                            Interna</option>
                        <option value="Oficina Externa" {{ old('tipo') == 'Oficina Externa' ? 'selected' : '' }}>Oficina
                            Externa</option>
                        <option value="Juzgado" {{ old('tipo') == 'Juzgado' ? 'selected' : '' }}>Juzgado</option>
                    </select>
                    <div class="error-message text-danger" id="nameError"></div>
                </div>
                @php
                    $montohoras = \App\Models\MontoHora::all();
                @endphp
                <div class="col">
                    <div data-mdb-input-init class="form-outline">
                        <label class="form-label" for="rut">Monto por Hora</label>
                        <select id="precio" name="precio" class="form-control">
                            <option value="" disabled selected>Seleccione un monto</option>
                            @foreach ($montohoras as $montohora)
                                <option value="{{ $montohora->id }}"
                                    {{ old('precio') == $montohora->id ? 'selected' : '' }}>
                                    {{ $montohora->id }}
                                </option>
                            @endforeach
                        </select>
                        @error('precio')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>



            <div class="text-center pt-1 mb-5 pb-1">
                <button type="button" class="btn btn-secondary btn-block fs-lg mb-3"
                    onclick="window.history.back();">Volver</button>
                <button class="btn btn-primary btn-block fs-lg mb-3" type="submit">Guardar</button>

            </div>
        </form>
    </div>
@endsection



@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
@endsection
