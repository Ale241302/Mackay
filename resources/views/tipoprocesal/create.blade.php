@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center mb-4">Crear Etapa Procesal</h1>
        <form action="{{ route('tipoprocesal.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nombre</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Ingresar Nombre" required
                    maxlength="30" />
                <div class="error-message text-danger" id="nameError"></div>
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
