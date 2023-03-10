<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/dash.css">
    <link rel="stylesheet" href="{{asset('assets/css/babayo.css')}}">
    <title>MEM</title>
</head>
<body>
  
    <h2 style="color: white">Laporan Keluhan</h2>
    <div class="tombol">
    <a class='btn-border' href="{{route ('logout')}}" >Logout</a>
</div>
    <div class="tombol">
    <a class='btn-border' href="/" >Home</a>
</div>
    
</div>

<div style="display: flex; justify-content: flex-end;align-items: center;">
<form action="" method="GET">
  @csrf
  <input type="text" name="search" placeholder="Cari Berdasarkan nama....">
  <button type="submit" class="btn-login" style="margin-top: -1px" >Cari</button>
</form>
<a href="{{route('dashboard')}}" style="margin-left: 10px; margin-top: 2px">Refresh<a>

</div>

<div style="overflow-x: auto;">
        <table border="1">

        <tr>
           <th>No</th>
                  <th>Nik</th>
                  <th>Nama</th>
                  <th>Telepon</th>
                  <th>Pengaduan</th>
                  <th>Gambar</th>
                  <th>Status Response</th>
                  <th>Pesan Response</th>
                  <th>Aksi</th>
        </tr>
        @foreach ($wargas as $dt)
        <tr>
         <td>1</td>
                  <td>{{$dt->nik}}</td>
                  <td>{{$dt->nama}}</td>
                  @php
                  $telp = substr_replace($dt->telepon, "62", 0, 1)
                  @endphp
                  <td><a href="https://wa.me/{{$telp}}?text=Hallo,{{$dt->nama}} Pengaduan anda akan kami cek" target="_blank">{{$telp}}</a></td>
                  <td>{{$dt->pengaduan}}</td>
                  <td><img src="{{asset('assets/image/'.$dt->gambar)}}" alt="" srcset="" width="200px"></td>
                  <td>
                    @if ($dt->response)
                    {{$dt->response['status']}}
                    @else
                    -
                    @endif
                  </td>
                  <td>
                    @if ($dt->response)
                    {{$dt->response['pesan']}}
                    @else
                    -
                    @endif
                  </td>
                  <td style="display: flex; justify-content: center;">
                  <a href="{{route ('response.edit', $dt->id)}}" class="back-btn">Send Response</a>
                   </td>
                   
        </tr>
       @endforeach
      </table>
      </form>
</div>

</body>

</html>


<style>

  
footer {
  text-align: center;
  background-color: #ffdf98;
  padding: 15px;
  font-size: 14px;
  margin-top: 40px;
}

    h2 {
        text-align: center;
    }

    .tombol {
        text-align: center;
        margin-bottom: 13px;
    }

    /* Button Animated Border on Hover */
@import url(https://fonts.googleapis.com/css?family=BenchNine:700);
.btn-border {
  background-color: #c47135;
  border: none;
  color: #ffffff!important;
  cursor: pointer;
  display: inline-block;
  font-family: 'BenchNine', Arial, sans-serif;
  font-size: 1em;
  font-size: 15px;
  line-height: 1em;
  margin: 15px 40px;
  outline: none;
  padding: 10px 20px 10px;
  position: relative;
  text-transform: uppercase;
  font-weight: 700;
}

.btn-border:before,
.btn-border:after {
  border-color: transparent;
  -webkit-transition: all 0.25s;
  transition: all 0.25s;
  border-style: solid;
  border-width: 0;
  content: "";
  height: 24px;
  position: absolute;
  width: 24px;
}

.btn-border:before {
  border-color: #c47135;
  border-top-width: 2px;
  left: 0px;
  top: -5px;
}

.btn-border:after {
  border-bottom-width: 2px;
  border-color: #c47135;
  bottom: -5px;
  right: 0px;
}

.btn-border:hover {
  background-color: #c47135;
}

.btn-border:hover:before,
.btn-border:hover:after {
  height: 100%;
  width: 100%;
}
    /* table {
  width: 100%;
  border: 1px solid;
}

th, td {
    text-align: left;
  padding: 8px;
} */

.btn {
  box-sizing: border-box;
  -webkit-appearance: none;
     -moz-appearance: none;
          appearance: none;
  background-color: transparent;
  border: 2px solid #e74c3c;
  border-radius: 0.6em;
  color: #e74c3c;
  cursor: pointer;
  display: flex;
  align-self: center;
  font-size: 1rem;
  font-weight: 400;
  line-height: 1;
  margin: 5px;
  padding: 5px 10px;
  text-decoration: none;
  text-align: center;
  text-transform: uppercase;
  font-family: 'Montserrat', sans-serif;
  font-weight: 400;
}
.btn:hover, .btn:focus {
  color: #fff;
  outline: 0;
}
.third {
  border-color: #FF0032;
  color: #fff;
  box-shadow: 0 0 40px 40px #FF0032 inset, 0 0 0 0 #3498db;
  transition: all 150ms ease-in-out;
}
.third:hover {
  box-shadow: 0 0 10px 0 #3498db inset, 0 0 10px 4px #3498db;
}

/* table {
  width: 100%;
  font-family: Arial, Helvetica, sans-serif;
  color: #666;
  text-shadow: 1px 1px 0px #fff;
  background: #eaebec;
  border: #ccc 1px solid;
}

table th {
  padding: 15px 35px;
  border-left:1px solid #e0e0e0;
  border-bottom: 1px solid #e0e0e0;
  background: #ededed;
}

table th:first-child{  
  border-left:none;  
}

table tr {
  text-align: center;
  padding-left: 20px;
}

table td:first-child {
  text-align: left;
  padding-left: 20px;
  border-left: 0;
}

table td {
  padding: 15px 35px;
  border-top: 1px solid #ffffff;
  border-bottom: 1px solid #e0e0e0;
  border-left: 1px solid #e0e0e0;
  background: #fafafa;
  background: -webkit-gradient(linear, left top, left bottom, from(#fbfbfb), to(#fafafa));
  background: -moz-linear-gradient(top, #fbfbfb, #fafafa);
}

table tr:last-child td {
  border-bottom: 0;
}

table tr:last-child td:first-child {
  -moz-border-radius-bottomleft: 3px;
  -webkit-border-bottom-left-radius: 3px;
  border-bottom-left-radius: 3px;
}

table tr:last-child td:last-child {
  -moz-border-radius-bottomright: 3px;
  -webkit-border-bottom-right-radius: 3px;
  border-bottom-right-radius: 3px;
}

table tr:hover td {
  background: #f2f2f2;
  background: -webkit-gradient(linear, left top, left bottom, from(#f2f2f2), to(#f0f0f0));
  background: -moz-linear-gradient(top, #f2f2f2, #f0f0f0);
}

 */


</style>