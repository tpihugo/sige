@if (count($equipo->all()) > 0)
    <table class="table">
        <thead class="thead-light">
            <tr class="text-center">
                <th>Id UdeG</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Núm. Serie</th>
                <th>MAC</th>
                <th>IP</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($equipo as $item)
                <tr>
                    <td>{{ $item->udg_id }}</td>
                    <td>{{ $item->marca }}</td>
                    <td>{{ $item->modelo }}</td>
                    <td>{{ $item->numero_serie }}</td>
                    <td>{{ $item->mac }}</td>
                    <td>{{ $item->ip }}</td>
                    <td>
                        <a href="{{ route('desasignarEquipo', $item->ip) }}" class="btn btn-info btn-sm" title="">Desasignar
                            Equipo</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <h2>Sin coincidencias.</h2>
@endif
