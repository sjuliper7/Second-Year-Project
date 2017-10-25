@extends('adminlte::layouts.app')

@section('htmlheader_title')
{{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title"> DAFTAR PEMILIK HOMESTAY </h3>
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
<th>Nama Homestay</th>
<th>Nama Homestay</th>
<th>Alamat Homestay</th>
<th>Lihat Feedback</th>
</tr>
@foreach($dataF as $a)
<tr>
<td>{{$a->nama_homestay}}</td>
<td>{{$a->nama}}</td>
<td>{{$a->alamat}}</td>
<td> <a href="{{url('feedback/'.$a->id)}}" class="btn btn-primary"><i class="fa fa-eye"></i> </a></td>
</tr>
@endforeach
        </table>
  </div>
</div>

@endsection
