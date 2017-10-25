@extends('adminlte::layouts.master')

@section('main-content')
<div class="cuisines agileits w3layouts" style="padding-top: 50px; margin-top: 80px; margin-bottom: 100px;">
  <div class="container">
    <form class="form-horizontal" action="{{url('upload/'.$data->id)}}" method="post" enctype="multipart/form-data">
      <input type="hidden" name="_method" value="PUT">
      {{csrf_field()}}
      <label>Tanggal Mulai</label>
      <input type="text" name="tanggal_mulai" value="{{$data->tanggal_mulai}}" id="noTelepon" class="form-control" disabled>
      <label>Tanggal Berakhir</label>
      <input type="text" name="tanggal_berakhir" value="{{$data->tanggal_berakhir}}" class="form-control" disabled>
      <label>Jumlah Kamar</label>
      <input type="text" name="jumlah_kamar" value="{{$data->jumlah_kamar}}" class="form-control" disabled>
      <label>Bukti Pembayaran</label>
      <input type="file" name="bukti_pembayaran" id="foto" class="form-corol">nt<br>
      <div class="form-group" align="right">
      <input type="submit" class="btn btn-primary" value="simpan">
      </div>
    </form>
  </div>
</div>
@endsection
