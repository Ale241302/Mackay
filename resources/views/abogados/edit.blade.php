@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center mb-4">Editar Abogado</h1>
        <form id="editUsersForm" action="{{ route('abogados.update', $user->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" id="userId" value="{{ $user->id }}" />

            <div class="row mb-4">
                <div class="col">
                    <div data-mdb-input-init class="form-outline">
                        <label class="form-label" for="tipo_usuario">Rol</label>
                        <select id="tipo_usuario2" name="tipo_usuario" class="form-control" required>
                            @foreach (\App\Models\UserGroup::all() as $userGroup)
                                <option value="{{ $userGroup->id }}"
                                    {{ $userGroup->id == $user->tipo_usuario ? 'selected' : '' }}>
                                    {{ $userGroup->nombre }}
                                </option>
                            @endforeach
                        </select>
                        @error('tipo_usuario')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <div data-mdb-input-init class="form-outline">
                        <label class="form-label" for="estado">Estado</label>
                        <select id="estado" name="estado" class="form-control" required>
                            <option value="Activo" {{ $user->estado == 'Activo' ? 'selected' : '' }}>Activo</option>
                            <option value="Inactivo" {{ $user->estado == 'Desactivado' ? 'selected' : '' }}>Desactivado
                            </option>
                        </select>
                        @error('estado')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col">
                    <div data-mdb-input-init class="form-outline">
                        <label class="form-label" for="name">Nombre</label>
                        <input type="text" name="name" id="name2" class="form-control"
                            value="{{ old('name', $user->name) }}" required maxlength="20" />
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <div data-mdb-input-init class="form-outline">
                        <label class="form-label" for="apellido">Apellido</label>
                        <input type="text" name="apellido" id="apellido2" class="form-control"
                            value="{{ old('apellido', $user->apellido) }}" required maxlength="20" />
                        @error('apellido')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <div data-mdb-input-init class="form-outline">
                        <label class="form-label" for="name">Iniciales</label>
                        <input type="text" name="iniciales" id="iniciales2" class="form-control"
                            value="{{ old('iniciales', $user->iniciales) }}" required maxlength="20" />
                        @error('iniciales')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col">
                    <div data-mdb-input-init class="form-outline">
                        <label class="form-label" for="tipo_documento">Tipo de Documento</label>
                        <select id="tipo_documento2" name="tipo_documento" class="form-control" required>
                            @foreach (\App\Models\tipoDocumento::all() as $tipoDocumento)
                                <option value="{{ $tipoDocumento->id }}"
                                    {{ $tipoDocumento->id == $user->tipo_documento ? 'selected' : '' }}>
                                    {{ $tipoDocumento->nombre }}
                                </option>
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
                        <input type="text" name="numero_documento" id="numero_documento2" class="form-control"
                            value="{{ old('numero_documento', $user->numero_documento) }}" required maxlength="15" />
                        @error('numero_documento')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <div data-mdb-input-init class="form-outline">
                        <label class="form-label" for="email">Fecha Nacimiento</label>
                        <input type="date" id="fechan" name="fechan" class="form-control" max="{{ date('Y-m-d') }}"
                            value="{{ old('fechan', $user->fechan) }}" />

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
                        <input type="text" name="numero_telefonico" id="numero_telefonico2" class="form-control"
                            value="{{ old('numero_telefonico', $user->numero_telefonico) }}" required maxlength="15"
                            oninput="validatePhoneNumber(this)" />
                        @error('numero_telefonico')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
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
                <div class="col">
                    <div data-mdb-input-init class="form-outline">
                        <label class="form-label" for="email">Email</label>
                        <input type="email" name="email" id="email2" class="form-control"
                            value="{{ old('email', $user->email) }}" required />
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
                    accept=".jpg, .jpeg, .gif" onchange="previewImage(event)" />
                @error('profile_photo_path')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <!-- Mostrar imagen de perfil existente si hay una -->
                <div style="margin-top: 10px;">
                    <img id="image_preview"
                        src="{{ $user->profile_photo_path ? asset('storage/' . $user->profile_photo_path) : '#' }}"
                        alt="Vista Previa"
                        style="max-width: 10%; {{ $user->profile_photo_path ? '' : 'display: none;' }}" />
                </div>
            </div>

            <script>
                function previewImage(event) {
                    const input = event.target;
                    const reader = new FileReader();

                    reader.onload = function() {
                        const imagePreview = document.getElementById('image_preview');
                        imagePreview.src = reader.result; // Reemplazar la imagen de vista previa actual
                        imagePreview.style.display = 'block'; // Asegurarse de que la imagen de vista previa esté visible
                    };

                    if (input.files && input.files[0]) {
                        reader.readAsDataURL(input.files[0]); // Leer el archivo como una URL de datos
                    }
                }
            </script>

            <div class="text-center pt-1 mb-5 pb-1">
                <button type="button" class="btn btn-secondary btn-block fs-lg"
                    onclick="window.history.back();">Volver</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
@endsection
