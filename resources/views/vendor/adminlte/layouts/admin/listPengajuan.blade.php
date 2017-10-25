@extends('adminlte::layouts.app')

@section('htmlheader_title')
{{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')
<div class="box box-warning">
  <div class="box-header with-border">
    <h3 class="box-title"> Pengajuan Homestay </h3>
  </div>
  <div class="box-body">
      <div id="app">
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
        <table class="table table-striped">
          <tr>
            <th>Pengaju</th>
            <th>Nama Homestay</th>
            <th>Jumlah Kamar</th>
            <th colspan="2">Acction</th>
          </tr>
          @foreach($data as $a)
          <tr>
            <td>{{$a->nama}}</td>
            <td>{{$a->nama_homestay}}</td>
            <td>{{$a->jumlah_kamar}}</td>
            @if($a->status==1)
            <td>Di Terima</td>
            @elseif($a->status==2)
            <td>Ditolak</td>
            @elseif($a->status==0)
            <td>
              <form action="{{url('listPengajuanHomestay/'.$a->id)}}" method="post">
                {{csrf_field()}}
                <input type="hidden" name="_method" value="PUT">
                <button type="submit" class="btn btn-info"><i class="glyphicon glyphicon-apple"> Terima</i></button>
              </form>
              <td>
                <form action="{{url('listPengajuanHmsty/'.$a->id)}}" method="post">
                  {{csrf_field()}}
                  <input type="hidden" name="_method" value="PUT">
                  <button type="submit" class="btn btn-danger"><i class="glyphicon glyphicon-trash"> Tolak</i></button>
                </form>
              </td>
              @endif
            </tr>
            @endforeach
          </table>
        </div>
    </div>
  </div>


  @endsection
