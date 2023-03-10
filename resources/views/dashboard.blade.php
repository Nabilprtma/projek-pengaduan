<!-- <!DOCTYPE html>
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
<a href="{{route('export-excel')}}" style="margin-left: 10px; margin-top: 2px">Cetak Excel</a>
<a href="{{route('dashboard')}}" style="margin-left: 10px; margin-top: 2px">Refresh<a>
<a href="{{route('export-pdf')}}" style="margin-left: 10px; margin-top: 2px">Cetak PDF<a>

</div>

<div style="overflow-x: auto;">
    <table cellspacing='0'>
    <thead>
        <tr>
           <th>No</th>
                  <th>Nik</th>
                  <th>Nama</th>
                  <th>Telepon</th>
                  <th>Pengaduan</th>
                  <th>Gambar</th>
                  <th>Aksi</th>
        </tr>
</thead>
        @foreach ($wargas as $dt)
        <tr>
         <td>1</td>
                  <td>{{$dt->nik}}</td>
                  <td>{{$dt->nama}}</td>
                  <td>{{$dt->telepon}}</td>
                  <td>{{$dt->pengaduan}}</td>
                  <td><img src="assets/image/{{$dt->gambar}}" alt="" srcset="" width="200px"></td>
                  <td><form onsubmit="return confirm('Apakah Anda Yakin ?');" action="/hapus/{{$dt->id}}" method="post">
                    @method('DELETE')
                    @csrf

                    <button type="submit" class="btn third">Delete</button></form>
                    <form action="{{route('export', $dt->id)}}" method="GET">
                        <button type="submit" class="btn third">Cetak</button>
                    </form>
                   </td>
                   
        </tr>
       @endforeach
      </table>
      </form>
</div>

</body>

</html> -->




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaduan Masyarakat</title>
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
</head>
<body>
    <h2 class="title-table">Laporan Keluhan</h2>
<div style="display: flex; justify-content: center; margin-bottom: 30px">
    <a href="{{route('logout')}}" class="button-17" style="text-align: center; margin-top:-px">Logout</a> 
    <div style="margin-right:10px; margin-left:10px; margin-top:5px"> <b>|</b></div>
    <a href="{{route('home')}}" class="button-17" style="text-align: center">Home</a>
</div>



<div style="display: flex; justify-content:flex-end; align-items:center">
    <form action="" method="GET">
        @csrf
        <input type="text" name="search" placeholder="cari berdasarkan nama ...">
        <button class="button-17" role="button" style="margin-left:5px;margin-top: -0.1px">Cari</button>
        
    </form>
    <div>
        <form action="{{route('dashboard')}}" method="GET" style="margin-top:-30px; margin-left:5px ; margin-right: 33px">
            @csrf
            <button class="button-17" role="button">Refresh</button>
        </form>
    </div>
    </div>
    <div class="sec-center" style="margin-top: 5px; margin-right: 33px"> 	
        <input class="dropdown" type="checkbox" style="" id="dropdown" name="dropdown"/>
        <label class="for-dropdown" style="" for="dropdown">Print All <i class="uil uil-arrow-down"></i></label>
        <div class="section-dropdown"> 
            <a href="/export/excel">Print Excel<i class="uil uil-arrow-right"></i></a>
            <input class="dropdown-sub" type="checkbox" id="dropdown-sub" name="dropdown-sub"/>
            <a href="/export/pdf">Print PDF <i class="uil uil-arrow-right"></i></a>
        </div>
    <div>

    </div>
</div>

