@extends('adminlte::layouts.master')

@section('main-content')
<!-- Banner -->
<div class="banner agileits w3layouts">
		<img src="{{asset('/img/'.$data->gambar)}}" alt="Agileits W3layouts" style="max-height:500px; ">


	<h1 class="wow agileits w3layouts fadeInDown">{{$data->nama_homestay}}</h1>

</div>
<!-- //Banner -->

<!-- Booking -->

<div class="details agileits w3layouts" style="margin-top: 20px; padding:0px;">
	<br>
	@if(Session::has('message'))
		<div class="alert alert-danger">
			{{ Session::get('message') }}
		</div>
	@endif
	<div class="container">
		@if (count($errors) > 0)
			<div class="alert alert-danger">
				<strong>Whoops!</strong> {{ trans('adminlte_lang::message.someproblems') }}<br><br>
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif
	</div>
</div>
<!-- Informations -->
<div class="cuisines agileits w3layouts">
	<div class="container">
		<div class="col-md-6 col-sm-6 cuisines-grids agileits w3layouts cuisines-grids-1  ">
			<h3 style="margin-bottom: 10px; font-weight:10px;"> Fasilitas </h3>
			<ul style="list-style-type: none;">
				<p>{{$data->fasilitas}}</p>
			</ul>
			<img style="width: 450px; margin-top: 10px;" src="{{asset('img/line1.png')}}">
			<h3 style="margin-bottom: 10px;"> Info Pemilik </h3>

			<table class="table-condensed" style="font-size: 16px; margin-left: -3px; color: #777;">
				<tr>
					<td>Pemilik</td>
					<td>:</td>
					<td>{{$data->nama}}</td>
				</tr>
				<tr>
					<td> No Telp</td>
					<td>:</td>
					<td>{{$data->no_telepon}}</td>
				</tr>
				<tr>
					<td> Alamat </td>
					<td>:</td>
					<td>{{$data->alamat}}</td>
				</tr>

				<tr>
					<td> Harga </td>
					<td>:</td>
					<td>Rp 150.000 / malam</td>
				</tr>
				<tr>
					<td>
						<form action="{{url('rincianpemesanan/'.$id)}}">
							<input type="hidden" name="tanggal_mulai" value="{{$tm}}">
							<input type="hidden" name="lama_menginap" value="{{$lm}}">
							<input type="hidden" name="tanggal_selesai" value="{{$ts}}">
							<input type="hidden" name="jumlah_tamu" value="{{$jt}}">
							<input type="hidden" name="jumlah_kamar" value="{{$jk}}">
							<input type="submit" value="Pesan Sekarang" class="btn-succes" style="background-color: #1dc8d9;
    color: white;
    border: none;
    padding: 10px;">
						</form>
					</td>
				</tr>
			</table>
		</div>
		<div class="col-md-6 col-sm-6 cuisines-grids agileits w3layouts cuisines-grids-2  ">
			<img src="/img/{{$data->gambar}}" alt="Agileits W3layouts">
		</div>
		<!-- <div class="clearfix"></div> -->
		<div class="col-md-12 col-sm-12 gallery-grids agileits w3layouts gallery-grids1">

			<!--Homestay pict -->
			@foreach($dataKamar as $dk)
			<div class="col-md-3 col-sm-3 details-grid agileits w3layouts details-grid-1">
				<div id="gambar">
					<a class="example-image-link agileits w3layouts" href="/img/{{$dk->gambar}}" data-lightbox="example-set" data-title="">
	          <div class="grid agileits w3layouts">
	            <figure class="effect-apollo agileits w3layouts">
	              <img src="/img/{{$dk->gambar}}" alt="Agileits W3layouts" id="data">
	                <figcaption></figcaption>
	            </figure>
	          </div>
	        </a>
					<!-- <img src="" alt="Agileits W3layouts" data-toggle="modal" data-target="#myModal" style="cursor: pointer;"> -->
				</div>
				<div class="clearfix"></div>
			</div>
			@endforeach
			<div class="clearfix"></div>
			<!--Homestay pict -->
		</div>
	</div>
</div>
<!-- //Informations -->

<!-- //Kritik & Saran -->

<div class="cuisines agileits w3layouts">
	<div class="container">
		<div class="col-md-8 col-sm-8 cuisines-grids agileits w3layouts cuisines-grids-1  ">
			<h3 style="margin-bottom: 0px; font-weight:10px;"> Review Pengunjung </h3>
			<img style="width: 450px; margin-top: 3px;" src="{{asset('img/line1.png')}}"><br>

			<ul class="timeline">
				@foreach($feedback as $a)
					<li>
						<i class="glyphicon glyphicon-envelope"></i>
						<div class="timeline-item">
							<span class="time"><i class="fa fa-clock-o"></i> {{$a->created_at}}</span>
							<h3 class="timeline-header" style="border-bottom: 0px;"><a href="#">{{$a->nama}}</a> </h3>
							<div class="timeline-body">
								{{$a->feedback}}
							</div>
						</div>
					</li>
				@endforeach
			</ul>
		</div>
	</div>
</div>
<!-- //Informations -->

<!-- Scripts -->
<!-- Date-Picker-JavaScript -->
<script src="{{asset('js/jquery-ui.js')}}"></script>
<!-- Scripts -->

<script>
	function updateDate(object) {
		//$('#tanggal_selesai').datepicker({
		//	dateFormat: "yy-mm-dd",
		//});
		alert(object.value);
		//var tanggal_mulai = $('#datepicker1').datepicker('getDate');
		//tanggal_mulai.setDate(tanggal_mulai.getDate()+parseInt(object.value));
		//$('#tanggal_selesai').datepicker('setDate',tanggal_mulai);
		//alert(tanggal_mulai);

		var date1 = $('#datepicker1').datepicker('getDate');
		var date = new Date( Date.parse( date1 ) );
		date.setDate( date.getDate() + parseInt(object.value) );
		var newDate = date.toDateString();
		newDate = new Date( Date.parse( newDate ) );
		$('#datepicker2').datepicker("setDate",newDate);

	}
</script>

@endsection
