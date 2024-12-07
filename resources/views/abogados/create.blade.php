@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center mb-4">Crear Abogado</h1>
        <form action="{{ route('abogados.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" id="tipo_usuario" name="tipo_usuario" value="5">

            <div class="row mb-4">
                <div class="col">
                    <div data-mdb-input-init class="form-outline">
                        <label class="form-label" for="nombre">Nombre</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Nombre"
                            required value="{{ old('name') }}" maxlength="20" />
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <div data-mdb-input-init class="form-outline">
                        <label class="form-label" for="apellido">Apellido</label>
                        <input type="text" id="apellido" name="apellido" class="form-control" placeholder="Apellido"
                            required maxlength="20" value="{{ old('apellido') }}" />
                        @error('apellido')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <div data-mdb-input-init class="form-outline">
                        <label class="form-label" for="name">Iniciales</label>
                        <input type="text" name="iniciales" id="iniciales" class="form-control"
                            value="{{ old('iniciales') }}" required maxlength="20" />
                        @error('iniciales')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col">
                    <div data-mdb-input-init class="form-outline">
                        @php
                            $tipoDocumentos = \App\Models\tipoDocumento::all();
                        @endphp
                        <label class="form-label" for="tipo_documento">Tipo de Documento</label>
                        <select id="tipo_documento" name="tipo_documento" class="form-control" required>
                            @foreach ($tipoDocumentos as $tipoDocumento)
                                <option value="{{ $tipoDocumento->id }}">{{ $tipoDocumento->nombre }}</option>
                            @endforeach
                        </select>
                        @error('tipo_documento')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <div data-mdb-input-init class="form-outline">
                        <label class="form-label" for="numero_documento">Número de Documento</label>
                        <input type="text" id="numero_documento" name="numero_documento" class="form-control"
                            placeholder="Número de Documento" required maxlength="15"
                            value="{{ old('numero_documento') }}" />
                        @error('numero_documento')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <div data-mdb-input-init class="form-outline">
                        <label class="form-label" for="email">Fecha Nacimiento</label>
                        <input type="date" id="fechan" name="fechan" class="form-control" max="{{ date('Y-m-d') }}"
                            value="{{ old('fechan') }}" />

                        @error('fechan')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col">
                    <div data-mdb-input-init class="form-outline">
                        <label class="form-label" for="numero_telefonico">Número Telefónico</label>
                        <input type="number" id="numero_telefonico" name="numero_telefonico" class="form-control"
                            placeholder="Número Telefónico" required maxlength="15" value="{{ old('numero_telefonico') }}"
                            oninput="validatePhoneNumber(this)" />
                        @error('numero_telefonico')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <script>
                        function validatePhoneNumber(input) {
                            // Permite solo números y el signo +
                            input.value = input.value.replace(/[^0-9+]/g, '');

                            // Limita la longitud a 15 caracteres
                            if (input.value.length > 15) {
                                input.value = input.value.slice(0, 15);
                            }
                        }
                    </script>
                </div>
                <div class="col">
                    <div data-mdb-input-init class="form-outline">
                        <label class="form-label" for="email">Correo</label>
                        <input type="email" id="email" name="email" class="form-control"
                            placeholder="Correo Electrónico" required value="{{ old('email') }}" />
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div data-mdb-input-init class="form-outline">
                <br />
                <label class="form-label" for="profile_photo_path">Foto Perfil</label>
                <input type="file" id="profile_photo_path" name="profile_photo_path" class="form-control"
                    accept=".jpg, .jpeg, .gif" value="{{ old('profile_photo_path') }}" onchange="previewImage(event)" />
                @error('profile_photo_path')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <!-- Imagen de vista previa -->
                <div style="margin-top: 10px;">
                    <img id="image_preview" src="#" alt="Vista Previa" style="max-width: 10%; display: none;" />
                </div>
            </div>

            <script>
                function previewImage(event) {
                    const input = event.target;
                    const reader = new FileReader();

                    reader.onload = function() {
                        const imagePreview = document.getElementById('image_preview');
                        imagePreview.src = reader.result;
                        imagePreview.style.display = 'block'; // Mostrar la imagen de vista previa
                    };

                    if (input.files && input.files[0]) {
                        reader.readAsDataURL(input.files[0]); // Leer el archivo como una URL de datos
                    }
                }
            </script>

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
