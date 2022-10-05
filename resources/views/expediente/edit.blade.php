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

<x-adminlte-modal id="modal-eliminar" title="¿Seguro que deseas eliminar este equipo?" theme="primary" icon="fas fa-inbox" size='lg' disable-animations>
    @foreach($equipo as $value)
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
    @endforeach
    <x-slot name="footerSlot">
        <x-adminlte-button  theme="secondary" label="Cancelar" data-dismiss="modal"/>
        <x-adminlte-button  theme="danger" label="Eliminar"/>
    </x-slot>
</x-adminlte-modal>
{{-- modal-requisicion --}}
<x-adminlte-modal id="modal-requisicion" title="Cargar requisición" theme="primary" icon="fas fa-inbox" size='lg' disable-animations>
    {{-- Placeholder, sm size and prepend icon --}}
    @foreach($equipo as $value)
        @if($value[8]=="")
        <form action="{{route('expedientes.update', $value[0])}}" method="post" enctype="multipart/form-data" class="col-12">
            @method('put')
                {{--<div class="mb-3">
                    <input type="hidden" name="requisicion" id="requisicion" value="1">
                    <input class="form-control btn btn-outline" type="file" name="file" id="file">
                </div>--}}
            <x-adminlte-input name="iBasic"/>
            <x-adminlte-input-file name="requisicion" igroup-size="sm" legend="Buscar archivo" placeholder="Seleccionar archivo...">
                <x-slot name="requisicion">
                <div class="input-group-text text-primary">
                <i class="fas fa-file-upload"></i>
                </div>
                </x-slot>
            </x-adminlte-input-file>
            {{--<div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Cargar</button>
            </div>--}}
            <x-slot name="footerSlot">
                <x-adminlte-button  theme="secondary" label="Cancelar" data-dismiss="modal"/>
                <x-adminlte-button type="submit" theme="success" label="Cargar"/>
            </x-slot>
            @csrf
        </form>

        @else
            <div class="col">
                <a href="../../storage/app/documentos/{{$value[8]}}" target="_blank">
                    <div class="btn p-3">
                        <div class="card-header mx-5 p-1 text-center">
                            <div class=" pt-3 icon-lg fas fa-file border-radius-lg text-center">
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
    @endforeach


</x-adminlte-modal>
