@extends('adminlte::layouts.master')

@section('main-content')
<div class="cuisines agileits w3layouts" style="padding-top: 50px; margin-top: 80px; ">
	<div class="container">
		<div class="register agileits w3layouts wow agileits w3layouts slideInLeft">
			<form class="form-horizontal">
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label">Nama</label>
					<div class="col-sm-10">
						<input type="email" class="form-control" id="inputEmail3" placeholder="Email">
					</div>
				</div>
				<div class="form-group">
					<label for="inputPassword3" class="col-sm-2 control-label">Alamat</label>
					<div class="col-sm-10">
						<input type="password" class="form-control" id="inputPassword3" placeholder="Alamat">
					</div>
				</div>
				<div class="form-group">
					<label for="inputPassword3" class="col-sm-2 control-label">No.Telepon</label>
					<div class="col-sm-10">
						<input type="password" class="form-control" id="inputPassword3" placeholder="No.Telepon">
					</div>
				</div>
				<div class="form-group">
					<label for="inputPassword3" class="col-sm-2 control-label">Pekerjaan</label>
					<div class="col-sm-10">
						<input type="password" class="form-control" id="inputPassword3" placeholder="Pekerjaan">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label"> Foto </label>
					<div class="col-sm-10">
						<input class="btn btn-success"  value="Browse">
					</div>
				</div>
				<div class="form-group" align="right">
					<div class="col-sm-12">
						<input type="submit" class="btn btn-primary">
					</div>
				</div>
		</form>
	</div>
</div>
</div>
@endsection
