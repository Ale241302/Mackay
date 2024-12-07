@extends('layouts.app')

@section('content')
    <div class="container">


        <form id="editUsersForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <h1 class="text-center mb-4">Ref. {{ $subcaso->refsub }} / Caso {{ $subcaso->descripcion_caso }} </h1>
            <input type="hidden" name="id" id="userId" value="{{ $subcaso->id }}" />
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <ul class="nav nav-tabs custom-tabs mb-4" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="partes-tab" data-bs-toggle="tab" data-bs-target="#partes"
                        type="button" role="tab" aria-controls="partes" aria-selected="true">Partes</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="datos-tab" data-bs-toggle="tab" data-bs-target="#datos" type="button"
                        role="tab" aria-controls="datos" aria-selected="false">Datos del Caso</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="actividades-tab" data-bs-toggle="tab" data-bs-target="#actividades"
                        type="button" role="tab" aria-controls="actividades" aria-selected="false">Actividades</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="documentos-tab" data-bs-toggle="tab" data-bs-target="#documentos"
                        type="button" role="tab" aria-controls="documentos" aria-selected="false">Documentos</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="movimiento-tab" data-bs-toggle="tab" data-bs-target="#movimiento"
                        type="button" role="tab" aria-controls="movimiento" aria-selected="false">Movimiento</button>
                </li>

                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="finanzas-tab" data-bs-toggle="tab" data-bs-target="#finanzas"
                        type="button" role="tab" aria-controls="finanzas" aria-selected="false">Finanzas</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="partes" role="tabpanel" aria-labelledby="partes-tab">
                    <div class="row mb-4">
                        <br />
                        @php
                            // Obtener solo los casos con estado "Activo"
                            $casosActivos = \App\Models\Caso::where('estado', 'Activo')->get();
                        @endphp
                        <div class="col">
                            <div data-mdb-input-init class="form-outline">
                                <label class="form-label" for="caso">Caso Principal</label>
                                <select id="casos" name="caso" class="form-control"
                                    onchange="fetchCasoData(this.value)" disabled>
                                    <option value="" selected>Seleccione un caso</option>
                                    @foreach ($casosActivos as $casosActivo)
                                        <option value="{{ $casosActivo->id }}" data-empresa="{{ $casosActivo->empresa }}"
                                            data-empresa-demandante="{{ $casosActivo->empresa_demandante }}"
                                            data-rut-demandante="{{ $casosActivo->rut_demandante }}"
                                            data-email-demandante="{{ $casosActivo->email_demandante }}"
                                            data-telefono-demandante="{{ $casosActivo->telefono_demandante }}"
                                            data-representante-demandante="{{ $casosActivo->representante_demandante }}"
                                            data-domicilio-demandante="{{ $casosActivo->domicilio_demandante }}"
                                            {{ $casosActivo->id == $subcaso->caso ? 'selected' : '' }}>
                                            {{ $casosActivo->referencia_caso }}
                                        </option>
                                    @endforeach

                                </select>
                                @error('caso')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col">
                            <ul class="nav nav-tabs custom-tabs mb-4" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="cliente-tab" data-bs-toggle="tab"
                                        data-bs-target="#cliente" type="button" role="tab" aria-controls="cliente"
                                        aria-selected="true">Cliente</button>
                                </li>
                            </ul>

                            <div class="row mb-4">
                                @php
                                    // Obtener solo los clientes con estado "Activo"
                                    $clientesActivos = \App\Models\Cliente::where('estado', 'Activo')->get();
                                    $demantantes = \App\Models\Demandante::get();
                                @endphp

                                <div class="col">
                                    <div data-mdb-input-init class="form-outline">
                                        <label class="form-label" for="empresa">Empresa</label>
                                        <select id="empresa" name="empresa" class="form-control" required
                                            onchange="fetchClienteData(this.value)" disabled>
                                            <option value="" selected>Seleccione una empresa</option>
                                            @foreach ($clientesActivos as $cliente)
                                                <option value="{{ $cliente->id }}"
                                                    {{ $cliente->id == $subcaso->empresa ? 'selected' : '' }}>
                                                    {{ $cliente->empresa }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('empresa')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col">
                                    <div data-mdb-input-init class="form-outline">
                                        <label class="form-label" for="rut">RUT/NIT</label>
                                        <input type="text" id="rut" name="rut" class="form-control"
                                            placeholder="Número RUT/NIT" readonly maxlength="15"
                                            value="{{ old('rut') }}" />
                                        @error('rut')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col">
                                    <div data-mdb-input-init class="form-outline">
                                        <label class="form-label" for="email">Email</label>
                                        <input type="email" id="email" name="email" class="form-control"
                                            placeholder="Correo Electrónico" maxlength="255" value="{{ old('email') }}"
                                            readonly />
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <div data-mdb-input-init class="form-outline">
                                        <label class="form-label" for="telefono">Número Teléfono</label>
                                        <input type="text" id="telefono" name="telefono" class="form-control"
                                            placeholder="+5063046405009" maxlength="15" value="{{ old('telefono') }}"
                                            readonly />
                                        @error('telefono')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                            </div>

                            <div class="row mb-4">
                                <div class="col">
                                    <div data-mdb-input-init class="form-outline">
                                        <label class="form-label" for="representante">Representante legal</label>
                                        <input type="text" id="representante" name="representante"
                                            class="form-control" placeholder="Nombre Representante" maxlength="255"
                                            value="{{ old('representante') }}" readonly />
                                        @error('representante')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <div data-mdb-input-init class="form-outline">
                                        <label class="form-label" for="domicilio">Domicilio</label>
                                        <input type="text" id="domicilio" name="domicilio" class="form-control"
                                            placeholder="Domicilio" readonly maxlength="255"
                                            value="{{ old('domicilio') }}" />
                                        @error('domicilio')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>


                            </div>
                        </div>
                        <div class="col">
                            <ul class="nav nav-tabs custom-tabs mb-4" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="demandante-tab" data-bs-toggle="tab"
                                        data-bs-target="#demandante" type="button" role="tab"
                                        aria-controls="demandante" aria-selected="true">Demandante</button>
                                </li>
                            </ul>
                            <div class="row mb-4">
                                <div class="col">
                                    <div data-mdb-input-init class="form-outline">
                                        <label class="form-label" for="empresa">Empresa Demandante</label>
                                        <select id="demandante" name="demandante" class="form-control" disabled
                                            onchange="fetchDemandanteData(this.value)">
                                            <option value="" selected>Seleccione un demantante</option>
                                            @foreach ($demantantes as $demantante)
                                                <option value="{{ $demantante->id }}"
                                                    {{ $demantante->rut_demandante == $subcaso->rut_demandante ? 'selected' : '' }}>
                                                    {{ $demantante->empresa_demandante }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('demandante')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col">
                                    <div data-mdb-input-init class="form-outline">
                                        <label class="form-label" for="empresa">Empresa</label>
                                        <input type="text" id="empresa_demandante" name="empresa_demandante"
                                            class="form-control" placeholder="Nombre Empresa" readonly
                                            value="{{ old('empresa_demandante', $subcaso->empresa_demandante) }}"
                                            maxlength="30" />
                                        @error('empresa_demandante')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <div data-mdb-input-init class="form-outline">
                                        <label class="form-label" for="rut">RUT/NIT</label>
                                        <input type="text" id="rut_demandante" name="rut_demandante"
                                            class="form-control" placeholder="Número RUT/NIT" readonly maxlength="15"
                                            value="{{ old('rut_demandante', $subcaso->rut_demandante) }}" />
                                        @error('rut_demandante')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col">
                                    <div data-mdb-input-init class="form-outline">
                                        <label class="form-label" for="email">Email</label>
                                        <input type="email" id="email_demandante" name="email_demandante"
                                            class="form-control" placeholder="Correo Electrónico" maxlength="255"
                                            value="{{ old('email_demandante', $subcaso->email_demandante) }}" readonly />
                                        @error('email_demandante')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <div data-mdb-input-init class="form-outline">
                                        <label class="form-label" for="telefono">Número Teléfono</label>
                                        <input type="text" id="telefono_demandante" name="telefono_demandante"
                                            class="form-control" placeholder="+5063046405009" maxlength="15"
                                            value="{{ old('telefono_demandante', $subcaso->telefono_demandante) }}"
                                            readonly />
                                        @error('telefono_demandante')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                            </div>

                            <div class="row mb-4">
                                <div class="col">
                                    <div data-mdb-input-init class="form-outline">
                                        <label class="form-label" for="representante">Representante legal</label>
                                        <input type="text" id="representante_demandante"
                                            name="representante_demandante" class="form-control"
                                            placeholder="Nombre Representante" maxlength="255"
                                            value="{{ old('representante_demandante', $subcaso->representante_demandante) }}"
                                            readonly />
                                        @error('representante_demandante')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <div data-mdb-input-init class="form-outline">
                                        <label class="form-label" for="domicilio">Domicilio</label>
                                        <input type="text" id="domicilio_demandante" name="domicilio_demandante"
                                            class="form-control" placeholder="Domicilio" readonly maxlength="255"
                                            value="{{ old('domicilio_demandante', $subcaso->domicilio_demandante) }}" />
                                        @error('domicilio_demandante')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>

                </div>

                <div class="tab-pane fade" id="datos" role="tabpanel" aria-labelledby="datos-tab">
                    <!-- Contenido de Datos -->
                    <div class="row mb-4">
                        <div class="col">
                            <div data-mdb-input-init class="form-outline">
                                <label class="form-label" for="referencia_caso">Referencia Cliente</label>
                                <input type="number" id="referencia_caso" name="referencia_caso" class="form-control"
                                    placeholder="111" readonly
                                    value="{{ old('referencia_caso', $subcaso->referencia_caso) }}" maxlength="30" />
                                @error('referencia_caso')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div data-mdb-input-init class="form-outline">
                                <label class="form-label" for="rut">Nave/Descrición del Caso</label>
                                <input type="text" id="descripcion_caso" name="descripcion_caso" class="form-control"
                                    placeholder="descripcion del caso" readonly maxlength="50"
                                    value="{{ old('descripcion_caso', $subcaso->descripcion_caso) }}" />
                                @error('descripcion_caso')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div data-mdb-input-init class="form-outline">
                                <label class="form-label" for="rut">Asunto/Caratula</label>
                                <input type="text" id="asunto_caso" name="asunto_caso" class="form-control"
                                    placeholder="Asunto" readonly maxlength="255"
                                    value="{{ old('asunto_caso', $subcaso->asunto_caso) }}" />
                                @error('asunto_caso')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col">
                            <div data-mdb-input-init class="form-outline">
                                <label class="form-label" for="referencia_demandante">Referencia Demandante</label>
                                <input type="number" id="referencia_demandante" name="referencia_demandante"
                                    class="form-control" placeholder="111" readonly
                                    value="{{ old('referencia_demandante', $subcaso->referencia_demandante) }}"
                                    maxlength="30" />
                                @error('referencia_demandante')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div data-mdb-input-init class="form-outline">
                                <label class="form-label" for="referencia_caso">Fecha de Inicio</label>
                                <input type="date" id="fechai" name="fechai" class="form-control" readonly
                                    value="{{ old('fechai', $subcaso->fechai) }}" max="{{ date('Y-m-d') }}" />
                                @error('fechai')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        @php
                            // Obtener solo los clientes con estado "Activo" y tipo_usuario igual a 5
                            $abogadosActivos = \App\Models\User::where('estado', 'Activo')->get();
                            $abogadosActivos2 = \App\Models\User::where('estado', 'Activo')->get();

                            $tipocasos = \App\Models\TipoCaso::all();
                            $tipoprocesal = \App\Models\TipoProcesal::all();
                            $tipoactividad = \App\Models\TipoActividad::all();
                            $montohoras = \App\Models\MontoHora::all();
                            $tribunales = \App\Models\Tribunal::all();

                        @endphp

                        <div class="col">
                            <div data-mdb-input-init class="form-outline">
                                <label class="form-label" for="abogados">Abogados</label>
                                <br />
                                <select id="abogados" name="abogados[]" class="form-control" multiple disabled>
                                    <option value="" disabled>Seleccione una empresa</option>
                                    @foreach ($abogadosActivos as $abogados)
                                        <option value="{{ $abogados->id }}"
                                            {{ in_array($abogados->id, json_decode($subcaso->abogados, true)) ? 'selected' : '' }}>
                                            &nbsp;&nbsp;&nbsp;&nbsp;{{ $abogados->iniciales }}
                                        </option>
                                    @endforeach
                                </select>


                                @error('abogados')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                    </div>
                    <div class="row mb-4">
                        <div class="col">
                            <div data-mdb-input-init class="form-outline">
                                <label class="form-label" for="referencia_caso">Tipo de Cobro</label>
                                <div class="row mb-4">
                                    <!-- Cobro Fijo -->
                                    <div class="col">
                                        <div data-mdb-input-init class="form-outline">
                                            <label class="form-label" for="cobrofijo">Cobro fijo</label>
                                            <div class="form-switch">
                                                <!-- Campo oculto para enviar '0' cuando el checkbox esté desmarcado -->
                                                <input type="hidden" name="cobrofijo" value="0">

                                                <!-- Checkbox deshabilitado -->
                                                <input class="form-check-input" type="checkbox" id="cobrofijo"
                                                    name="cobrofijo" value="1"
                                                    onchange="toggleLabel(this, 'label-cobrofijo')"
                                                    @checked($subcaso->cobrofijo == 1) disabled>
                                                <!-- Agrega el atributo disabled aquí -->

                                                <!-- Etiqueta para indicar el estado del checkbox -->
                                                <label id="label-cobrofijo" class="toggle-state-label" for="cobrofijo">
                                                    {{ $subcaso->cobrofijo == 1 ? 'Sí' : 'No' }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Cobro Hora -->
                                    <div class="col">
                                        <div data-mdb-input-init class="form-outline">
                                            <label class="form-label" for="cobrohora">Cobro hora</label>
                                            <div class="form-switch">
                                                <input type="hidden" name="cobrohora" value="0">
                                                <!-- Checkbox deshabilitado -->
                                                <input class="form-check-input" type="checkbox" id="cobrohora"
                                                    name="cobrohora" value="1"
                                                    onchange="toggleLabel(this, 'label-cobrohora')"
                                                    @checked($subcaso->cobrohora == 1) disabled>
                                                <!-- Agrega el atributo disabled aquí -->
                                                <label id="label-cobrohora" class="toggle-state-label" for="cobrohora">
                                                    {{ $subcaso->cobrohora == 1 ? 'Sí' : 'No' }}</label>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Cobro Porciento -->
                                    <div class="col">
                                        <div data-mdb-input-init class="form-outline">
                                            <label class="form-label" for="cobroporciento">Cobro %</label>
                                            <div class="form-switch">
                                                <input type="hidden" name="cobroporciento" value="0">
                                                <!-- Checkbox deshabilitado -->
                                                <input class="form-check-input" type="checkbox" id="cobroporciento"
                                                    name="cobroporciento" value="1"
                                                    onchange="toggleLabel(this, 'label-cobroporciento')"
                                                    @checked($subcaso->cobroporciento == 1) disabled>
                                                <!-- Agrega el atributo disabled aquí -->
                                                <label id="label-cobroporciento" class="toggle-state-label"
                                                    for="cobroporciento">{{ $subcaso->cobroporciento == 1 ? 'Sí' : 'No' }}</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script>
                            function toggleCheckboxesState(disabled) {
                                document.getElementById('cobrofijo').disabled = disabled;
                                document.getElementById('cobrohora').disabled = disabled;
                                document.getElementById('cobroporciento').disabled = disabled;
                            }
                        </script>
                        <div class="col">
                            <div data-mdb-input-init class="form-outline">
                                <label class="form-label" for="rol_caso">Rol</label>
                                <div id="tag-container" class="form-control"
                                    style="min-height: 38px; display: flex; align-items: center; flex-wrap: wrap;">
                                    <!-- Los tags se agregarán aquí -->
                                    <input type="text" id="rol_caso_input" class="tag-input" placeholder="E-122-2024"
                                        maxlength="50" style="border: none; outline: none; flex: 1;" readonly />
                                </div>
                                <input type="hidden" id="rol_caso" name="rol_caso[]"
                                    value="{{ old('rol_caso', implode(' ', json_decode($subcaso->rol_caso, true) ?? [])) }}" />
                                @error('rol_caso')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div data-mdb-input-init class="form-outline">
                                <label class="form-label" for="rut">Nombre del Juicio</label>
                                <input type="text" id="nombre_juicio" name="nombre_juicio" class="form-control"
                                    placeholder="Nombre del Juicio" readonly maxlength="30"
                                    value="{{ old('nombre_juicio', $subcaso->nombre_juicio) }}" />
                                @error('nombre_juicio')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col">
                            <div data-mdb-input-init class="form-outline">
                                <label class="form-label" for="rut">Tribunal</label>
                                <select id="tribunal" name="tribunal[]" class="form-control" multiple disabled>
                                    <option value="" disabled>Seleccione un tribunal</option>
                                    @foreach ($tribunales as $tribunal)
                                        <option value="{{ $tribunal->id }}"
                                            {{ in_array($tribunal->id, json_decode($subcaso->tribunal, true)) ? 'selected' : '' }}>
                                            &nbsp;&nbsp;&nbsp;&nbsp;{{ $tribunal->nombre }}
                                        </option>
                                    @endforeach

                                </select>
                                @error('tribunal')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div data-mdb-input-init class="form-outline">
                                <label class="form-label" for="rut">Fecha de Ingreso al Tribunal</label>
                                <input type="date" id="fechait" name="fechait" class="form-control" readonly
                                    value="{{ old('fechait', $subcaso->fechait) }}" max="{{ date('Y-m-d') }}" />
                                @error('fechait')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div data-mdb-input-init class="form-outline">
                                <label class="form-label" for="rut">Juez Civil</label>
                                <input type="text" id="juez_civil" name="juez_civil" class="form-control"
                                    placeholder="Nombre del Juez Civil" readonly maxlength="30"
                                    value="{{ old('juez_civil', $subcaso->juez_civil) }}" />
                                @error('juez_civil')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col">
                            <div data-mdb-input-init class="form-outline">
                                <label class="form-label" for="rut">Juez Arbitro</label>
                                <input type="text" id="juez_arbitro" name="juez_arbitro" class="form-control"
                                    placeholder="Nombre del Juez Arbitro" readonly maxlength="30"
                                    value="{{ old('juez_arbitro', $subcaso->juez_arbitro) }}" />
                                @error('juez_arbitro')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div data-mdb-input-init class="form-outline">
                                <label class="form-label" for="rol_arbitral">Rol Arbitral</label>
                                <div id="tag-container2" class="form-control"
                                    style="min-height: 38px; display: flex; align-items: center; flex-wrap: wrap;">
                                    <input type="text" id="rol_arbitral_input" class="tag-input"
                                        placeholder="A-456-2024" maxlength="50"
                                        style="border: none; outline: none; flex: 1;" readonly />
                                </div>
                                <input type="hidden" id="rol_arbitral" name="rol_arbitral[]"
                                    value="{{ old('rol_arbitral', implode(' ', json_decode($subcaso->rol_arbitral, true) ?? [])) }}" />
                                @error('rol_arbitral')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div data-mdb-input-init class="form-outline">
                                <label class="form-label" for="tipo_moneda">Tipo de Moneda</label>
                                <select id="tipo_moneda" name="tipo_moneda" class="form-control" disabled>
                                    <option value="" disabled
                                        {{ old('tipo_moneda', $subcaso->tipo_moneda) === null ? 'selected' : '' }}>
                                        Seleccione
                                        un tipo de moneda</option>
                                    <option value="USD"
                                        {{ old('tipo_moneda', $subcaso->tipo_moneda) == 'USD' ? 'selected' : '' }}>USD -
                                        Dólar
                                        Estadounidense</option>
                                    <option value="EUR"
                                        {{ old('tipo_moneda', $subcaso->tipo_moneda) == 'EUR' ? 'selected' : '' }}>EUR -
                                        Euro
                                    </option>
                                    <option value="CLP"
                                        {{ old('tipo_moneda', $subcaso->tipo_moneda) == 'CLP' ? 'selected' : '' }}>CLP -
                                        Peso
                                        Chileno</option>
                                    <option value="ARS"
                                        {{ old('tipo_moneda', $subcaso->tipo_moneda) == 'ARS' ? 'selected' : '' }}>ARS -
                                        Peso
                                        Argentino</option>
                                    <option value="UF"
                                        {{ old('tipo_moneda', $subcaso->tipo_moneda) == 'UF' ? 'selected' : '' }}>UF -
                                        Unidad
                                        Fomento</option>
                                </select>

                                @error('tipo_moneda')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col">
                            <div data-mdb-input-init class="form-outline">
                                <label class="form-label" for="rut">Monto Demanda</label>
                                <input type="number" id="monto_demanda" name="monto_demanda" class="form-control"
                                    placeholder="3.000" readonly min="0" step="0.01"
                                    value="{{ old('monto_demanda', $subcaso->monto_demanda) }}" />
                                @error('monto_demanda')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col">
                            <div data-mdb-input-init class="form-outline">
                                <label class="form-label" for="rut">Fecha y Hora Creación Caso</label>
                                <input type="datetime-local" id="created_at" name="created_at" class="form-control"
                                    placeholder="5" readonly
                                    value="{{ old('created_at', $subcaso->created_at ? $subcaso->created_at->format('Y-m-d\TH:i') : '') }}" />

                                @error('created_at')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                    </div>
                    <div class="row mb-4">
                        <div class="col">
                            <div data-mdb-input-init class="form-outline">
                                <label class="form-label" for="rut">Ultima Modificación</label>
                                <input type="text" id="updated_at" name="updated_at" class="form-control"
                                    placeholder="5" readonly
                                    value="{{ old('updated_at', $subcaso->updated_at ? '' . $subcaso->updated_at->format('Y-m-d') . ' ' . (\App\Models\User::find($subcaso->usuario)->iniciales ?? 'N/A') : '') }}" />

                                @error('updated_at')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div data-mdb-input-init class="form-outline">
                                <label class="form-label" for="rut">Bill of Lading</label>
                                <div id="tag-container3" class="form-control"
                                    style="min-height: 38px; display: flex; align-items: center; flex-wrap: wrap;">
                                    <input type="text" id="bill_input" class="tag-input" placeholder="A-456-2024"
                                        maxlength="50" style="border: none; outline: none; flex: 1;" readonly />
                                </div>
                                <input type="hidden" id="bill" name="bill[]"
                                    value="{{ old('bill', implode(' ', json_decode($subcaso->bill, true) ?? [])) }}" />
                                @error('bill')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="actividades" role="tabpanel" aria-labelledby="actividades-tab">
                    <!-- Botón para abrir el modal -->
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#actividadModal">
                            Añadir Actividad
                        </button>
                    </div>
                    <div class="table-responsive">
                        <br />
                        <table class="table table-bordered" style="text-align: center">
                            <thead>
                                <tr>
                                    <th style="text-align: center">No</th>
                                    <th style="text-align: center">Actividad</th>
                                    <th style="text-align: center">Tipo Actividad</th>
                                    <th style="text-align: center">Abogado</th>
                                    <th style="text-align: center">Fecha y Hora</th>
                                    <th style="text-align: center">Horas Trabajadas</th>
                                    <th style="text-align: center">Realizada</th>


                                </tr>
                            </thead>
                            <div class="tabla-contenedor">
                                <tbody id="tablaActividades">
                                    <!-- Las actividades se agregarán aquí -->
                                </tbody>
                            </div>
                            <input type="hidden" id="actividadesData" name="actividadesData"
                                value="{{ old('actividadesData', $subcaso->actividadesData) }}">

                        </table>
                    </div>
                </div>

                <div class="tab-pane fade" id="documentos" role="tabpanel" aria-labelledby="documentos-tab">
                    <!-- Botón para abrir el modal -->
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#documentoModal">
                            Cargar Documentos
                        </button>
                    </div>
                    <div class="table-responsive">
                        <br />
                        <table class="table table-bordered" style="text-align: center">
                            <thead>
                                <tr>
                                    <th style="text-align: center">No</th>
                                    <th style="text-align: center">Abogado</th>

                                    <th style="text-align: center">Fecha y Hora</th>

                                    <th style="text-align: center">Nombre</th>
                                    <th style="text-align: center">Documento</th>
                                    <th style="text-align: center">Origen del Doc.</th>


                                </tr>
                            </thead>
                            <div class="tabla-contenedor">
                                <tbody id="tablaDocumentos">
                                    <!-- Las actividades se agregarán aquí -->
                                </tbody>
                            </div>
                            <input type="hidden" id="documentosData" name="documentosData"
                                value="{{ old('documentosData', $subcaso->documentosData) }}">

                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="movimiento" role="tabpanel" aria-labelledby="movimiento-tab">


                </div>

                <div class="tab-pane fade" id="finanzas" role="tabpanel" aria-labelledby="finanzas-tab">
                    <!-- Contenido de Finanzas -->
                    <!-- Aquí irán los campos financieros, como Cobro fijo, Cobro hora, Cobro % -->

                </div>
                <div class="row mb-4">
                    <hr class="line-separator">
                    <div class="col">
                        <div data-mdb-input-init class="form-outline">
                            <label class="form-label" for="referencia_demandante">Ref. Subcaso</label>
                            <input type="text" id="id" name="id" class="form-control" placeholder="111"
                                readonly value="{{ old('id', $subcaso->refsub) }}" maxlength="30" />
                            @error('id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <div data-mdb-input-init class="form-outline">
                            <label class="form-label" for="tipo_caso">Tipo de Caso</label>
                            <select id="tipo_caso" name="tipo_caso" class="form-control" disabled>
                                <option value="" disabled selected>Seleccione un tipo de caso</option>
                                @foreach ($tipocasos as $tipoCaso)
                                    <option value="{{ $tipoCaso->id }}"
                                        {{ $tipoCaso->id == $subcaso->tipo_caso ? 'selected' : '' }}>
                                        {{ $tipoCaso->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('tipo_caso')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>

                    <!-- Tu lógica de PHP para obtener actividades y abogados -->
                    <div class="col">
                        <label for="estado_caso" class="form-label">Estado Caso</label>
                        <select id="estado_caso" name="estado_caso" class="form-control" disabled>
                            <option value=""
                                {{ old('estado_caso', $subcaso->estado_caso) === null ? 'selected' : '' }}>Seleccione
                                un estado</option>

                            <option value="Iniciada"
                                {{ old('estado_caso', $subcaso->estado_caso) == 'Iniciada' ? 'selected' : '' }}>Iniciada
                            </option>

                            <option
                                value="Finalizado"{{ old('estado_caso', $subcaso->estado_caso) == 'Finalizado' ? 'selected' : '' }}>
                                Finalizado
                            </option>

                        </select>
                        @error('estado_caso')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- Abogado -->
                    <div class="col">
                        <label for="etapa_procesal" class="form-label">Etapa Procesal</label>

                        <select id="etapa_procesal" name="etapa_procesal" class="form-control" disabled>
                            <option value="" disabled selected>Seleccione un tipo de caso</option>
                            @foreach ($tipoprocesal as $tipoprocesa)
                                <option value="{{ $tipoprocesa->id }}"
                                    {{ $tipoprocesa->id == $subcaso->etapa_procesal ? 'selected' : '' }}>
                                    {{ $tipoprocesa->nombre }}
                                </option>
                            @endforeach
                        </select>
                        @error('etapa_procesal')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col">
                        <div data-mdb-input-init class="form-outline">
                            <label class="form-label" for="estado">Congelado</label>

                            <!-- Muestra el Label en lugar del input -->
                            @if ($subcaso->estado === 'Activo')
                                <br />
                                <span class="badge bg-danger custom-label">No</span>
                            @else
                                <br />
                                <span class="badge bg-success custom-label">Sí</span>
                            @endif

                            <!-- Campo de entrada escondido para mantener el valor en el formulario -->
                            <input type="hidden" id="estado" name="estado"
                                value="{{ old('estado', $subcaso->estado) }}" />

                            @error('estado')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <label for="estado_caso" class="form-label">Estado Interno</label>
                        <select id="estado_casoi" name="estado_casoi" class="form-control" disabled>
                            <option value=""
                                {{ old('estado_casoi', $subcaso->estado_casoi) === null ? 'selected' : '' }}>
                                Seleccione un estado
                            </option>
                            <option value="Tramitacion"
                                {{ old('estado_casoi', $subcaso->estado_casoi) == 'Tramitacion' ? 'selected' : '' }}>
                                Tramitacion
                            </option>
                            <option value="Suspendido"
                                {{ old('estado_casoi', $subcaso->estado_casoi) == 'Suspendido' ? 'selected' : '' }}>
                                Suspendido
                            </option>
                            <option value="TramitacionN"
                                {{ old('estado_casoi', $subcaso->estado_casoi) == 'TramitacionN' ? 'selected' : '' }}>
                                Tramitacion Negociando
                            </option>
                            <option value="SuspendidoN"
                                {{ old('estado_casoi', $subcaso->estado_casoi) == 'SuspendidoN' ? 'selected' : '' }}>
                                Suspendido Negociando
                            </option>
                            <option value="Transado"
                                {{ old('estado_casoi', $subcaso->estado_casoi) == 'Transado' ? 'selected' : '' }}>
                                Transado
                            </option>
                            <option value="Otra"
                                {{ old('estado_casoi', $subcaso->estado_casoi) == 'Otra' ? 'selected' : '' }}>
                                Otra Causal de Termino
                            </option>

                        </select>
                        @error('estado_casoi')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col">
                        <div data-mdb-input-init class="form-outline">
                            <label class="form-label" for="referencia_caso">Fecha de Cierre</label>
                            <input type="date" id="fecha_fin" name="fecha_fin" class="form-control"
                                value="{{ old('fecha_fin', $subcaso->fecha_fin) }}" max="{{ date('Y-m-d') }}"
                                readonly />
                            @error('fecha_fin')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="text-center pt-1 mb-5 pb-1">
                    <button type="button" class="btn btn-secondary btn-block fs-lg mb-3"
                        onclick="window.history.back();">Volver</button>


                </div>

        </form>
        <!-- Modal Activiades -->
        <div class="modal fade" id="actividadModal" tabindex="-1" aria-labelledby="actividadModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="actividadModalLabel">Añadir Actividad</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <div class="modal-body">
                        <form id="actividadForm">
                            <!-- Tipo de Actividad -->
                            <div class="row mb-4">
                                <!-- Tu lógica de PHP para obtener actividades y abogados -->
                                <div class="col">
                                    <label for="tipo_actividad" class="form-label">Actividad</label>
                                    <select id="actividad" name="actividad" class="form-control"
                                        onchange="loadTipoActividad(this)">
                                        <option value="" disabled selected>Seleccione una actividad
                                        </option>
                                        @foreach ($tipoactividad as $tipoactivida)
                                            <option value="{{ $tipoactivida->id }}"
                                                data-tipo="{{ $tipoactivida->tipo }}"
                                                {{ old('actividad') == $tipoactivida->id ? 'selected' : '' }}>
                                                {{ $tipoactivida->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('actividad')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <!-- Abogado -->
                                <div class="col">
                                    <label for="abogado" class="form-label">Abogado</label>
                                    <br />
                                    <select id="abogado_actividad" name="abogado_actividad" class="form-control">
                                        <option value="" disabled>Seleccione un abogado</option>
                                        @foreach ($abogadosActivos2 as $abogados2)
                                            <option value="{{ $abogados2->id }}"
                                                {{ is_array(old('abogado_actividad')) && in_array($abogados2->id, old('abogado_actividad')) ? 'selected' : '' }}>
                                                &nbsp;&nbsp;&nbsp;&nbsp;{{ $abogados2->iniciales }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('abogado_actividad')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col">
                                    <label for="fecha_hora" class="form-label">Fecha y Hora</label>
                                    <input type="datetime-local" id="fecha_hora" name="fecha_hora"
                                        max="{{ now()->format('Y-m-d\TH:i') }}" class="form-control" required>
                                </div>

                                <!-- Horas Trabajadas -->
                                <div class="col">
                                    <label for="horas_trabajadas" class="form-label">Horas Trabajadas</label>
                                    <input type="number" id="horas_trabajadas" name="horas_trabajadas"
                                        class="form-control" required min="0" step="0.1">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col">
                                    <label for="tipo_actividad_valor" class="form-label">Tipo
                                        Actividad</label>
                                    <input type="text" id="tipo_actividad_valor" name="tipo_actividad_valor"
                                        class="form-control" readonly />
                                </div>
                                <div class="col">
                                    <!-- Realizada -->
                                    <label for="realizada" class="form-label">Realizada</label>
                                    <select id="realizada" name="realizada" class="form-control" required>
                                        <option value="Si" {{ old('realizada') == 'Si' ? 'selected' : '' }}>Sí
                                        </option>
                                        <option value="No" {{ old('realizada') == 'No' ? 'selected' : '' }}>No
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" onclick="agregarActividad()">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Documentos -->
        <div class="modal fade" id="documentoModal" tabindex="-1" aria-labelledby="documentoModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="documentoModalLabel">Añadir Documento</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <div class="modal-body">
                        <form id="documentoForm" enctype="multipart/form-data">
                            <!-- Tipo de Actividad -->
                            <div class="row mb-4">

                                <!-- Abogado -->
                                <div class="col">
                                    <label for="abogado" class="form-label">Abogado</label>
                                    <br />
                                    <select id="abogado_documento" name="abogado_documento" class="form-control">
                                        <option value="" disabled>Seleccione un abogado</option>
                                        @foreach ($abogadosActivos2 as $abogados2)
                                            <option value="{{ $abogados2->id }}"
                                                {{ is_array(old('abogado_documento')) && in_array($abogados2->id, old('abogado_documento')) ? 'selected' : '' }}>
                                                &nbsp;&nbsp;&nbsp;&nbsp;{{ $abogados2->iniciales }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('abogado_documento')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="fecha_documento" class="form-label">Fecha y Hora</label>
                                    <input type="datetime-local" id="fecha_documento" name="fecha_documento"
                                        max="{{ now()->format('Y-m-d\TH:i') }}" class="form-control" required>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col">
                                    <label for="nombre_documento" class="form-label">Nombre del Documento</label>
                                    <input type="text" id="nombre_documento" name="nombre_documento"
                                        class="form-control" required />
                                </div>
                                <div class="col">
                                    <label for="documentos" class="form-label">Archivo</label>
                                    <input type="file" id="documento_documentos" name="documento_documentos"
                                        class="form-control" required accept=".pdf,.rar,.zip,.docx,.xls">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col">
                                    <!-- Realizada -->
                                    <label for="origen" class="form-label">Origen</label>
                                    <select id="origen" name="origen" class="form-control" required>
                                        <option value="Tribunal" {{ old('origen') == 'Tribunal' ? 'selected' : '' }}>
                                            Tribunal
                                        </option>
                                        <option value="Correos" {{ old('origen') == 'Correos' ? 'selected' : '' }}>
                                            Correos
                                        </option>
                                    </select>
                                </div>

                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" onclick="agregarDocumento()">Guardar</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
    <!-- Incluye Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

    <!-- Incluye jQuery (necesario para Select2) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Incluye Select2 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <!-- Scripts de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>


    <script>
        function loadTipoActividad(selectElement) {
            // Obtener el tipo de actividad desde el atributo data-tipo de la opción seleccionada
            const selectedOption = selectElement.options[selectElement.selectedIndex];
            const tipoActividad = selectedOption.getAttribute('data-tipo');

            // Asignar el valor de tipo actividad al campo de texto correspondiente
            document.getElementById('tipo_actividad_valor').value = tipoActividad;
        }

        let filaActual = null; // Variable global para almacenar la fila actual en edición
        let filaActualDoc = null;


        let actividadContador = 0;
        let actividadesArray = [];

        // Función para encontrar el último ID y actualizar el contador
        function actualizarActividadContador() {
            if (actividadesArray.length > 0) {
                const maxId = Math.max(...actividadesArray.map(act => act.id));
                actividadContador = maxId; // Actualiza el contador al valor máximo existente
            }
        }

        // Función para agregar una fila a la tabla de actividades
        function agregarFilaActividad(actividadObj) {
            let nuevaFila = `
        <tr data-id="${actividadObj.id}">
            <td style="text-align: center">${actividadObj.id}</td>
            <td style="text-align: center">${actividadObj.actividadTexto}</td>
            <td style="text-align: center">${actividadObj.tipoActividad}</td>
            <td style="text-align: center">${actividadObj.abogados.trim()}</td>
            <td style="text-align: center">${actividadObj.fechaHora}</td>
            <td style="text-align: center">${actividadObj.horasTrabajadas}</td>
            <td style="text-align: center">${actividadObj.realizada}</td>
           
    `;



            nuevaFila += `</tr>`;

            // Agregar la nueva fila al cuerpo de la tabla
            document.getElementById('tablaActividades').insertAdjacentHTML('beforeend', nuevaFila);
        }

        // Función para agregar una actividad desde el modal
        function agregarActividad() {
            try {
                // Obtener valores del formulario del modal
                const actividad = document.getElementById('actividad').value;
                const actividadTexto = document.getElementById('actividad').options[document.getElementById('actividad')
                    .selectedIndex].text;
                const tipoActividad = document.getElementById('tipo_actividad_valor').value;
                const abogados = Array.from(document.getElementById('abogado_actividad').selectedOptions).map(option =>
                    option.text).join(', ');
                const fechaHora = document.getElementById('fecha_hora').value;
                const horasTrabajadas = document.getElementById('horas_trabajadas').value;
                const realizada = document.getElementById('realizada').value;

                // Crear un objeto para la actividad
                const actividadObj = {
                    id: ++actividadContador, // Incrementar el contador para generar el ID
                    actividad,
                    actividadTexto,
                    tipoActividad,
                    abogados,
                    fechaHora,
                    horasTrabajadas,
                    realizada
                };

                if (filaActual) {
                    // Si se está editando una fila existente
                    const idFila = parseInt(filaActual.getAttribute('data-id'));
                    const index = actividadesArray.findIndex(act => act.id === idFila);

                    if (index !== -1) {
                        // Actualizar la actividad en el array
                        actividadesArray[index] = actividadObj;
                    }

                    // Actualizar la fila existente en la tabla
                    filaActual.cells[1].textContent = actividadTexto;
                    filaActual.cells[2].textContent = tipoActividad;
                    filaActual.cells[3].textContent = abogados;
                    filaActual.cells[4].textContent = fechaHora;
                    filaActual.cells[5].textContent = horasTrabajadas;
                    filaActual.cells[6].textContent = realizada;

                    // Reiniciar la variable de fila actual
                    filaActual = null;
                } else {
                    // Agregar la nueva actividad al array
                    actividadesArray.push(actividadObj);

                    // Crear la nueva fila en la tabla
                    agregarFilaActividad(actividadObj);
                }

                // Actualizar el campo oculto con el array de actividades en formato JSON
                document.getElementById('actividadesData').value = JSON.stringify(actividadesArray);

                // Cerrar el modal utilizando Bootstrap's modal method
                $('#actividadModal').modal('hide');
                $('.modal-backdrop').remove(); // Forzar la eliminación del backdrop
                // Limpiar el formulario después de agregar o editar
                resetActividadForm();

            } catch (error) {
                console.error('Error en agregarActividad:', error);
            }
        }
        // Función para limpiar el formulario de actividades
        function resetActividadForm() {
            // Restablecer el formulario
            document.getElementById('actividadForm').reset();
            $('#abogado_actividad').val(null).trigger('change'); // Reiniciar select2
            document.getElementById('tipo_actividad_valor').value = ''; // Limpiar tipo de actividad

            // Habilitar todos los campos del formulario
            $('#actividad').prop('disabled', false);
            $('#abogado_actividad').prop('disabled', false); // Enable select2
            $('#tipo_actividad_valor').prop('readonly', false);
            $('#fecha_hora').prop('readonly', false);
            $('#realizada').prop('disabled', false);
            $('#horas_trabajadas').prop('readonly', false);

            // Reiniciar el select de actividad y realizada
            document.getElementById('actividad').selectedIndex = 0;
            document.getElementById('realizada').selectedIndex = 0;
        }

        // Limpiar el formulario al cerrar el modal de actividad
        $('#actividadModal').on('hidden.bs.modal', function() {
            resetActividadForm();
        });

        let documentosArray = [];
        let documentoContador = 0; // Inicializar el contador de documentos

        function agregarFilaDocumento(documentoObj) {

            let nuevaFilaDoc = `
        <tr data-id2="${documentoObj.id}">
            <td style="text-align: center">${documentoObj.id}</td>
            <td style="text-align: center">${documentoObj.abogadosdoc.trim()}</td>
            <td style="text-align: center">${documentoObj.fechaHoradoc}</td>
            <td style="text-align: center">${documentoObj.nombredoc}</td>
            <td style="text-align: center"><a href="/storage/${documentoObj.documentoRuta}" target="_blank">${documentoObj.nombredoc}</a></td>
            <td style="text-align: center">${documentoObj.origen}</td>
            
    `;

            // Aquí verificas los permisos (simulando el código de permisos)

            nuevaFilaDoc += `</tr>`;

            // Agregar la nueva fila al cuerpo de la tabla
            document.getElementById('tablaDocumentos').insertAdjacentHTML('beforeend', nuevaFilaDoc);
        }

        // Función para agregar un nuevo documento
        function agregarDocumento() {
            try {
                const abogadosdoc = Array.from(document.getElementById('abogado_documento').selectedOptions).map(option =>
                    option.text).join(', ');
                const fechaHoradoc = document.getElementById('fecha_documento').value;
                const nombredoc = document.getElementById('nombre_documento').value;
                const documentoInput = document.getElementById('documento_documentos');
                const origen = document.getElementById('origen').value;

                // Verificar si se seleccionó un archivo
                if (documentoInput.files.length === 0) {
                    alert("Por favor, selecciona un archivo.");
                    return;
                }

                // Obtener el archivo seleccionado
                const archivoSeleccionado = documentoInput.files[0];
                const documentoNombre = archivoSeleccionado.name; // Obtener solo el nombre del archivo

                // Crear un FormData para enviar el archivo al servidor
                const formData = new FormData();
                formData.append('documento_documentos', archivoSeleccionado);
                formData.append('abogadosdoc', abogadosdoc);
                formData.append('fechaHoradoc', fechaHoradoc);
                formData.append('nombredoc', nombredoc);
                formData.append('origen', origen);

                // Realizar la petición AJAX al servidor para subir el archivo
                fetch(`/subcasos/update-documento`, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Crear un objeto para el documento con la ruta recibida del servidor
                            const documentoObj = {
                                id: ++documentoContador, // Incrementar el contador para generar el ID
                                abogadosdoc,
                                fechaHoradoc,
                                nombredoc,
                                documentoRuta: data.ruta, // La ruta del archivo subida
                                origen
                            };

                            // Agregar el nuevo documento al array
                            documentosArray.push(documentoObj);

                            // Crear una nueva fila en la tabla
                            agregarFilaDocumento(documentoObj);

                            // Actualizar el campo oculto con el array de documentos en formato JSON
                            document.getElementById('documentosData').value = JSON.stringify(documentosArray);

                            // Cerrar el modal utilizando Bootstrap's modal method
                            $('#documentoModal').modal('hide');
                            $('.modal-backdrop').remove(); // Forzar la eliminación del backdrop
                            // Limpiar el formulario después de agregar
                            resetDocumentoForm();
                        } else {
                            alert('Error al subir el archivo.');
                        }
                    })
                    .catch(error => {
                        console.error('Error en agregarDocumento:', error);
                    });
            } catch (error) {
                console.error('Error en agregarDocumento:', error);
            }
        }

        // Función para limpiar el formulario de documentos
        function resetDocumentoForm() {
            document.getElementById('documentoForm').reset();
            $('#abogado_documento').val(null).trigger('change'); // Reiniciar select2
        }

        // Limpiar el formulario al cerrar el modal de documentos
        $('#documentoModal').on('hidden.bs.modal', function() {
            resetDocumentoForm();
        });

        function eliminarFila(button) {
            // Obtener la fila seleccionada
            const fila = button.closest('tr');
            const actividadId = parseInt(fila.getAttribute('data-id'));

            // Remover la fila del DOM
            fila.remove();

            // Remover la actividad del array usando filter para excluir la actividad con el ID especificado
            actividadesArray = actividadesArray.filter(act => act.id !== actividadId);

            // Actualizar el campo oculto con el array de actividades en formato JSON
            document.getElementById('actividadesData').value = JSON.stringify(actividadesArray);

            // Log para verificar el contenido del array actualizado
            console.log('Actividades restantes en el array:', actividadesArray);
        }

        function eliminarFiladoc(button) {
            // Obtener la fila seleccionada
            const fila2 = button.closest('tr');
            const docId = parseInt(fila2.getAttribute('data-id2'));

            // Buscar el documento en el array por su id
            const documentoObj = documentosArray.find(doc => doc.id === docId);

            // Verificar si se encontró el documento
            if (!documentoObj) {
                console.error('Documento no encontrado en el array.');
                return;
            }

            // Confirmar antes de eliminar
            if (confirm("¿Estás seguro de que quieres eliminar este documento?")) {
                // Realizar la petición AJAX para eliminar el archivo en el servidor
                fetch(`/subcasos/eliminar-documento`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            ruta: documentoObj.documentoRuta // Ruta del archivo a eliminar
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Remover la fila del DOM
                            fila2.remove();

                            // Remover el documento del array usando filter para excluir el documento con el ID especificado
                            documentosArray = documentosArray.filter(doc => doc.id !== docId);

                            // Actualizar el campo oculto con el array de documentos en formato JSON
                            document.getElementById('documentosData').value = JSON.stringify(documentosArray);

                            // Log para verificar el contenido del array actualizado
                            console.log('Documentos restantes en el array:', documentosArray);
                            console.log('Valor de documentosData:', document.getElementById('documentosData').value);
                        } else {
                            alert('Error al eliminar el archivo del servidor.');
                        }
                    })
                    .catch(error => {
                        console.error('Error en eliminarFiladoc:', error);
                    });
            }
        }



        function editarFila(button) {
            // Obtener la fila seleccionada
            filaActual = button.closest('tr');

            // Obtener los datos de la fila
            const actividadTexto = filaActual.cells[1].textContent;
            const tipoActividad = filaActual.cells[2].textContent;
            const abogados = filaActual.cells[3].textContent.split(', ').map(abogado => abogado.trim());
            const fechaHora = filaActual.cells[4].textContent;
            const horasTrabajadas = filaActual.cells[5].textContent;
            const realizada = filaActual.cells[6].textContent;

            // Establecer los valores en el formulario del modal
            const actividadSelect = document.getElementById('actividad');

            // Seleccionar la opción correcta en el select de actividad
            for (let i = 0; i < actividadSelect.options.length; i++) {
                if (actividadSelect.options[i].text === actividadTexto) {
                    actividadSelect.selectedIndex = i;
                    break;
                }
            }

            // Obtener el select de abogados con Select2
            const abogadoSelect = $('#abogado_actividad');

            // Seleccionar las opciones correctas en el select múltiple de abogados utilizando Select2
            let abogadoValues = [];
            for (let i = 0; i < abogadoSelect[0].options.length; i++) {
                if (abogados.includes(abogadoSelect[0].options[i].text.trim())) {
                    abogadoValues.push(abogadoSelect[0].options[i].value); // Añade el valor correspondiente al texto
                }
            }
            abogadoSelect.val(abogadoValues).trigger('change'); // Usa los valores correctos de los abogados

            // Asignar otros valores
            document.getElementById('tipo_actividad_valor').value = tipoActividad;
            document.getElementById('fecha_hora').value = fechaHora;
            document.getElementById('horas_trabajadas').value = horasTrabajadas;

            // Seleccionar la opción correcta en el select de realizada
            const realizadaSelect = document.getElementById('realizada');
            for (let i = 0; i < realizadaSelect.options.length; i++) {
                if (realizadaSelect.options[i].text === realizada) {
                    realizadaSelect.selectedIndex = i;
                    break;
                }
            }

            // Abrir el modal para editar
            $('#actividadModal').modal('show');
        }

        function cargarhFila(button) {
            resetActividadForm();
            // Obtener la fila seleccionada
            filaActual = button.closest('tr');

            // Obtener los datos de la fila
            const actividadTexto = filaActual.cells[1].textContent;
            const tipoActividad = filaActual.cells[2].textContent;
            const abogados = filaActual.cells[3].textContent.split(', ').map(abogado => abogado.trim());
            const fechaHora = filaActual.cells[4].textContent;
            const horasTrabajadas = filaActual.cells[5].textContent;
            const realizada = filaActual.cells[6].textContent;

            // Establecer los valores en el formulario del modal
            const actividadSelect = document.getElementById('actividad');
            const abogadoSelect = $('#abogado_actividad');

            // Seleccionar la opción correcta en el select de actividad
            for (let i = 0; i < actividadSelect.options.length; i++) {
                if (actividadSelect.options[i].text === actividadTexto) {
                    actividadSelect.selectedIndex = i;
                    break;
                }
            }

            // Seleccionar las opciones correctas en el select múltiple de abogados utilizando Select2
            let abogadoValues = [];
            for (let i = 0; i < abogadoSelect[0].options.length; i++) {
                if (abogados.includes(abogadoSelect[0].options[i].text.trim())) {
                    abogadoValues.push(abogadoSelect[0].options[i].value); // Añade el valor correspondiente al texto
                }
            }
            abogadoSelect.val(abogadoValues).trigger('change');

            // Asignar otros valores
            document.getElementById('tipo_actividad_valor').value = tipoActividad;
            document.getElementById('fecha_hora').value = fechaHora;
            document.getElementById('horas_trabajadas').value = horasTrabajadas;

            // Deshabilitar campos excepto el de horas trabajadas
            $('#actividad').prop('disabled', true);
            $('#abogado_actividad').prop('disabled', true); // Disable select2
            $('#tipo_actividad_valor').prop('readonly', true);
            $('#fecha_hora').prop('readonly', true);
            $('#realizada').prop('disabled', true);

            // Habilitar el campo de horas trabajadas para edición
            $('#horas_trabajadas').prop('readonly', false);

            // Seleccionar la opción correcta en el select de realizada
            const realizadaSelect = document.getElementById('realizada');
            for (let i = 0; i < realizadaSelect.options.length; i++) {
                if (realizadaSelect.options[i].text === realizada) {
                    realizadaSelect.selectedIndex = i;
                    break;
                }
            }

            // Abrir el modal para editar
            $('#actividadModal').modal('show');
        }



        $(document).ready(function() {
            $('#abogados').select2({
                placeholder: "Seleccione un abogado",
                allowClear: true
            });
            $('#tribunal').select2({
                placeholder: "Seleccione un tribunal",
                allowClear: true
            });
            $('#actividadModal').modal({
                backdrop: true, // Permite cerrar el modal al hacer clic fuera
                keyboard: true // Permite cerrar el modal con la tecla Escape
            });

            $('#actividadModal').on('shown.bs.modal', function() {
                // Asegura que select2 esté cargado correctamente cada vez que el modal se muestre
                $('#abogado_actividad').select2({
                    placeholder: "Seleccione un abogado",
                    allowClear: true,
                    dropdownParent: $('#actividadModal'),
                    width: '100%'
                });
            });
            $('#documentoModal').on('shown.bs.modal', function() {
                // Asegura que select2 esté cargado correctamente cada vez que el modal se muestre
                $('#abogado_documento').select2({
                    placeholder: "Seleccione un abogado",
                    allowClear: true,
                    dropdownParent: $('#documentoModal'),
                    width: '100%'
                });
            });


            // Tu función de validación personalizada para input fields
            document.querySelectorAll('input[type="text"]').forEach(function(input) {
                input.addEventListener('input', function() {
                    const maxLength = this.getAttribute('maxlength');
                    let value = this.value;

                    if (this.id === 'rut' || this.id === 'rut_demandante') {
                        value = value.replace(/[^0-9.-]/g, '');
                    } else if (this.id === 'domicilio' || this.id === 'domicilio_demandante') {
                        value = value.replace(/[^a-zA-Z0-9\s-#]/g, '');
                    } else {
                        value = value.replace(/[^a-zA-Z0-9.+-/:\s#]/g, '');
                    }

                    if (maxLength && value.length > maxLength) {
                        value = value.slice(0, maxLength);
                    }

                    this.value = value;
                });
            });

            // Validar campos de teléfono
            document.querySelectorAll('#telefono, #telefono_demandante').forEach(function(input) {
                input.addEventListener('input', function() {
                    let value = this.value;
                    value = value.replace(/[^0-9+\s]/g, '');
                    this.value = value;
                });
            });
        });



        document.addEventListener('DOMContentLoaded', function() {

            // Obtener el elemento del select
            const casoSelect = document.getElementById('casos');
            const demandanteSelect = document.getElementById('demandante');

            // Verificar si hay una opción seleccionada al cargar la página
            if (casoSelect.value) {
                fetchCasoData(casoSelect); // Pasar el elemento select completo
            }
            if (demandanteSelect.value) {
                // Llamar a la función con el valor seleccionado
                fetchDemandanteData(demandanteSelect.value);
            }

            // Escuchar el evento de cambio en el select
            casoSelect.addEventListener('change', function() {
                fetchCasoData(this); // Pasar el elemento select completo
            });
            demandanteSelect.addEventListener('change', function() {
                const selectedValue = this.value;
                console.log("Cambio detectado en el select de empresa. Valor seleccionado:",
                    selectedValue); // Debug
                fetchDemandanteData(selectedValue);
            });

            // Modificar la función fetchCasoData para recibir directamente el select
            function fetchCasoData(selectElement) {
                const selectedOption = selectElement.options[selectElement.selectedIndex];

                if (!selectedOption) return; // Si no hay opción seleccionada, salir

                // Obtener valores de los atributos data-*
                const empresa = selectedOption.getAttribute('data-empresa');
                const empresaDemandante = selectedOption.getAttribute('data-empresa-demandante');
                const rutDemandante = selectedOption.getAttribute('data-rut-demandante');
                const emailDemandante = selectedOption.getAttribute('data-email-demandante');
                const telefonoDemandante = selectedOption.getAttribute('data-telefono-demandante');
                const representanteDemandante = selectedOption.getAttribute('data-representante-demandante');
                const domicilioDemandante = selectedOption.getAttribute('data-domicilio-demandante');

                // Asignar los valores a los inputs correspondientes
                document.getElementById('empresa').value = empresa || '';
                document.getElementById('empresa_demandante').value = empresaDemandante || '';
                document.getElementById('rut_demandante').value = rutDemandante || '';
                document.getElementById('email_demandante').value = emailDemandante || '';
                document.getElementById('telefono_demandante').value = telefonoDemandante || '';
                document.getElementById('representante_demandante').value = representanteDemandante || '';
                document.getElementById('domicilio_demandante').value = domicilioDemandante || '';

                // Llamar a fetchClienteData si el valor de empresa no está vacío
                if (empresa) {
                    fetchClienteData(empresa);
                }
            }

            // La función que obtiene los datos del cliente
            function fetchClienteData(clienteId) {
                if (!clienteId) return;

                fetch(`/subcasos/clientes/${clienteId}`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('rut').value = data.rut || '';
                        document.getElementById('email').value = data.email || '';
                        document.getElementById('telefono').value = data.telefono || '';
                        document.getElementById('representante').value = data.representante || '';
                        document.getElementById('domicilio').value = data.domicilio || '';
                    })
                    .catch(error => {
                        console.error('Error fetching cliente data:', error);
                    });
            }

            function fetchDemandanteData(clienteId) {
                if (!clienteId) return;

                fetch(`/subcasos/demandante/${clienteId}`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('empresa_demandante').value = data.empresa_demandante || '';
                        document.getElementById('rut_demandante').value = data.rut_demandante || '';
                        document.getElementById('email_demandante').value = data.email_demandante || '';
                        document.getElementById('telefono_demandante').value = data.telefono_demandante || '';
                        document.getElementById('representante_demandante').value = data
                            .representante_demandante || '';
                        document.getElementById('domicilio_demandante').value = data.domicilio_demandante || '';
                    })
                    .catch(error => {
                        console.error('Error fetching cliente data:', error);
                    });
            }
            // Inicializa ambos contenedores de tags
            initializeTagInput('rol_caso_input', 'tag-container', 'rol_caso');
            initializeTagInput('rol_arbitral_input', 'tag-container2', 'rol_arbitral');
            initializeTagInput('bill_input', 'tag-container3', 'bill');

            function initializeTagInput(inputId, containerId, hiddenInputId) {
                const input = document.getElementById(inputId);
                const container = document.getElementById(containerId);
                const hiddenInput = document.getElementById(hiddenInputId);

                // Convertir el valor del input oculto a tags al cargar la página
                const existingTags = hiddenInput.value.split(' ');
                existingTags.forEach(tag => {
                    if (tag.trim() !== '') {
                        createTag(tag, container, hiddenInput);
                    }
                });

                input.addEventListener('keyup', function(event) {
                    if (event.key === ' ' || event.key === 'Enter') {
                        const value = input.value.trim();
                        if (value) {
                            createTag(value, container, hiddenInput);
                            input.value = ''; // Limpiar el input
                        }
                    }
                });

                container.addEventListener('click', function(event) {
                    if (event.target.classList.contains('remove-tag')) {
                        event.target.parentElement.remove();
                        updateHiddenInput(container, hiddenInput);
                    }
                });
            }

            function createTag(text, container, hiddenInput) {
                const tag = document.createElement('span');
                tag.className = 'tag';
                tag.style =
                    'margin-right: 5px; padding: 5px; background: #808080; color: white; border-radius: 3px; display: inline-flex; align-items: center;';
                tag.textContent = text;

                const removeBtn = document.createElement('span');
                removeBtn.className = 'remove-tag';
                removeBtn.textContent = ' ×';
                removeBtn.style = 'margin-left: 5px; cursor: pointer;';
                tag.appendChild(removeBtn);

                container.insertBefore(tag, container.querySelector('.tag-input'));
                updateHiddenInput(container, hiddenInput);
            }

            function updateHiddenInput(container, hiddenInput) {
                const tags = container.querySelectorAll('.tag');
                const tagValues = Array.from(tags).map(tag => tag.textContent.replace('×', '').trim());
                hiddenInput.value = tagValues.join(' ');
            }
            //Actividad Tabla
            try {
                // Obtener el valor original del campo de actividadesData
                let actividadesDataValue = document.getElementById('actividadesData').value;
                console.log('Original actividadesData Value:',
                    actividadesDataValue); // Mostrar el valor original

                // Paso 1: Limpiar la cadena de caracteres adicionales
                // Reemplazar secuencias de escape problemáticas
                actividadesDataValue = actividadesDataValue
                    .replace(/\\\\"/g, '"') // Reemplazar '\"' por '"'
                    .replace(/\\\\/g, '\\') // Reemplazar '\\' por '\'
                    .replace(/\\u00a0/g,
                        ' ') // Reemplazar '\u00a0' (espacio no separable) por un espacio normal
                    .replace(/\\\//g, '/') // Reemplazar '\/' por '/'
                    .replace(/\\\n/g, ' ') // Reemplazar 'nueva línea' por espacio
                    .replace(/\\"/g, '"') // Reemplazar '\"' por '"'
                    .replace(/\s{2,}/g, ' '); // Reemplazar múltiples espacios por uno solo.

                console.log('Step 1 Cleaned actividadesData Value:', actividadesDataValue);

                // Paso 2: Eliminar comillas dobles adicionales al principio y al final si existen
                if (actividadesDataValue.startsWith('"') && actividadesDataValue.endsWith('"')) {
                    actividadesDataValue = actividadesDataValue.slice(1, -1);
                }

                console.log('Step 2 Cleaned actividadesData Value:', actividadesDataValue);

                // Paso 3: Validar si la cadena empieza y termina con corchetes
                if (!actividadesDataValue.startsWith('[') || !actividadesDataValue.endsWith(']')) {
                    throw new Error('JSON malformado: no empieza y/o termina con corchetes.');
                }

                // Paso 4: Intentar parsear el JSON limpio
                actividadesArray = JSON.parse(actividadesDataValue);

                // Verificar si el objeto parseado es de tipo array
                if (!Array.isArray(actividadesArray)) {
                    throw new Error('Parsed actividadesArray is not an array');
                }

                console.log('Parsed Actividades Array:', actividadesArray);

                // Encontrar el máximo ID existente para inicializar actividadContador correctamente
                if (actividadesArray.length > 0) {
                    actividadContador = Math.max(...actividadesArray.map(actividad => actividad.id));
                }

                console.log('actividadContador inicializado en:', actividadContador);

            } catch (error) {
                console.error('Error parsing actividadesData:', error);
            }

            // Si el array se parseó correctamente, llenar la tabla
            if (Array.isArray(actividadesArray)) {
                actividadesArray.forEach(actividad => {
                    agregarFilaActividad(actividad);
                });
            }
            //

            //Documentos Tabla
            try {
                // Obtener el valor original del campo de documentosData
                let documentosDataValue = document.getElementById('documentosData').value;
                console.log('Original documentosData Value:',
                    documentosDataValue); // Mostrar el valor original

                // Paso 1: Limpiar la cadena de caracteres adicionales
                documentosDataValue = documentosDataValue
                    .replace(/\\\\"/g, '"') // Reemplazar '\"' por '"'
                    .replace(/\\\\/g, '\\') // Reemplazar '\\' por '\'
                    .replace(/\\u00a0/g,
                        ' ') // Reemplazar '\u00a0' (espacio no separable) por un espacio normal
                    .replace(/\\\//g, '/') // Reemplazar '\/' por '/'
                    .replace(/\\\n/g, ' ') // Reemplazar 'nueva línea' por espacio
                    .replace(/\\"/g, '"') // Reemplazar '\"' por '"'
                    .replace(/\s{2,}/g, ' '); // Reemplazar múltiples espacios por uno solo.

                console.log('Step 1 Cleaned documentosData Value:', documentosDataValue);

                // Paso 2: Eliminar comillas dobles adicionales al principio y al final si existen
                if (documentosDataValue.startsWith('"') && documentosDataValue.endsWith('"')) {
                    documentosDataValue = documentosDataValue.slice(1, -1);
                }

                console.log('Step 2 Cleaned documentosData Value:', documentosDataValue);

                // Paso 3: Validar si la cadena empieza y termina con corchetes
                if (!documentosDataValue.startsWith('[') || !documentosDataValue.endsWith(']')) {
                    throw new Error('JSON malformado: no empieza y/o termina con corchetes.');
                }

                // Paso 4: Intentar parsear el JSON limpio
                documentosArray = JSON.parse(documentosDataValue);

                // Verificar si el objeto parseado es de tipo array
                if (!Array.isArray(documentosArray)) {
                    throw new Error('Parsed documentosData is not an array');
                }

                console.log('Parsed documentosData Array:', documentosArray);

                // Encontrar el máximo ID existente para inicializar documentoContador correctamente
                if (documentosArray.length > 0) {
                    documentoContador = Math.max(...documentosArray.map(documento => documento.id));
                }

                console.log('documentoContador inicializado en:', documentoContador);

            } catch (error) {
                console.error('Error parsing documentosData:', error);
            }

            // Si el array se parseó correctamente, llenar la tabla
            if (Array.isArray(documentosArray)) {
                documentosArray.forEach(documento => {
                    agregarFilaDocumento(documento);
                });
            }
            //
        });
    </script>
@endsection
