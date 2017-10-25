@extends('adminlte::layouts.app')

@section('htmlheader_title')
{{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')
<div class="box box-warning">
  <div class="box-header with-border">
    <h3 class="box-title"> DAFTAR PENGAJUAN HOMESTAY </h3>
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
  <div class="box-body">

    <table class="table table-striped">
      <tr>
        <th>Pengaju</th>
        <th>Nama Homestay</th>
        <td>Jumlah Kamar</td>
        <td>Status</td>
      </tr>
      @foreach($data as $a)
      <tr>
        <td>{{$a->nama}}</td>
        <td>{{$a->nama_homestay}}</td>
        <td>{{$a->jumlah_kamar}}</td>
        <td>@if($a->status==0)  Sedang Menunggu
          @elseif($a->status==1)  Diterima
          @elseif($a->status==2)  Ditolak
          @endif
        </td>
      </tr>
      @endforeach
    </table>

  </div>
</div>
@endsection
