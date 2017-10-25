@extends('adminlte::layouts.app')

@section('htmlheader_title')
{{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')
<div class="box box-warning">
  <div class="box-header with-border">
    <h3 class="box-title"> DATA PEMESANAN </h3>
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
      <form action="{{url('caripesanan')}}">
        <div class="form-group" align="right">
          <label>Bulan</label>
          <input type="number" min="1" max="12" name="bulan">
        </div>

        <div class="form-group" align="right">
          <label>Nama Homestay</label>
          <input type="text" name="nama_homestay">
        </div>

        <div class="form-group" align="right">
            <input type="submit" class="btn btn-warning"  value="Cari" >
        </div>
      </form>

      <table class="table table-striped">
      <tr>
        <th>Nama Homestay</th>
        <th>Nama Pemilik Homstay</th>
        <th>Nama Pemesan</th>
        <th>Tanggal Mulai</th>
        <th>Tanggal Berakhir</th>
        <th>Jumlah Kamar yang dipesan</th>
      </tr>
      @foreach($data as $a)
      <tr>
        <td>{{$a->nama_homestay}}</td>
        <td>{{$a->owner}}</td>
        <td>{{$a->nama_pemesan}}</td>
        <td>{{$a->tanggal_mulai}}</td>
        <td>{{$a->tanggal_berakhir}}</td>
        <td>{{$a->jumlah_kamar}}</td>
      </tr>
      @endforeach
    </table>
    {!! $data->render() !!}
  </div>
</div>


@endsection
