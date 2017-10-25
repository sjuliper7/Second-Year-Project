@extends('adminlte::layouts.master')

@section('main-content')
    <div class="cuisines agileits w3layouts" style="padding-top: 50px; margin-top: 80px; margin-bottom: 100px;">
        <div class="container">
            <form class="form-horizontal" action="{{url('perbaharui/'.$data->id)}}" method="post">
                <input type="hidden" name="_method" value="PUT">
                {{csrf_field()}}
                <label>Tanggal Mulai</label>
                <input type="text" name="tanggal" value="{{$data->tanggal_mulai}}" id="noTelepon" class="form-control">
                <label>Lama Menginap</label>
                <input type="text" name="lama_menginap" value="{{$lama_menginap}}" class="form-control" >
                <label>Jumlah Kamar</label>
                <input type="text" name="jumlah_kamar" value="{{$data->jumlah_kamar}}" class="form-control">
                <br>
                <div class="form-group" align="right" style="margin-right:0px;">
                    <input type="submit" class="btn btn-primary" value="Simpan">
                </div>
            </form>
        </div>
    </div>
@endsection
