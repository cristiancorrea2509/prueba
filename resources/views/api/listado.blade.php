

<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">First</th>
            <th scope="col">Last</th>
            <th scope="col">Handle</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $dato)
        @if ($dato['nombre']==$nombre || $nombre=="")
            
        <tr>
            <td>{{ $dato['id'] }}</td>
            <td>{{ $dato['nombre'] }}</td>
            <td>{{ $dato['valor'] }}</td>
            <td>{{ $dato['codigo'] }}</td>
            <td>{{ $dato['cantidad'] }}</td>
        </tr>
        @endif
        @endforeach
        
        
    </tbody>
</table>
