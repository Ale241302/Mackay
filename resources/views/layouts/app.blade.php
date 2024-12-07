<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" href="{{ asset('assets/Mackay.jpg') }}" type="image/x-icon">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @livewireStyles
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/estilos.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Incluir la fuente Inter desde Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <!-- CSS de Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />



    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .hidden {
            display: none;
        }

        .arrow {
            cursor: pointer;
        }

        .arrow i {
            transition: transform 0.3s;
        }

        .arrow.down i {
            transform: rotate(180deg);
        }

        .permissions-list {
            padding-left: 20px;
        }

        .custom-tabs .nav-link {
            border: none;
            color: #6c757d;
            /* Color de texto para pestañas inactivas */
            background-color: transparent;
            font-weight: bold;
        }

        .custom-tabs .nav-link.active {
            color: blue;
            /* Color de texto para la pestaña activa */
            background-color: white;
            /* Fondo de la pestaña activa */
            border-bottom: 3px solid blue;
            /* Borde inferior para la pestaña activa */
        }

        .custom-tabs .nav-link:hover {
            color: blue;
            /* Color de texto al pasar el ratón por encima */
        }

        .table-responsive th {
            font-family: 'Inter', sans-serif;
            color: gray;
            padding: 10px;
            /* Opcional: para agregar espacio alrededor del texto */
            text-align: left;
            /* Opcional: alinear el texto a la izquierda */
        }

        /* Estilo base para los enlaces de la barra lateral */
        .sidebar .nav-link {
            color: #6c757d;
            /* Color de texto normal */
            transition: color 0.3s ease;
            /* Efecto de transición para el cambio de color */
        }

        /* Efecto hover para los enlaces de la barra lateral */
        .sidebar .nav-link:hover {
            color: blue;
            /* Color cuando se pasa el cursor por encima */
        }

        /* Estilo para el enlace activo */
        .sidebar .nav-link.active {
            color: blue;
            /* Color de la opción activa */
        }
    </style>

</head>

