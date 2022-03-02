@extends('layouts.app')
@section('content')


    <div class="container">
        @if(Auth::check())
            @if (session('message'))
                <div class="alert alert-success">
                    <h2>{{ session('message') }}</h2>

                </div>
            @endif
            <div class="row">
                <h2>Captura de Préstamo o Traslado de Equipo Individual</h2>
                
                <hr>
                <script type="text/javascript">

                    $(document).ready(function() {
                        $('#js-example-basic-single').select2();
                        $('#equipos').select2();
                    });

                </script>

            </div>

                <form action="{{route ('guardar-nuevo-prestamo')}}" method="post" enctype="multipart/form-data" class="col-12">
                <div class="row">
                    <div class="col">
                        {!! csrf_field() !!}
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                        @foreach($errors->all() as $error)
                                            <li>{{$error}}</li>
                                        @endforeach
                                </ul>
                            </div>
                        @endif
                        <br>

                        <div class="row g-3 align-items-center">
                            <div class="col-md-8">
                                <label for="id_area">Área para préstamo o traslado</label>
                                <select class="form-control" class="form-control" id="js-example-basic-single" name="id_area">
                                    <option value="No Aplica" selected>No Aplica</option>
                                    @foreach($areas as $area)
                                        <option value="{{$area->id}}">{{$area->sede}} - {{$area->division}} - {{$area->coordinacion}} - {{$area->area}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="prioridad">Estado </label>
                                <select class="form-control" id="estado" name="estado">
                                    <option value="En préstamo" selected>En préstamo</option>
                                </select>
                            </div>

                        </div>
                        <br>
                        <div class="row g-3 align-items-center">
                            <div class="col-md-6">
                                <label for="solicitante">Solicitante</label>
                                <input type="text" class="form-control" id="solicitante" name="solicitante" value="{{old('solicitante')}}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="cargo">Cargo</label>
                                <input type="text" class="form-control" id="cargo" name="cargo" value="{{old('cargo')}}" required>
                            </div>


                        </div>
                        <br>
                        <div class="row g-3 align-items-center">
                            <div class="col-md-4">
                                <label for="telefono">Teléfono</label>
                                <input type="text" class="form-control" id="telefono" name="telefono" value="{{old('telefono')}}" required>
                            </div>
                            <div class="col-md-4">
                                <label for="correo">Correo</label>
                                <input type="text" class="form-control" id="correo" name="correo" value="{{old('correo')}}" required>
                            </div>

                            <div class="col-md-4">
                                <label for="fecha_inicio">Fecha:</label>
                                <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" value="{{old('fecha_inicio')}}" required>
                            </div>
                            
                        </div>

                        <div class="row g-3 align-items-center">
                            <div class="col-md-12">
                                <label for="observaciones">Observaciones</label>
                                <textarea class="form-control" id="observaciones" name="observaciones" required>{{old('observaciones')}}</textarea>
                            </div>
                        </div>
			<br>
			<div class="row g-3 align-items-center">
                        	<div class="col-md-6">
                           
                                    <!-- <a href="{{ route('home') }}" class="btn btn-primary">< Regresar</a> -->
        
                            		<a href="{{ route('home') }}" class="btn btn-danger">Cancelar</a>
                            		<button type="submit" class="btn btn-success">Guardar datos</button>
                        	</div>
                    	</div>

                    </div>
                    <br>
                    
                </div>
            </form>
            <br>
            <div class="row g-3 align-items-center">

                <br>
                <h5>En caso de inconsistencias, favor de reportarlas.</h5>
                <hr>

            </div>
    </div>

    

    @else
        El periodo de Registro de Proyectos a terminado
    @endif


@endsection
