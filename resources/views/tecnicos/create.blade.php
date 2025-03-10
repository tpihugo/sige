@extends('adminlte::page')
@section('title', 'Tecnico edit')

@section('css')
    @include('layouts.head_2')
@stop
@section('content')
    <div class="container">
        @if (Auth::check())
            @if (session('message'))
                <div class="alert alert-success">
                    <h2>{{ session('message') }}</h2>
                </div>
            @endif
            <div class="row">
                <h2>Captura de Técnico</h2>
                <hr>
            </div>
            <div class="row">
                <form action="{{ route('tecnicos.store') }}" method="post" class="col-sm-12">
                    <div class="row">
                        <div class="col">
                            {!! csrf_field() !!}
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <br>
                            <br>
                            <div class="row g-3 align-items-center">
                                <div class="col-md-6">
                                    <label for="usuario">Selecciona el usuario</label>
                                    <select class="form-control" id="usuario" name="usuario">
                                        <option disabled selected>Selecciona un usuario</option>
                                        @foreach ($users as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="ciclo_inicio">Ciclo de Inicio</label>
                                    <input class="form-control" id="ciclo_inicio" name="ciclo_inicio"
                                        value="{{ old('ciclo_inicio') }} " />
                                </div>
                                <div class="col-md-6">
                                    <label for="telefono">Teléfono de Contacto</label>
                                    <input class="form-control" id="telefono" name="telefono"
                                        value="{{ old('telefono') }} ">
                                </div>
                                <div class="col-md-6">
                                    <label for="telefono_emergencia">Teléfono de Emergencia</label>
                                    <input class="form-control" id="telefono_emergencia" name="telefono_emergencia"
                                        value="{{ old('telefono_emergencia') }} ">
                                </div>
                                <div class="col-md-6">
                                    <label for="asistencia">Asistencia</label>
                                    <input class="form-control" id="asistencia" name="asistencia"
                                        value="{{ old('asistencia') }} ">
                                </div>
                                <div class="col-md-6">
                                    <label for="carrera">Carrera</label>
                                    <input class="form-control" id="carrera" name="carrera" value="{{ old('carrera') }} ">
                                </div>
                                <div class="col-md-6">
                                    <label for="institucion">Institución</label>
                                    <input class="form-control" id="institucion" name="institucion"
                                        value="{{ old('institucion') }} ">
                                </div>
                                <div class="col-md-6">
                                    <label for="comentarios">Programa/Comentario</label>
                                    <input class="form-control" id="comentarios" name="comentarios"
                                        value="{{ old('comentarios') }} ">
                                </div>
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
            </div>
    </div>
@else
    Acceso No válido
    @endif
@endsection

@section('footer')
    <h5 class="text-end">En caso de inconsistencias, favor de reportarlas.</h5>
@endsection
@section('js')
    @include('layouts.scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#usuario').select2({
                theme: 'bootstrap-5'
            });
        });
    </script>
@endsection