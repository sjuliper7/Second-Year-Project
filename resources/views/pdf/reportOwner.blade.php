<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title></title>

  <style type="text/css">
  table.table-style-one {
    font-family: verdana,arial,sans-serif;
    font-size:11px;
    color:#333333;
    border-width: 1px;
    border-color: #3A3A3A;
    border-collapse: collapse;
  }
  table.table-style-one th {
    border-width: 1px;
    padding: 8px;
    border-style: solid;
    border-color: #3A3A3A;
    background-color: #B3B3B3;
  }
  table.table-style-one td {
    border-width: 1px;
    padding: 8px;
    border-style: solid;
    border-color: #3A3A3A;
    background-color: #ffffff;
  }

  hr {
    display: block;
    position: relative;
    padding: 0;
    margin: 8px auto;
    height: 0;
    width: 100%;
    max-height: 0;
    font-size: 1px;
    line-height: 0;
    clear: both;
    border: none;
    border-top: 2px solid #aaaaaa;
    border-bottom: 2px solid #ffffff;
  }

    h1, h2{
    font-family:'Source Sans Pro', sans-serif;
  }

    </style>


  </head>
  <body>

    <p style="float:right;"><b>Tanggal : </b> <?php echo date("Y/m/d") ;?></p>
    <br>
    <center>  <h1>Laporan di Bulan {{$bulan}}</h1></center>
    <center> <h2>{{$namaHomestay}}</h2> </center>

    <hr>
    <br>


<table class="table table-user-information">
    <table class="table-style-one">
      <body>
        <tr>
          <th>Nama Pemesan</th>
          <th>Jumlah Kamar</th>
          <th>Jumlah Tamu</th>
          <th>Lama Menginap</th>
          <th>Extra-bed</th>
          <th>Tanggal Check-in</th>
          <th>Tanggal Check-out</th>
          <th>Total Pembayaran</th>
        </tr>
        @foreach($data as $a)
        <tr>
          <td>{{$a->nama_pemesan}}</td>
          <td>{{$a->jumlah_kamar}} kamar</td>
          <td>{{$a->jumlah_tamu}} orang</td>
          <td>{{$a->lama_menginap}} Malam</td>
          <td>{{$a->extrabed}} buah</td>
          <td>{{$a->tanggal_mulai}}</td>
          <td>{{$a->tanggal_berakhir}}</td>
          <td>Rp. {{$a->total_harga}}</td>
      </tr>
    @endforeach

        <tr>
          <td colspan="2">Total</td>
          <td>{{$tamu}} Orang </td>
          <td colspan="4"></td>
          <td>Rp. {{$penghasilan}}</td>
        </tr>
      </body>
      </table>
</table>
    </body>
    </html>
