<table class="table">
    <thead class="thead-light">
        <tr class="text-center">
            <th>Id UdeG</th>
            <th>Marca</th>
            <th>Modelo</th>
            <th>Núm. Serie</th>
            <th>MAC</th>
            <th>IP</th>
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
            </tr>
        @endforeach
    </tbody>
</table>
