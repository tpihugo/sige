<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
<div class="container-fluid">
<a class="navbar-brand" href="{{ url('/') }}">
SIGE CTA CUCSH


</a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
<span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="navbarSupportedContent">
<!-- Left Side Of Navbar -->
<ul class="navbar-nav mr-auto">
@if(Auth::check() && (Auth::user()->role =='admin' || Auth::user()->role =='rh' || Auth::user()->role =='cta' || Auth::user()->role =='redes'))

<li class="nav-item dropdown">
<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
Áreas
</a>
<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
<li><a class="dropdown-item" href="{{ route('areas.create') }}">Captura Área</a></li>
<li><a class="dropdown-item" href="{{ route('areas.index') }}">Consulta Áreas</a></li>
</ul>
</li>

@endif
@if(Auth::check() && (Auth::user()->role =='admin' || Auth::user()->role =='cta' || Auth::user()->role =='auxiliar' || Auth::user()->role =='redes' || Auth::user()->role =='general' ))


<li class="nav-item dropdown">
<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
Mobiliario
</a>
<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
@if(Auth::check() && (Auth::user()->role =='admin' || Auth::user()->role =='cta' || Auth::user()->role =='auxiliar' || Auth::user()->role =='redes'))
<li><a class="dropdown-item" href="{{ route('mobiliarios.create') }}">Captura Mobiliario</a></li>
@endif
<li><a class="dropdown-item" href="{{ route('mobiliarios.index') }}">Consulta Mobiliarios</a></li>
</ul>
</li>

@endif

@if(Auth::check() && (Auth::user()->role == 'admin' || Auth::user()->role == 'cta' || Auth::user()->role == 'auxiliar' || Auth::user()->role == 'redes'))

<li class="nav-item dropdown">
<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
Equipos y Préstamos
</a>
<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
<li><a class="dropdown-item" href="{{ route('equipos.create') }}">Captura Equipo</a></li>
<li><hr class="dropdown-divider"></li>
<li><a class="dropdown-item" href="{{ route('nuevo-prestamo') }}">Crear Préstamo </a></li>
<li><a class="dropdown-item" href="{{ route('prestamos.index') }}">Consultar Préstamos</a></li>
<li><a class="dropdown-item" href="{{ route('prestamos-all') }}">Historial Préstamos</a></li>
</ul>
</li>

@endif
@if(Auth::check() && (Auth::user()->role =='admin'))

{{-- <li class="nav-item dropdown">
<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
Estadisticas
</a>
<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
<li><a class="dropdown-item" href="{{ route('estadisticas') }}">Generales</a></li>
</ul>
</li> --}}

@endif

@if(Auth::check() && (Auth::user()->role =='admin'|| Auth::user()->role =='cta' || Auth::user()->role =='auxiliar' || Auth::user()->role =='redes'))


<li class="nav-item dropdown">
<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
Tickets
</a>
<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
<li><a class="dropdown-item" href="{{ route('tickets.create') }}">Capturar Tickets</a></li>
<li><a class="dropdown-item" href="{{ route('tickets.index') }}">Consultar Tickets Abiertos</a></li>
<li><a class="dropdown-item" href="{{ route('revisionTickets') }}">Consultar Tickets Completos</a></li>
</ul>

</li>

@endif

@if(Auth::check() && (Auth::user()->role =='admin'|| Auth::user()->role =='cta' || Auth::user()->role =='auxiliar' || Auth::user()->role =='redes' || Auth::user()->role =='aulas' || Auth::user()->role =='general'))


<li class="nav-item dropdown">
<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
Cursos
</a>
<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
@if(Auth::check() && Auth::user()->role !='general')
<li><a class="dropdown-item" href="{{ route('cursos.create') }}" >Capturar</a></li>
@endif
<li><a class="dropdown-item" href="{{ url('cursos/2022A') }}">Todos</a></li>
<li><a class="dropdown-item" href="{{ route('cursos-laboratorios', '2022A') }}">Laboratorios</a></li>
<li><a class="dropdown-item" href="{{ route('cursos-presenciales', '2022A') }}">Presenciales</a></li>
</ul>

</li>

@endif


@if(Auth::check() && (Auth::user()->role =='admin'))

{{-- <li class="nav-item dropdown">
<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
Usuarios
</a>
<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
<li><a class="dropdown-item" href="{{ route('usuarios.index') }}">Administrar Usuarios</a></li>

</ul>

</li> --}}
@endif
@if(Auth::check() && (Auth::user()->role =='admin')) 


