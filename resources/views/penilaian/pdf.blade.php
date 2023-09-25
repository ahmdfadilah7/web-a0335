<!DOCTYPE html>
<html>

<head>
    <title>
        @if (Auth::user()->role->title=='Koordinator')
            @if (Request::segment(2) == 'exportpdfta_2')
                NILAI TUGAS AKHIR 2 {{ Auth::user()->prodi->title }}  
            @else
                NILAI TUGAS AKHIR 1 {{ Auth::user()->prodi->title }}              
            @endif
        @else
            @if (Request::segment(2) == 'exportpdfta_2')
                NILAI TUGAS AKHIR 2 {{ strtoupper(Auth::user()->name) }}    
            @else
                NILAI TUGAS AKHIR 1 {{ strtoupper(Auth::user()->name) }}    
            @endif
        @endif
    </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <style type="text/css">
        table tr td,
        table tr th {
            font-size: 9pt;
        }
    </style>
    <center>
        <h5>
            @if (Auth::user()->role->title=='Koordinator')
                @if (Request::segment(2) == 'exportpdfta_2')
                    NILAI TUGAS AKHIR 2 {{ Auth::user()->prodi->title }}  
                @else
                    NILAI TUGAS AKHIR 1 {{ Auth::user()->prodi->title }}              
                @endif
            @else
                @if (Request::segment(2) == 'exportpdfta_2')
                    NILAI TUGAS AKHIR 2 {{ strtoupper(Auth::user()->name) }}    
                @else
                    NILAI TUGAS AKHIR 1 {{ strtoupper(Auth::user()->name) }}    
                @endif
            @endif
        </h5>
    </center>

    <table class='table table-bordered'>
        <thead>
            <tr>
                <th>No</th>
                <th>Mahasiswa</th>
                <th>Prodi</th>
                <th>Judul</th>
                @if (Request::segment(2) == 'exportpdfta_2')
                    <th>Nilai Pra Sidang</th>
                    <th>Nilai Sidang</th>
                @else
                    <th>Nilai Seminar Proposal</th>
                    <th>Nilai Seminar</th>
                @endif
                <th>Nilai Pembimbing</th>
                <th>Nilai Administrasi</th>
                <th>Total</th>
                <th>Grade</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($penilaian as $no => $value)
                <tr>
                    <td>{{ ++$no }}</td>
                    <td>
                        {{ $value->mahasiswa }}
                    </td>
                    <td>
                        {{ $value->prodi }}
                    </td>
                    <td>
                        {{ $value->judul }}
                    </td>
                    <td>
                        {{ $value->nilai_1 }}
                    </td>
                    <td>
                        {{ $value->nilai_2 }}
                    </td>
                    <td>
                        {{ $value->nilai_3 }}
                    </td>
                    <td>
                        {{ $value->nilai_4 }}
                    </td>
                    <td>
                        {{ $value->total_nilai }}
                    </td>
                    <td>
                        {{ $value->grade }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
