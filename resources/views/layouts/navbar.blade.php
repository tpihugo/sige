<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ url('/') }}">SIGE CTA CUCSH</a>
        <button
            class="navbar-toggler"
            type="button"
            data-toggle="collapse"
            data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="{{ __('Toggle navigation') }}"
        >
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                @can('AULAS_AREAS#ver')
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>Áreas</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('areas.create') }}">Captura Área</a></li>
                            <li><a class="dropdown-item" href="{{ route('areas.index') }}">Consulta Áreas</a></li>
                        </ul>
                    </li>
                @endcan

                @can('MOBILIARIO#ver')
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>Mobiliario</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @can('MOBILIARIO#crear')
                                <li><a class="dropdown-item" href="{{ route('mobiliarios.create') }}">Captura Mobiliario</a></li>
                            @endcan
                            <li><a class="dropdown-item" href="{{ route('mobiliarios.index') }}">Consulta Mobiliarios</a></li>
                        </ul>
                    </li>
                @endcan

                @can('EQUIPOS#ver')
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>Equipos y Préstamos</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('equipos.create') }}">Captura Equipo</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ route('nuevo-prestamo') }}">Crear Préstamo </a></li>
                            <li><a class="dropdown-item" href="{{ route('prestamos.index') }}">Consultar Préstamos</a></li>
                            <li><a class="dropdown-item" href="{{ route('prestamos-all') }}">Historial Préstamos</a></li>
                        </ul>
                    </li>
                @endcan

                @can('ESTADISTICAS#ver')
                    {{--
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>Estadisticas</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{ route('estadisticas') }}">Generales</a></li>
                            </ul>
                        </li>
                    --}}
                @endcan

                @can('TICKETS#ver')
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>Tickets</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('tickets.create') }}">Capturar Tickets</a></li>
                            <li><a class="dropdown-item" href="{{ route('tickets.index') }}">Consultar Tickets Abiertos</a></li>
                            <li><a class="dropdown-item" href="{{ route('revisionTickets') }}">Consultar Tickets Completos</a></li>
                        </ul>
                    </li>
                @endcan

                @can('CURSOS#ver')
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>Cursos</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @can('CURSOS#crear')
                            <li><a class="dropdown-item" href="{{ route('cursos.create') }}" >Capturar</a></li>
                        @endcan
                            <li><a class="dropdown-item" href="{{ url('cursos/2022A') }}">Todos</a></li>
                            <li><a class="dropdown-item" href="{{ route('cursos-laboratorios', '2022A') }}">Laboratorios</a></li>
                            <li><a class="dropdown-item" href="{{ route('cursos-presenciales', '2022A') }}">Presenciales</a></li>
                        </ul>
                    </li>
                @endcan

                @can('USUARIOS#ver')
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>Usuarios</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('usuarios.index') }}">Administrar Usuarios</a></li>
                            <li><a class="dropdown-item" href="{{ route('usuarios.index') }}">Roles y Permisos</a></li>
                        </ul>
                    </li>
                @endcan

                @can('LOGS#crear')
                    {{--
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>Logs</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{ route('logs.index') }}">Consultar Logs</a></li>
                            </ul>
                        </li>
                    --}}
                @endcan

                @can('PROYECTOS#ver')
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>Proyectos</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('proyectos.create') }}">Capturar Proyecto</a></li>
                            <li><a class="dropdown-item" href="{{ route('proyectos.index') }}">Consultar Proyectos</a></li>
                        </ul>
                    </li>
                @endcan

                @can('LICENCIAS#ver')
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>Licencias</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('licencias.create') }}">Capturar licencia</a></li>
                            <li><a class="dropdown-item" href="{{ route('licencias.index') }}">Consultar licencia</a></li>
                        </ul>
                    </li>
                @endcan

                @can('SERVICIOS#ver')
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>Servicios</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('servicios.create') }}">Capturar servicio</a></li>
                            <li><a class="dropdown-item" href="{{ route('servicios.index') }}">Consultar servicios</a></li>
                        </ul>
                    </li>
                @endcan

                @can('SUBREDES_IP#ver')
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>Subredes e IP's</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('subredes.create') }}">Captura Subred</a></li>
                            <li><a class="dropdown-item" href="{{ route('ips.create') }}">Captura IP</a></li>
                            <li><a class="dropdown-item" href="{{ route('subredes.index') }}">Consulta Subred</a></li>
                            <li><a class="dropdown-item" href="{{ route('ips.index') }}">Consulta IP</a></li>
                        </ul>
                    </li>
                @endcan

                @can('MENU_ADMINISTRADOR#ver')
                    <!-- ADMIN NAVBAR-MKII -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Administrador</a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @can('USUARIOS#ver')
                                <a class="dropdown-item" href="#"><strong>Usuarios</strong></a>
                                <a class="dropdown-item" href="{{ route('usuarios.index') }}">Administrar Usuarios</a>
                            @endcan

                            @can('LOGS#ver')
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#"><strong>Logs</strong></a>
                                <a class="dropdown-item" href="{{ route('logs.index') }}">Consultar Logs</a>
                            @endcan

                            @can('ESTADISTICAS#ver')
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#"><strong>Estadisticas</strong></a>
                                <a class="dropdown-item" href="{{ route('estadisticas') }}">Generales</a>
                            @endcan

                            @can('TECNICOS#ver')
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#"><strong>Técnicos</strong></a>
                                <a class="dropdown-item" href="{{ route('tecnicos.index') }}">Administrar Técnicos</a>
                            @endcan

                            @can('MANTENIMIENTO#ver')
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#"><strong>Mantenimiento</strong></a>
                                <a class="dropdown-item" href="{{ route('mantenimiento.index') }}">Consultar Mantenimiento</a>
                            @endcan
                        </div>
                    </li>
                @endcan
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    @if (Route::currentRouteName() == 'register')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Acceder') }}</a>
                        </li>
                    @endif

                    @if (Route::currentRouteName() == 'login')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Registrarse') }}</a>
                        </li>
                    @endif
                @endguest

                @auth
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();"
                            >
                                {{ __('Salir') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
