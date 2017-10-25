@extends('adminlte::layouts.app')

@section('htmlheader_title')
{{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title"> UPDATE DATA HOMESTAY </h3>
    @if (count($errors) > 0)
    <div class="alert alert-danger">
      <strong>Whoops!</strong> {{ trans('adminlte_lang::message.someproblems') }}<br><br>
      <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>

    @if(session()->has('message'))
    <div class="alert alert-info">
      {{session()->get('message')}}
    </div>
    @endif

    @endif
  </div>
  <div class="box-body">
    <form action="{{ url('updateHomestay/'.$data->id) }}" method="post" enctype="multipart/form-data">
      <input type="hidden" name="_method" value="PUT">
      {{csrf_field()}}
      <div class="form-group">
        <label> Nama Homestay </label>
        <div class="input-group">
          <div class="input-group-addon">
            <i class="fa fa-bookmark"></i>
          </div>
          <input type="text" class="form-control" placeholder="Nama Request Fasilitas" name="namaUpdate" value="{{$data->nama_homestay}}"/>
        </div>
      </div>

      <div class="form-group">
        <label> Alamat Homestay </label>
        <div class="input-group">
          <div class="input-group-addon">
            <i class="fa fa-building"></i>
          </div>
          <input type="text" class="form-control" placeholder="Nama Request Fasilitas" name="alamatUpdate" value="{{$data->alamat}}"/>
        </div>
      </div>

      <div class="form-group">
        <label> Harga per Kamar </label>
        <div class="input-group">
          <div class="input-group-addon">
            <i class="fa fa-dollar"></i>
          </div>
          <input type="text" class="form-control" value="{{$data->harga}}" placeholder="Nama Request Fasilitas" name="hargaUpdate"/>
        </div>
      </div>

      <div class="form-group">
        <label> fasilitas </label>
        <div class="input-group">
          <div class="input-group-addon">
            <i class="fa fa-newspaper-o"></i>
          </div>
          <textarea class="form-control" value="{{$data->fasilitas}}" placeholder="Deskripsi" name="fasilitasUpdate" style="height:200px;"> </textarea>
        </div>
      </div>

      <div class="form-group">
        <label>Foto</label>
        <div class="input-group">
          <input type="file" name="gambar" id="foto" class="form-corol"><br>
        </div>
      </div>

      <div class="form-group" align="right" style="color: black;">
        <button type="submit" class="btn btn-primary ">Update</button>
      </div>
    </form>
  </div>
</div>
@endsection
