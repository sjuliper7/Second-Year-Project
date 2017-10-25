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
								<a href ="{{url('homestay/'.$a[0]->id.'/'.$tm.'/'.$lm.'/'.$ts.'/'.$jt.'/'.$jk)}}" ><img src="/img/{{$a[0]->gambar}}" alt="Agileits W3layouts" ></a>
							</div>
							<div class="details-grid-info agileits w3layouts">
								<a href ="{{url('homestay/'.$a[0]->id.'/'.$tm.'/'.$lm.'/'.$ts.'/'.$jt.'/'.$jk)}}" ><h4>{{$a[0]->nama_homestay}}</h4></a>
							</div>
							<div class="clearfix"><h5>RP.{{$a[0]->harga}}</h5></div>
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

	<!-- //Lokasi -->
@endsection
