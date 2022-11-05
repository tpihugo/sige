<x-adminlte-modal id="modal-editar-equipo2" title="Editar equipo" theme="primary" icon="fas fa-inbox" size='lg' disable-animations>
    {{-- Placeholder, sm size and prepend icon --}}
    <h1>Desde edit</h1>
    @foreach($equipo as $value)

    @endforeach
    <x-slot name="footerSlot">
        <x-adminlte-button  theme="danger" label="Cancelar" data-dismiss="modal"/>
        <x-adminlte-button  theme="success" label="Cargar"/>
    </x-slot>
</x-adminlte-modal>

{{-- ## modal-eliminar --}}
@foreach($equipo as $value)
        <div class="modal fade" id="modal-eliminar">
            <div class="modal-dialog">
                <div class="modal-content">
                        <div class="modal-header bg-gradient-warning">
                            <h4 class="modal-title">Eliminar equipo</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="row">
                                <div class="col-sm-4 border-right">
                                    <div class="description-block">
                                        <span class="description-text">Marca</span>
                                        <h5 class="description-header">{{$value[3]}}</h5>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 border-right">
                                    <div class="description-block">
                                        <span class="description-text">Modelo</span>
                                        <h5 class="description-header">{{$value[4]}}</h5>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4">
                                    <div class="description-block">
                                        <span class="description-text">N° Serie</span>
                                        <h5 class="description-header">{{$value[5]}}</h5>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <a class="btn bg-gradient-danger" href="{{route('delete-equipo', $value[0])}}" >Eliminar</a>
                            {{--<button type="submit" class="btn btn-danger">Eliminar</button>--}}
                        </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
@endforeach

{{-- ## modal-requisicion --}}
@foreach($equipo as $value)
        <div class="modal fade" id="modal-requisicion">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{route('expedientes.update', $value[0])}}" method="post" enctype="multipart/form-data" class="col-12">
                        @method('put')
                        <div class="modal-header">
                            <h4 class="modal-title">Cargar requisición</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <input type="hidden" name="requisicion" id="requisicion" value="1">
                            <input class="form-control btn btn-outline" type="file" name="file" id="file">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Cargar</button>
                        </div>
                        @csrf
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
@endforeach

{{-- ## modal-cotización --}}
@foreach($equipo as $value)
        <div class="modal fade" id="modal-cotizacion">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{route('expedientes.update', $value[0])}}" method="post" enctype="multipart/form-data" class="col-12">
                        @method('put')
                        <div class="modal-header">
                            <h4 class="modal-title">Cargar cotización</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <input type="hidden" name="cotizacion" id="cotizacion" value="2">
                            <input class="form-control btn btn-outline" type="file" name="file" id="file">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Cargar</button>
                        </div>
                        @csrf
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
@endforeach

{{-- ## modal-factura --}}
@foreach($equipo as $value)
        <div class="modal fade" id="modal-factura">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{route('expedientes.update', $value[0])}}" method="post" enctype="multipart/form-data" class="col-12">
                        @method('put')
                        <div class="modal-header">
                            <h4 class="modal-title">Cargar factura</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <input type="hidden" name="factura" id="factura" value="3">
                            <input class="form-control btn btn-outline" type="file" name="file" id="file">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Cargar</button>
                        </div>
                        @csrf
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
@endforeach

{{-- ## modal-otros --}}
@foreach($equipo as $value)
        <div class="modal fade" id="modal-otros">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{route('expedientes.update', $value[0])}}" method="post" enctype="multipart/form-data" class="col-12">
                        @method('put')
                        <div class="modal-header">
                            <h4 class="modal-title">Cargar otros</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <input type="hidden" name="otros" id="otros" value="4">
                            <input class="form-control btn btn-outline" type="file" name="file" id="file">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Cargar</button>
                        </div>
                        @csrf
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
@endforeach


