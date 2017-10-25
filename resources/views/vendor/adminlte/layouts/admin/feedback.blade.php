@extends('adminlte::layouts.app')

@section('htmlheader_title')
{{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')
<div class="box box-warning">
  <div class="box-header with-border">
    <h3 class="box-title"> FEEDBACK  </h3>
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
