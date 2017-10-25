@extends('adminlte::layouts.master')

@section('main-content')
<div class="cuisines agileits w3layouts" style="padding-top: 50px; margin-top: 80px; ">
	<div class="container">
		<div class="register agileits w3layouts ">
			<form class="form-horizontal" action="{{url('editProfileCustomer/'.$data->id)}}" method="post" enctype="multipart/form-data">
				<input type="hidden" name="_method" value="PUT">
				{{csrf_field()}}
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label">Nama</label>
					<div class="col-sm-10">
						<input type="text" name="nama" class="form-control" id="inputEmail3" value="{{$data->nama}}">
					</div>
				</div>
				<div class="form-group">
					<label for="inputPassword3" class="col-sm-2 control-label">Alamat</label>
					<div class="col-sm-10">
						<input type="text" name="alamat" class="form-control" id="inputPassword3" value="{{$data->alamat}}">
					</div>
				</div>
				<div class="form-group">
					<label for="inputPassword3" class="col-sm-2 control-label">No.Telepon</label>
					<div class="col-sm-10">
						<input type="text" name="noTelepon" class="form-control" id="inputPassword3" value="{{$data->no_telepon}}">
					</div>
				</div>
				<div class="form-group">
					<label for="inputPassword3" class="col-sm-2 control-label">Pekerjaan</label>
					<div class="col-sm-10">
						<input type="text" name="pekerjaan" class="form-control" id="inputPassword3" value="{{$data->pekerjaan}}">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label"> Foto </label>
					<div class="col-sm-10">
						<input type="file"  value="Browse"  name="foto" id="picture" >
					</div>
					<div class="form-group" align="right">
						<div class="col-sm-12">
							<input type="submit" class="btn btn-primary">
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
