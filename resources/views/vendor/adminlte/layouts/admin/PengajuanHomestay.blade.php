@extends('adminlte::layouts.app')

@section('htmlheader_title')
{{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">HOMESTAY </h3>
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

  @if(Session::has('message'))
    <div class="alert alert-danger">
      {{ Session::get('message') }}
    </div>
  @endif


  <div class="box-body">
    <form action="{{ url('pengajuanHomestay') }}" method="post">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">

      <div class="form-group">
        <label> Nama Homestay </label>
        <div class="input-group">
          <div class="input-group-addon">
            <i class="fa fa-bookmark"></i>
          </div>
          <input type="text" class="form-control" placeholder="Nama Homestay" name="namaHomestay"/>
        </div>
      </div>

      <div class="form-group">
        <label>Jumlah Kamar </label>
        <div class="input-group">
          <div class="input-group-addon">
            <i class="fa fa-bed"></i>
          </div>
          <input type="Number" class="form-control" placeholder="Jumlah Kamar" name="jumlahKamar" >
        </div>
      </div>

      <br>
      <div class="form-group" align="right" style="color: black;">
        <button type="submit" class="btn btn-primary ">Ajukan</button>
      </div>
    </form>
  </div>
</div>

@endsection
