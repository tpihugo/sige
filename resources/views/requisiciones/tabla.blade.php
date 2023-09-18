
@if (count($articulos->all()) > 0)
    <table class="table">
        <thead class="thead-light">
            <tr class="text-center">
                <th>Descripción</th>
                <th>Cantidad</th>
                <th>Estatus</th>
                <th>Requisicion</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($articulos as $item)
                <tr>
                    <td>{{ $item->descripcion }}</td>
                    <td>{{ $item->cantidad }}</td>
                    <td>{{ $item->status }}</td>
                    <td>{{ $item->requisicion_id }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <h2>Sin coincidencias.</h2>
@endif