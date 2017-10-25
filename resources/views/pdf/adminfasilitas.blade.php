<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>

  <p style="float:right;"><b>Tanggal : </b> <?php echo date("Y/m/d") ;?></p>

    <br> <br> <br> <center><h1>Permintan Fasilitas</h1></center>

    <table class="table table-user-information">

      <tr>
          <th>Judul Pengajuan</th>
          <td>: </td>
          <td>{{$data->nama_request_fasilitas}}</td>
      </tr>
      <tr>
          <th>Nama Pengaju</th>
          <td>: </td>
          <td>{{$data->nama}}</td>
      </tr>
      <tr>
          <th>Nama Homestay</th>
          <td>: </td>
          <td>{{$data->nama_homestay}}</td>
      </tr>
      <tr>
          <th>Alamat</th>
          <td>: </td>
          <td>{{$data->alamat}}</td>
      </tr>
      <tr>
          <th>No Telepon</th>
          <td>: </td>
          <td>{{$data->no_telepon}}</td>
      </tr>
      <tr>
          <th>Keterangan</th>
          <td>: </td>
          <td>{{$data->deskripsi}}</td>
      </tr>
      <tr>
          <th>Gambar</th>
          <td>: </td>
      </tr>
    </table>
    <img src="img/{{$data->gambar}}" style="min-width: 400px;">
  </body>
</html>
