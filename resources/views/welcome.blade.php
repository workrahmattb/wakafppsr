
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>test</h1>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Data Wakif PPSR</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped border=5">
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
                            @foreach ($data as $datawakif)
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
                    </div>
                </div>
            </div>
        </div>
</body>
</html>

