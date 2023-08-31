@extends('adminlte::page')
@section('title', 'Editar Personal')

@section('css')
    @include('layouts.head_2')
@stop
@section('content')
    @php
        use App\Models\Area;
        use App\Models\Plaza;
        
        $areas = Area::all();
        $plazas = Plaza::all();
    @endphp
    @can('cNormal_PERSONAL#editar')
        <div class="container">
            @if (Auth::check())
                @if (session('message'))
                    <div class="alert alert-success">
                        <h2>{{ session('message') }}</h2>

                    </div>
                @endif
                <div class="row">
                    <h2 class="mt-3">Edici&oacute;n de Personal:  {{ $personal->apellido_paterno .' '.$personal->apellido_materno .' '. $personal->nombre }}</h2>
                    <hr>
                    <script type="text/javascript">
                        $(document).ready(function() {
                            $('#js-example-basic-single').select2();
                            $('#js-example-basic-single2').select2();
                            $('#js-example-basic-single3').select2();
                        });


                        var dateControl = document.querySelector('input[type="date"]');
                        dateControl.value = '2017-06-01';
                    </script>

                </div>
                <form action="{{ route('personal.update', $personal->id) }}" method="post" enctype="multipart/form-data"
                    class="col-12">
                    {!! csrf_field() !!}
                    {{ method_field('PUT') }}
                    <div class="row">
                        <div class="col">
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

                            <div class="row g-3 align-items-center">

                                <input class="form-control" id="activo" name="activo" type="hidden" value="1">

                                <div class="col-md-2">
                                    <label class="font-weight-bold" for="codigo">Código: *</label>
                                    <input class="form-control" id="codigo" name="codigo" type="number"
                                        value="{{ $personal->codigo }}">
                                </div>
                                <div class="col-md-2">
                                    <label class="font-weight-bold" for="apellido_paterno">Apellido paterno: *</label>
                                    <input class="form-control" id="apellido_paterno" name="apellido_paterno" type="text"
                                        value="{{ $personal->apellido_paterno }}">
                                </div>
                                <div class="col-md-2">
                                    <label class="font-weight-bold" for="apellido_materno">Apellido materno: *</label>
                                    <input class="form-control" id="apellido_materno" name="apellido_materno" type="text"
                                        value="{{ $personal->apellido_materno }}">
                                </div>
                                <div class="col-md-4">
                                    <label class="font-weight-bold" for="nombre">Nombre (s): *</label>
                                    <input class="form-control" id="nombre" name="nombre" type="nombre"
                                        value="{{ $personal->nombre }}">
                                </div>
                            </div>
                            <br>
                            <div class="row g-3 align-items-center">
                                <div class="col-md-6">
                                    <label class="font-weight-bold" for="grado_estudios">Grado de Estudios: *</label>
                                    <input class="form-control" id="grado_estudios" name="grado_estudios" type="text"
                                        value="{{ $personal->grado_estudios }}">
                                </div>

                                <div class="col-md-6">

                                    <label class="font-weight-bold" for="plaza">Plaza: *</label>
                                    <select class="form-control" id="js-example-basic-single2" name="plaza" required>
                                        <option>{{ $personal->plaza }}</option>
                                        @foreach ($plazas as $Plaza)
                                            <option value="{{ $Plaza->nombre }}">{{ $Plaza->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="row g-3 align-items-center">
                                <div class="col-md-4">
                                    <label class="font-weight-bold" for="categoria">Categoria: *</label>
                                    <select class="form-control" id="js-example-basic-single" name="categoria">
                                        <option>{{ $personal->categoria }}</option>
                                        <option>Administrativo</option>
                                        <option>Confianza</option>
                                        <option>Directivo</option>
                                        <option>Operativo</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label class="font-weight-bold" for="carga_horaria">Carga Horaria: *</label>
                                    <input class="form-control" id="carga_horaria" name="carga_horaria" type="number"
                                        value="{{ $personal->carga_horaria }}">
                                </div>

                                <div class="col-md-6">
                                    <label class="font-weight-bold" for="adscripcion">Adscripción: *</label>
                                    <select class="form-control" id="js-example-basic-single3" name="adscripcion">
                                        <option>{{ $personal->adscripcion }}</option>
                                        <option>Secretaría Académica - CTA - U. de Multimedia Instruccional</option>
                                        <option>Secretaría Académica - CTA - U. de Cómputo</option>
                                        <option>Secretaría Académica - CTA - Taller</option>
                                        <option>Secretaría Académica - CTA - Auditorio</option>
                                        <option>Secretaría Académica - CTA - Soporte</option>
                                        <option>Secretaría Académica - CTA - Préstamo Externo a Alumnos y Administrativos
                                        </option>
                                        <option>Secretaría Académica - CTA - Coord. de Redes Belenes</option>
                                        <option>Secretaría Académica - CTA - Bodega Baja Juan Manuel</option>
                                        <option>Secretaría Académica - Bufetes Jurídicos - Bufetes Jurídicos</option>
                                        <option>Secretaría Académica - Servicios Académicos, Coordinación - U. de Intercambio
                                        </option>
                                        <option>Secretaría Académica - Coord. de Servicios Académicos - U. de Biblioteca y
                                            Acervos Documentales</option>
                                        <option>Secretaría Académica -- Coord. de Servicios Académicos - Bibliotecas</option>
                                        <option>Secretaría Académica - Coord. de Servicios Académicos - U. de Becas</option>
                                        <option>Secretaría Académica - Coord. de Servicios Académicos - Becas e Intercambio
                                        </option>
                                        <option>Secretaría Académica - Coord. de Servicios Académicos - Coord. de Servicios
                                            Académicos</option>
                                        <option>Secretaría Académica - Coord. de Docencia - U. de Seguimiento de los procesos de
                                            Calidad de los Programas Educativos</option>
                                        <option>Secretaría Académica - Coor. de Investigación - Coord. de Investigación</option>
                                        <option>Secretaría Académica - Coord. de Investigación - U. de Investigación</option>
                                        <option>Secretaría Académica - Coord. de Posgrado - U. de Posgrado</option>
                                        <option>Secretaría Académica - Coord. de Planeación - U. de Planeación</option>
                                        <option>Secretaría Académica - Coord. de Planeación - Coord. de Planeación</option>
                                        <option>Secretaría Académica - Coord. de Control Escolar - Atención</option>
                                        <option>Secretaría Administrativa - U. de Transparencia - U. de Transparencia</option>
                                        <option>Secretaría Administrativa - Servicios Generales Belenes - Mantenimiento
                                            Servicios Generales</option>
                                        <option>Secretaría Administrativa - Coord. de Finanzas - U. de Contabilidad y Control
                                            Interno</option>
                                        <option>Secretaría Administrativa - Coord. de Finanzas - U. de Ingresos Autogenerados
                                        </option>
                                        <option>Secretaría Administrativa - Coord. de Finanzas - U. de Nóminas</option>
                                        <option>Secretaría Administrativa - Coord. de Finanzas - U. de Presupuesto</option>
                                        <option>Secretaría Administrativa - Coord. de Personal - U. de Personal Administrativo
                                        </option>
                                        <option>Secretaría Administrativa - Coord. de Personal - Administrativo</option>
                                        <option>Secretaría Administrativa - Coord. de Personal - U. de Personal Académico
                                        </option>
                                        <option>Secretaría Administrativa - Coord. de Personal - U. de Contratos Cíviles y
                                            Laborales</option>
                                        <option>Secretaría Administrativa - Coord. de Servicios Generales - Coord. de Servicios
                                            Generales</option>
                                        <option>Secretaría Administrativa - Coord. de Servicios Generales - U. Médica y
                                            Protección Cívil Belenes</option>
                                        <option>Secretaría Administrativa - Secretaría Administrativa - Secretaría
                                            Administrativa</option>
                                        <option>Secretaría Administrativa - CTA - Diseño Web</option>


                                        <option>Rectoría - Lab. Documentación Electrónica - Lab. Documentación Electrónica
                                        </option>
                                        <option>Rectoría - Contraloría - Controlaría-</option>
                                        <option>Rectoría - Congreso ALAS - Congreso ALAS</option>
                                        <option>Rectoría - Rectoría - Recepción Rectoría</option>
                                        <option>Rectoría - Rectoría - Secretaría Privada</option>
                                        <option>Rectoría - Rectoría - Secretaría Técnica</option>
                                        <option>Rectoría - Rectoría - Secretaría Particular</option>
                                        <option>Rectoría - Rectoría - Sala de Exposiciones</option>
                                        <option>Rectoría - Rectoría - Proyectos Digitalización Secretaría Privada</option>
                                        <option>Rectoría - Servicios Generales Belenes - Mantenimiento Belenes</option>


                                        <option>Div. de Estudios de Estado y Sociedad - Dpto. de Estudios en Educación - Depto.
                                            de Estudios en Educación</option>
                                        <option>Div. Estudios Históricos y Humanos - Geografía - Lab. Cartografía (b143)
                                            geotecnologías</option>
                                        <option>Div. Estudios Históricos y Humanos - Lab. Estudios Internacionales - Lab.
                                            Estudios Internacionales</option>
                                        <option>Div. Estudios Históricos y Humanos - Lab. de Estudios Históricos y Humanos I -
                                            Lab. de Estudios Históricos y Humanos I</option>
                                        <option>Div. Estudios Históricos y Humanos - Lab. de Estudios Históricos y Humanos II -
                                            Lab. Estudios Históricos y Humanos II</option>
                                        <option>Div. Estudios Históricos y Humanos - Depto. de Historia - Lab. de Arqueología
                                        </option>
                                        <option>Div. de Estudios de Estado y Sociedad - Dpto. de Estudios del Pacífico -
                                            Maestría en Global Politics and Transpacific Studies</option>
                                        <option>Div. de Estudios de la Cultura - Depto. de Estudios Literarios - Maestría en
                                            Literaturas Interamericanas</option>
                                        <option>Div. de Estudios de la Cultura - Depto. de Estudios Mesoamericanos y Mexicanos -
                                            Maestría en Estudios Mesoamericanos</option>
                                        <option>Div. de Estudios de Estado y Sociedad - Depto. de Estudios del Pacífico - Centro
                                            de Estudios Sobre América del Norte</option>
                                        <option>Div. de Estudios Políticos y Sociales - Depto. de Trabajo Social - Depto. de
                                            Trabajo Social</option>
                                        <option>Div. de Estudios Políticos y Sociales - Depto. de Sociología - Depto. de
                                            Sociología</option>
                                        <option>Div. de Estudios Políticos y Sociales - Depto. de Sociología - Instituto de
                                            Investigaciones Sociológicas</option>
                                        <option>Div. de Estudios Políticos y Sociales - Depto. de Sociología - Lab. de Estudios
                                            de Violencia (LESVI)</option>
                                        <option>Div. de Estudios Políticos y Sociales - Depto. de Estudios Políticos - Maestría
                                            en Ciencia Política</option>
                                        <option>Div. de Estudios Políticos y Sociales - Depto. de Estudios Políticos - Instituto
                                            de Investigaciones en Innovación y Gobernanza</option>
                                        <option>Div. de Estudios Políticos y Sociales - Depto. de Estudios Políticos - Doctorado
                                            en Ciencia Política</option>
                                        <option>Div. de Estudios Políticos y Sociales - Depto. de Estudios Políticos - Depto. de
                                            Estudios Políticos</option>
                                        <option>Div. de Estudios Políticos y Sociales - Depto. de Estudios Internacionales -
                                            Maestría en Relaciones Internacionales de Gobiernos y Actores Locales</option>
                                        <option>Div. de Estudios Políticos y Sociales - Depto. de Estudios Internacionales -
                                            Depto. de Estudios Internacionales</option>
                                        <option>Div. de Estudios Políticos y Sociales - Depto. de Desarrollo Social - Maestría
                                            en Gestión y Desarrollo Social</option>
                                        <option>Div. de Estudios Políticos y Sociales - Depto. de Desarrollo Social - Depto. de
                                            Desarrollo Social</option>
                                        <option>Div. de Estudios Jurídicos - Depto. de Estudios Interdiciplinarios en Ciencias
                                            Penales - Depto. de Estudios Interdiciplinarios en Ciencias Penales</option>
                                        <option>Div. de Estudios Jurídicos - Coord. de la Maestría en Ciencias Forenses y
                                            Criminología - Coord. de la Maestría en Ciencias Forenses y Criminología</option>
                                        <option>Div. de Estudios Jurídicos - Coord. de Carrera Semipresencial de Licenciatura en
                                            Derecho - Coord. de Carrera Semipresencial de Licenciatura en Derecho</option>
                                        <option>Div. de Estudios Jurídicos - Coord. de Licenciatura en Derecho - Coord. de
                                            Licenciatura en Derecho</option>
                                        <option>Div. de Estudios Jurídicos - Div. de Estudios Jurídicos - Sala de Juicios
                                            Orales:Mariano Otero</option>
                                        <option>Div. de Estudios Jurídicos - Div. de Estudios Jurídicos - Sala de Directores
                                        </option>
                                        <option>Div. de Estudios Jurídicos - Maestría en Derecho - Coord. en la Maestría en
                                            Derecho</option>
                                        <option>Div. de Estudios Jurídicos - Depto. de Derecho Privado - Depto. de Derecho
                                            Privado</option>
                                        <option>Div. de Estudios Jurídicos - Depto. de Derecho Privado - Lic. en Criminología
                                        </option>
                                        <option>Div. de Estudios Jurídicos - Depto. de Derecho Público - Depto. de Derecho
                                            Público</option>
                                        <option>Div. de Estudios Jurídicos - Depto. de Derecho Público - C. de Investigación
                                            Observatorio Sobre Seguridad</option>
                                        <option>Div. de Estudios Jurídicos - Depto. de Derecho Global - Depto. de Derecho Global
                                        </option>
                                        <option>Div. de Estudios Jurídicos - Depto. de Disciplinas sobre el Derecho - Depto. de
                                            Disciplinas sobre el Derecho</option>
                                        <option>Div. de Estudios Jurídicos - Doctorado en Derecho - Doctorado en Derecho
                                        </option>
                                        <option>Div. de Estudios Jurídicos - Div. de Estudios Jurídicos - Div. de Estudios
                                            Jurídicos</option>
                                        <option>Div. de Estudios Jurídicos - Div. de Estudios Jurídicos - Auditorio 1 (Edificio
                                            "I") Planta Baja</option>
                                        <option>Div. de Estudios Jurídicos - Div. de Estudios Jurídicos - Auditorio 2 (Edificio
                                            "I") Planta Baja</option>
                                        <option>Div. de Estudios Jurídicos - Div. de Estudios Jurídicos - Sala de Juicios Orales
                                        </option>
                                        <option>Div. de Estudios Jurídicos - Doctorado en Derecho - Doctorado en Derecho
                                        </option>
                                        <option>Div. de Estudios Jurídicos - Bufetes Jurídicos - Coord. de Bufetes Jurídicos
                                        </option>
                                        <option>Div. de Estudios Jurídicos - Depto. de Derecho Social y Disciplinas sobre el
                                            Derecho - Depto. de Derecho Social y Disciplinas sobre el Derecho</option>
                                        <option>Div. de Estudios de Estado y Sociedad - Depto. de Estudios Socio Urbanos - C. de
                                            Estudios Estrategicos para el Desarrollo</option>



                                        <option>C.U. de CS. Sociales y Humanidades - Sindicato - Delegación Académica</option>
                                        <option>C.U. de CS. Sociales y Humanidades - C.U. de CS. Sociales y Humanidades - C.U.
                                            de CS. Sociales y Humanidades</option>


                                    </select>
                                </div>


                            </div>
                            <br>
                            <div class="row g-3 align-items-center">
                                <div class="col-md-4">
                                    <label class="font-weight-bold" for="area_fisica">Área Física: *</label>
                                    <input class="form-control" id="area_fisica" name="area_fisica" type="text"
                                        value="{{ $personal->area_fisica }}">


                                </div>
                                <div class="col-md-4">
                                    <label class="font-weight-bold" for="sede">Sede: *</label>
                                    <input class="form-control" id="sede" name="sede" type="text"
                                        value="{{ $personal->sede }}">
                                </div>

                                <div class="col-md-6">
                                    <label for="" class="form-label">Adjuntar Reporte</label>
                                    <input type="file" name="pdf" id="pdf" class="form-control">
                                </div>

                            </div>
                            <br>

                            <div class="col-md-6">
                                <label class="font-weight-bold">Horario:</label>
                            </div>
                            <br>
                            <!-- DÍAS DE LA SEMANA -->
                            <div class="row g-3 align-items-center">
                                <div class="col-md-2">
                                    <label class="font-weight-bold">Lunes: *</label>
                                </div>
                                <div class="col-md-2">
                                    <label class="font-weight-bold">Martes: *</label>
                                </div>

                                <div class="col-md-2">
                                    <label class="font-weight-bold">Miércoles: *</label>
                                </div>
                                <div class="col-md-2">
                                    <label class="font-weight-bold">Jueves: *</label>
                                </div>
                                <div class="col-md-2">
                                    <label class="font-weight-bold">Viernes: *</label>
                                </div>
                                <div class="col-md-2">
                                    <label class="font-weight-bold">Sábado: *</label>
                                </div>
                            </div>
                            <!--CIERRE DIV ALINEACIÓN TEXTO-->

                            <!-- CAJAS DE TEXTO DE LOS DÍAS -->
                            <div class="row g-3 align-items-center">
                                <div class="col-md-2">
                                    <label class="font-weight-bold" for="lunes"></label>
                                    <input type="text" class="form-control" id="lunes" name="lunes"
                                        placeholder="Lunes" value="{{ $personal->lunes }}">
                                </div>
                                <div class="col-md-2">
                                    <label class="font-weight-bold" for="martes"></label>
                                    <input type="text" class="form-control" id="martes" name="martes"
                                        placeholder="Martes" value="{{ $personal->martes }}">
                                </div>
                                <div class="col-md-2">
                                    <label class="font-weight-bold" for="miercoles"></label>
                                    <input type="text" class="form-control" id="miercoles" name="miercoles"
                                        placeholder="Miércoles" value="{{ $personal->miercoles }}">
                                </div>
                                <div class="col-md-2">
                                    <label class="font-weight-bold" for="jueves"></label>
                                    <input type="text" class="form-control" id="jueves" name="jueves"
                                        placeholder="Jueves" value="{{ $personal->jueves }}">
                                </div>
                                <div class="col-md-2">
                                    <label class="font-weight-bold" for="viernes"></label>
                                    <input type="text" class="form-control" id="viernes" name="viernes"
                                        placeholder="Viernes" value="{{ $personal->viernes }}">
                                </div>
                                <div class="col-md-2">
                                    <label class="font-weight-bold" for="sabado"></label>
                                    <input type="text" class="form-control" id="sabado" name="sabado"
                                        placeholder="Sábado" value="{{ $personal->sabado }}">
                                </div>
                            </div>
                            <!--CIERRE DIV ALINEACIÓN CAJAS-->
                        </div>
                    </div>
                    <br>
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <a href="{{ route('home') }}" class="btn btn-danger">Cancelar</a>
                            <button type="submit" class="btn btn-success">
                                Guardar datos
                                <i class="ml-1 fas fa-save"></i>
                            </button>
                        </div>
                    </div>

                    <div class="row g-3 align-items-center">

                        <br>
                        <h5>En caso de inconsistencias, favor de reportarlas.</h5>
                        <hr>

                    </div>
                </form>
                <br>

        </div>
    @endcan
@else
    Acceso No válido
    @endif
@endsection
