@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center mb-4">Editar Actividad</h1>
        <form action="{{ route('tipoactividad.update', $userGroup->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row mb-4">
                <div class="col">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Ingresar Nombre"
                        value="{{ old('name', $userGroup->nombre) }}" required maxlength="30" />
                    @error('name')
                        <div class="error-message text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col">
                    <label for="tipo" class="form-label">Tipo</label>
                    <select name="tipo" id="tipo" class="form-control" required>
                        <option value="" disabled {{ old('tipo', $userGroup->tipo) == '' ? 'selected' : '' }}>
                            Seleccione un tipo</option>
                        <option value="Presencial" {{ old('tipo', $userGroup->tipo) == 'Presencial' ? 'selected' : '' }}>
                            Presencial</option>
                        <option value="Oficina Virtual"
                            {{ old('tipo', $userGroup->tipo) == 'Oficina Virtual' ? 'selected' : '' }}>Oficina Virtual
                        </option>
                        <option value="Correo" {{ old('tipo', $userGroup->tipo) == 'Correo' ? 'selected' : '' }}>Correo
                        </option>
                        <option value="Oficina Interna"
                            {{ old('tipo', $userGroup->tipo) == 'Oficina Interna' ? 'selected' : '' }}>Oficina Interna
                        </option>
                        <option value="Oficina Externa"
                            {{ old('tipo', $userGroup->tipo) == 'Oficina Externa' ? 'selected' : '' }}>Oficina Externa
                        </option>
                        <option value="Juzgado" {{ old('tipo', $userGroup->tipo) == 'Juzgado' ? 'selected' : '' }}>Juzgado
                        </option>
                    </select>
                    @error('tipo')
                        <div class="error-message text-danger">{{ $message }}</div>
                    @enderror
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
                                    {{ $montohora->id == $userGroup->precio ? 'selected' : '' }}>
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
