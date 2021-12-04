<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">



    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" ></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>
<body>
@if(Auth::check())
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
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
    </div>
    <div class="container-fluid">
        <div class="row">
            @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
            <hr>
            @if(Auth::user()->role == 'admin')
                <h2>Administración General de Proyectos </h2>
            @elseif(Auth::user()->role == 'investigador')
                <h2>Listado de proyectos registrados como Investigador(a) </h2>
            @elseif(Auth::user()->role == 'evaluador')
                    <h2>Listado de proyectos registrados a Evaluar </h2>
            @elseif(Auth::user()->role == 'investigador-evaluador')
                @if($role->role == 'investigador')
                    <h2>Listado de proyectos registrados como Investigador(a) </h2>
                @elseif($role->role == 'evaluador')
                    <h2>Listado de proyectos registrados a Evaluar </h2>
                @endif
            @else
                <h1>Falta especificar rol</h1>
            @endif
            <br>
            @if(Auth::user()->role != 'admin' && Auth::user()->role != 'evaluador' && $numero_proyectos->cuenta_proyectos == 0 && $role->role != 'evaluador')
                  <p class="text-center"><a href="{{ route('proyectos.create') }}" class="btn btn-success">Capturar Nuevo Proyecto </a></p>
            @endif
            <br>
            <table id="example" class="table table-striped table-bordered" style="width:100% ">
                <thead>
                <tr>
                    <th>Proyecto</th>
                    @if(Auth::user()->role != 'evaluador' || $role->role != 'evaluador')
                        <th>Responsable</th>
                        <th>Adscripción</th>
                    @endif
                    <th>Detalle</th>
                    <th>Personal del Proyecto</th>
                    <th>Fecha del Proyecto</th>
                    <th>Resumen del Proyecto</th>
                    @if(Auth::user()->role != 'evaluador' || $role->role != 'evaluador')
                        <th>Proyecto en extenso</th>
                    @endif
                    <th>Proyecto</th>
                    <th>Estatus</th>
                </tr>
                </thead>
                <tbody>

                @foreach($proyectos as $proyecto)
                    <tr>
                        <td width="10%"><b>Folio: {{$proyecto->id}}.</b><br>
                            Año: {{$proyecto->anio}}. <br><b>Título: </b>{{$proyecto->titulo_proyecto}}. <br>
                            @if(Auth::user()->role != 'evaluador' || $role->role != 'evaluador')
                                <p><br><a href="{{ route('proyectos.show', $proyecto->id) }}" class="btn btn-primary">Detalles</a></p>
                                <p><a href="{{route('imprimirpdf',$proyecto->id)}}" class="btn btn-success">Imprimir</a></p>
                            @endif
                        </td>
                        @if(Auth::user()->role != 'evaluador' || $role->role != 'evaluador')
                            <td width="20%"><b>Nombre del responsable: </b>{{$proyecto->nombre_responsable}}.
                                <br><b>Correo electrónico: </b>{{$proyecto->correo_responsable}}
                                <br><b>Nombramiento: </b>{{$proyecto->nombramiento}}.
                                <br><b>Cuerpo Académico: </b>{{$proyecto->cuerpo_academico}}.
                                <br><b>Reconocimiento S.N.I: </b>{{$proyecto->reconocimiento_sni}}.
                                <br><b>Reconocimiento PROMEP: </b>{{$proyecto->reconocimiento_promep}}.
                                <br><b>Reconocimiento PROESDE: </b>{{$proyecto->reconocimiento_proesde}}.
                            </td>
                            <td width="10%">
                                <b>Departamento: </b>{{$proyecto->departamento}}
                                <br><b>División: </b>{{$proyecto->division}}.
                            </td>
                        @endif
                        <td width="15%">
                            <b>Registro de proyecto en otras instituciones: </b>{{$proyecto->registro_otras_instituciones}}
                            <br><b>Financiamiento: </b>{{$proyecto->financiamiento}}
                            <br><b>Opción de registro: </b>{{$proyecto->tipo_registro}}
                            @if($proyecto->monto_total>0)
                                <br><b>Montos: </b>Pasaje aereo nacional: ${{$proyecto->monto_pasaje_aereo_nacional}}
                                <br>Pasaje terrestre nacional: ${{$proyecto->monto_pasaje_terrestre_nacional}}
                                <br>Combustible para vehículo: ${{$proyecto->monto_combustible_vehiculo}}
                                <br>Viáticos (Hotel y Alimentos): ${{$proyecto->monto_viaticos}}

                                <br>Materiales menores de oficina (Toner, Papelería, Fotocopias): ${{$proyecto->monto_equipos_menores_oficina}}
                                <br><b>Monto total: </b>$ {{$proyecto->monto_total}}
                                <br><b>Justificación de montos económicos: </b>{{$proyecto->justificacion}}
                            @endif
                        </td>
                        <td width="10%">
                            <b>Personal académcio adscrito: </b>{{$proyecto->personal_adscrito}}
                            <br><b>Estudiantes colaboradores: </b>{{$proyecto->estudiantes_adscritos}}
                            <br><b>Colaboradores o asistentes al proyecto externos: </b>{{$proyecto->colaboradores_externos}}
                        </td>
                        <td width="5%"><b>Fecha inicio (mes/año): </b>{{$proyecto->fecha_inicio}}. <br><b>Fecha fin (mes/año): </b>{{$proyecto->fecha_fin}}</td>
                        <td width="20%">
                            @if(Auth::user()->role == 'admin')
                                <b>Tipo de Proyecto: </b>{{$proyecto->tipo_proyecto}}.
                                <br><b>Tiempo: </b>{{$proyecto->tiempo_proyecto}}.
                                <br>Para ver el detalle completo del proyecto presione <b><a href="{{ route('proyectos.show', $proyecto->id) }}">aquí</a></b>.
                            @elseif(Auth::user()->role == 'evaluador' || Auth::user()->role == 'investigador' ||  Auth::user()->role == 'investigador-evaluador')
                                <b>Abstract: </b>{{$proyecto->abstract}}.
                                <br><b>Tipo de Proyecto: </b>{{$proyecto->tipo_proyecto}}.
                                <br><b>Tiempo: </b>{{$proyecto->tiempo_proyecto}}.
                                <br><b>Objetivos: </b>{{$proyecto->objetivos}}.
                                <br><b>Preguntas: </b>{{$proyecto->preguntas}}.
                                <br><b>Hipótesis: </b>{{$proyecto->hipotesis}}.
                                <br><b>Metodología: </b>{{$proyecto->metodologia}}.
                                <br><b>Actividades de divulgación: </b>{{$proyecto->actividades_divulgacion}}.
                                <br><b>Actividades de vinculación: </b>{{$proyecto->actividades_vinculacion}}.
                            @endif
                        </td>
                        @if(Auth::user()->role != 'evaluador' || $role->role != 'evaluador')
                            @if(!is_null($proyecto->proyecto_extenso) && isset($proyecto->proyecto_extenso))
                                <td width="5%"><h5><a href="{{route('documento',['filename' =>$proyecto->proyecto_extenso])}}" target="_blank" download>Ver</a></h5></td>
                            @else
                                <td width="5%"><h5>No se subió documento</h5></td>
                            @endif
                        @endif
                        @if(!is_null($proyecto->proyecto_testado) && isset($proyecto->proyecto_testado))
                            <td width="5%"><h5><a href="{{route('documento-testado',['filename' =>$proyecto->proyecto_testado])}}" target="_blank" download>Ver</a></h5></td>
                        @else
                            <td width="5%"><h5>No se subió documento</h5></td>
                        @endif
                        <td width="5%">
                            @if(Auth::user()->role == 'evaluador' || $role->role == 'evaluador')
                                @if(is_null($proyecto->IdProyecto))
                                    <p><a href="{{ route('create-evaluacion',$proyecto->id) }}" class="btn btn-success">Capturar Evaluación</a></p>
                                @else
                                    @if($proyecto->evaluado == 'No')
                                        <p><a href="{{ route('evaluaciones.edit', $proyecto->IdEvaluacion) }}" class="btn btn-success">Ver Evaluación</a></p>
                                        <p><a class="btn btn-warning" role="button" href="#evaluacion_definitiva{{$proyecto->id}}" data-toggle="modal">Enviar evaluación</a></p>
                                        <!-- Modal / Ventana / Overlay en HTML -->
                                        <div id="evaluacion_definitiva{{$proyecto->id}}" class="modal fade">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><h4>X</h4></button>

                                                    </div>
                                                    <div class="modal-body">
                                                        <h5>¿Seguro de mandar como definitivo su evaluación para el proyecto: {{$proyecto->id}}?</h5>
                                                        <h5 class="text-primary"><small>{{$proyecto->titulo_proyecto}}</small></h5>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                        <a href="{{route('evaluacion-definitiva',$proyecto->id)}}" type="button" class="btn btn-success ">Enviar Definitivo</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @if($proyecto->evaluado == 'Si' && Auth::user()->role == 'admin')
                                        <p><a class="btn btn-dark" role="button" href="{{route('imprimir-evaluacion',$proyecto->id)}}">Imprimir Evaluación</a></p>
                                    @endif
                                @endif
                            @endif
                            @if($proyecto->definitivo=='Si')
                                @if($proyecto->evaluado == 'Si')
                                    <p>El proyecto ya fue evaluado.</p>
                                @else
                                    <p>El proyecto aún no ha sido evaluado.</p>
                                @endif
                            @else
                                <p>El proyecto aún no ha sido enviado para su evaluación.</p>
                            @endif
                            @if(Auth::user()->role == 'investigador' || $role->role == 'investigador')
                                    @if($proyecto->definitivo=='Si')
                                        <p>El proyecto ya fue enviado a su evaluación</p>
                                    @else
                                    <!-- Botón en HTML (lanza el modal en Bootstrap) -->
                                        <p><a href="#rolar{{$proyecto->id}}" role="button" class="btn btn-success" data-toggle="modal">Enviar Definitivo</a></p>

                                        <!-- Modal / Ventana / Overlay en HTML -->
                                        <div id="rolar{{$proyecto->id}}" class="modal fade">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><h4>X</h4></button>

                                                    </div>
                                                    <div class="modal-body">
                                                        <h5>¿Seguro de mandar como definitivo su registro Folio: {{$proyecto->id}}?</h5>
                                                        <h5 class="text-primary"><small>{{$proyecto->titulo_proyecto}}</small></h5>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                        <a href="{{route('rolar-definitivo', $proyecto->id)}}" type="button" class="btn btn-success ">Enviar Definitivo</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                                @if(Auth::user()->role == 'admin')
                                        <br><p><a href="#asignar_evaluador{{$proyecto->id}}" class="btn btn-secondary" role="button" data-toggle="modal">Asignar Evaluador(a)</a></p>
                                        <div id="asignar_evaluador{{$proyecto->id}}" class="modal fade">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <label for="proyecto"><b>Titulo: </b>{{$proyecto->titulo_proyecto}}</label>
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><h4>X</h4></button>
                                                    </div>
                                                        <div class="modal-body">

                                                            <br>
                                                            <form method="POST" action="{{route('asignar-evaluador')}}">
                                                                {!! csrf_field() !!}
                                                                <input type="hidden" class="form-control" id="proyecto_id" name="proyecto_id" value="{{$proyecto->id}}" readonly>
                                                                <label for="evaluador">Seleccionar Evaluador(a)*</label>
                                                                <select class="form-control" name="evaluador_id">
                                                                    <option disabled selected>Elegir</option>
                                                                    @foreach($evaluadores as $evaluador)
                                                                        <option value="{{$evaluador->id}}">{{$evaluador->name}}</option>
                                                                    @endforeach
                                                                </select>

                                                            <div class="modal-footer">
                                                                <button type="submit" name="Enviar" class="btn btn-success">Asignar</button>
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                            </div>
                                                            </form>
                                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                    @if($proyecto->evaluado == 'Si' && Auth::user()->role == 'admin')
                                        <p><a class="btn btn-dark" role="button" href="{{route('imprimir-evaluacion',$proyecto->id)}}">Imprimir Evaluación</a></p>
                                    @endif
                                @endif


                        </td>


                    </tr>
                @endforeach

                </tbody>

            </table>
            <div>

            </div>

        </div>
        <p>
            <a href="{{ route('home') }}" class="btn btn-primary">< Regresar</a>
        </p>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>

    <script src="https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.print.min.js"></script>
    <script>

    </script>
    <script>
        jQuery.extend( jQuery.fn.dataTableExt.oSort, {
            "portugues-pre": function ( data ) {
                var a = 'a';
                var e = 'e';
                var i = 'i';
                var o = 'o';
                var u = 'u';
                var c = 'c';
                var special_letters = {
                    "Á": a, "á": a, "Ã": a, "ã": a, "À": a, "à": a,
                    "É": e, "é": e, "Ê": e, "ê": e,
                    "Í": i, "í": i, "Î": i, "î": i,
                    "Ó": o, "ó": o, "Õ": o, "õ": o, "Ô": o, "ô": o,
                    "Ú": u, "ú": u, "Ü": u, "ü": u,
                    "ç": c, "Ç": c
                };
                for (var val in special_letters)
                    data = data.split(val).join(special_letters[val]).toLowerCase();
                return data;
            },
            "portugues-asc": function ( a, b ) {
                return ((a < b) ? -1 : ((a > b) ? 1 : 0));
            },
            "portugues-desc": function ( a, b ) {
                return ((a < b) ? 1 : ((a > b) ? -1 : 0));
            }
        } );
        //"columnDefs": [{ type: 'portugues', targets: "_all" }],

        $(document).ready(function() {
            $('#example').DataTable( {

                "order": [[ 0, "desc" ]],
                "language": {
                    "sProcessing": "Procesando...",
                    "sLengthMenu": "Mostrar _MENU_ registros",
                    "sZeroRecords": "No se encontraron resultados",
                    "sEmptyTable": "Ningún dato disponible en esta tabla",
                    "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix": "",
                    "sSearch": "Buscar:",
                    "sUrl": "",
                    "sInfoThousands": ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst": "Primero",
                        "sLast": "Último",
                        "sNext": "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                },
                dom: 'Bfrtip',
                buttons: [


                ]
            } );
        } );
    </script>
@else
    Acceso No válido
@endif
</body>
</html>
