<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak</title>
</head>
<body>
    <h2 style='text-align: center; margin-bottom: 20px' >Data Keseluruhan Pengaduan</h2>
    <table style="width:100%">
        <tr>
            <th>No</th>
            <th>NIK</th>
            <th>Nama</th>
            <th>No Telp</th>
            <th>Tanggal</th>
            <th>Pengaduan</th>
            <th>Gambar</th>
            <th>Status Pesan</th>
            <th>Pesan Response</th>
        </tr>
        @php $no = 1; @endphp
        @foreach ($data as $rt)
        <tr>
            <td>{{$no++}}</td>
            <td>{{$rt['nik']}}</td>
            <td>{{$rt['nama']}}</td>
            <td>{{$rt['telepon']}}</td>
            <td>{{\Carbon\Carbon::parse($rt['created_at'])->format('j F,Y')}}</td>
            <td>{{$rt['pengaduan']}}</td>
            <td><img src="assets/image/{{$rt['gambar']}}" width="80"></td>
            <td>
                @if ($rt['response'])
                {{$rt['response']['status']}}
                @else
                -
                @endif
            </td>
            <td>
                @if ($rt['response'])
                {{$rt['response']['pesan']}}
                @else
                -
                @endif
            </td>
        </tr>
        @endforeach
    </table>
</body>
</html>