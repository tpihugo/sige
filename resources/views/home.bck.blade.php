@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><b>{{ __('Menú') }}</b></div>
                
                <div class="card-body">
		@if(Auth::check() && Auth::user()->role =='admin')
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
                                <div class="col-md-2">
                                    <label>Búsqueda</label>
                                </div>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" id="busqueda" name="busqueda" >
                                </div>
                                <div class="col-md-2 mb-1">
                                    <button type="submit" class="btn btn-success">Buscar</button>
                                </div>
                                <div class="col-auto mb-1">
                                    <a href="{{ route('busquedaAvanzada') }}" class="btn btn-secondary">Avanzada</a>
                                </div>
                            </div>
                            <br>
                            <hr>
                            <br>
                            <div class="row align-items-center">
                                <div class="col-md-2">
                                    <label><b>Equipos</b></label>
                                </div>
                                <div class="col-auto mb-1">
                                    <a href="{{ route('equipos.create') }}" class="btn btn-outline-success">Captura Equipo</a>
                                </div>
                                <div class="col-auto mb-1">

                                    <!-- Botón en HTML (lanza el modal en Bootstrap) -->
                                    <a href="#info1" role="button" class="btn btn-outline-primary" data-toggle="modal">Crear Préstamo</a>

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
                                <div class="col-auto mb-1">
                                    <a href="{{ route('prestamos.index') }}" class="btn btn-outline-dark">Consultar Préstamos</a>
                                </div>
                            </div>

                            <br>
                            <hr>
                            <br>
                            <div class="row align-items-center">
                                <div class="col-md-2">
                                    <label><b>Tickets</b></label>
                                </div>
                                <div class="col-auto mb-1">
                                    <a class="btn btn-outline-success" href="{{ route('tickets.create') }}">Capturar Tickets</a>
                                </div>
                                <div class="col-auto mb-1">
                                    <a href="{{ route('tickets.index') }}" class="btn btn-outline-primary">Consultar Tickets</a>
                                </div>
                                <div class="col-auto mb-1">
                                    
                                </div>
                            </div>
                            <br>
                            <hr>
                            <br>
                           <div class="row align-items-center">
                              <div class="col-3 col-sm-3 col-md-2">
                                 <label><b>Inventario</b></label>
                              </div>
                              <div class="col-auto mb-1">
                                 <a class="btn btn-outline-success" href="{{ route('revision-inventario') }}" >Revisión Express</a>
                              </div>
                              <div class="col-auto mb-1">
                                 <a class="btn btn-outline-danger" href="{{ route('inventario-cta') }}" >Inventario General</a>
                              </div>
                              <div class="col-auto mb-1">
                                 <a class="btn btn-outline-danger" href="{{ route('panel-inventario') }}" >Panel de Revisión</a>
                                 
                              </div>
                           </div>

                            <br>
                            <hr>
                            <br>

                            <div class="row align-items-center">
                                <div class="col-md-2">
                                    <label><b>Aulas</b></label>
                                </div>
                                <div class="col-auto mb-1">
                                    <a class="btn btn-outline-primary" href="{{ route('areas.index') }}" >Listado &Aacute;reas</a>
                                </div>
				<div class="col-auto mb-1">
                                    <a class="btn btn-outline-secondary" href="{{ route('area-ticket','Belenes') }}" >Detalle Aulas</a>
                                </div>
                            </div>

                            <br>
                            <hr>
                            <br>
                            <div class="row align-items-center">
                                <div class="col-md-2">
                                    <label><b>Cursos</b></label>
                                </div>
                                <div class="col-auto mb-1">
                                    <a href="{{ route('cursos.create') }}" class="btn btn-outline-success">Capturar</a>
                                </div>
                                <div class="col-auto mb-1">
                                    <a class="btn btn-outline-primary" href="{{ url('cursos/2021B') }}">Todos</a>
                                </div>
<div class="col-auto mb-1">
                                    <a class="btn btn-outline-danger" href="{{ route('cursos-laboratorios', '2021B') }}">Laboratorios</a>
                                </div>

				<div class="col-auto mb-1">
                                    <a class="btn btn-outline-primary" href="{{ route('cursos-presenciales', '2021B') }}">Presenciales</a>
                                </div>
				

                            </div>
                            
                        </form>
                </div>
                @else
                    <div class="row align-items-center">
                                <div class="col-md-2">
                                    <label><b>Cursos</b></label>
                                </div>
				@if(Auth::user()->role =='admin')
                                	<div class="col-auto mb-1">
                                    		<a href="{{ route('cursos.create') }}" class="btn btn-outline-success">Capturar</a>
                                	</div>
				@endif
                                <div class="col-auto mb-1">
                                    <a class="btn btn-outline-primary" href="{{ url('cursos/2021B') }}">Todos</a>
                                </div>
				<div class="col-auto mb-1">
                                    <a class="btn btn-outline-primary" href="{{ route('cursos-presenciales', '2021B') }}">Presenciales</a>
                                </div>
				<div class="col-auto mb-1">
                                    <a class="btn btn-outline-danger" href="{{ route('cursos-laboratorios', '2021B') }}">Laboratorios</a>
                                </div>

                            </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

