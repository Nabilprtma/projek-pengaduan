<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('assets/css/babayo.css')}}">

    <title>Document</title>
</head>
<body>
<form action="{{route('response.update', $wargaId)}}" method="POST" style="width: 500px; margin: 50px auto; display: block;">
              @csrf
              @method('PATCH')
              <div class="input-card">
                <label for="status">Status :</label>
                @if($warga)
                <select name="status" id="">
                    <option selected hidden disable>Pilih Status</option>
                    <option value="ditolak" {{ $warga['status'] == 'ditolak' ? 'selected' : '' }} >ditolak</option>
                    <option value="proses" {{ $warga['status'] == 'proses' ? 'selected' : '' }}>proses</option>
                    <option value="diterima" {{ $warga['status'] == 'diterima' ? 'selected' : '' }}>diterima</option>


                </select>
                @else
                <select name="status" id="">
                    <option selected hidden disable>Pilih Status</option>
                    <option value="ditolak"  >ditolak</option>
                    <option value="proses" >proses</option>
                    <option value="diterima" >diterima</option>
</select>
@endif
              </div>
              <div class="input-card">
                <label for="pesan">Pesan :</label>
                <textarea name="pesan" id="pesan" rows="3">{{ $warga ? $warga['pesan'] : ''}}</textarea>
</div>
                <button type="submit">Kirim Response</button>
</body>
</html>