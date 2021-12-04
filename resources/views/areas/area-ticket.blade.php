@extends('layouts.app')

@section('content')
    @if (Auth::check() && Auth::user()->role == 'admin')
        <div class="container-fluid">
            <div class="row">
                <div class="col-10">
                    @foreach ($areas as $key => $value)
                        <div class="row my-5">
                            <div class="col-12">
                                <div class="row mb-3">
                                    <div class="col">
                                        <p id="{{ $areas[$key]['edificio'] }}">Edificio:
                                            <strong>{{ $areas[$key]['edificio'] }}</strong>
                                        </p>
                                    </div>
                                    <div class="col">
                                        <p>Sede: <strong>{{ $areas[$key]['sede'] }}</strong></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <dl class="row align-items-center">
                                    @for ($i = 0; $i < count($areas[$key]['piso']); $i++)
                                        <dt class="col-sm-1"> {{ $areas[$key]['piso'][$i]['piso'] }} </dt>
                                        <dd class="col-sm-11">
                                            @for ($j = 0; $j < count($areas[$key]['piso'][$i]['area']); $j++)
                                                @if ($areas[$key]['piso'][$i]['area'][$j]['ticket'] == 'existe') 
                                               <button class="m-2 btn-mod btn btn-danger" data-toggle="modal"
                                                        data-target="#exampleModalCenter"
                                                        data-imagen="{{ url('/images/'.$areas[$key]['piso'][$i]['area'][$j]['imagen_1']) }}"
							data-imagen2="{{ url('/images/'.$areas[$key]['piso'][$i]['area'][$j]['imagen_2']) }}"
                                                        data-id="{{ $areas[$key]['piso'][$i]['area'][$j]['id'] }}"
                                                        data-name="{{ $areas[$key]['piso'][$i]['area'][$j]['area'] }}"
                                                        data-area="{{ $areas[$key]['edificio'] }} >
                                                                    {{ $areas[$key]['piso'][$i]['piso'] }} >
                                                                    {{ $areas[$key]['sede'] }}"
                                                      >

                                                        {{ $areas[$key]['piso'][$i]['area'][$j]['area'] }}
							@if ($areas[$key]['piso'][$i]['area'][$j]['equipamiento'] == 'Computadora')
                                                    		<i class="pl-2 fa fa-laptop "></i> 
							@endif
							@if ($areas[$key]['piso'][$i]['area'][$j]['equipamiento'] == 'Videoconferencia')
                                                        	<i class="pl-2 fas fa-chalkboard-teacher"></i>
	                                                @endif


                                                        @if ($areas[$key]['piso'][$i]['area'][$j]['equipamiento'] == 'Proyector, computadora, videoconferencia')
                                                            <i class="pl-2 fas fa-video"></i>
                                                            <i class="pl-2 fa fa-laptop "></i>
                                                            <i class="pl-2 fas fa-chalkboard-teacher"></i>
                                                        @endif

                                                        @if ($areas[$key]['piso'][$i]['area'][$j]['equipamiento'] == 'Proyector, computadora')
                                                            <i class="pl-2 fa fa-laptop "></i>
                                                            <i class="pl-2 fas fa-video"></i>
                                                        @endif

                                                        @if ($areas[$key]['piso'][$i]['area'][$j]['equipamiento'] == 'Proyector')
                                                            <i class="pl-2 fas fa-video"></i>
                                                        @endif

                                                        @if ($areas[$key]['piso'][$i]['area'][$j]['equipamiento'] == 'Sin equipo')
                                                            <i class="pl-2 fas fa-ban"></i>
                                                        @endif
							<span class="badge badge-light">!</span>
                                                    </button>

                                                @else
                                                    <button class="m-2 btn-mod btn btn-success" data-toggle="modal"
                                                        data-target="#exampleModalCenter"
                                                        data-imagen="{{ url('/images/'.$areas[$key]['piso'][$i]['area'][$j]['imagen_1']) }}"
							data-imagen2="{{ url('/images/'.$areas[$key]['piso'][$i]['area'][$j]['imagen_2']) }}"
                                                        data-id="{{ $areas[$key]['piso'][$i]['area'][$j]['id'] }}"
                                                        data-name="{{ $areas[$key]['piso'][$i]['area'][$j]['area'] }}"
                                                        data-area="{{ $areas[$key]['edificio'] }} >
                                                                    {{ $areas[$key]['piso'][$i]['piso'] }} >
                                                                    {{ $areas[$key]['sede'] }}"
                                                      >

                                                        {{ $areas[$key]['piso'][$i]['area'][$j]['area'] }}
							@if ($areas[$key]['piso'][$i]['area'][$j]['equipamiento'] == 'Computadora')
                                                    		<i class="pl-2 fa fa-laptop "></i> 
							@endif
							@if ($areas[$key]['piso'][$i]['area'][$j]['equipamiento'] == 'Videoconferencia')
                                                        	<i class="pl-2 fas fa-chalkboard-teacher"></i>
	                                                @endif


                                                        @if ($areas[$key]['piso'][$i]['area'][$j]['equipamiento'] == 'Proyector, computadora, videoconferencia')
                                                            <i class="pl-2 fas fa-video"></i>
                                                            <i class="pl-2 fa fa-laptop "></i>
                                                            <i class="pl-2 fas fa-chalkboard-teacher"></i>
                                                        @endif

                                                        @if ($areas[$key]['piso'][$i]['area'][$j]['equipamiento'] == 'Proyector, computadora')
                                                            <i class="pl-2 fa fa-laptop "></i>
                                                            <i class="pl-2 fas fa-video"></i>
                                                        @endif

                                                        @if ($areas[$key]['piso'][$i]['area'][$j]['equipamiento'] == 'Proyector')
                                                            <i class="pl-2 fas fa-video"></i>
                                                        @endif

                                                        @if ($areas[$key]['piso'][$i]['area'][$j]['equipamiento'] == 'Sin equipo')
                                                            <i class="pl-2 fas fa-ban"></i>
                                                        @endif
                                                    </button>
                                                @endif
                                            @endfor
                                        </dd>
                                    @endfor
                                </dl>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="col-2 position-relative mt-5">
                    <div class="d-flex flex-column align-items-center sticky-top">
                        <p class="font-weight-bold">Nomenclatura</p>                        

                       <div class="row">
                          <div class="col-6 d-flex flex-column align-items-center">
                              <button type="button" class="btn btn-danger mt-1" data-toggle="tooltip" data-placement="top"
                                 title="Ticket Abierto">
                              </button>
                              <button type="button" class="btn btn-primary btn-sm mt-1" data-toggle="tooltip" data-placement="left"
                                 title="Proyector">
                                 <i class="fas fa-video fa-xs"></i>
                              </button>
                              <button type="button" class="btn btn-primary btn-sm mt-1" data-toggle="tooltip" data-placement="left"
                                 title="Computadora">
                                 <i class="fa fa-laptop  fa-xs"></i>
                              </button>
                          </div>
                           <div class="col-6 d-flex flex-column align-items-center">
                              <button type="button" class="btn btn-success mt-1" data-toggle="tooltip" data-placement="bottom"
                                 title="Sin tickets">
                              </button>
                              <button type="button" class="btn btn-primary btn-sm mt-1" data-toggle="tooltip" data-placement="left"
                                 title="Videoconferencia">
                                 <i class="fas fa-chalkboard-teacher fa-xs"></i>
                              </button>
                              <button type="button" class="btn btn-primary btn-sm mt-1" data-toggle="tooltip" data-placement="left"
                                 title="Sin equipo">
                                 <i class="fas fa-ban fa-xs"></i>
                              </button>
                          </div>
                       </div>

                        <label class="font-weight-bold my-3" for="sede">Área </label>
                        <a href="{{ route('area-ticket', 'Belenes') }}"
                            class="col-auto my-2 btn btn-secondary">Belenes</a>

                        <a href="{{ route('area-ticket', 'La Normal') }}" class="col-auto my-2 btn btn-secondary">La
                            Normal</a>

                        <label class="font-weight-bold my-2" for="">Edificio </label>
                        <div class="col-auto">
                            @foreach ($areas as $key => $value)
                                <a href="#{{ $areas[$key]['edificio'] }}"
                                    class="my-2 btn btn-primary">{{ $areas[$key]['edificio'] }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- MODAL -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="titulo_modal"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body bg-light">
                        <div class="row">
                            <div class="col-8">
                                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                    <ol class="carousel-indicators">
                                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                    </ol>
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <img id="aula-img-1" class="d-block" width="300" height="200" src=""
                                                alt="First slide">
                                        </div>
                                        <div class="carousel-item">
                                            <img id="aula-img-2" class="d-block" width="300" height="200" src=""
                                                alt="Second slide">
                                        </div>
                                    </div>
                                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                                        data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                                        data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>

                            </div>
                            <div id="acciones" class="col-4 d-flex align-items-center flex-column">
                                <a id="historial" class="col-auto my-2 btn btn-success text-white"><i
                                        class="p-2 fa fa-list-ol"></i></a>
                                <a id="equipos" class="col-auto my-2 btn btn-primary text-white"><i
                                        class="p-2 fa fa-laptop"></i></a>
                            </div>
                        </div>
                        </di>
                    </div>
                    <div class="modal-footer">
                        <h5 class="modal-title" id="area_modal"></h5>
                    </div>
                </div>
            </div>
        </div>

        <script type="text/javascript"
            src="https://cdn.datatables.net/v/bs4-4.1.1/jszip-2.5.0/dt-1.10.24/b-1.7.0/b-html5-1.7.0/b-print-1.7.0/r-2.2.7/datatables.min.js">
        </script>

        <script type="text/javascript">
            $(function() {
                $('[data-toggle="tooltip"]').tooltip()
            })

            $(document).on('click', '.btn-mod', function(event) {
                var acciones = document.getElementById('acciones');
                $('#ticket_abierto').remove();

                const id = $(this).data("id");

                if ($(this).data('ticket') == 'abierto') {

                    const route = "{{ route('tickets.index') }}";

                    const btn_ticket = `
                               <a id="ticket_abierto" href="${route}/${id}" class="col-auto my-2 btn btn-danger text-white">
                                  <i class="p-2 fa fa-laptop"></i>
                               </a>
                            `;
                    $(acciones).append(btn_ticket);

                }

                const name = $(this).data("name");
                const area = $(this).data("area");
                const imagen_1 = $(this).data("imagen");
                const imagen_2 = $(this).data("imagen2");

                $('#aula-img-1').attr("src", imagen_1);
                $('#aula-img-2').attr("src", imagen_2);

                $('#titulo_modal').text(id + "-" + name);
                $('#area_modal').text("Edificio " + area);

                const historial = "{{ route('ticket-historial') }}";

                $('#historial').attr('href', historial+'/'+id);
                //$('#equipos').attr('href');
            });

        </script>
    @else
        Acceso No válido
    @endif
@endsection