<div style="padding: 0 30px; margin-top:10px">
    <table>
        <thead>
        <tr>
            <th width="5%">No</th>
            <th>NIK</th>
            <th>Nama</th>
            <th>Telp</th>
            <th>Pengaduan</th>
            <th>Gambar</th>
            <th>Status Response</th>
            <th>Pesan Response</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
            @php
            $no = 1;
            @endphp
            @foreach ($wargas as $report)
            <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $report['nik']}}</td>
                    <td>{{ $report['nama']}}</td>
                    @php
                    $telp = substr_replace($report->telepon, "62", 0, 1)
                    @endphp
                    @php 
                    if ($report->response) {
                        $pesanWA = 'Hallo' . $report->nama . '!pengaduan anda di ' . 'Berikut pesan untuk anda :' . $report->response['pesan'];

                    } else {
                        $pesanWA = 'Belum ada data response!';
                    }
                    
                    @endphp
                  <td><a href="https://wa.me/{{$telp}}?text={{$pesanWA}}" target="_blank">{{$telp}}</a></td>
                    <td>{{ $report['pengaduan']}}</td>
                   
                    <td>
                        <a href="../assets/image/{{$report->gambar}}" target="_blank">
                        <img src="{{asset('assets/image/'. $report->gambar)}}" width="120">
                        </a>
                    </td>
                     <td> @if ($report->response)
                        {{$report->response['status']}}
                        @else
                        -
                        @endif
                    </td>
                    <td>
                        @if ($report->response)
                        {{$report->response['pesan']}}
                        @else
                        -
                        @endif
                    </td>
                    <td>
                        
                        <div>
                            <form action="{{route('export', $report->id)}}" method="GET" style="margin-top:-20px; margin-right:5px">
                                @csrf
                                <button class="button-17" role="button">Print</button>
                            </form>
                        </div>

                        <form action="{{ route('delete', $report->id) }}" method="post" style="">
                            @csrf
                            @method('delete')
                            <button class="button-17" role="button" style="background-color: #ff0033ca; color:aliceblue">Delete</button>
                        </form>

                    </td>
            </tr>
            @endforeach
        </tbody>
    </table>    
    
</div>
</body>
</html>

<style>
  * {
    margin: 0;
    padding: 0;
}

.baris {
    box-sizing: border-box;
    padding: 20px;
}

.kolom {
    height: 500px;
    box-sizing: border-box;
}

.kolom1 {
    width: 45%;
    float: left;
    padding: 30px;
}

.kolom2 {
    float: right;
    width: 55%;
}

.kolom2 img {
    width: 100%;
    height: 100%;
}

li {
    margin-bottom: 15px;
}

@media (max-width: 760px) {
    .kolom2 {
        float: left;
        width: 100%;
    }

    .kolom1 {
        width: 100%;
    }

    .kolom {
        height: auto;
    }
}

.flex-container,
.form-container {
    display: flex;
    flex-wrap: wrap;
    flex-direction: row;
    justify-content: center;
    clear: both;
    padding: 20px;
}

.item {
    width: 333px;
    height: auto;
    background-color: #ffce66;
    margin: 3px;
    box-sizing: border-box;
    flex-grow: 1;
    flex-shrink: 1;
    padding: 20px;
}

.item p {
    font-size: 1.6rem;
    text-align: center;
}

@media (max-width: 760px) {
    .item h2 {
        font-size: 1rem;
    }
}

.form-card {
    background-color: #f3f3f3;
    margin-right: 30px;
    width: 40%;
    padding: 20px;
}

.laporan-card {
    width: 50%;
}

.input-card {
    display: flex;
    flex-direction: column;
}

label {
    font-size: 18px;
    margin-bottom: 10px;
}

input,
textarea {
    font-size: 14px;
    border: 2px solid #eee;
    border-radius: 5px;
    margin-bottom: 10px;
    padding: 0 15px;
}

textarea {
    padding: 15px;
}

input {
    height: 30px;
}

button,
.login-btn,
.back-btn {
    width: auto;
    padding: 8px 20px;
    border: none;
    border-radius: 20px;
    float: right;
    margin-top: 20px;
    background-color: #ffce66;
    cursor: pointer;
}

button.btn-delete {
    float: none;
}

.back-btn {
    color: #fff;
    text-decoration: none;
    margin-right: 10px;
    font-size: 14px;
    background-color: #9c9494;
}

