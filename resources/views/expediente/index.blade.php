@extends('layouts.app')

@section('content')
@if(Auth::check() && Auth::user()->role == 'admin')

    <div class="container-fluid">
        <div class="row">
            @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">

  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="../material2/css/material-dashboard.css?v=3.0.0" rel="stylesheet" />
</head>

<body class="g-sidenav-show bg-gray-200">
 
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <div class="container-fluid">
      <div class="row">
        <div class="col-6 d-flex align-items-center">
          <h2 class="mb-0">Expediente</h2>
        </div>
        <div class="col-6 text-end">
          <a class="btn bg-gradient-dark mb-0" href="javascript:;"> <i class="fas fa-file-pdf"></i>&nbsp;&nbsp;Imprimir expediente</a>
          </div>
        </div>
        <div class="col-md-12 mb-lg-0 mb-4">
          <div class="card">
            <div class="card-header pb-0 p-1">
              <div class="card-body p-1">
                <ul class="list-group"> 
                @foreach($equipo as $equipo)       
                  <li class="list-group-item border-0 d-flex p-4 mb-2 mt-3 bg-gray-100 border-radius-lg">
                    <div class="d-flex flex-column">
                      <h3>Información del equipo</h3>
                      <h6>Tipo de equipo: <span class="text-dark ms-sm-1 font-weight-bold">{{$equipo[2]}}</span><h6>
                      <h6>Descripción: <span class="text-dark ms-sm-2 font-weight-bold">{{$equipo[6]}}</span></h6>
                      <h6>Modelo: <span class="text-dark ms-sm-2 font-weight-bold">{{$equipo[4]}}</span></h6>
                      <h6>Marca: <span class="text-dark ms-sm-2 font-weight-bold">{{$equipo[3]}}</span></h6>
                    </div>
                    <div class="ms-auto text-end">
                      <a href="#delete" role="button" class="btn btn-link text-danger text-gradient px-3 mb-0" data-toggle="modal" title="Eliminar">
                              Eliminar
                          </a>
                            <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                               <div class="modal-content">
                                  <div class="modal-header">
                                       <h5 class="modal-title" id="exampleModalLabel">¿Seguro que deseas eliminar este equipo?</h5>
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                                       </button>
                                 </div>
                         <div class="modal-body">
                        <p class="text-primary">
                          <small> 
                            Marca: '.{{$equipo[3]}}.', Modelo:'.{{$equipo[4]}}.', N/S: '.{{$equipo[5]}}.'
                          </small>
                           </p>
                         </div>
                           <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <a href="{{route('delete-equipo', $equipo[0])}}" type="button" class="btn btn-danger">Eliminar</a>
                         </div>
                          </div>
                      </div>
                  </div>  
                      <a class="btn btn-link text-dark px-3 mb-0" href="{{route('equipos.edit', $equipo[0])}}"><i class="material-icons text-sm me-2">edit</i>Editar</a>
                    </div>
                  </li>
                  
                </ul>
              </div>
            </div>

            <div class="container-fluid">
              <div class="row row-cols-1 row-cols-sm-2 row-cols-md-6">
              
              @if($equipo[8]=="")

                <div class="col">
                  <a href="javascript:;" type="button" data-toggle="modal" data-target="#modalR" data-dismiss="modal">
                    <div class="btn p-3">
                      <div class="card-header mx-5 p-1 text-center">
                        <div class=" pt-3 icon-lg bg-gradient-primary shadow  border-radius-lg text-center">
                          <i class="fas fa-file-pdf " style="color:#fff"></i>
                        </div>
                      </div>
                      <div class="card-body pt-0 p-1 text-center">
                        <hr class="horizontal dark my-3">
                        <h5 class="mb-0">Requisición</h5>
                      </div>
                    </div>
                  </a>
                </div>

                     <div class="modal fade" id="modalR" tabindex="-1" role="dialog" aria-labelledby="modalProyecto" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                           <form action="{{route('expedientes.update', $equipo[0])}}" method="post" enctype="multipart/form-data" class="col-12">
                              @method('put')
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Cargar requisición</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div> 
                          <div class="modal-body p-3">
                           <div class="mb-3">
                            <input type="hidden" name="requisicion" id="requisicion" value="1">
                            <input class="form-control btn btn-outline" type="file" name="file" id="file">
                          </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                              <button type="submit" class="btn btn-primary">Cargar</button>
                            </div>
                              @csrf
                          </form>
                          </div>
                        </div>
                      </div>

                @else
                <div class="col">
                  <a href="../archivos_expediente/{{$equipo[8]}}" target="_blank">
                    <div class="btn p-3">
                      <div class="card-header mx-5 p-1 text-center">
                        <div class=" pt-3 icon-lg bg-gradient-primary shadow  border-radius-lg text-center">
                          <i class="fas fa-file-pdf " style="color:#fff"></i>
                        </div>
                      </div>
                      <div class="card-body pt-0 p-1 text-center">
                        <hr class="horizontal dark my-3">
                        <h5 class="mb-0">Ver requisición</h5>
                      </div>
                    </div>
                  </a>
                </div>
                @endif


                @if($equipo[9]=="")

                <div class="col">
                  <a href="javascript:;" type="button" data-toggle="modal" data-target="#modalC" data-dismiss="modal">
                    <div class="btn p-3">
                      <div class="card-header mx-5 p-1 text-center">
                        <div class=" pt-3 icon-lg bg-gradient-danger shadow  border-radius-lg text-center">
                          <i class="fas fa-file-pdf " style="color:#fff"></i>
                        </div>
                      </div>
                      <div class="card-body pt-0 p-1 text-center">
                        <hr class="horizontal dark my-3">
                        <h5 class="mb-0">Cotización</h5>
                      </div>
                    </div>
                  </a>
                </div>

                     <div class="modal fade" id="modalC" tabindex="-1" role="dialog" aria-labelledby="modalProyecto" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                           <form action="{{route('expedientes.update', $equipo[0])}}" method="post" enctype="multipart/form-data" class="col-12">
                              @method('put')
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Cargar Cotización</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div> 
                          <div class="modal-body p-3">
                           <div class="mb-3">
                            <input type="hidden" name="cotizacion" id="cotizacion" value="2">
                            <input class="form-control btn btn-outline" type="file" name="file" id="file">
                          </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                              <button type="submit" class="btn btn-primary">Cargar</button>
                            </div>
                              @csrf
                          </form>
                          </div>
                        </div>
                      </div>

                @else
                <div class="col">
                  <a href="../archivos_expediente/{{$equipo[9]}}" target="_blank">
                    <div class="btn p-3">
                      <div class="card-header mx-5 p-1 text-center">
                        <div class=" pt-3 icon-lg bg-gradient-danger shadow  border-radius-lg text-center">
                          <i class="fas fa-file-pdf " style="color:#fff"></i>
                        </div>
                      </div>
                      <div class="card-body pt-0 p-1 text-center">
                        <hr class="horizontal dark my-3">
                        <h5 class="mb-0">Ver cotización</h5>
                      </div>
                    </div>
                  </a>
                </div>
                @endif

                @if($equipo[10]=="")

                <div class="col">
                  <a href="javascript:;" type="button" data-toggle="modal" data-target="#modalF" data-dismiss="modal">
                    <div class="btn p-3">
                      <div class="card-header mx-5 p-1 text-center">
                        <div class=" pt-3 icon-lg bg-gradient-success shadow  border-radius-lg text-center">
                          <i class="fas fa-file-pdf " style="color:#fff"></i>
                        </div>
                      </div>
                      <div class="card-body pt-0 p-1 text-center">
                        <hr class="horizontal dark my-3">
                        <h5 class="mb-0">Factura</h5>
                      </div>
                    </div>
                  </a>
                </div>

                     <div class="modal fade" id="modalF" tabindex="-1" role="dialog" aria-labelledby="modalProyecto" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                           <form action="{{route('expedientes.update', $equipo[0])}}" method="post" enctype="multipart/form-data" class="col-12">
                              @method('put')
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Cargar Factura</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div> 
                          <div class="modal-body p-3">
                           <div class="mb-3">
                            <input type="hidden" name="factura" id="factura" value="3">
                            <input class="form-control btn btn-outline" type="file" name="file" id="file">
                          </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                              <button type="submit" class="btn btn-primary">Cargar</button>
                            </div>
                              @csrf
                          </form>
                          </div>
                        </div>
                      </div>

                @else
                <div class="col">
                  <a href="../archivos_expediente/{{$equipo[10]}}" target="_blank">
                    <div class="btn p-3">
                      <div class="card-header mx-5 p-1 text-center">
                        <div class=" pt-3 icon-lg bg-gradient-success shadow  border-radius-lg text-center">
                          <i class="fas fa-file-pdf " style="color:#fff"></i>
                        </div>
                      </div>
                      <div class="card-body pt-0 p-1 text-center">
                        <hr class="horizontal dark my-3">
                        <h5 class="mb-0">Ver factura</h5>
                      </div>
                    </div>
                  </a>
                </div>
                @endif

                @if($equipo[11]=="")

                <div class="col">
                  <a href="javascript:;" type="button" data-toggle="modal" data-target="#modalO" data-dismiss="modal">
                    <div class="btn p-3">
                      <div class="card-header mx-5 p-1 text-center">
                        <div class=" pt-3 icon-lg bg-gradient-dark shadow  border-radius-lg text-center">
                          <i class="fas fa-file-pdf " style="color:#fff"></i>
                        </div>
                      </div>
                      <div class="card-body pt-0 p-1 text-center">
                        <hr class="horizontal dark my-3">
                        <h5 class="mb-0">Otros</h5>
                      </div>
                    </div>
                  </a>
                </div>

                     <div class="modal fade" id="modalO" tabindex="-1" role="dialog" aria-labelledby="modalProyecto" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                           <form action="{{route('expedientes.update', $equipo[0])}}" method="post" enctype="multipart/form-data" class="col-12">
                              @method('put')
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Cargar Otros</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div> 
                          <div class="modal-body p-3">
                           <div class="mb-3">
                            <input type="hidden" name="otros" id="otros" value="4">
                            <input class="form-control btn btn-outline" type="file" name="file" id="file">
                          </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                              <button type="submit" class="btn btn-primary">Cargar</button>
                            </div>
                              @csrf
                          </form>
                          </div>
                        </div>
                      </div>

                @else
                <div class="col">
                  <a href="../archivos_expediente/{{$equipo[11]}}" target="_blank">
                    <div class="btn p-3">
                      <div class="card-header mx-5 p-1 text-center">
                        <div class=" pt-3 icon-lg bg-gradient-dark shadow  border-radius-lg text-center">
                          <i class="fas fa-file-pdf " style="color:#fff"></i>
                        </div>
                      </div>
                      <div class="card-body pt-0 p-1 text-center">
                        <hr class="horizontal dark my-3">
                        <h5 class="mb-0">Ver otros</h5>
                      </div>
                    </div>
                  </a>
                </div>
                @endif

              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-7 mt-4">
          <div class="card">
            <div class="card-header pb-0 p-3">
              <div class="row">
                <div class="col-6 d-flex align-items-center">
                  <h6 class="mb-0">Mantenimientos</h6>
                </div>  
                <div class="col-6 text-end">
                  <a  type="button" data-toggle="modal" data-target="#modalManto" data-dismiss="modal">
                  <button class="btn bg-gradient-dark mb-0"><i class="material-icons text-sm">add</i>&nbsp;&nbsp;Crear mantenimiento</button></a>
                  </div>
                </div>
              </div>

              <div class="modal fade" id="modalManto" tabindex="-1" aria-labelledby="modalMantenimientos" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                        <form action="{{route('mantenimientoEquipos.store')}}" method="post" enctype="multipart/form-data" class="col-12">
                              
                      <h5 class="modal-title" id="exampleModalLabel">Crear mantenimiento</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Detalles del mantenimiento</label>
                        <input type="hidden" name="equipos_id" value="{{$equipo[0]}}">  
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="detalles"></textarea>
                      </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                      <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                  </div>
                </form>
                </div>
              </div>
            <div class="card-body pt-4 p-3">
              <ul class="list-group">
              
                <li class="list-group-item border-0 d-flex p-4 mb-2 mt-3 bg-gray-100 border-radius-lg">
                  <div class="d-flex flex-column">
                    <h6 class="mb-3 text-sm">Realizo</h6>
                    <span class="mb-2 text-xs">Fecha: <span class="text-dark font-weight-bold ms-sm-2">xxxxx</span></span>
                    <span class="mb-2 text-xs">Detalles: <span class="text-dark ms-sm-2 font-weight-bold">xxxx</span></span>
                    
                  </div>
                  <div class="ms-auto text-end">
              
                    <a class="btn btn-link text-dark px-3 mb-0" href="javascript:;">+ detalles</a>
                  </div>
                </li>
              </ul>
            </div>
          </div>

          <div class="card">
            <div class="card-header pb-0 p-3">
              <div class="row">
                <div class="col-6 d-flex align-items-center">
                  <h6 class="mb-0">Revición express</h6>
                </div>
              </div>
              </div>

            <div class="card-body pt-4 p-3">
              <ul class="list-group">
                <li class="list-group-item border-0 d-flex p-4 mb-2 mt-3 bg-gray-100 border-radius-lg">
                  <div class="d-flex flex-column">
                    <h6 class="mb-3 text-sm">Realizo</h6>
                    <span class="mb-2 text-xs">Fecha: <span class="text-dark font-weight-bold ms-sm-2">xxxxx</span></span>
                    <span class="mb-2 text-xs">Detalles: <span class="text-dark ms-sm-2 font-weight-bold">xxxx</span></span>
                  </div>
                  <div class="ms-auto text-end">
                    <a class="btn btn-link text-dark px-3 mb-0" href="javascript:;">+ detalles</a>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>

        <div class="col-md-5 mt-4">
          <div class="card">
            <div class="card-header pb-0 p-3">
              <div class="row">
                <div class="col-6 d-flex align-items-center">
                  <h6 class="mb-0">Proyectos</h6>
                </div>
               
                
               
                <div class="col-6 text-end">
                  <button type="button" class="btn bg-gradient-dark" data-toggle="modal" data-target="#modalProyecto" data-dismiss="modal" data-backdrop="false">
                    Asignar proyecto
                  </button>
             
                  </div> 
                
                  <div class="card-body pt-4 p-3 ">
                    <ul class="list-group">
                      <li class="list-group-item border-0 d-flex p-4 mb-2 mt-3 bg-gray-100 border-radius-lg">
                        <div class="d-flex flex-column">
                          <h6 class="text-sm">Asigna un proyecto</h6>      
                        </div>
                      </li>
                    </ul>
                  </div>
                  
                </div>
              </div>
            </div>
          <div class="card mb-4">
            <div class="card-header pb-0 px-3">
              <div class="row">
                <div class="col-md-6">
                  <h6 class="mb-0">Tickets</h6>
                </div>
                <div class="col-6 text-end">
                  <a class="btn bg-gradient-dark mb-0" href="{{ route('tickets.create') }}"><i class="material-icons text-sm"></i>&nbsp;&nbsp;Crear ticket</a>
                  </div>
                
              </div>
            </div>
            <div class="card-body pt-4 p-3">
              <h6 class="text-uppercase text-body text-xs font-weight-bolder mb-3">Abiertos</h6>
              <ul class="list-group">
               @foreach($ticket as $ticket)

                <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                  <div class="d-flex align-items-center">
                    {!! $ticket[0] !!}
                    <div class="d-flex flex-column">
                      <h6 class="mb-1 text-dark text-sm">Requisitor:</h6>
                      <h6 class="mb-1 text-dark text-sm">{{$ticket[5]}}</h6>
                      
                    </div>
                  </div>
                  
                </li>
                @endforeach
              </ul>
              <h6 class="text-uppercase text-body text-xs font-weight-bolder my-3">Cerrados</h6>
              <ul class="list-group">
                <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                  <div class="d-flex align-items-center">
                    <button class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-3 p-3 btn-sm d-flex align-items-center justify-content-center"><i class="material-icons text-lg">expand_less</i></button>
                    <div class="d-flex flex-column">
                      <h6 class="mb-1 text-dark text-sm">Stripe</h6>
                      <span class="text-xs">26 March 2020, at 13:45 PM</span>
                    </div>
                  </div>
                  <div class="d-flex align-items-center text-success text-gradient text-sm font-weight-bold">
                    + $ 750
                  </div>
                </li>
                <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                  <div class="d-flex align-items-center">
                    <button class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-3 p-3 btn-sm d-flex align-items-center justify-content-center"><i class="material-icons text-lg">expand_less</i></button>
                    <div class="d-flex flex-column">
                      <h6 class="mb-1 text-dark text-sm">HubSpot</h6>
                      <span class="text-xs">26 March 2020, at 12:30 PM</span>
                    </div>
                  </div>
                  <div class="d-flex align-items-center text-success text-gradient text-sm font-weight-bold">
                    + $ 1,000
                  </div>
                </li>
                <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                  <div class="d-flex align-items-center">
                    <button class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-3 p-3 btn-sm d-flex align-items-center justify-content-center"><i class="material-icons text-lg">expand_less</i></button>
                    <div class="d-flex flex-column">
                      <h6 class="mb-1 text-dark text-sm">Creative Tim</h6>
                      <span class="text-xs">26 March 2020, at 08:30 AM</span>
                    </div>
                  </div>
                  <div class="d-flex align-items-center text-success text-gradient text-sm font-weight-bold">
                    + $ 2,500
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
      
       @endforeach
    
    </div>
  </main>
  <!--   Core JS Files   -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/material-dashboard.min.js?v=3.0.0"></script>
</body>

@else
    Acceso No válido
@endif
@endsection