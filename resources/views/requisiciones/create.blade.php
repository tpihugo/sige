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
                <h2>Captura de requisición </h2>

                <hr>
                <script type="text/javascript">

                    $(document).ready(function() {
                        $('#js-example-basic-single').select2();
                        $('#equipos').select2();
                    });

                </script>


            </div>

            <form action="{{route ('crear_requisicion')}}" method="post" enctype="multipart/form-data" class="col-12">
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
                            <div class="col-md-6">
                                <label for="num_solicitud">Número Solicitud</label>
                                <input type="text" class="form-control" id="num_solicitud" name="num_solicitud" value="{{old('num_solicitud')}}" required>
                            </div>
                            <div class="col-md-6">
                            <label for="fecha_inicio">Fecha:</label>
                            <input type="date" class="form-control" id="fecha" name="fecha" value="{{old('fecha')}}" required>
                            </div>
                        </div>
                        <br>

                            <div class="col-md-12">
                                <label for="cargo">Proyecto</label>
                                <input type="text" class="form-control" id="proyecto" name="proyecto" value="{{old('proyecto')}}" required>
                            </div>


                        </div>
                        <br>
                        <div class="row g-3 align-items-center">
                            <div class="col-md-4">
                                <label for="telefono">Fondo</label>
                                <input type="text" class="form-control" id="fondo" name="fondo" value="{{old('fondo')}}" required>
                            </div>

                            <div class="col-md-4">
                                <label for="fecha_inicio">Fecha Recibido:</label>
                                <input type="date" class="form-control" id="fecha_recibido" name="fecha_recibido" value="{{old('fecha_recibido')}}" required>
                            </div>
                            <div class="col-md-4">
                                <label for="correo">Recibido por:</label>
                                <input type="text" class="form-control" id="quien_recibio" name="quien_recibio" value="{{old('quien_recibio')}}" required>
                            </div>
                           <!--  <div class="col-md-4">
                                <label for="correo">ID:</label>
                              {{--  <input type="text" class="form-control" id="id" name="id" value="{{old('id')}}" required>--}}
                            </div>
 -->


                        </div>

			<br>
			<div class="row g-3 align-items-center">
                        	<div class="col-md-6">


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




</div>

@endsection