.button-17 {
    align-items: center;
    appearance: none;
    background-color: #fff;
    border-radius: 24px;
    border-style: none;
    box-shadow: rgba(0, 0, 0, 0.2) 0 3px 5px -1px,
        rgba(0, 0, 0, 0.14) 0 6px 10px 0, rgba(0, 0, 0, 0.12) 0 1px 18px 0;
    box-sizing: border-box;
    color: #3c4043;
    cursor: pointer;
    display: inline-flex;
    fill: currentcolor;
    font-family: "Google Sans", Roboto, Arial, sans-serif;
    font-size: 14px;
    font-weight: 500;
    height: 30px;
    justify-content: center;
    letter-spacing: 0.25px;
    line-height: normal;
    max-width: 100%;
    overflow: visible;
    padding: 2px 24px;
    position: relative;
    text-align: center;
    text-transform: none;
    transition: box-shadow 280ms cubic-bezier(0.4, 0, 0.2, 1),
        opacity 15ms linear 30ms, transform 270ms cubic-bezier(0, 0, 0.2, 1) 0ms;
    user-select: none;
    -webkit-user-select: none;
    touch-action: manipulation;
    width: auto;
    will-change: transform, opacity;
    z-index: 0;
    text-decoration: none;
}

.button-17:hover {
    background: #f6f9fe;
    color: #174ea6;
}

.button-17:active {
    box-shadow: 0 4px 4px 0 rgb(60 64 67 / 30%),
        0 8px 12px 6px rgb(60 64 67 / 15%);
    outline: none;
}

.button-17:focus {
    outline: none;
    border: 2px solid #4285f4;
}

.button-17:not(:disabled) {
    box-shadow: rgba(60, 64, 67, 0.3) 0 1px 3px 0,
        rgba(60, 64, 67, 0.15) 0 4px 8px 3px;
}

.button-17:not(:disabled):hover {
    box-shadow: rgba(60, 64, 67, 0.3) 0 2px 3px 0,
        rgba(60, 64, 67, 0.15) 0 6px 10px 4px;
}

.button-17:not(:disabled):focus {
    box-shadow: rgba(60, 64, 67, 0.3) 0 1px 3px 0,
        rgba(60, 64, 67, 0.15) 0 4px 8px 3px;
}

.button-17:not(:disabled):active {
    box-shadow: rgba(60, 64, 67, 0.3) 0 4px 4px 0,
        rgba(60, 64, 67, 0.15) 0 8px 12px 6px;
}

.button-17:disabled {
    box-shadow: rgba(60, 64, 67, 0.3) 0 1px 3px 0,
        rgba(60, 64, 67, 0.15) 0 4px 8px 3px;
}

@media (max-width: 760px) {
    .form-container {
        padding: 0 40px;
    }

    .form-card {
        width: 100%;
        margin-bottom: 30px;
        margin-right: 0;
    }

    .laporan-card {
        width: 100%;
    }
}

@media (max-width: 550px) {
    label {
        font-size: 0.9rem;
    }
}

footer {
    text-align: center;
    background-color: #ffdf98;
    padding: 15px;
    font-size: 14px;
    margin-top: 40px;
}

header {
    padding: 20px;
}

a.login-btn {
    margin-top: 0;
    margin-bottom: 20px;
    text-decoration: none;
    color: #000;
}

.article {
    border: 1px solid #000;
    padding: 20px;
    margin-top: 20px;
}

.article p {
    text-align: right;
}

.content {
    display: flex;
    justify-content: space-between;
    margin-top: 30px;
}

.content .text {
    max-width: 70%;
    margin-right: 15px;
}

.content img {
    width: 180px;
    max-width: 100%;
}

@media (max-width: 550px) {
    .content {
        flex-direction: column;
    }

    .content img {
        float: right;
        margin-top: 10px;
    }

    .content .text {
        font-size: 0.8rem;
    }

    .content img {
        width: 150px;
    }
}

/* table */
h2.title-table {
    margin: 30px 0 10px 0;
    text-align: center;
}

table {
    border: 1px solid #ccc;
    border-collapse: collapse;
    margin: 0;
    padding: 0;
    width: 100%;
}

table tr {
    background-color: #f8f8f8;
    border: 1px solid #ddd;
    padding: 0.35em;
    
}

table th,
table td {
    padding: 0.625em;
    text-align: center;
}

table th {
    font-size: 0.85em;
    letter-spacing: 0.1em;
    text-transform: uppercase;
}

