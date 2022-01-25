@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
<div class="content">
    <div class="container">
    <div class="row align-items-center">
@if(Auth::check() && (Auth::user()->role =='admin' || Auth::user()->role =='cta' || Auth::user()->role =='auxiliar' || Auth::user()->role =='redes' || Auth::user()->role =='aulas'))
 <div class="col-md-12">
        <div class="card card-chart">
            <div class="card-header card-header-success">
            B&uacute;squeda General
            </div>
            <div class="card-body">
	    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
            @endif
            @if (session('message'))
                  <div class="alert alert-success">
                        {{ session('message') }}
                  </div>
            @endif

           	<form action="{{route('busqueda')}}" method="POST" enctype="multipart/form-data" class="col-12">
                            {!! csrf_field() !!}
                            @if($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        Debe de escribir un criterio de búsqueda
                                    </ul>
                                </div>
                            @endif
                            <br>
                            <div class="row align-items-center">
                                <div class="col-md-2 offset-md-1">
                                    <h3 class="card-title"> <span class="text-success"><i class="fa fa-search"></span></i> Búsqueda</3>
                                </div>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" id="busqueda" name="busqueda" >
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-success">Buscar</button>
                                </div>
                               
                            </div>
	    	</form>
            
            
            </div>
            <div class="card-footer">
         
            </div>
        </div>
        </div>
</div>
        @endif
 <div class="col-md-12 ">
        <div class="card card-chart">
            <div class="card-header card-header-success">
            Sistema Integral de Gesti&oacute;n
            </div>
<div class="row m-1">

    @if (Auth::check() && (Auth::user()->role =='admin' || Auth::user()->role =='cta' || Auth::user()->role =='auxiliar' || Auth::user()->role =='redes'))
       <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="card card-stats ">
            <div class="card-header card-header-warning card-header-icon">
            <div class="card-icon">
                <i class="material-icons">devices</i>
            </div>
           
            <h3 class="card-title">Equipos <br></h3>
                <a href="{{ route('equipos.create') }}" class="btn btn-outline-success">Capturar Equipo</a>
                <a href="{{ route('nuevo-prestamo') }}" class="btn btn-outline-success">nuevo prestamo</a>
		<a href="{{ route('prestamos.index') }}" class="btn btn-outline-warning">Consultar Préstamos</a>
            </div>
            <div class="card-footer">
            <div class="stats">
                <i class="material-icons text-dark">important_devices</i>
		 <!-- Botón en HTML (lanza el modal en Bootstrap) -->
                                    <a href="#info1" data-toggle="modal">Crear Préstamo</a>
                                    <!-- Modal / Ventana / Overlay en HTML -->
                                    <div id="info1" class="modal fade">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><h5>X</h5></button>
                                                </div>
                                                <div class="modal-body">
                                                    <h5>Para Generar un Préstamo, primero busque el equipo, y seleccione la opción Préstamo en el respectivo elemento</h5>
                                                    <h3 class="text-warning"></h3>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
            </div>
            </div>

        </div>
        </div>

    @endif 
<!-- Apartado de Tickets  -->
	@if(Auth::check() && (Auth::user()->role =='admin' || Auth::user()->role =='cta' || Auth::user()->role =='auxiliar' || Auth::user()->role =='redes'))
	<div class="col-lg-4 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-header card-header-danger card-header-icon">
            <div class="card-icon">
                <i class="material-icons">info_outline</i>
            </div>
 	     <h3 class="card-title">Tickets</h3>            
             <a class="btn btn-outline-success" href="{{ route('tickets.create') }}">Capturar Tickets</a>
 	     <a href="{{ route('tickets.index') }}" class="btn btn-outline-danger">Consultar Tickets</a>
            </div>
            <div class="card-footer">
            <div class="stats">
                <i class="material-icons">local_offer</i> La Normal: {{$ticketsNormal}} 
		<i class="material-icons">local_offer</i> Belenes: {{$ticketsBelenes}} 
            </div>
            </div>
        </div>
        </div>
@endif
<!-- Apartado de Inventario   -->
	@if(Auth::check() && (Auth::user()->role =='admin'))

        <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-header card-header-success card-header-icon">
            <div class="card-icon">
                <i class="material-icons">fact_check</i>
            </div>
            <h3 class="card-title">Inventario</h3>
<a class="btn btn-outline-success" href="{{ route('revision-inventario') }}" >Revisión Express</a>

<a class="btn btn-outline-danger" href="{{ route('panel-inventario') }}" >Panel de Revisión</a>
            </div>
            <div class="card-footer">
            <div class="stats">
		<i class="material-icons">inventory</i><a href="{{ route('inventario-cta') }}" >Inventario General</a>
		<i class="material-icons">location_searching</i><a href="{{ route('inventario-localizado') }}" >Inventario Localizado</a>
            </div>
            </div>
        </div>
        </div>
@endif

<!-- Apartado de Aulas y �reas   -->
	@if(Auth::check() && (Auth::user()->role =='admin' || Auth::user()->role =='cta' || Auth::user()->role =='rh' || Auth::user()->role =='redes'))

        <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-header card-header-secondary card-header-icon">
            	<div class="card-icon">
                	<i class="material-icons">fact_check</i>
           	 </div>
	         <h3 class="card-title">Aulas y &Aacute;reas</h3>
	    	<a class="btn btn-outline-success" href="{{ route('areas.index') }}" >Listado &Aacute;reas</a>
            	<a class="btn btn-outline-secondary" href="{{ route('area-ticket','Belenes') }}" >Detalle Aulas</a>            
	    </div>
            <div class="card-footer">
            <div class="stats">
		<i class="material-icons">inventory</i><a href="{{ route('inventario-cta') }}" >Inventario General</a>
            </div>
            </div>
        </div>
        </div>
@endif
<!-- Apartado de Cursos   -->
	@if(Auth::check() && (Auth::user()->role =='admin' || Auth::user()->role =='cta' || Auth::user()->role =='aulas' || Auth::user()->role =='redes' || Auth::user()->role =='auxiliar'))

        <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-header card-header-info card-header-icon">
            <div class="card-icon">
                <i class="material-icons">school</i>
            </div>
	    <h3 class="card-title">Cursos</h3>           
		<a class="btn btn-outline-success" href="{{ route('cursos-presenciales', '2021B') }}">Presenciales</a>            
		<a class="btn btn-outline-danger" href="{{ route('cursos-laboratorios', '2021B') }}">Laboratorios</a>
	    
            </div>
            <div class="card-footer">
            <div class="stats">
		<i class="material-icons">spellcheck</i><a href="{{ route('cursos.create') }}" >Capturar</a> 
                <i class="material-icons">update</i><a  href="{{ url('cursos/2021B') }}">Todos</a>

            </div>
            </div>
        </div>
        </div>
@endif
<!-- Apartado de Usuarios   -->
	@if(Auth::check() && (Auth::user()->role =='admin'))
 <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-header card-header-success card-header-icon">
            <div class="card-icon">
                <i class="material-icons">people</i>
            </div>
	    <h3 class="card-title">Usuarios</h3>                   
		<a class="btn btn-outline-success" href="{{ route('usuarios.create') }}">Agregar Usuario</a>            
		<a class="btn btn-outline-danger" href="{{ route('usuarios.index') }}">Administrar Usuarios</a>       
            </div>
            <div class="card-footer">
            <div class="stats">
 <i class="material-icons">contact_phone</i>

            </div>
            </div>
        </div>
        </div>

    
        
@endif
    @if (Auth::check() && (Auth::user()->role =='admin' || Auth::user()->role =='cta' || Auth::user()->role =='auxiliar' || Auth::user()->role =='redes'))
       <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-header card-header-danger card-header-icon">
            <div class="card-icon">
                <i class="material-icons">chair</i>
            </div>
 	     <h3 class="card-title">Mobiliario</h3>            
             <a class="btn btn-outline-success" href="{{ route('mobiliarios.create') }}">Captura Mobiliário</a>
 	     <a href="{{ route('mobiliarios.index') }}" class="btn btn-outline-danger">Consulta Mobiliários</a>
            </div>
            <div class="card-footer">
            <div class="stats">
                <i class="material-icons">info</i>
            </div>
            </div>

        </div>
        </div>

    @endif 

     @if (Auth::check() && (Auth::user()->role =='admin' || Auth::user()->role =='cta' || Auth::user()->role =='redes'))
       <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
            <div class="card-icon">
                <i class="material-icons">build</i>
            </div>
 	     <h3 class="card-title">Proyectos</h3>            
             <a class="btn btn-outline-success" href="{{ route('proyectos.create') }}">Capturar Proyecto</a>
 	     <a href="{{ route('proyectos.index') }}" class="btn btn-outline-danger">Consulta Proyectos</a>
            </div>
            <div class="card-footer">
            <div class="stats">
                <i class="material-icons">info</i>
            </div>
            </div>

        </div>
        </div>

    @endif 

     @if (Auth::check() && (Auth::user()->role =='admin'))
       <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-header card-header-secundary card-header-icon">
            <div class="card-icon">
                <i class="material-icons">info_outline</i>
            </div>
 	     <h3 class="card-title">Licencias</h3>            
             <a class="btn btn-outline-success" href="{{ route('licencias.create') }}">Capturar licencia</a>
 	     <a href="{{ route('licencias.index') }}" class="btn btn-outline-danger">Consultar licencia</a>
            </div>
            <div class="card-footer">
            <div class="stats">
                <i class="material-icons">info</i>
            </div>
            </div>

        </div>
        </div>

    @endif 

     @if (Auth::check() && (Auth::user()->role =='admin'))
       <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-header card-header-success card-header-icon">
            <div class="card-icon">
                <i class="material-icons">dashboard</i>
            </div>
 	     <h3 class="card-title">Estadisticas</h3>            
             <a class="btn btn-outline-success" href="{{ route('estadisticas') }}">Consultar Estadisticas</a>
 	     
            </div>
            <div class="card-footer">
            <div class="stats">
                <i class="material-icons">info</i>
            </div>
            </div>

        </div>
        </div>

    @endif 
     @if (Auth::check() && (Auth::user()->role =='admin'))
       <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-header card-header-primary card-header-icon">
            <div class="card-icon">
                <i class="material-icons">info_outline</i>
            </div>
 	     <h3 class="card-title">Logs</h3>          
             <a class="btn btn-outline-success" href="{{ route('logs.index') }}">Consultar Logs</a>

 	     
            </div>
            <div class="card-footer">
            <div class="stats">
                <i class="material-icons">info</i>
            </div>
            </div>

        </div>
        </div>

    @endif
    
</div>
</div>
</div>{{-- fin del container --}}
    </div>{{-- fin del content --}}
@endsection
