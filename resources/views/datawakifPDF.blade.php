<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../public/assets/css/styles.css">
    <title>Data Wakaf Syafa'aturrsul</title>
</head>
<body class="A4">

    <h1>Laporan ZISWAF SYAFA'ATURRASUL</h1>
    <p>Tanggal : {{ $date }}</p>
    <div>
    <section class="sheet padding-10mm">
    <table>
        <tr>
            <th scope="col" colspan="2">
                Total Wakaf Syafa'aturrasul
            </th>
            <td scope="col" colspan="2">
                Wakaf Pembangunan
            </td>
            <td scope="col" colspan="2">
                Wakaf Produktif
            </td>
            <td scope="col" colspan="2">
                Donasi Pendidikan
            </td>
        </tr>
        <tr>
            <td colspan="2" ><b>
                @php
                echo rupiah($datawakifs->sum('donasipendidikan') + $datawakifs->sum('wakafpembangunan') + $datawakifs->sum('wakafproduktif'));
            @endphp
            </b>
            </td>
            <td colspan="2">
                <b>
                @php
                echo rupiah($datawakifs->sum('wakafpembangunan'));
            @endphp
            </b>
            </td>
            <td colspan="2">
                <b>
                @php
                echo rupiah($datawakifs->sum('wakafproduktif'));
            @endphp
            </b>
            </td>
            <td colspan="2">
                <b>
                @php
                echo rupiah($datawakifs->sum('donasipendidikan'));
            @endphp
            </b>
            </td>
        </tr>
        </table>
    </section>
    </div>
    <div class="tableFixHead"></div>
    <section class="sheet padding-10mm">
        <table>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Nomor Telpon</th>
            <th>Tanggal Ber Wakaf</th>
            <th>Wakaf Bangunan</th>
            <th>Wakaf Produktif</th>
            <th>Donasi Pendidikan</th>
            <th>Total Wakaf</th>
        </tr>
        @php
            $no =1;
            function rupiah ($angka) {
            $hasil = 'Rp. ' . number_format($angka, 0, ",", ".");
            return $hasil;
            }
        @endphp
        @foreach ($datawakifs as $datawakif)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $datawakif->nama }}</td>
                <td>{{ $datawakif->notelpon }}</td>
                <td>{{ $datawakif->tglwakaf }}</td>
                <td>@php
                    echo rupiah($datawakif->wakafpembangunan);
                @endphp</td>
                <td>@php
                    echo rupiah($datawakif->wakafproduktif);
                @endphp</td>
                <td>@php
                    echo rupiah($datawakif->donasipendidikan);
                @endphp</td>
                <td>
                    <b>@php
                        echo rupiah($datawakif->donasipendidikan + $datawakif->wakafpembangunan + $datawakif->wakafproduktif);
                    @endphp</b>
                </td>
            </tr>
        @endforeach
    </table>

    </section>
</div>
</body>
</html>
