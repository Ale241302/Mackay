@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center mb-4">Crear Cliente</h1>

        <form action="{{ route('clientes.store') }}" method="POST">
            @csrf

            <div class="tab-content" id="myTabContent">
                <div class="row mb-4">
                    <div class="col">
                        <div data-mdb-input-init class="form-outline">
                            <label class="form-label" for="empresa">Empresa Representada</label>
                            <input type="text" id="empresa" name="empresa" class="form-control"
                                placeholder="Nombre Empresa" required value="{{ old('empresa') }}" maxlength="30" />
                            @error('empresa')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <div data-mdb-input-init class="form-outline">
                            <label class="form-label" for="rut">RUT/NIT</label>
                            <input type="text" id="rut" name="rut" class="form-control"
                                placeholder="Número RUT/NIT" required maxlength="15" value="{{ old('rut') }}" />
                            @error('rut')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <div data-mdb-input-init class="form-outline">
                            <label class="form-label" for="domicilio">Domicilio</label>
                            <input type="text" id="domicilio" name="domicilio" class="form-control"
                                placeholder="Domicilio" required maxlength="255" value="{{ old('domicilio') }}" />
                            @error('domicilio')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col">
                        <div data-mdb-input-init class="form-outline">
                            @php
                                $paises = \App\Models\Pais::all();
                            @endphp
                            <label class="form-label" for="pais">País de constitución</label>
                            <select id="pais" name="pais" class="form-control" onchange="fetchCities(this.value)">
                                <option value="">Seleccione un país</option>
                                @foreach ($paises as $pais)
                                    <option value="{{ $pais->id }}">{{ $pais->nombre }}</option>
                                @endforeach
                            </select>
                            @error('pais')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <div data-mdb-input-init class="form-outline">
                            <label class="form-label" for="direccion">Dirección</label>
                            <input type="text" id="direccion" name="direccion" class="form-control"
                                placeholder="Dirección" value="{{ old('direccion') }}" maxlength="255" />
                            @error('direccion')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <div data-mdb-input-init class="form-outline">
                            <label class="form-label" for="ciudad">Ciudad</label>
                            <select id="ciudad" name="ciudad" class="form-control">
                                <option value="">Seleccione una ciudad</option>
                                <!-- Las opciones de ciudades se llenarán dinámicamente aquí -->
                            </select>
                            @error('ciudad')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col">
                        <div data-mdb-input-init class="form-outline">
                            <label class="form-label" for="asegurador">Codigo Postal</label>
                            <input type="number" id="postal" name="postal" class="form-control" placeholder="762501"
                                value="{{ old('postal') }}" />
                            @error('postal')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <div data-mdb-input-init class="form-outline">
                            <label class="form-label" for="representante">Representante legal</label>
                            <input type="text" id="representante" name="representante" class="form-control"
                                placeholder="Nombre Representante" maxlength="255" value="{{ old('representante') }}" />
                            @error('representante')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <div data-mdb-input-init class="form-outline">
                            <label class="form-label" for="email">Email de representante legal</label>
                            <input type="email" id="email" name="email" class="form-control"
                                placeholder="Correo Electrónico" maxlength="255" value="{{ old('email') }}" />
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                </div>
                <div class="row mb-4">
                    <div class="col">
                        <div data-mdb-input-init class="form-outline">
                            <label class="form-label" for="telefono">Número Teléfono de representante legal</label>
                            <input type="text" id="telefono" name="telefono" class="form-control"
                                placeholder="+5063046405009" maxlength="15" value="{{ old('telefono') }}" />
                            @error('telefono')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <div data-mdb-input-init class="form-outline">
                            <label class="form-label" for="ejecutivo">Ejecutivo encargado</label>
                            <input type="text" id="ejecutivo" name="ejecutivo" class="form-control"
                                placeholder="Nombre Ejecutivo" value="{{ old('ejecutivo') }}" maxlength="255" />
                            @error('ejecutivo')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <div data-mdb-input-init class="form-outline">
                            <label class="form-label" for="email2">Email de ejecutivo encargado</label>
                            <input type="email" id="email2" name="email2" class="form-control"
                                placeholder="Correo Electrónico" maxlength="255" value="{{ old('email2') }}" />
                            @error('email2')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                </div>
                <div class="row mb-4">

                    <div class="col">
                        <div data-mdb-input-init class="form-outline">
                            <label class="form-label" for="telefono2">Número Teléfono de ejecutivo encargado</label>
                            <input type="text" id="telefono2" name="telefono2" class="form-control"
                                placeholder="+5063046405009" maxlength="15" value="{{ old('telefono2') }}" />
                            @error('telefono2')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <div data-mdb-input-init class="form-outline">
                            <label class="form-label" for="sitio">Sitio Web</label>
                            <input type="text" id="sitio" name="sitio" class="form-control" placeholder="URL"
                                value="{{ old('sitio') }}" maxlength="255" />
                            @error('sitio')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                </div>


                <script>
                    function fetchCities(paisId) {
                        // Verifica que se haya seleccionado un país
                        if (paisId) {
                            // Realiza una solicitud AJAX al servidor
                            fetch(`/clientes/ciudades/${paisId}`)
                                .then(response => response.json())
                                .then(data => {
                                    const ciudadSelect = document.getElementById('ciudad');
                                    ciudadSelect.innerHTML = ''; // Limpia las opciones anteriores
                                    // Añade la opción predeterminada
                                    ciudadSelect.innerHTML = '<option value="">Seleccione una ciudad</option>';
                                    // Añade las nuevas opciones basadas en la respuesta del servidor
                                    data.forEach(ciudad => {
                                        const option = document.createElement('option');
                                        option.value = ciudad.id;
                                        option.textContent = ciudad.nombre;
                                        ciudadSelect.appendChild(option);
                                    });
                                })
                                .catch(error => console.error('Error al obtener ciudades:', error));
                        } else {
                            // Limpia el select de ciudades si no hay país seleccionado
                            document.getElementById('ciudad').innerHTML = '<option value="">Seleccione una ciudad</option>';
                        }
                    }
                    document.addEventListener('DOMContentLoaded', function() {
                        // Validar campos de tipo text
                        document.querySelectorAll('input[type="text"]').forEach(function(input) {
                            input.addEventListener('input', function() {
                                const maxLength = this.getAttribute('maxlength');
                                let value = this.value;

                                // Verificar específicamente el campo de RUT para permitir solo números y guiones
                                if (this.id === 'rut') {
                                    value = value.replace(/[^0-9.-]/g,
                                        ''); // Reemplaza cualquier cosa que no sea número, punto o guion
                                } else if (this.id === 'domicilio' || this.id === 'direccion' || this.id ===
                                    'postal') {
                                    // Permitir letras, números, espacios, guiones y símbolo numeral para 'domicilio' y 'direccion'
                                    value = value.replace(/[^a-zA-Z0-9\s-#]/g, '');
                                } else {
                                    // Validación general para otros campos de tipo texto
                                    value = value.replace(/[^a-zA-Z0-9.+/:\s#]/g, '');
                                }

                                // Verificar el maxlength
                                if (maxLength && value.length > maxLength) {
                                    value = value.slice(0, maxLength);
                                }

                                this.value = value;
                            });
                        });

                        // Validar campos de teléfono para permitir números, +, y -
                        document.querySelectorAll('#telefono, #telefono2').forEach(function(input) {
                            input.addEventListener('input', function() {
                                let value = this.value;

                                // Permite solo números, el signo más (+) y el espacio
                                value = value.replace(/[^0-9+\s]/g,
                                    ''); // Permite números, el signo más (+) y espacios

                                this.value = value;
                            });
                        });
                    });
                </script>




                <div class="text-center pt-1 mb-5 pb-1">
                    <button type="button" class="btn btn-secondary btn-block fs-lg mb-3"
                        onclick="window.history.back();">Volver</button>
                    <button class="btn btn-primary btn-block fs-lg mb-3" type="submit">Guardar</button>

                </div>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
@endsection
