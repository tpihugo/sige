@extends('layouts.app')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
</script>
    @if(Auth::check() && Auth::user()->role =='admin' || Auth::user()->role =='cta')

    <div class="container">
        <div class="container-fluid">
            @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
            <center><h3>Pr&eacutestamo {{$prestamo_id}}.</h3> <br></center>
                <table class="table table-success" style="width:100%">
                    <thead class="thead-light">
                    <tr>
                        <th>Folio</th>
                        <th>Solicitante</th>
                        <th>Cargo</th>
                        <th>&Aacuterea</th>
                        <th>Contacto</th>
                        <th>Estatus</th>
                        <th>Fecha</th>
                        <th>Observaciones</th>
<th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{{$prestamo->id}}</td>
                        <td>{{$prestamo->solicitante}}</td>
                        <td>{{$prestamo->cargo}}</td>
                        <td>{{$prestamo->lugar}}</td>
                        <td>{{$prestamo->contacto}}</td>
                        <td>{{$prestamo->estado}}</td>
                        <td>{{\Carbon\Carbon::parse($prestamo->fecha_inicio)->format('d/m/Y') }}</td>
			            <td>{{$prestamo->observaciones}}</td>
                    </tr>
                    </tbody>
                </table>
                <div style="text-align: center; justify-content: center;" class="row g-3 align-items-center">
                    <div class="col-md-5">  
                        <td><a class="btn btn-outline-info" style="width: auto" href="{{ route('imprimirPrestamo', $prestamo->id)}}" target="blank">Imprimir formato de préstamo</a></td>
                    </div>
                    <div class="col-md-5">  
                        <td><a class="btn btn-outline-success" style="width: auto" href="{{ route('imprimirContrato', $prestamo->id)}}" target="blank">Imprimir formato de contrato</a></td>
                    </div>
                </div>
                 <p>
                <br>
                </p>


                <h5><p align="center">Equipo ya Registrado</p></h5>
                <table class="table table-bordered" style="width:100%">
                    <thead>
                    <tr>
                        <th>Id SIGE</th>
                        <th>Id UdeG</th>
                        <th>Tipo Equipo</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Núm. Serie</th>
                        <th>Detalles</th>
                        <th>Comentarios</th>
                        <th>Accesorios</th>
                    </tr>
                    </thead>
                    <tbody>

                        @foreach($equipoPorPrestamo as $equipoPorPrestam)
                            <tr>
                                <td>{{$equipoPorPrestam->id_equipo}}</td>
                                <td>
                                    {{$equipoPorPrestam->udg_id}}
                                </td>
                                <td>{{$equipoPorPrestam->tipo_equipo}}</td>
                                <td>{{$equipoPorPrestam->marca}}</td>
                                <td>{{$equipoPorPrestam->modelo}}</td>
                                <td>{{$equipoPorPrestam->numero_serie}}</td>
                                <td>{{$equipoPorPrestam->detalles}}.</td>
                                <td> @if($equipoPorPrestam->resguardante=='CTA')
                                        Equipo de CTA.<br>
                                        @if($equipoPorPrestam->localizado_sici=='S')
                                            Localizado.
                                        @else
                                            No localizado.
                                        @endif
                                    @endif
                                </td>
                                <td>
                                    <form action="{{route('agregar-comentario')}}" method="POST">
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
                                                <input type="hidden" name="equipo_id" id="equipo_id" value="{{$equipoPorPrestam->id_equipo}}">
                                                <input type="hidden" name="prestamo_id" id="prestamo_id" value="{{$prestamo_id}}">
                                                <input type="text" name="comentarios" id="comentarios" value="{{$equipoPorPrestam->accesorios}}">
                                                <br><br>
                                                <input type="submit" class="btn btn-outline-success" value="Agregar">
                                            </div>
                                        </div>
                                    </form>
                                </td>
                                </br>
                                <td><a href="{{route('eliminarEquipoPrestamo', [$equipoPorPrestam->id_equipo, $prestamo_id])}}" class="btn btn-outline-danger">Quitar</a></td>



                            </tr>
                        @endforeach

                    </tbody>
                </table>

                
                <h5><p align="center">Agregar Equipos</p></h5>
                <form action="{{route('busquedaEquiposPrestamo')}}" method="POST" enctype="multipart/form-data" class="col-12">
                    {!! csrf_field() !!}
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                Debe de escribir un criterio de búsqueda
                            </ul>
                        </div>
                    @endif
                    <br>
                    <div class="row g-3 align-items-center">
                        <div class="col-md-2">
                            <label>Búsqueda</label>
                        </div>
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="busqueda" name="busqueda" >
                            <input type="hidden" class="form-control" id="prestamo_id" name="prestamo_id" value="{{$prestamo_id}}" readonly>
                        </div>
                        <div class="col-md-1">

                            <button type="submit" class="btn btn-success">Buscar</button>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('equipos.create') }}" class="btn btn-outline-success">Capturar Equipo</a>
                        </div>
                    </div>
                    <br>
                </form>
        <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                <tr>
                    <th>Id SIGE</th>
                    <th>Id UdeG</th>
                    <th>Tipo Equipo</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Núm. Serie</th>
                    <th>Detalles</th>
                    <th>Área</th>
                    <th>Acciones</th>

                </tr>
                </thead>
                
                <tbody>
                        @if(isset($equipos))
                                    @foreach($equipos as $equipo)
                                        <tr>
                                                <td>{{$equipo->id}}</td>
                                                <td>{{$equipo->udg_id}}</td>
                                                <td>{{$equipo->tipo_equipo}}</td>
                                                <td>{{$equipo->marca}}</td>
                                                <td>{{$equipo->modelo}}</td>
                                                <td>{{$equipo->numero_serie}}</td>
                                                <td>{{$equipo->detalles}}.<br><br>
                                                    @if($equipo->resguardante=='CTA')
                                                        Equipo de CTA.<br>
                                                        @if($equipo->localizado_sici=='S')
                                                            Localizado.
                                                        @else
                                                            No localizado.
                                                        @endif
                                                    @endif 
                                                </td>
                                                    <td>{{$equipo->area}}</td>
                                                    
                                                <td>     
                                                    @if($consult =DB::table('movimiento_equipos')->where('id_equipo' ,'=' ,$equipo->id)->orderBy('id', 'desc')->limit(1)->latest()->first())
                                                            @if($consult->registro == 'En préstamo')
                                                                <p><a onclick="modal({{ collect($equipo) }})" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#exampleModal" style="color: rgb(7,189,212)">En prèstamo</a></p>        
                                                            @else
                                                                <p><a href="{{route('registrarEquipoPrestamo', [$equipo->id, $prestamo_id])}}" class="btn btn-outline-success">Agregar</a></p>
                                                        @endif
                                                    @endif
                                                </td>
                                        </tr>
                       
                                        @endforeach
                        @endif
                    </tbody>
            </table>
              
        <p>
            <a href="{{ route('home') }}" class="btn btn-primary"> < Regresar</a>
        </p>
    </div>  
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


        $(document).ready(function() {
            $('#example').DataTable( {
                "pageLength": 20,
                "order": [[ 0, "asc" ]],
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
                    'copy', 'excel',
                    {
                        extend:'pdfHtml5',
                        orientation: 'landscape',
                        pageSize:'LETTER',
                    }

                ]
            } );
        } );
    </script>
@else
    Acceso No válido
@endif


<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Equipo en préstamo</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>                    
            </div>
            <div class="modal-body">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <h5>Id préstamo:</h5>
                        <strong id="id"></strong>        
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <h5>Área:</h5>
                        <strong id="lugar"></strong> 
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <h5>Solicitante:</h5>
                      <strong id="solicitante"></strong> 
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <h5>Contacto:</h5>
                       <strong id="contacto"></strong> 
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <h5>Responsable:</h5>
                       <strong id="responsable"></strong> 
                    </div>
                </div>
  
                
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <button type="button" class="btn grey btn btn-success" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div> 

 <script>
    function modal(params) {
       // console.log(params);
        $("#exampleModalLabel").html(params['prestamo']);

        if (params.hasOwnProperty('prestamo')){
            $("#id").html(params['prestamo']['id']);
            $("#lugar").html(params['prestamo']['lugar']);
            $("#solicitante").html(params['prestamo']['solicitante']);
            $("#contacto").html(params['prestamo']['contacto']);
            $("#responsable").html(params['prestamo']['responsable']);
        } else {
         //   console.log('entro');
        }
      
    
    }
</script> 

@endsection