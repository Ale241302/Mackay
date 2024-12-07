@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center mb-4">Crear Subcaso</h1>

        <form action="{{ route('subcasos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
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
                                <select id="caso" name="caso" class="form-control"
                                    onchange="fetchCasoData(this.value)">
                                    <option value="" selected>Seleccione un caso</option>
                                    @foreach ($casosActivos as $casosActivo)
                                        <option value="{{ $casosActivo->id }}" data-empresa="{{ $casosActivo->empresa }}"
                                            data-empresa-demandante="{{ $casosActivo->empresa_demandante }}"
                                            data-rut-demandante="{{ $casosActivo->rut_demandante }}"
                                            data-email-demandante="{{ $casosActivo->email_demandante }}"
                                            data-telefono-demandante="{{ $casosActivo->telefono_demandante }}"
                                            data-representante-demandante="{{ $casosActivo->representante_demandante }}"
                                            data-domicilio-demandante="{{ $casosActivo->domicilio_demandante }}"
                                            {{ old('caso') == $casosActivo->id ? 'selected' : '' }}>
                                            {{ $casosActivo->id }}
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
                                        <select id="empresa" name="empresa" class="form-control"
                                            onchange="fetchClienteData(this.value)">
                                            <option value="" selected>Seleccione una empresa</option>
                                            @foreach ($clientesActivos as $cliente)
                                                <option value="{{ $cliente->id }}"
                                                    {{ old('empresa') == $cliente->id ? 'selected' : '' }}>
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
                                            placeholder="Número RUT/NIT" maxlength="15" readonly
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
                                            placeholder="Correo Electrónico" maxlength="255"
                                            value="{{ old('email') }}" />
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <div data-mdb-input-init class="form-outline">
                                        <label class="form-label" for="telefono">Número Teléfono</label>
                                        <input type="text" id="telefono" name="telefono" class="form-control"
                                            placeholder="+5063046405009" maxlength="15" value="{{ old('telefono') }}" />
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
                                            value="{{ old('representante') }}" />
                                        @error('representante')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <div data-mdb-input-init class="form-outline">
                                        <label class="form-label" for="domicilio">Domicilio</label>
                                        <input type="text" id="domicilio" name="domicilio" class="form-control"
                                            placeholder="Domicilio" maxlength="255" value="{{ old('domicilio') }}" />
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
                                        <select id="demandante" name="demandante" class="form-control"
                                            onchange="fetchDemandanteData(this.value)">
                                            <option value="" disabled selected>Seleccione un demantante</option>
                                            @foreach ($demantantes as $demantante)
                                                <option value="{{ $demantante->id }}"
                                                    {{ old('demandante') == $demantante->id ? 'selected' : '' }}>
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
                                        <label class="form-label" for="empresa">Empresa (Registro Actual)</label>
                                        <input type="text" id="empresa_demandante" name="empresa_demandante"
                                            class="form-control" placeholder="Nombre Empresa"
                                            value="{{ old('empresa_demandante') }}" maxlength="30" />
                                        @error('empresa_demandante')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <div data-mdb-input-init class="form-outline">
                                        <label class="form-label" for="rut">RUT/NIT</label>
                                        <input type="text" id="rut_demandante" name="rut_demandante"
                                            class="form-control" placeholder="Número RUT/NIT" maxlength="15"
                                            value="{{ old('rut_demandante') }}" />
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
                                            value="{{ old('email_demandante') }}" />
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
                                            value="{{ old('telefono_demandante') }}" />
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
                                            value="{{ old('representante_demandante') }}" />
                                        @error('representante_demandante')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <div data-mdb-input-init class="form-outline">
                                        <label class="form-label" for="domicilio">Domicilio</label>
                                        <input type="text" id="domicilio_demandante" name="domicilio_demandante"
                                            class="form-control" placeholder="Domicilio" maxlength="255"
                                            value="{{ old('domicilio_demandante') }}" />
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
                                    placeholder="111" value="{{ old('referencia_caso') }}" maxlength="30" />
                                @error('referencia_caso')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div data-mdb-input-init class="form-outline">
                                <label class="form-label" for="rut">Nave/Descrición del Caso</label>
                                <input type="text" id="descripcion_caso" name="descripcion_caso" class="form-control"
                                    placeholder="descripcion del caso" maxlength="50"
                                    value="{{ old('descripcion_caso') }}" />
                                @error('descripcion_caso')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div data-mdb-input-init class="form-outline">
                                <label class="form-label" for="rut">Asunto/Caratula</label>
                                <input type="text" id="asunto_caso" name="asunto_caso" class="form-control"
                                    placeholder="Asunto" maxlength="15" value="{{ old('asunto_caso') }}" />
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
                                    class="form-control" placeholder="111" value="{{ old('referencia_demandante') }}"
                                    maxlength="30" />
                                @error('referencia_demandante')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div data-mdb-input-init class="form-outline">
                                <label class="form-label" for="referencia_caso">Fecha de Inicio</label>
                                <input type="date" id="fechai" name="fechai" class="form-control"
                                    value="{{ old('fechai') }}" max="{{ date('Y-m-d') }}" />
                                @error('fechai')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        @php
                            // Obtener solo los clientes con estado "Activo" y tipo_usuario igual a 5
                            $abogadosActivos = \App\Models\User::where('estado', 'Activo')
                               
                                ->get();
                            $abogadosActivos2 = \App\Models\User::where('estado', 'Activo')
                               
                                ->get();

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
                                <select id="abogados" name="abogados[]" class="form-control" multiple>
                                    <option value="" disabled>Seleccione una empresa</option>
                                    @foreach ($abogadosActivos as $abogados)
                                        <option value="{{ $abogados->id }}"
                                            {{ is_array(old('abogados')) && in_array($abogados->id, old('abogados')) ? 'selected' : '' }}>
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
                                                <input type="hidden" name="cobrofijo" value="0">
                                                <!-- Asegura que se envíe '0' cuando esté desmarcado -->
                                                <input class="form-check-input" type="checkbox" id="cobrofijo"
                                                    name="cobrofijo" value="1"
                                                    onchange="toggleLabel(this, 'label-cobrofijo')">
                                                <label id="label-cobrofijo" class="toggle-state-label"
                                                    for="cobrofijo">No</label>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Cobro Hora -->
                                    <div class="col">
                                        <div data-mdb-input-init class="form-outline">
                                            <label class="form-label" for="cobrohora">Cobro hora</label>
                                            <div class="form-switch">
                                                <input type="hidden" name="cobrohora" value="0">
                                                <!-- Asegura que se envíe '0' cuando esté desmarcado -->
                                                <input class="form-check-input" type="checkbox" id="cobrohora"
                                                    name="cobrohora" value="1"
                                                    onchange="toggleLabel(this, 'label-cobrohora')">
                                                <label id="label-cobrohora" class="toggle-state-label"
                                                    for="cobrohora">No</label>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Cobro Porciento -->
                                    <div class="col">
                                        <div data-mdb-input-init class="form-outline">
                                            <label class="form-label" for="cobroporciento">Cobro %</label>
                                            <div class="form-switch">
                                                <input type="hidden" name="cobroporciento" value="0">
                                                <!-- Asegura que se envíe '0' cuando esté desmarcado -->
                                                <input class="form-check-input" type="checkbox" id="cobroporciento"
                                                    name="cobroporciento" value="1"
                                                    onchange="toggleLabel(this, 'label-cobroporciento')">
                                                <label id="label-cobroporciento" class="toggle-state-label"
                                                    for="cobroporciento">No</label>
                                            </div>
                                        </div>
                                    </div>
                                    <script>
                                        function toggleLabel(checkbox, labelId) {
                                            const label = document.getElementById(labelId);
                                            label.textContent = checkbox.checked ? 'Sí' : 'No';
                                        }
                                    </script>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div data-mdb-input-init class="form-outline">
                                <label class="form-label" for="rol_caso">Rol</label>
                                <div id="tag-container" class="form-control"
                                    style="min-height: 38px; display: flex; align-items: center; flex-wrap: wrap;">
                                    <input type="text" id="rol_caso_input" class="tag-input" placeholder="E-122-2024"
                                        maxlength="50" style="border: none; outline: none; flex: 1;" />
                                </div>
                                <input type="hidden" id="rol_caso" name="rol_caso[]" value="{{ old('rol_caso') }}" />
                                @error('rol_caso')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                        <div class="col">
                            <div data-mdb-input-init class="form-outline">
                                <label class="form-label" for="rut">Nombre del Juicio</label>
                                <input type="text" id="nombre_juicio" name="nombre_juicio" class="form-control"
                                    placeholder="Nombre del Juicio" maxlength="30" value="{{ old('nombre_juicio') }}" />
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
                                <select id="tribunal" name="tribunal[]" class="form-control" multiple>
                                    <option value="" disabled>Seleccione un tribunal</option>
                                    @foreach ($tribunales as $tribunal)
                                        <option value="{{ $tribunal->id }}"
                                            {{ is_array(old('tribunal')) && in_array($tribunal->id, old('tribunal')) ? 'selected' : '' }}>
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
                                <input type="date" id="fechait" name="fechait" class="form-control"
                                    value="{{ old('fechait') }}" max="{{ date('Y-m-d') }}" />
                                @error('fechait')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div data-mdb-input-init class="form-outline">
                                <label class="form-label" for="rut">Juez Civil</label>
                                <input type="text" id="juez_civil" name="juez_civil" class="form-control"
                                    placeholder="Nombre del Juez Civil" maxlength="30"
                                    value="{{ old('juez_civil') }}" />
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
                                    placeholder="Nombre del Juez Arbitro" maxlength="30"
                                    value="{{ old('juez_arbitro') }}" />
                                @error('juez_arbitro')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div data-mdb-input-init class="form-outline">
                                <label class="form-label" for="rut">Rol Arbitral</label>
                                <div id="tag-container2" class="form-control"
                                    style="min-height: 38px; display: flex; align-items: center; flex-wrap: wrap;">
                                    <input type="text" id="rol_arbitral_input" class="tag-input"
                                        placeholder="E-122-2024" maxlength="50"
                                        style="border: none; outline: none; flex: 1;" />
                                </div>
                                <input type="hidden" id="rol_arbitral" name="rol_arbitral[]"
                                    value="{{ old('rol_arbitral') }}" />
                                @error('rol_arbitral')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div data-mdb-input-init class="form-outline">
                                <label class="form-label" for="rut">Bill of Lading</label>
                                <div id="tag-container3" class="form-control"
                                    style="min-height: 38px; display: flex; align-items: center; flex-wrap: wrap;">
                                    <input type="text" id="bill_input" class="tag-input" placeholder="E-122-2024"
                                        maxlength="50" style="border: none; outline: none; flex: 1;" />
                                </div>
                                <input type="hidden" id="bill" name="bill[]" value="{{ old('bill') }}" />
                                @error('bill')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col">
                            <div data-mdb-input-init class="form-outline">
                                <label class="form-label" for="tipo_moneda">Tipo de Moneda</label>
                                <select id="tipo_moneda" name="tipo_moneda" class="form-control">
                                    <option value="" disabled selected>Seleccione un tipo de moneda</option>
                                    <option value="USD" {{ old('tipo_moneda') == 'USD' ? 'selected' : '' }}>USD - Dólar
                                        Estadounidense</option>
                                    <option value="EUR" {{ old('tipo_moneda') == 'EUR' ? 'selected' : '' }}>EUR - Euro
                                    </option>
                                    <option value="CLP" {{ old('tipo_moneda') == 'CLP' ? 'selected' : '' }}>CLP - Peso
                                        Chileno</option>
                                    <option value="ARS" {{ old('tipo_moneda') == 'ARS' ? 'selected' : '' }}>ARS - Peso
                                        Argentino</option>
                                    <option value="UF" {{ old('tipo_moneda') == 'UF' ? 'selected' : '' }}>UF - Unidad
                                        Fomento</option>
                                </select>
                                @error('tipo_moneda')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div data-mdb-input-init class="form-outline">
                                <label class="form-label" for="rut">Monto Demanda</label>
                                <input type="number" id="monto_demanda" name="monto_demanda" class="form-control"
                                    placeholder="3.000" min="0" step="0.01"
                                    value="{{ old('monto_demanda') }}" />
                                @error('monto_demanda')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div data-mdb-input-init class="form-outline">
                                <label class="form-label" for="rut">Monto por Hora</label>
                                <select id="monto_hora" name="monto_hora" class="form-control">
                                    <option value="" disabled selected>Seleccione un monto</option>
                                    @foreach ($montohoras as $montohora)
                                        <option value="{{ $montohora->id }}"
                                            {{ old('monto_hora') == $montohora->id ? 'selected' : '' }}>
                                            {{ $montohora->id }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('monto_hora')
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
                                    <th style="text-align: center">Acciones</th>

                                </tr>
                            </thead>
                            <div class="tabla-contenedor">
                                <tbody id="tablaActividades">
                                    <!-- Las actividades se agregarán aquí -->
                                </tbody>
                            </div>
                            <input type="hidden" id="actividadesData" name="actividadesData" value="[]">
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
                            <input type="hidden" id="doucumentosData" name="documentosData" value="[]">
                        </table>
                    </div>
                </div>
                <div class="row mb-4">
                    <hr class="line-separator">
                    <!-- Tu lógica de PHP para obtener actividades y abogados -->
                    <div class="col">
                        <div data-mdb-input-init class="form-outline">
                            <label class="form-label" for="tipo_caso">Tipo de Caso</label>
                            <select id="tipo_caso" name="tipo_caso" class="form-control" required>
                                <option value="" disabled selected>Seleccione un tipo de caso</option>
                                @foreach ($tipocasos as $tipoCaso)
                                    <option value="{{ $tipoCaso->id }}"
                                        {{ old('tipo_caso') == $tipoCaso->id ? 'selected' : '' }}>
                                        {{ $tipoCaso->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('tipo_caso')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                    <div class="col">
                        <label for="estado_caso" class="form-label">Estado del caso</label>
                        <select id="estado_caso" name="estado_caso" class="form-control">
                            <option value="" disabled selected>Seleccione un estado
                            </option>
                            <option value="Iniciada" {{ old('estado_caso') == 'Iniciada' ? 'selected' : '' }}>Iniciada
                            </option>
                            <option value="Finalizado" {{ old('estado_caso') == 'Finalizado' ? 'selected' : '' }}>
                                Finalizado
                            </option>

                        </select>
                        @error('estado_caso')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="estado_caso" class="form-label">Estado Interno</label>
                        <select id="estado_casoi" name="estado_casoi" class="form-control">
                            <option value="" disabled selected>Seleccione un estado
                            </option>
                            <option value="Tramitacion" {{ old('estado_casoi') == 'Tramitacion' ? 'selected' : '' }}>
                                Tramitación
                            </option>
                            <option value="Suspendido" {{ old('estado_casoi') == 'Suspendido' ? 'selected' : '' }}>
                                Suspendido
                            </option>
                            <option value="TramitacionN" {{ old('estado_casoi') == 'TramitacionN' ? 'selected' : '' }}>
                                Tramitacion Negociando
                            </option>
                            <option value="SuspendidoN" {{ old('estado_casoi') == 'SuspendidoN' ? 'selected' : '' }}>
                                Suspendido Negociando
                            </option>
                            <option value="Transado" {{ old('estado_casoi') == 'Transado' ? 'selected' : '' }}>
                                Transado
                            </option>
                            <option value="Otra" {{ old('estado_casoi') == 'Otra' ? 'selected' : '' }}>
                                Otra Causal de Termino
                            </option>

                        </select>
                        @error('estado_casoi')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- Abogado -->
                    <div class="col">
                        <label for="etapa_procesal" class="form-label">Etapa Procesal</label>

                        <select id="etapa_procesal" name="etapa_procesal" class="form-control" required>
                            <option value="" disabled selected>Seleccione un tipo de caso</option>
                            @foreach ($tipoprocesal as $tipoprocesa)
                                <option value="{{ $tipoprocesa->id }}"
                                    {{ old('etapa_procesal') == $tipoprocesa->id ? 'selected' : '' }}>
                                    {{ $tipoprocesa->nombre }}
                                </option>
                            @endforeach
                        </select>
                        @error('etapa_procesal')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="text-center pt-1 mb-5 pb-1">
                    <button type="button" class="btn btn-secondary btn-block fs-lg mb-3"
                        onclick="window.history.back();">Volver</button>
                    <button class="btn btn-primary btn-block fs-lg mb-3" type="submit">Guardar</button>

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
                                    <input type="text" id="horas_trabajadas" name="horas_trabajadas"
                                        class="form-control" required>
                                </div>

                                <!-- Incluir Flatpickr -->
                                <link rel="stylesheet"
                                    href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
                                <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
                                <script>
                                    flatpickr("#horas_trabajadas", {
                                        enableTime: true,
                                        noCalendar: true,
                                        dateFormat: "H:i", // Formato de 24 horas
                                        time_24hr: true
                                    });
                                </script>
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
        let actividadContador = 0;
        let documentoContador = 0;

        function loadTipoActividad(selectElement) {
            // Obtener el tipo de actividad desde el atributo data-tipo de la opción seleccionada
            const selectedOption = selectElement.options[selectElement.selectedIndex];
            const tipoActividad = selectedOption.getAttribute('data-tipo');

            // Asignar el valor de tipo actividad al campo de texto correspondiente
            document.getElementById('tipo_actividad_valor').value = tipoActividad;
        }

        let filaActual = null; // Variable global para almacenar la fila actual en edición
        let filaActualDoc = null;
        let actividadesArray = [];
        let documentosArray = [];

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
                    id: actividadContador,
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
                    // Incrementar el contador de actividad para una nueva fila
                    actividadContador++;

                    // Asignar el ID a la actividad
                    actividadObj.id = actividadContador;

                    // Agregar la nueva actividad al array
                    actividadesArray.push(actividadObj);

                    // Crear una nueva fila en la tabla
                    let nuevaFila = `
                <tr data-id="${actividadContador}">
                    <td>${actividadContador}</td>
                    <td>${actividadTexto}</td>
                    <td>${tipoActividad}</td>
                    <td>${abogados}</td>
                    <td>${fechaHora}</td>
                    <td>${horasTrabajadas}</td>
                    <td>${realizada}</td>
                    <td>
            `;

                    // Verificar si el usuario tiene permisos para las diferentes acciones
                    @if (in_array(34, $permisosUsuario))
                        nuevaFila +=
                            `<button type="button" class="btn btn-warning btn-sm" onclick="editarFila(this)">Editar</button>`;
                    @endif
                    @if (in_array(33, $permisosUsuario))
                        nuevaFila +=
                            `<button type="button" class="btn btn-warning btn-sm" onclick="cargarhFila(this)">Cargar H</button>`;
                    @endif
                    @if (in_array(35, $permisosUsuario))
                        nuevaFila +=
                            `<button type="button" class="btn btn-danger btn-sm" onclick="eliminarFila(this)">Eliminar</button>`;
                    @endif

                    nuevaFila += `</td></tr>`;

                    // Agregar la nueva fila al cuerpo de la tabla
                    document.getElementById('tablaActividades').insertAdjacentHTML('beforeend', nuevaFila);
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
                                id: documentoContador,
                                abogadosdoc,
                                fechaHoradoc,
                                nombredoc,
                                documentoRuta: data.ruta, // La ruta del archivo subida
                                origen
                            };

                            // Incrementar el contador de documentos para una nueva fila
                            documentoContador++;

                            // Agregar el nuevo documento al array
                            documentosArray.push(documentoObj);
                            console.log('Documento agregado al array:',
                                documentoObj); // Debug: imprimir el documento agregado
                            console.log('Array de documentos actualizado:',
                                documentosArray); // Debug: imprimir el array actualizado

                            // Crear una nueva fila en la tabla
                            let nuevaFilaDoc = `
                    <tr data-id2="${documentoObj.id}">
                        <td>${documentoObj.id}</td>
                        <td>${abogadosdoc}</td>
                        <td>${fechaHoradoc}</td>
                        <td>${nombredoc}</td>
                        <td><a href="/storage/${data.ruta}" target="_blank">${documentoNombre}</a></td>
                        <td>${origen}</td>
                        <td>
                            `;

                            @if (in_array(28, $permisosUsuario))
                                nuevaFilaDoc +=
                                    `<button type="button" class="btn btn-danger btn-sm" onclick="eliminarFiladoc(this)">Eliminar</button>`;
                            @endif

                            nuevaFilaDoc += `</td></tr>`;

                            // Agregar la nueva fila al cuerpo de la tabla
                            document.getElementById('tablaDocumentos').insertAdjacentHTML('beforeend', nuevaFilaDoc);

                            // Actualizar el campo oculto con el array de documentos en formato JSON
                            document.getElementById('doucumentosData').value = JSON.stringify(documentosArray);

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
            console.log('ID del documento a eliminar:', docId); // Debug: verifica el id que se intenta eliminar

            // Buscar el objeto del documento en el array
            const documentoObj = documentosArray.find(doc => doc.id === docId);
            console.log('Objeto documento encontrado:', documentoObj); // Debug: verifica el objeto documento encontrado

            // Verificar si el documentoObj se ha encontrado
            if (!documentoObj) {
                console.error('No se encontró el documento con ID:', docId);
                alert('No se pudo encontrar el documento a eliminar.');
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
                            ruta: documentoObj.documentoRuta // Enviar la ruta del archivo al servidor
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
                            document.getElementById('doucumentosData').value = JSON.stringify(documentosArray);

                            // Log para verificar el contenido del array actualizado
                            console.log('Documentos restantes en el array:', documentosArray);
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

        function fetchCasoData(selectElement) {
            const selectedOption = selectElement.options[selectElement.selectedIndex];

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
                    document.getElementById('representante_demandante').value = data.representante_demandante || '';
                    document.getElementById('domicilio_demandante').value = data.domicilio_demandante || '';
                })
                .catch(error => {
                    console.error('Error fetching cliente data:', error);
                });
        }

        // Evento de cambio en el select de Caso Padre
        document.getElementById('caso').addEventListener('change', function() {
            fetchCasoData(this);
        });

        document.addEventListener('DOMContentLoaded', function() {
            const input = document.getElementById('rol_caso_input');
            const container = document.getElementById('tag-container');
            const hiddenInput = document.getElementById('rol_caso');
            const input2 = document.getElementById('rol_arbitral_input');
            const container2 = document.getElementById('tag-container2');
            const hiddenInput2 = document.getElementById('rol_arbitral');
            const input3 = document.getElementById('bill_input');
            const container3 = document.getElementById('tag-container3');
            const hiddenInput3 = document.getElementById('bill');

            input.addEventListener('keyup', function(event) {
                if (event.key === ' ' || event.key === 'Enter') {
                    const value = input.value.trim();
                    if (value) {
                        createTag(value, container, hiddenInput);
                        input.value = '';
                    }
                }
            });

            input2.addEventListener('keyup', function(event) {
                if (event.key === ' ' || event.key === 'Enter') {
                    const value2 = input2.value.trim();
                    if (value2) {
                        createTag(value2, container2, hiddenInput2);
                        input2.value = '';
                    }
                }
            });
            input3.addEventListener('keyup', function(event) {
                if (event.key === ' ' || event.key === 'Enter') {
                    const value3 = input3.value.trim();
                    if (value3) {
                        createTag(value3, container3, hiddenInput3);
                        input3.value = '';
                    }
                }
            });

            container.addEventListener('click', function(event) {
                if (event.target.classList.contains('remove-tag')) {
                    event.target.parentElement.remove();
                    updateHiddenInput(container, hiddenInput);
                }
            });

            container2.addEventListener('click', function(event) {
                if (event.target.classList.contains('remove-tag')) {
                    event.target.parentElement.remove();
                    updateHiddenInput(container2, hiddenInput2);
                }
            });
            container3.addEventListener('click', function(event) {
                if (event.target.classList.contains('remove-tag')) {
                    event.target.parentElement.remove();
                    updateHiddenInput(container3, hiddenInput3);
                }
            });

            function createTag(text, container, hiddenInput) {
                const tag = document.createElement('span');
                tag.className = 'tag';
                tag.style =
                    'margin-right: 5px; padding: 5px; background: #808080; color: white; border-radius: 3px; display: inline-flex; align-items: center;';
                tag.textContent = text;

                const removeBtn = document.createElement('span');
                removeBtn.className = 'remove-tag';
                removeBtn.textContent = '×';
                tag.appendChild(removeBtn);

                container.insertBefore(tag, container.querySelector('input'));
                updateHiddenInput(container, hiddenInput);
            }

            function updateHiddenInput(container, hiddenInput) {
                const tags = container.querySelectorAll('.tag');
                const tagValues = Array.from(tags).map(tag => tag.textContent.replace('×', '').trim());
                hiddenInput.value = tagValues.join(' ');
            }
        });
    </script>
@endsection
