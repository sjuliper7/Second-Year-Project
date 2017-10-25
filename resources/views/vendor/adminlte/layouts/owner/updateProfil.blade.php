@extends('adminlte::layouts.app')

@section('htmlheader_title')
{{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title"> UPDATE PROFIL</h3>
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
    <form action="{{ url('profileupdate/'.$data->id) }}" method="post" enctype="multipart/form-data">
      <input type="hidden" name="_method" value="PUT">
      {{csrf_field()}}
      <div class="form-group">
        <label> Nama </label>
        <div class="input-group">
          <div class="input-group-addon">
            <i class="fa fa-bookmark"></i>
          </div>
          <input type="text" class="form-control" placeholder="nama" name="nama" value="{{$data->nama}}"/>
        </div>
      </div>

      <div class="form-group">
        <label> Alamat </label>
        <div class="input-group">
          <div class="input-group-addon">
            <i class="fa fa-building"></i>
          </div>
          <input type="text" class="form-control" placeholder="Alamat" name="alamat" value="{{$data->alamat}}"/>
        </div>
      </div>

      <div class="form-group">
        <label> Perkerjaan </label>
        <div class="input-group">
          <div class="input-group-addon">
            <i class="fa fa-dollar"></i>
          </div>
          <input type="text" class="form-control" value="{{$data->pekerjaan}}" name="pekerjaan"/>
        </div>
      </div>

      <div class="form-group">
        <label> No Telepon </label>
        <div class="input-group">
          <div class="input-group-addon">
            <i class="fa fa-dollar"></i>
          </div>
          <input type="Number" class="form-control" value="{{$data->no_telepon}}" placeholder="noTelepon" name="noTelepon"/>
        </div>
      </div>

      <div class="form-group">
        <label>No Rekening </label>
        <div class="input-group">
          <div class="input-group-addon">
            <i class="fa fa-dollar"></i>
          </div>
          <input type="Number" class="form-control" value="{{$data->no_rekening}}" placeholder="noRekening" name="noRekening"/>
        </div>
      </div>

      <div class="form-group">
        <label>Foto </label>
        <div class="input-group">
        <input type="file"  value="Browse"  name="picture" id="picture" >
        </div>
      </div>

      <div class="form-group" align="right" style="color: black;">
        <button type="submit" class="btn btn-primary ">Update</button>
      </div>
    </form>
  </div>
</div>
@endsection