<body class="font-sans antialiased">
    <x-banner />

    <div class="sidebar">
        <a class="navbar-brand" href="{{ route('dashboard') }}">
            <img src="{{ asset('assets/Mackay.jpg') }}" style="width: 250px; height: auto;" alt="logo">
        </a>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                    <i class="fas fa-home"></i>Dashboard
                </a>
            </li>
            @if (in_array('1', $permisosUsuario))
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('usuario*') ? 'active' : '' }}"
                        href="{{ route('usuario.index') }}">
                        <i class="fas fa-user"></i>Usuarios
                    </a>
                </li>
            @endif
            @if (in_array('13', $permisosUsuario))
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('abogados*') ? 'active' : '' }}"
                        href="{{ route('abogados.index') }}">
                        <i class="fas fa-user-tie"></i>Abogados
                    </a>
                </li>
            @endif
            @if (in_array('9', $permisosUsuario))
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('clientes') ? 'active' : '' }}"
                        href="{{ route('clientes.index') }}">
                        <i class="fa-solid fa-hand-holding-dollar"></i>Clientes
                    </a>
                </li>
            @endif
            @if (in_array('53', $permisosUsuario))
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('demandantes') ? 'active' : '' }}"
                        href="{{ route('demandantes.index') }}">
                        <i class="fa-solid fa-building"></i>Directorio
                    </a>
                </li>
            @endif
            @if (in_array('29', $permisosUsuario))
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('caso*') ? 'active' : '' }}"
                        href="{{ route('casos.index') }}">
                        <i class="fa-solid fa-chart-column"></i>Casos
                    </a>
                </li>
            @endif
            @if (in_array('37', $permisosUsuario))
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('subcaso*') ? 'active' : '' }}"
                        href="{{ route('subcasos.index') }}">
                        <i class="fa-solid fa-briefcase"></i>Subcasos
                    </a>
                </li>
            @endif
            <li class="nav-item">
                <a class="nav-link {{ request()->is('configuracion*') ? 'active' : '' }}" href="#"
                    id="configLink">
                    <i class="fas fa-cogs"></i> Configuracion
                    <i class="fas fa-chevron-down toggle-icon" id="toggleIcon"></i>
                </a>
                <ul class="nav hidden" id="configMenu" style="flex-direction: column;">
                    @if (in_array('5', $permisosUsuario))
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('usergroups*') ? 'active' : '' }}"
                                href="{{ route('usergroups.index') }}">
                                <i class="fas fa-user-tag"></i> Roles
                            </a>
                        </li>
                    @endif
                    @if (in_array('17', $permisosUsuario))
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('tipocaso*') ? 'active' : '' }}"
                                href="{{ route('tipocaso.index') }}">
                                <i class="fa-solid fa-tag"></i>Tipo Casos
                            </a>
                        </li>
                    @endif
                    @if (in_array('41', $permisosUsuario))
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('tipoprocesal*') ? 'active' : '' }}"
                                href="{{ route('tipoprocesal.index') }}">
                                <i class="fa-solid fa-bars-staggered"></i>Tipo Procesal
                            </a>
                        </li>
                    @endif
                    @if (in_array('45', $permisosUsuario))
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('montohora*') ? 'active' : '' }}"
                                href="{{ route('montohora.index') }}">
                                <i class="fa-solid fa-money-bill"></i>Monto Hora
                            </a>
                        </li>
                    @endif
                    @if (in_array('49', $permisosUsuario))
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('tribunal*') ? 'active' : '' }}"
                                href="{{ route('tribunal.index') }}">
                                <i class="fa-solid fa-gavel"></i>Tribunales
                            </a>
                        </li>
                    @endif
                    @if (in_array('21', $permisosUsuario))
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('tipoactividad*') ? 'active' : '' }}"
                                href="{{ route('tipoactividad.index') }}">
                                <i class="fa-solid fa-chart-line"></i>Actividades
                            </a>
                        </li>
                    @endif
                </ul>
            </li>

        </ul>
    </div>


    <!-- User Profile Dropdown -->
    <div class="dropdown profile-dropdown">
        @if (Auth::check())
            <button class="btn btn-outline-danger dropdown-toggle d-flex align-items-center" type="button"
                id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                @if (Auth::user()->profile_photo_path)
                    <img src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}" alt="Perfil"
                        class="rounded-circle"
                        style="width: 60px; height: 60px; object-fit: cover; margin-right: 8px;">
                @else
                    {{ Auth::user()->name }}
                @endif
            </button>

            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <li><a class="dropdown-item" href="#">Editar Perfil</a></li>
                <li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    <a class="dropdown-item" href="#"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar
                        Sesión</a>
                </li>
            </ul>
        @else
            <a href="{{ route('login') }}" class="btn btn-outline-danger">Ingresar</a>
        @endif
    </div>

    <div class="content">
        <div class="container mt-4">
            @yield('content') <!-- Aquí se renderizará el contenido de la sección -->
        </div>
    </div>

    @stack('modals')
    @livewireScripts

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var configLink = document.getElementById('configLink');
            var configMenu = document.getElementById('configMenu');
            var toggleIcon = document.getElementById('toggleIcon');

            if (configLink && configMenu && toggleIcon) {
                configLink.addEventListener('click', function(event) {
                    event.preventDefault();
                    configMenu.classList.toggle('hidden');
                    toggleIcon.classList.toggle('rotate');
                });
            } else {
                console.warn('One or more elements not found.');
            }

            // Ensure that dropdowns are initialized
            var dropdownButton = document.getElementById('dropdownMenuButton');
            if (dropdownButton) {
                dropdownButton.addEventListener('click', function() {
                    console.log('Dropdown button clicked');
                });
            }
        });
    </script>

    @yield('scripts')

</body>

</html>
