@extends('adminlte::layouts.master')
@section('main-content')
<div class="cuisines agileits w3layouts" style="padding-top: 50px; margin-top: 40px; ">
	<div class="container">
		<div class="col-md-4 col-sm-3 cuisines-grids agileits w3layouts cuisines-grids-2">
			<img src="img/{{Auth::user()->foto}}" alt="Agileits W3layouts" style="width:250px;">
			<h3 style="margin-left:60px ; margin-top: 3px;"> {{Auth::user()->name}} </h2>

		</div>
		<div class="col-md-8 col-sm-8 cuisines-grids agileits w3layouts cuisines-grids-1">
			<h3>Data Diri</h3>
			<table class="table-condensed" style="font-size: 16px; margin-left: -3px; color: #777;" >
				<tr>
					<td>Nama</td>
					<td>:</td>
					<td>{{$data->nama}}</td>
				</tr>
				<tr>
					<td> Alamat</td>
					<td>:</td>
					<td>{{$data->alamat}}</td>
				</tr>
				<tr>
					<td> No Telepon</td>
					<td>:</td>
					<td>{{$data->no_telepon}}</td>
				</tr>
				<tr>
					<td> Pekerjaan </td>
					<td>:</td>
					<td>{{$data->pekerjaan}}</td>
				</tr>
			</table>
			<br><br>
			<div class="services agileits w3layouts" style="background-color: #fff; padding: 1px 1px 1px 0px; margin-top: 30px;">
				<a class="agileits w3layoutswow slideInLeft" href="{{url('editProfileCustomer/'.$data->id)}}" >Edit Profile <span class="glyphicon agileits w3layouts glyphicon-arrow-right" aria-hidden="true"></span></a>
				<a class="agileits w3layoutswow slideInLeft" href="{{url('customerHistory')}}">History <span class="glyphicon agileits w3layouts glyphicon-arrow-right" aria-hidden="true"></span></a>
			</div>
			<br><br>
			@if(Session::has('message'))
				<div class="alert alert-danger">
					{{ Session::get('message') }}
				</div>
			@endif
		</div>
		<div class="clearfix"></div>
	</div>
</div>
@endsection
