@extends('adminlte::layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::message.home') }}
@endsection
@section('main-content')

<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title"> Tambah Pemilik Homestay </h3>
  </div>
  <div class="box-body">
      <div id="app">


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
        <div class="register-box-body ">
          <form action="{{ url('admin') }}" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group has-feedback">
              <input type="text" class="form-control" placeholder="Nama Lengkap" name="name" value="{{ old('name') }}"/>
              <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
              <input type="text" class="form-control" placeholder="Username" name="username" value="{{ old('username') }}"/>
              <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
              <input type="email" class="form-control" placeholder="{{ trans('adminlte_lang::message.email') }}" name="email" value="{{ old('email') }}"/>
              <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
              <input type="password" class="form-control" placeholder="{{ trans('adminlte_lang::message.password') }}" name="password"/>
              <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
              <input type="password" class="form-control" placeholder="{{ trans('adminlte_lang::message.retrypepassword') }}" name="password_confirmation"/>
              <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
              <input value="Owner" hidden  type="text" placeholder="{{ trans('adminlte_lang::message.role') }}" name="role"/>
              <span class="glyphicon glyphicon-wrench  form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
              <input class="form-control" type="text" placeholder="Nama Homestay" name="nama_homestay"/>
              <span class="glyphicon glyphicon-wrench  form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
              <input value="Owner" class="form-control"  type="number" placeholder="Jumlah Kamar" name="jumlah_kamar"/>
              <span class="glyphicon glyphicon-wrench  form-control-feedback"></span>
            </div>
            <div class="row">
              <div class="col-xs-1">
                <label>

                </label>
              </div><!-- /.col -->
              <div class="col-xs-6">

              </div><!-- /.col -->
              <div class="col-xs-4 col-xs-push-1">
                <button type="submit" class="btn btn-success btn-block btn-flat">{{ trans('adminlte_lang::message.register') }}</button>
              </div><!-- /.col -->
            </div>
          </form>
        </div><!-- /.form-box -->
      </div>
  </div>
</div>


@endsection
