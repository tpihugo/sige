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
                <h2>Captura de Personal</h2>
                <hr>
                <script type="text/javascript">

                    $(document).ready(function() {
                        $('#js-example-basic-single').select2();
                        $('#js-example-basic-single2').select2();
                        $('#equipos').select2();
                    });

                </script>

            </div>
            <form action="{{route('personal.store')}}" method="post" enctype="multipart/form-data" class="col-12">
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
                            <div class="row g-3 align-items-center">
                                <div class="col-md-12">
                                        <label for="NombreYApellidos">Nombre del Personal</label>
                                        <textarea class="form-control" id="NombreYApellidos" name="NombreYApellidos"></textarea>
                                </div>
                            </div>
                            <div class="row g-3 align-items-center">
                                <div class="col-md-12">
                                        <label for="Sexo">Sexo</label>
                                        <textarea class="form-control" id="Sexo" name="Sexo"></textarea>
                                </div>
                            </div>
                            <div class="row g-3 align-items-center">
                                <div class="col-md-12">
                                        <label for="RFC">RFC</label>
                                        <textarea class="form-control" id="RFC" name="RFC"></textarea>
                                </div>
                            </div>
                            <div class="row g-3 align-items-center">
                                <div class="col-md-12">
                                        <label for="CURP">CURP</label>
                                        <textarea class="form-control" id="CURP" name="CURP"></textarea>
                                </div>
                            </div>
                            <div class="row g-3 align-items-center">
                                <div class="col-md-12">
                                        <label for="Nacionalidad">Nacionalidad</label>
                                        <textarea class="form-control" id="Nacionalidad" name="Nacionalidad"></textarea>
                                </div>
                            </div>
                            <div class="row g-3 align-items-center">
                                <div class="col-md-12">
                                        <label for="División">División</label>
                                        <textarea class="form-control" id="División" name="División"></textarea>
                                </div>
                            </div>
                            <div class="row g-3 align-items-center">
                                <div class="col-md-12">
                                        <label for="DepartamentoAdscripcion">Departamento Adscripción</label>
                                        <textarea class="form-control" id="DepartamentoAdscripcion" name="DepartamentoAdscripcion"></textarea>
                                </div>
                            </div>
                            <div class="row g-3 align-items-center">
                                <div class="col-md-12">
                                        <label for="DepartamentoLabora">Departamento Laboral</label>
                                        <textarea class="form-control" id="DepartamentoLabora" name="DepartamentoLabora"></textarea>
                                </div>
                            </div>
                            <div class="row g-3 align-items-center">
                                <div class="col-md-12">
                                        <label for="Categoria">Categoria</label>
                                        <textarea class="form-control" id="Categoria" name="Categoria"></textarea>
                                </div>
                            </div>
                            <div class="row g-3 align-items-center">
                                <div class="col-md-12">
                                        <label for="Domicilio">Domicilio</label>
                                        <textarea class="form-control" id="Domicilio" name="Domicilio"></textarea>
                                </div>
                            </div>
                            <div class="row g-3 align-items-center">
                                <div class="col-md-12">
                                        <label for="Telefono">Teléfono</label>
                                        <textarea class="form-control" id="Telefono" name="Telefono"></textarea>
                                </div>
                            </div>
                            <div class="row g-3 align-items-center">
                                <div class="col-md-12">
                                        <label for="TelefonoCelular">Teléfono Celular</label>
                                        <textarea class="form-control" id="TelefonoCelular" name="TelefonoCelular"></textarea>
                                </div>
                            </div>
                            <div class="row g-3 align-items-center">
                                <div class="col-md-12">
                                        <label for="CodigoPostal">Código Postal</label>
                                        <textarea class="form-control" id="CodigoPostal" name="CodigoPostal"></textarea>
                                </div>
                            </div>
                            <div class="row g-3 align-items-center">
                                <div class="col-md-12">
                                        <label for="comentarios">Correo Electrónico</label>
                                        <textarea class="form-control" id="comentarios" name="comentarios"></textarea>
                                </div>
                            </div>

                        </div>

                        <br>
			<div class="row g-3 align-items-center">
                        	<div class="col-md-12">
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
    Acceso No válido
@endif
@endsection