.pagination{
    justify-content: flex-end;
    margin-top: 10px;
    
}

@media screen and (max-width: 800px) {
    table {
        border: 0;
    }

    table thead {
        border: none;
        height: 1px;
        margin: -1px;
        overflow: hidden;
        padding: 0;
        position: absolute;
        width: 1px;
    }

    table tr {
        border-bottom: 3px solid #ddd;
        display: block;
        margin-bottom: 0.625em;
    }

    table td {
        border-bottom: 1px solid #ddd;
        display: block;
        font-size: 0.8em;
        text-align: right;
    }

    table td::before {
        float: left;
        font-weight: bold;
        text-transform: uppercase;
    }

    table td:last-child {
        border-bottom: 0;
    }
}

@import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap');

*,
*::before,
*::after {
  box-sizing: border-box;
}

.sec-center {
  position: relative;
  max-width: 100%;
  text-align: right;
  z-index: 200;
}
[type="checkbox"]:checked,
[type="checkbox"]:not(:checked){
  position: absolute;
  left: -9999px;
  opacity: 0;
  pointer-events: none;
}

.dropdown:checked + label,
.dropdown:not(:checked) + label{
  align-items: center;
    appearance: none;
    background-color: #fff;
    border-radius: 24px;
    border-style: none;
    box-shadow: rgba(0, 0, 0, 0.2) 0 3px 5px -1px,
        rgba(0, 0, 0, 0.14) 0 6px 10px 0, rgba(0, 0, 0, 0.12) 0 1px 18px 0;
    box-sizing: border-box;
    color: #3c4043;
    cursor: pointer;
    display: inline-flex;
    fill: currentcolor;
    font-family: "Google Sans", Roboto, Arial, sans-serif;
    font-size: 14px;
    font-weight: 500;
    height: 30px;
    justify-content: center;
    letter-spacing: 0.25px;
    line-height: normal;
    max-width: 100%;
    overflow: visible;
    padding: 2px 24px;
    position: relative;
    text-align: right;
    text-transform: none;
    transition: box-shadow 280ms cubic-bezier(0.4, 0, 0.2, 1),
        opacity 15ms linear 30ms, transform 270ms cubic-bezier(0, 0, 0.2, 1) 0ms;
    user-select: none;
    -webkit-user-select: none;
    touch-action: manipulation;
    width: auto;
    will-change: transform, opacity;
    z-index: 0;
    text-decoration: none;
}

.section-dropdown {
  position: absolute;
  padding: 5px;
  background-color: #508A8B;
  top: 45px;
  right: 0;
  width: 30%;
  border-radius: 4px;
  display: block;
  box-shadow: 0 14px 35px 0 rgba(9,9,12,0.4);
  z-index: 2;
  opacity: 0;
  pointer-events: none;
  transform: translateY(20px);
  transition: all 200ms linear;
}

.dropdown:checked ~ .section-dropdown{
  opacity: 1;
  pointer-events: auto;
  transform: translateY(0);
}

.section-dropdown:after {
  position: absolute;
  top: -7px;
  right: 30px;
  width: 0; 
  height: 0; 
  border-left: 8px solid transparent;
  border-right: 8px solid transparent; 
  border-bottom: 8px solid #508A8B;
  content: '';
  display: block;
  z-index: 2;
  transition: all 200ms linear;
}


a {
  position: relative;
  color: #fff; /* error pagination */
  transition: all 200ms linear;
  font-family: 'Roboto', sans-serif;
  font-weight: 500;
  font-size: 15px;
  border-radius: 2px;
  padding: 5px 0;
  padding-left: 20px;
  padding-right: 15px;
  margin: 2px 0;
  text-align: left;
  text-decoration: none;
  display: -ms-flexbox;
  display: flex; /* error pagination */
  -webkit-align-items: center;
  -moz-align-items: center;
  -ms-align-items: center;
  align-items: center;
  justify-content: space-between;
    -ms-flex-pack: distribute;
}
a:hover {
  background-color: #ffce66; /* error pagination */
}





@media screen and (max-width: 991px) {
.logo {
	top: 30px;
	left: 20px;
}

}
</style>