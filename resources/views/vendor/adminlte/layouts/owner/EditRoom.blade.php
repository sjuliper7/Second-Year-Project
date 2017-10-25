@extends('adminlte::layouts.app')

@section('htmlheader_title')
{{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')
<div class="box box-info">
  <div class="box-header with-border">
    <h3 class="box-title"> EDIT KAMAR </h3>
    @if(Session::has('alert-success'))
    <div class="alert alert-success">
      {{ Session::get('alert-success') }}
    </div>
    @endif

    @if (count($errors) > 0)
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    @endif
  </div>
  <div class="box-body">
    <form action="{{url('editRoom/'.$data->id)}}" method="post" enctype="multipart/form-data">
      <input type="hidden" name="_method" value="PUT">
      {{csrf_field()}}
      <label>Jumlah Bed</label>
      <input class="form-control" value="{{$data->jumlah_bed}}" name="jumlah_bed">
      <label>Fasilitas</label>
      <textarea name="fasilitas" value="{{$data->fasilitas}}" id="fasilitas" class="form-control" style="height:200px;"></textarea>
      <label>Foto</label>
      <input type="file"  value="Browse"  name="foto" id="picture" >
      <div class="form-group" align="right">
        <input type="submit" class="btn btn-primary" value="simpan">
      </div>
    </form>
  </div>
  <div class="box-footer">
  </div>
</div>


@endsection
