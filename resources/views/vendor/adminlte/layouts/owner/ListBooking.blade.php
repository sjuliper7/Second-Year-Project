@extends('adminlte::layouts.app')

@section('htmlheader_title')
{{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')
<div class="box box-warning">
  <div class="box-header with-border">
    <h3 class="box-title"> DAFTAR PELANGGAN </h3>
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


    <table class="table table-striped">
      <tr>
        <th>Nama Pelanggan</th>
        <th>Tanggal Check-in</th>
        <th>Tanggal Check-out</th>
        <th>Jumlah Kamar</th>
        <th></th>
      </tr>
      @foreach($data as $a)
      <tr>
        <td>{{$a->nama_pemesan}}</td>
        <td>{{$a->tanggal_mulai}}</td>
        <td>{{$a->tanggal_berakhir}}</td>
        <td>{{$a->jumlah_kamar}}</td>
        <td>
          @if($a->status==0)
            <form action="{{url('check/'.$a->id)}}" method="post">
            {{csrf_field()}}
            <input type="hidden" name="_method" value="PUT">
            <input type="text" hidden name="id" value="1">
            <button type="submit" class="btn btn-succes"><i class="fa fa-check"> Checkin</i></button>
          </form>
          @elseif($a->status==1)
            <form action="{{url('check/'.$a->id)}}" method="post">
              {{csrf_field()}}
              <input type="hidden" name="_method" value="PUT">
              <input type="text" hidden name="id" value="2">
              <button type="submit" class="btn btn-info"><i class="fa fa-check"> Checkout</i></button>
            </form>
           @elseif($a->status == 2) Sudah Checkout
          @endif
        </td>
      </tr>
      @endforeach
    </table>
  </div>
</div>
@endsection
