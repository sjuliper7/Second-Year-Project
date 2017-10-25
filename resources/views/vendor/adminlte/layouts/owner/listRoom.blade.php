@extends('adminlte::layouts.app')

@section('htmlheader_title')
{{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')
<div class="box box-warning">
  <div class="box-header with-border">
    <h3 class="box-title"> DAFTAR KAMAR </h3>
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
    @if(!empty($success))
    <div class="alert alert-success">
      {{$succes}}
    </div>
    @endif

  </div>
  <div class="box-body">
    <div class="col-md-4 col-sm-6 col-xs-12">
      <!-- <div class="info-box bg-yellow">
        <span class="info-box-icon"><i class="glyphicon glyphicon glyphicon-bed"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">List Room</span>
          <span class="info-box-number">{{$count}}</span>
        </div>
      </div> -->
    </div>

    <table class="table table-striped">
      <tr>
        <th>No Kamar</th>
        <th>Jumlah Kasur</th>
        <th>Deskripsi</th>
        <th>Foto</th>
        <th colspan="2">Aksi</th>
      </tr>
      @foreach($data as $a)
      <tr>
        <td>{{$a->nomor_kamar}}</td>
        <td>{{$a->jumlah_bed}}</td>
        <td>{{$a->fasilitas}}</td>
        <td>@if($a->gambar == null)
          <img alt="Belum ada foto" >
          @else
          <a href="/img/{{$a->gambar}}" data-lightbox="roadtrip"><img src="/img/{{$a->gambar}}" style="max-height: 150px; width:200px;"></a>
          @endif
        </td>
        <td>
          <a href="{{url('editRoom/'.$a->id)}}" class="btn btn-primary"><i class="glyphicon glyphicon-edit"></i> </a>

        <form action="{{url('room/'.$a->id)}}" method="POST">
            {{csrf_field()}}
            <input type="hidden" name="_method" value="DELETE">

          </form>
        </td>
        <td>
          <button type="submit" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></button>
        </td>
      </tr>
      @endforeach
    </table>
  </div>
</div>
@endsection