{{-- <li class="nav-item dropdown">
<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
Logs
</a>
<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
<li><a class="dropdown-item" href="{{ route('logs.index') }}">Consultar Logs</a></li>

</ul>

</li> --}}			

@endif
@if(Auth::check() && (Auth::user()->role =='admin' || Auth::user()->role =='cta' || Auth::user()->role =='redes')) 



<li class="nav-item dropdown">
<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
Proyectos
</a>
<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
<li><a class="dropdown-item" href="{{ route('proyectos.create') }}">Capturar Proyecto</a></li>
<li><a class="dropdown-item" href="{{ route('proyectos.index') }}">Consultar Proyectos</a></li>
</ul>
</li>

@endif

@if(Auth::check() && (Auth::user()->role =='admin')) 

<li class="nav-item dropdown">
<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
Licencias
</a>
<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
<li><a class="dropdown-item" href="{{ route('licencias.create') }}">Capturar licencia</a></li>
<li><a class="dropdown-item" href="{{ route('licencias.index') }}">Consultar licencia</a></li>
</ul>
</li>  	
@endif


@if(Auth::check() && (Auth::user()->role =='admin' || Auth::user()->role =='cta' || Auth::user()->role =='redes'))
<li class="nav-item dropdown">
<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
Servicios
</a>
<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
<li><a class="dropdown-item" href="{{ route('servicios.create') }}">Capturar servicio</a></li>
<li><a class="dropdown-item" href="{{ route('servicios.index') }}">Consultar servicios</a></li>
</ul>
</li>

@endif

@if(Auth::check() && (Auth::user()->role =='admin' ||  Auth::user()->role =='cta' || Auth::user()->role =='redes'))

<li class="nav-item dropdown">
<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
Subredes e IP's
</a>
<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
<li><a class="dropdown-item" href="{{ route('subredes.create') }}">Captura Subred</a></li>
<li><a class="dropdown-item" href="{{ route('ips.create') }}">Captura IP</a></li>
<li><a class="dropdown-item" href="{{ route('subredes.index') }}">Consulta Subred</a></li>
<li><a class="dropdown-item" href="{{ route('ips.index') }}">Consulta IP</a></li>
</ul>
</li>

@endif

@if(Auth::check() && (Auth::user()->role =='admin'))

{{-- ADMIN NAVBAR-MKII --}}
<li class="nav-item dropdown">
<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
Administrador
</a>
<div class="dropdown-menu" aria-labelledby="navbarDropdown">
<a class="dropdown-item" href="#"><strong>Usuarios</strong></a>
<a class="dropdown-item" href="{{ route('usuarios.index') }}">Administrar Usuarios</a>
<div class="dropdown-divider"></div>
<a class="dropdown-item" href="#"><strong>Logs</strong></a>
<a class="dropdown-item" href="{{ route('logs.index') }}">Consultar Logs</a>
<div class="dropdown-divider"></div>
<a class="dropdown-item" href="#"><strong>Estadisticas</strong></a>
<a class="dropdown-item" href="{{ route('estadisticas') }}">Generales</a>
<div class="dropdown-divider"></div>
<a class="dropdown-item" href="#"><strong>Técnicos</strong></a>
<a class="dropdown-item" href="{{ route('tecnicos.index') }}">Administrar Técnicos</a>
<div class="dropdown-divider"></div>
<a class="dropdown-item" href="#"><strong>Mantenimiento</strong></a>
<a class="dropdown-item" href="{{ route('mantenimiento.index') }}">Consultar Mantenimiento</a>
</div>
</li>

@endif

</ul>


<!-- Right Side Of Navbar -->
<ul class="navbar-nav ml-auto">
<!-- Authentication Links -->
@guest
@if (Route::has('login'))
<li class="nav-item">
<a class="nav-link" href="{{ route('login') }}">{{ __('Acceder') }}</a>
</li>
@endif

@if (Route::has('register'))
<li class="nav-item">
<a class="nav-link" href="{{ route('register') }}">{{ __('Registrarse') }}</a>
</li>
@endif
@else
<li class="nav-item dropdown">
<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
{{ Auth::user()->name }}
</a>

<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

<a class="dropdown-item" href="{{ route('logout') }}"
onclick="event.preventDefault();
document.getElementById('logout-form').submit();">
{{ __('Salir') }}
</a>

<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
@csrf
</form>

</div>
</li>
@endguest
</ul>
</div>
</div>
</nav>