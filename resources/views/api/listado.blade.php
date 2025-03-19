@php
    $url = "http://127.0.0.1:8000/api/productos"; // API de ejemplo
    $response = file_get_contents($url);
    $data = json_decode($response, true); // Convertir JSON a array asociativo

    print_r($data);
@endphp

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
        <tr>
            <th scope="row">1</th>
            <td>Mark</td>
            <td>Otto</td>
            <td>@mdo</td>
        </tr>
        <tr>
            <th scope="row">2</th>
            <td>Jacob</td>
            <td>Thornton</td>
            <td>@fat</td>
        </tr>
    </tbody>
</table>
