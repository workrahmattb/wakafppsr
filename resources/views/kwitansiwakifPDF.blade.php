<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Data Wakif PPSR</h1>
    <p>{{ $date }}</p>

    <table> class="table table-striped"
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Nomor Telpon</th>
            <th>Tanggal Ber Wakaf</th>
            <th>Wakaf Bangunan</th>
            <th>Wakaf Produktif</th>
            <th>Donasi Pendidikan</th>
        </tr>
        @php
            $no =1;
        @endphp
        @foreach ($datawakifs as $datawakif)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $datawakif->nama }}</td>
                <td>{{ $datawakif->notelpon }}</td>
                <td>{{ $datawakif->tglwakaf }}</td>
                <td>Rp. {{ $datawakif->wakafpembangunan }}</td>
                <td>Rp. {{ $datawakif->wakafproduktif }}</td>
                <td>Rp. {{ $datawakif->donasipendidikan }}</td>
            </tr>
        @endforeach
    </table>
</body>
</html>
