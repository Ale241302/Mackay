@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center mb-4">Editar Cliente</h1>


        <form id="editUsersForm" action="{{ route('clientes.update', $cliente->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <ul class="nav nav-tabs custom-tabs mb-4" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="datos-tab" data-bs-toggle="tab" data-bs-target="#datos"
                        type="button" role="tab" aria-controls="datos" aria-selected="true">Datos</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="casos-tab" data-bs-toggle="tab" data-bs-target="#casos" type="button"
                        role="tab" aria-controls="casos" aria-selected="false">Casos</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="finanzas-tab" data-bs-toggle="tab" data-bs-target="#finanzas"
                        type="button" role="tab" aria-controls="finanzas" aria-selected="false">Finanzas</button>
                </li>
            </ul>
            <input type="hidden" name="id" id="userId" value="{{ $cliente->id }}" />
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="datos" role="tabpanel" aria-labelledby="datos-tab">
                    <div class="row mb-4">
                        <div class="col">
                            <div data-mdb-input-init class="form-outline">
                                <label class="form-label" for="empresa">Empresa Representada</label>
                                <input type="text" id="empresa" name="empresa" class="form-control"
                                    placeholder="Nombre Empresa" required value="{{ old('empresa', $cliente->empresa) }}"
                                    maxlength="255" />
                                @error('empresa')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div data-mdb-input-init class="form-outline">
                                <label class="form-label" for="rut">RUT/NIT</label>
                                <input type="text" id="rut" name="rut" class="form-control"
                                    placeholder="Número RUT/NIT" required maxlength="15"
                                    value="{{ old('rut', $cliente->rut) }}" />
                                @error('rut')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div data-mdb-input-init class="form-outline">
                                <label class="form-label" for="domicilio">Domicilio</label>
                                <input type="text" id="domicilio" name="domicilio" class="form-control"
                                    placeholder="Domicilio" required maxlength="255"
                                    value="{{ old('domicilio', $cliente->domicilio) }}" />
                                @error('domicilio')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col">
                            <div data-mdb-input-init class="form-outline">
                                <label class="form-label" for="pais">País de constitución</label>
                                <select id="pais" name="pais" class="form-control"
                                    onchange="fetchCities(this.value)">
                                    <option value="">Seleccione un país</option>
                                    @foreach (\App\Models\Pais::all() as $Pais)
                                        <option value="{{ $Pais->id }}"
                                            {{ $Pais->id == $cliente->pais ? 'selected' : '' }}>
                                            {{ $Pais->nombre }}
                                        </option>
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
                                    placeholder="Dirección" value="{{ old('direccion', $cliente->direccion) }}"
                                    maxlength="255" />
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
                                <input type="number" id="postal" name="postal" class="form-control"
                                    placeholder="762501" maxlength="255"
                                    value="{{ old('postal', $cliente->postal) }}" />
                                @error('postal')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div data-mdb-input-init class="form-outline">
                                <label class="form-label" for="representante">Representante legal</label>
                                <input type="text" id="representante" name="representante" class="form-control"
                                    placeholder="Nombre Representante"
                                    value="{{ old('representante', $cliente->representante) }}" maxlength="255" />
                                @error('representante')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div data-mdb-input-init class="form-outline">
                                <label class="form-label" for="email">Email de representante legal</label>
                                <input type="email" id="email" name="email" class="form-control"
                                    placeholder="Correo Electrónico" maxlength="255"
                                    value="{{ old('email', $cliente->email) }}" />
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                    </div>
                    <div class="row mb-4">
                        <div class="col">
                            <div data-mdb-input-init class="form-outline">
                                <label class="form-label" for="telefono">Número Teléfono de representante
                                    legal</label>
                                <input type="text" id="telefono3" name="telefono" class="form-control"
                                    placeholder="+5063046405009" maxlength="15"
                                    value="{{ old('telefono', $cliente->telefono) }}" />
                                @error('telefono')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div data-mdb-input-init class="form-outline">
                                <label class="form-label" for="ejecutivo">Ejecutivo encargado</label>
                                <input type="text" id="ejecutivo" name="ejecutivo" class="form-control"
                                    placeholder="Nombre Ejecutivo" value="{{ old('ejecutivo', $cliente->ejecutivo) }}"
                                    maxlength="255" />
                                @error('ejecutivo')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div data-mdb-input-init class="form-outline">
                                <label class="form-label" for="email2">Email de ejecutivo encargado</label>
                                <input type="email" id="email2" name="email2" class="form-control"
                                    placeholder="Correo Electrónico" maxlength="255"
                                    value="{{ old('email2', $cliente->email2) }}" />
                                @error('email2')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                    </div>
                    <div class="row mb-4">
                        <div class="col">
                            <div data-mdb-input-init class="form-outline">
                                <label class="form-label" for="telefono2">Número Teléfono de ejecutivo
                                    encargado</label>
                                <input type="text" id="telefono4" name="telefono2" class="form-control"
                                    placeholder="+5063046405009" maxlength="15"
                                    value="{{ old('telefono2', $cliente->telefono2) }}" />
                                @error('telefono2')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div data-mdb-input-init class="form-outline">
                                <label class="form-label" for="sitio">Sitio Web</label>
                                <input type="text" id="sitio" name="sitio" class="form-control"
                                    placeholder="URL" value="{{ old('sitio', $cliente->sitio) }}" maxlength="255" />
                                @error('sitio')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                    </div>


                    <script>
                        function toggleLabel(checkbox, labelId) {
                            const label = document.getElementById(labelId);
                            label.textContent = checkbox.checked ? 'Sí' : 'No';
                        }

                        document.addEventListener('DOMContentLoaded', function() {
                            const paisId = document.getElementById('pais').value; // Obtiene el ID del país seleccionado
                            if (paisId) {
                                fetchCities(paisId,
                                    {{ $cliente->ciudad }}); // Llama a fetchCities con el país y ciudad seleccionada
                            }
                        });

                        function fetchCities(paisId, ciudadId = null) {
                            if (paisId) {
                                // Realiza una solicitud AJAX al servidor
                                fetch(`/clientes/ciudades/${paisId}`)
                                    .then(response => response.json())
                                    .then(data => {
                                        const ciudadSelect = document.getElementById('ciudad');
                                        ciudadSelect.innerHTML = ''; // Limpia las opciones anteriores
                                        ciudadSelect.innerHTML = '<option value="">Seleccione una ciudad</option>';
                                        // Añade las nuevas opciones basadas en la respuesta del servidor
                                        data.forEach(ciudad => {
                                            const option = document.createElement('option');
                                            option.value = ciudad.id;
                                            option.textContent = ciudad.nombre;
                                            if (ciudadId && ciudad.id == ciudadId) {
                                                option.selected = true; // Marca como seleccionada la ciudad que coincide
                                            }
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
                            document.querySelectorAll('#telefono3, #telefono4').forEach(function(input) {
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
                </div>
                <div class="tab-pane fade" id="casos" role="tabpanel" aria-labelledby="casos-tab">

                    <div class="table-responsive">
                        <br />
                        <table class="table table-bordered" style="text-align: center">
                            <thead>
                                <tr>
                                    <th style="text-align: center; white-space: nowrap;">Referencia</th>
                                    <th style="text-align: center; white-space: nowrap; max-width: 200px;">Descripcion</th>
                                    <th style="text-align: center; white-space: nowrap;">Abogados</th>
                                    <th style="text-align: center; white-space: nowrap;">Rol</th>
                                    <th style="text-align: center; white-space: nowrap;">Fecha Inicio</th>
                                    <th style="text-align: center; white-space: nowrap;">Horas</th>
                                    <th style="text-align: center; white-space: nowrap;">Finalizado</th>
                                    <th style="text-align: center; white-space: nowrap;">Fecha Finalizacion</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($casos as $index => $subcaso)
                                    <tr>
                                        <td style="white-space: nowrap; text-align: center;">
                                            {{ $subcaso->referencia_caso ?? 'N/A' }}</td>
                                        <td style="white-space: nowrap; text-align: center;">
                                            {{ $subcaso->descripcion_caso ?? 'N/A' }}</td>
                                        <td style="white-space: nowrap; text-align: center;">
                                            @if (!empty($subcaso->abogadosNombres))
                                                {{ implode(', ', $subcaso->abogadosNombres) }}
                                            @else
                                                No asignado
                                            @endif
                                        </td>
                                        <td style="white-space: nowrap; text-align: center;">
                                            {{ implode(', ', json_decode($subcaso->rol_caso)) }}</td>
                                        <td style="white-space: nowrap; text-align: center;">
                                            {{ $subcaso->created_at ? $subcaso->created_at->format('Y-m-d') : 'N/A' }}
                                        </td>
                                        @php
                                            // Fecha de creación
                                            $created_at = $subcaso->created_at;

                                            // Fecha de fin o fecha actual si no existe fecha de fin
                                            $fecha_fin = $subcaso->fecha_fin ?? now();

                                            // Calcular la diferencia en horas
                                            $horas = $created_at->diffInHours($fecha_fin);

                                            // Convertir a entero para mostrar solo la parte entera
                                            $horasEnteras = intval($horas);
                                        @endphp

                                        <td style="white-space: nowrap; text-align: center;">
                                            {{ $horasEnteras }}
                                        </td>
                                        <td style="white-space: nowrap; text-align: center;">
                                            @if ($subcaso->fecha_fin && $subcaso->fecha_fin <= now())
                                                Sí
                                            @else
                                                No
                                            @endif
                                        </td>

                                        <td style="white-space: nowrap; text-align: center;">
                                            {{ $subcaso->fecha_fin ?? 'N/A' }}</td>



                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="finanzas" role="tabpanel" aria-labelledby="finanzas-tab">
                    <!-- Contenido de Finanzas -->
                    <!-- Aquí irán los campos financieros, como Cobro fijo, Cobro hora, Cobro % -->

                </div>

                <div class="text-center pt-1 mb-5 pb-1">
                    <button type="button" class="btn btn-secondary btn-block fs-lg"
                        onclick="window.history.back();">Volver</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>

                </div>
        </form>


    </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
@endsection
