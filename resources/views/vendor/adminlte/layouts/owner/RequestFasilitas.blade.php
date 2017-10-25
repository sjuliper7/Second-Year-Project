@extends('adminlte::layouts.app')

@section('htmlheader_title')
{{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title"> PERMINTAAN FASILITAS </h3>
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
    <form action="{{ url('reqFasilitas') }}" method="post" enctype="multipart/form-data" name="myForm" onsubmit="return(validate())">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <div class="form-group">
        <label> Judul </label>
        <div class="input-group">
          <div class="input-group-addon">
            <i class="fa fa-bookmark"></i>
          </div>
          <input type="text" class="form-control" placeholder="Judul Request Fasilitas" name="namaRequestFasilitas"/>
        </div>
        <span id="errfn" style="color: red"></span>
      </div>

      <div class="form-group">
        <label> Deskripsi </label>
        <div class="input-group">
          <div class="input-group-addon">
            <i class="fa fa-newspaper-o"></i>
          </div>
          <textarea class="form-control" placeholder="Deskripsi" style="height:200px;"  name="deskripsi"> </textarea>
        </div>
        <span id="errfn2" style="color: red"></span>
      </div>

      <div class="form-group">
        <label> Jumlah </label>
        <div class="input-group">
          <div class="input-group-addon">
            <i class="fa fa-newspaper-o"></i>
          </div>
          <input type="Number" class="form-control" placeholder="Jumlah" name="jumlah" />
        </div>
        <span id="errfn3" style="color: red"></span>
      </div>

      <div class="form-group">
        <label> Kategori </label>
        <div class="input-group">
          <div class="input-group-addon">
            <i class="fa fa-list-ul"></i>
          </div>
          <select class="form-control select2 select2-hidden-accessible" name="id_kategoriFasiltas" style="width: 100%;" tabindex="-1" aria-hidden="true">
            <option value=1> Kamar Tidur </option>
            <option value=2> Perlatan Kamar Mandi </option>
          </select>
        </div>
      </div>


      <div class="form-group">
        <label>Foto</label>
        <div class="input-group">
          <input type="file" name="gambar" id="foto" class="form-corol"><br>
        </div>
      </div>

      <div class="form-group" align="right" style="color: black;">
        <button type="submit" class="btn btn-primary ">Ajukan</button>
      </div>
    </form>
  </div>
</div>

@endsection
