@foreach ($equiposPorPrestamo as $item)
    <tr>
        <td>{{ $item->id_equipo }}</td>
        <td>{{ $item->udg_id }}</td>
        <td>{{ $item->tipo_equipo }}</td>
        <td>{{ $item->marca }}</td>
        <td>{{ $item->modelo }}</td>
        <td>{{ $item->numero_serie }}</td>
        <td>{{ $item->accesorios }}</td>
    </tr>
@endforeach
