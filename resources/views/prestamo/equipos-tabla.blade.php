
<table  class="table table-striped table-bordered displa" id="equipos_prestamo" style="width:100%;">
    <thead class="thead-light">
        <tr>
            <td>Id SIGE</td>
            <td>Id udg</td>
            <td>Tipo de equipo</td>
            <td>Marca</td>
            <td>Modelo</td>
            <td>N/S</td>
            <td>Accesorios</td>
        </tr>
    </thead>
    <tbody>
        @forEach($equiposPorPrestamo as $item)
            <tr> 
                <td>{{$item->id_equipo}}</td>
                <td>{{$item->udg_id}}</td>
                <td>{{$item->tipo_equipo}}</td>
                <td>{{$item->marca}}</td>
                <td>{{$item->modelo}}</td>
                <td>{{$item->numero_serie}}</td>
                <td>{{$item->accesorios}}</td> 
            </tr>
        @endforeach
    </tbody>


</table>