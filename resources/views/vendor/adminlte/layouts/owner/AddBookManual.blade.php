@extends('adminlte::layouts.app')

@section('htmlheader_title')
{{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title"> TAMBAH PEMESANAN MANUAL</h3>
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
    @if(session()->has('message'))
      <div class="alert alert-info">
        {{session()->get('message')}}
      </div>
    @endif
  </div>
  <div class="box-body">
    <form action="{{url('addManual')}}" method="post">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <div class="form-group">
        <label> Nama Pemesan </label>
        <div class="input-group">
          <div class="input-group-addon">
            <i class="fa fa-user"></i>
          </div>
          <input type="text" name="nama" value="" id="nama" class="form-control">
        </div>
      </div>
      <div class="form-group">
        <label> Jumlah Kamar </label>
        <div class="input-group">
          <div class="input-group-addon">
            <i class="fa fa-bed"></i>
          </div>
          <input type="Number" name="jumlah_kamar" value="" id="kamar" class="form-control">
        </div>
      </div>
      <div class="form-group">
        <label> Tanggal Check In </label>
        <div class="input-group date">
          <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
          </div>
          <input type="text" name="tanggal_mulai" class="form-control datepicker" id="datepicker">
        </div>
        <!-- /.input group -->
      </div>
      <div class="form-group">
        <label> Lama Menginap </label>
        <div class="input-group">
          <div class="input-group-addon">
            <i class="fa fa-user"></i>
          </div>
          <input type="Number" name="lama_menginap" value="" id="nama" class="form-control">
        </div>
      </div>
      <div class="form-group">
        <label> Jumlah Tamu </label>
        <div class="input-group">
          <div class="input-group-addon">
            <i class="fa fa-user"></i>
          </div>
          <input type="Number" min="1" name="jumlah_tamu" value="" id="nama" class="form-control">
        </div>
      </div>
      <div class="form-group">
        <label> Extrabed </label>
        <div class="input-group">
          <div class="input-group-addon">
            <i class="fa fa-user"></i>
          </div>
          <input type="Number" min="0" name="extrabed" value="" id="nama" class="form-control">
        </div>
      </div>
      <div class="form-group" align="right">
        <input type="submit" class="btn btn-primary" value="simpan">
      </div>
    </form>
  </div>
</div>
<script src="{{ asset('/js/bootstrap-datepicker.js') }}"></script>
<script type="text/javascript">
$('#datepicker').datepicker({
  autoclose: true
});
</script>

@endsection
