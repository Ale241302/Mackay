@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center mb-4">Editar Tribunal</h1>
        <form action="{{ route('tribunal.update', $userGroup->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Nombre</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Ingresar Nombre"
                    value="{{ old('name', $userGroup->nombre) }}" required maxlength="100" />
                @error('name')
                    <div class="error-message text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Nombre</label>
                <select id="ciudad" name="ciudad" class="form-control" required>
                    <option value="">Seleccione una ciudad</option>
                    @foreach (\App\Models\Ciudad::orderBy('nombre', 'asc')->get() as $ciudades)
                        <option value="{{ $ciudades->id }}" {{ $ciudades->id == $userGroup->ciudad ? 'selected' : '' }}>
                            {{ $ciudades->nombre }}
                        </option>
                    @endforeach
                </select>
                @error('pais')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
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
