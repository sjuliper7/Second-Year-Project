<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>

  <p style="float:right;"><b>Tanggal : </b> <?php echo date("Y/m/d") ;?></p>

<br><br><br>

    <center>  <h1>Rincian Pemesanan</h1></center>

    <table class="table table-user-information">
      <tr>
          <th>Nama pemilikhomestay</th>
          <td>: </td>
          <td>{{$data->nama}}</td>
      </tr>
      <tr>
          <th>Nama Homestay</th>
          <td>: </td>
          <td>{{$data->nama_homestay}}</td>
      </tr>
      <tr>
          <th>Tanggal Check-in</th>
          <td>: </td>
          <td>{{$data->tanggal_mulai}}</td>
      </tr>
      <tr>
          <th>Lama Menginap</th>
          <td>: </td>
          <td>{{$data->lama_menginap}} Malam </td>
      </tr>
      <tr>
          <th>Tanggal Check-out</th>
          <td>: </td>
          <td>{{$data->tanggal_berakhir}}</td>
      </tr>
      <tr>
        <th>Total Pembayaran</th>
        <td>:</td>
        <td>Rp {{number_format($data->total_pembayaran)}}</td>
      </tr>
      <tr>
        <th>Bukti pembayaran</th>
        <td>:</td>
      </tr>
    </table>

    <img src="img/{{ $data->bukti_pembayaran }}" style="max-height: 250px;
  width: auto;">
  </body>
</html>
