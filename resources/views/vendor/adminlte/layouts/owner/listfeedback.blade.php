@extends('adminlte::layouts.app')

@section('htmlheader_title')
{{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')

<div class="box box-info">
  <div class="box-header with-border">
    <h3 class="box-title"> DAFTAR KOMENTAR </h3>
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

    @if(session()->has('message'))
    <div class="alert alert-info">
      {{session()->get('message')}}
    </div>
    @endif
  </div>
  <div class="box-body">
    <div class="col-md-4 col-sm-6 col-xs-12"></div>

    <ul class="timeline">
        @foreach($data as $a)
          <li>
            <i class="fa fa-comment bg-aqua"></i>
            <div class="timeline-item">
              <span class="time"><i class="fa fa-clock-o"></i> {{$a->created_at}}</span>
              <h3 class="timeline-header" style="border-bottom: 0px;"><a href="#">{{$a->nama}}</a> </h3>
              <div class="timeline-body">
                {{$a->feedback}}
              </div>
              <!-- <div class="timeline-footer">
                <a class="btn btn-primary btn-xs">Read more</a>
                <a class="btn btn-danger btn-xs">Delete</a>
              </div> -->
            </div>
          </li>
        @endforeach
        </ul>
      {!! $data->render() !!}
  </div>
</div>
@endsection
