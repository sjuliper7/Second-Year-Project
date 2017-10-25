@extends('adminlte::layouts.master')
@section('main-content')
	@include('adminlte::layouts.partialweb.slider')<br>
	<!--Welcome-->

	<!--Welcome-->

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

			<div class="col-md-12 col-sm-12 agileits w3layouts contact-grid contact-grid-2" style="background-color: #f3f3f3; padding-top: 28px;padding-bottom: 28px;">
				<form action="{{url('cari')}}">

					<div class="col-md-2 col-sm-2 agileits w3layouts contact-grid contact-grid-2  "></div>

					<div class="col-md-2 col-sm-2 agileits w3layouts contact-grid contact-grid-2  ">
						<label>Tanggal Check-in:</label>
						<input class="date agileits w3layouts" id="datepicker1" name="tanggal_mulai" type="text" required value="Tanggal Check in" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '';}">
					</div>
					<div class="col-md-2 col-sm-2 agileits w3layouts contact-grid contact-grid-2  ">
						<label>Durasi/Malam</label>
						<input type="number" min="1" class="text wow agileits w3layouts " name="jumlah_hari" required onchange="updateDate(this)" placeholder="Lama Menginap" style="background-color: white; color: black">
					</div>
					<div class="col-md-2 col-sm-2 agileits w3layouts contact-grid contact-grid-2  ">
						<label>Tanggal Check-out:</label>
						<input class="date agileits w3layouts" id="datepicker2" name="tanggal_selesai" type="text" value="Tanggal Check Out" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '';}">
					</div>

					<div class="col-md-1 col-sm-2 agileits w3layouts contact-grid contact-grid-2  ">
						<label>Tamu :</label>
						<input type="number" min="1" class="text wow agileits w3layouts " required name="jumlah_Tamu" placeholder="" style="background-color: white; color: black">
					</div>
					<div class="col-md-1 col-sm-2 agileits w3layouts contact-grid contact-grid-2  ">
						<label>Kamar : </label>
						<input type="number" min="1" class="text wow agileits w3layouts " required name="jumlah_kamar" placeholder="" style="background-color: white; color: black">
					</div>
					<div class="book"><br>
						<input type="submit" class="more_btn wow agileits w3layouts " value="Cari">
					</div>

				</form>
			</div>
			<br>
		</div>




	<!--Greating-->
	<div class="clearfix" style="margin-top: 120px;"></div>
	<div class="cuisines agileits w3layouts" style="">
		<div class="container">
			<div class="col-md-6 col-sm-6 cuisines-grids agileits w3layouts cuisines-grids-1" style=" text-align: justify;
    text-justify: inter-word;">
				<h2>Pengembangan Pariwisata Homestay</h2>
				<p>Untuk mendukung pengembangan pariwisata di sekitaran Danau Toba pemerintah membuat suatu program  yaitu dengan pembangunan homestay di setiap titik destinasi pariwisata sehingga para pengujung/penikmat wisata
				bisa lebih lama di tempat wisata tanpa dibebankan biaya menginap yang terlalu besar atau mahal</p>
			</div>

			<div class="col-md-6 col-sm-6 cuisines-grids agileits w3layouts cuisines-grids-2  ">
				<img src="{{asset('img/pantai-bulbul.jpg')}}" alt="Agileits W3layouts">
			</div>
			<div class="clearfix"></div>

		</div>
	</div>
	<!-- //Greating -->


	<!-- List Homestay -->
	<div id ="DaftarHomestay">
	<div class="details agileits w3layouts">
		<div class="container">
			<h3>Daftar Homestay</h3>
			<div class="details-grids agileits w3layouts">
				@foreach($data as $a)
					<div class="col-md-4 col-sm-4 details-grid details-grid-2  agileits w3layouts ">
						<div class="details-grid2 agileits w3layouts">
							<div class="details-grid-image agileits w3layouts" >
								<a href ="{{url('detailhomestay/'.$a->id)}}" ><img src="/img/{{$a->gambar}}" alt="Agileits W3layouts" ></a>
							</div>
							<div class="details-grid-info agileits w3layouts">
								<a href ="{{url('detailhomestay/'.$a->id)}}" ><h4>{{$a->nama_homestay}}</h4></a>
							</div>
							<div class="clearfix"></div>
						</div>
					</div>
				@endforeach
				<div class="clearfix"></div>
			</div>

			<!-- Tooltip-Content -->
			<div class="tooltip-content agileits w3layouts">

				<div class="modal fade agileits w3layouts details-modal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
					<div class="modal-dialog agileits w3layouts modal-lg">
						<div class="modal-content agileits w3layouts">
							<div class="modal-header agileits w3layouts">
								<button type="button" class="close agileits w3layouts" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h4 class="modal-title agileits w3layouts">LOREM IPSUM</h4>
							</div>
							<div class="modal-body agileits w3layouts">
								<img src="{{asset('img/project-1.jpg')}}" alt="Agileits W3layouts">
								<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia.</p>
							</div>
						</div>
					</div>
				</div>

				<div class="modal fade agileits w3layouts details-modal" id="myModal2" tabindex="-1" role="dialog" aria-hidden="true">
					<div class="modal-dialog modal-lg agileits w3layouts">
						<div class="modal-content agileits w3layouts">
							<div class="modal-header agileits w3layouts">
								<button type="button" class="close agileits w3layouts" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h4 class="modal-title agileits w3layouts">LOREM IPSUM</h4>
							</div>
							<div class="modal-body agileits w3layouts">
								<img src="{{asset('img/project-6.jpg')}}" alt="Agileits W3layouts">
								<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia.</p>
							</div>
						</div>
					</div>
				</div>

				<div class="modal fade details-modal agileits w3layouts" id="myModal3" tabindex="-1" role="dialog" aria-hidden="true">
					<div class="modal-dialog modal-lg agileits w3layouts">
						<div class="modal-content agileits w3layouts">
							<div class="modal-header agileits w3layouts">
								<button type="button" class="cloWse agileits w3layouts" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h4 class="modal-title agileits w3layouts">LOREM IPSUM</h4>
							</div>
							<div class="modal-body agileits w3layouts">
								<img src="{{asset('img/project-7.jpg')}}" alt="Agileits W3layouts">
								<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia.</p>
							</div>
						</div>
					</div>
				</div>
				<script>
					$('#myModal').modal('');
				</script>
			</div>
			<!-- //Tooltip-Content -->

		</div>
	</div>
	</div>
	<!-- //List Homestay -->

	<!-- Lokasi -->
	<div id ="Lokasi">
	<div class="services agileits w3layouts" style="padding-top: 10px">
			<h1> Lokasi Kami</h1>
			<div class="banner agileits w3layouts">
				<iframe
				  width="100%"
				  height="400"
				  frameborder="0" style="border:0"
				  src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3986.473439179238!2d99.07229116254526!3d2.346290392637484!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x7438dfa4c9a63950!2sPantai+BUL+BUL!5e0!3m2!1sen!2sid!4v1497693314254" width="600" height="450" frameborder="0" style="border:0" allowfullscreen>
				</iframe>
		</div>


	</div>
	</div>
	<!-- //Lokasi -->


	<script>
		function updateDate(object) {
			//$('#tanggal_selesai').datepicker({
			//	dateFormat: "yy-mm-dd",
			//});
			//alert(object.value);
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
