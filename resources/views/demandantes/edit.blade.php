@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center mb-4">Editar Directorio</h1>


        <form id="editUsersForm" action="{{ route('demandantes.update', $cliente->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <ul class="nav nav-tabs custom-tabs mb-4" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="datos-tab" data-bs-toggle="tab" data-bs-target="#datos"
                        type="button" role="tab" aria-controls="datos" aria-selected="true">Datos</button>
                </li>

            </ul>
            <input type="hidden" name="id" id="userId" value="{{ $cliente->id }}" />
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="datos" role="tabpanel" aria-labelledby="datos-tab">
                    <div class="row mb-4">
                        <div class="col">
                            <div data-mdb-input-init class="form-outline">
                                <label class="form-label" for="empresa">Empresa Demandante</label>
                                <input type="text" id="empresa_demandante" name="empresa_demandante" class="form-control"
                                    placeholder="Nombre Empresa" required
                                    value="{{ old('empresa_demandante', $cliente->empresa_demandante) }}" maxlength="30" />
                                @error('empresa_demandante')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div data-mdb-input-init class="form-outline">
                                <label class="form-label" for="rut">RUT/NIT</label>
                                <input type="text" id="rut_demandante" name="rut_demandante" class="form-control"
                                    placeholder="Número RUT/NIT" required maxlength="15"
                                    value="{{ old('rut_demandante', $cliente->rut_demandante) }}" />
                                @error('rut_demandante')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div data-mdb-input-init class="form-outline">
                                <label class="form-label" for="representante">Representante</label>
                                <input type="text" id="representante_demandante" name="representante_demandante"
                                    class="form-control" placeholder="Nombre Representante" maxlength="255"
                                    value="{{ old('representante_demandante', $cliente->representante_demandante) }}" />
                                @error('representante_demandante')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">

                        <div class="col">
                            <div data-mdb-input-init class="form-outline">
                                <label class="form-label" for="email">Email de representante</label>
                                <input type="email" id="email_demandante" name="email_demandante" class="form-control"
                                    placeholder="Correo Electrónico" maxlength="255"
                                    value="{{ old('email_demandante', $cliente->email_demandante) }}" />
                                @error('email_demandante')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div data-mdb-input-init class="form-outline">
                                <label class="form-label" for="telefono">Número Teléfono de representante</label>
                                <input type="text" id="telefono_demandante" name="telefono_demandante"
                                    class="form-control" placeholder="+5063046405009" maxlength="15"
                                    value="{{ old('telefono_demandante', $cliente->telefono_demandante) }}" />
                                @error('telefono_demandante')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div data-mdb-input-init class="form-outline">
                                <label class="form-label" for="domicilio">Domicilio</label>
                                <input type="text" id="domicilio_demandante" name="domicilio_demandante"
                                    class="form-control" placeholder="Domicilio" required maxlength="255"
                                    value="{{ old('domicilio_demandante', $cliente->domicilio_demandante) }}" />
                                @error('domicilio_demandante')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                    </div>


                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            // Validar campos de tipo text
                            document.querySelectorAll('input[type="text"]').forEach(function(input) {
                                input.addEventListener('input', function() {
                                    const maxLength = this.getAttribute('maxlength');
                                    let value = this.value;

                                    // Verificar específicamente el campo de RUT para permitir solo números y guiones
                                    if (this.id === 'rut_demandante') {
                                        value = value.replace(/[^0-9.-]/g,
                                            ''); // Reemplaza cualquier cosa que no sea número, punto o guion
                                    } else if (this.id === 'domicilio_demandante') {
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
                            document.querySelectorAll('#telefono_demandante').forEach(function(input) {
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
