<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>

  <p style="float:right;"><b>Tanggal : </b> <?php echo date("Y/m/d") ;?></p>

<br><br><br>

    <center> <h1 style="margin-bottom:2px;">{{$data->nama_homestay}} </h1>  </center>
    <center> {{$data->alamat}}</center>

    <table class="table table-user-information">
      <tr>
          <th>Nama </th>
          <td>: </td>
          <td>{{$data->nama}}</td>
      </tr>
      <tr>
          <th>No Telepon</th>
          <td>: </td>
          <td>{{$data->no_telepon}}</td>
      </tr>
      <tr>
          <th>Tanggal Check-in</th>
          <td>: </td>
          <td>{{$data->tanggal_mulai}}</td>
      </tr>
      <tr>
          <th>Lama Menginap</th>
          <td>: </td>
          <td>{{$data->lama_menginap}} malam </td>
      </tr>
      <tr>
          <th>Tanggal Check-out</th>
          <td>: </td>
          <td>{{$data->tanggal_mulai}}</td>
      </tr>
      <tr>
          <th>Jumlah kamar</th>
          <td>: </td>
          <td>{{$data->jumlah_kamar}}</td>
      </tr>
      <tr>
          <th>Total Bayar</th>
          <td>: </td>
          <td>Rp. {{$data->total_pembayaran}}</td>
      </tr>
      <tr>
          <th>bukti Pembayaran</th>
          <td>: </td>
          <td><img src="img/{{ $data->bukti_pembayaran }}"></td>
      </tr>
    </table>
  </body>
</html>
