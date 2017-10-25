@extends('adminlte::layouts.master')
@section('main-content')
<div class="cuisines agileits w3layouts" style="padding-top: 50px; margin-top: 70px; ">
	<div class="container">
		<div class="col-md-6 col-sm-6  cuisines-grids agileits w3layouts" style="padding:0px;">
        <h3>Data Pemesanan Homestay</h3> <br>
			<!-- <h3 style="margin-left:60px ; margin-top: 3px;"> </h2> -->


  			<form class="form-horizontal" action="{{url('booking')}}" method="post" enctype="multipart/form-data">
  				{{csrf_field()}}
  				<div class="form-group">

  					<div class="col-sm-10">
              <label for="">Nama</label>
  						<input type="text" name="nama" class="form-control" value="{{Auth::user()->name}}" id="inputEmail3" >
  					</div>
  				</div>

          <div class="form-group">
  					<div class="col-sm-5">
              <label>Nomor Handphone Kontak</label>
  						<input type="text" name="kontak_hp" class="form-control" id="inputEmail3" value="{{$dataUser->no_telepon}}">
  					</div>
            <div class="col-sm-5">
              <label>Alamat Email Kontak</label>
  						<input type="text" name="kontak_email" class="form-control" id="inputEmail3" value="{{Auth::user()->email}}">
  					</div>
		  </div>



          <div class="form-group">
  					<div class="col-sm-10">
              <label>Permintaan Khusus</label>
  						<textarea name="permintaan_khusus" style="border: #cccccc 1px solid;border-radius: 5px; min-height:150px;"></textarea>
  					</div>
  				</div>

				<div class="form-group">
					<div class="col-sm-10">
						<label>ExtraBed</label>
							<input type="number" min="0" name="extrabed" onchange="updateVal(this)" class="form-control" id="exbed" >
					</div>
				</div>

				<input type="hidden" value="{{$dataUser->no_telepon}}" name="id_user">
				<input type="hidden" value="{{$request->lama_menginap}}" name="lama_menginap">
				<input type="hidden" value="{{$request->tanggal_mulai}}" name="tanggal_mulai">
				<input type="hidden" value="{{$request->tanggal_selesai}}" name="tanggal_selesai">
				<input type="hidden" value="{{$request->jumlah_kamar}}" name="jumlah_kamar">
				<input type="hidden" value="{{$request->jumlah_tamu}}" name="jumlah_tamu">
				<input type="hidden" value="{{$data->harga}}" name="harga_homestay">
				<input type="hidden" value="{{$totalHarga}}" name="total_harga">
				<input type="hidden" value="{{$id}}" name="id_homestay">

  					<!-- <div class="form-group" align="right">
  						<div class="col-sm-10">
  							<input type="submit" class="btn btn-primary">
  						</div>
  					</div> -->
				<div class="form-group" align="left">
					<div class="col-sm-10">
						<input type="submit" class="btn btn-warning" value="Lanjutkan Pembayaran">
					</div>
				</div>


  			</form>
			</div>

        <div class="col-md-5 col-sm-5  cuisines-grids agileits w3layouts" style="background-color: #f9f9f9;padding: 40px;border-radius: 9px;">
          <h3>Rincian Pemesanan Homestay</h3> <br> <br><br>
          <table class="table-condensed" style="font-size: 16px; margin-left: -3px; color: #777;" >
    				<tr>
    					<td>Durasi</td>
    					<td>:</td>
						<td>{{$request->lama_menginap}} Malam</td>
    				</tr>
    				<tr>
    					<td> Check-in</td>
    					<td>:</td>
						<td>{{$request->tanggal_mulai}}</td>

    				</tr>
            <tr>
    					<td> Check-out</td>
    					<td>:</td>
						<td>{{$request->tanggal_selesai}}</td>

    				</tr>
    				<tr>
    					<td>Jumlah Kamar</td>
    					<td>:</td>
						<td>{{$request->jumlah_kamar}}</td>
    				</tr>
    				<tr>
    					<td> Jumlah Tamu </td>
    					<td>:</td>
						<td>{{$request->jumlah_tamu}}</td>
    				</tr>
    			</table>

          <br><br><br>
          <div class=" cuisines-grids agileits w3layouts" >
            <h3>Rincian Harga</h3><br>
            <table class="table-condensed" style="font-size: 16px; margin-left: -3px; color: #777;" >
                <label for="">{{$data->nama_homestay}}</label>

              <tr>
				  <td>Harga Kamar</td>
				  <td>:</td>
				  <td>Rp {{number_format($data->harga)}}</td>
			  </tr>
				<tr>
					<td>Harga extra bed</td>
					<td>:</td>
					<td>Rp {{number_format(30000)}}</td>
				</tr>
				<tr>
      					<td> Total Bayar</td>
      					<td>:</td>
					    <td><input type="text" id="tot_har" name="total_harga" value="Rp {{number_format($totalHarga)}}" disabled></td>
      				</tr>
      			</table>
            <br>
          </div>

        </div>
		</div>

		<div class="clearfix"></div>
	</div>
</div>

<script>
	function updateVal(object) {

		var field = document.getElementById('tot_har');
		field.value = parseInt(object.value) * 30000 + parseInt({{$totalHarga}});

	}
</script>

@endsection
