@extends('adminlte::layouts.app')

@section('htmlheader_title')
{{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')
<div class="box box-warning">
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
        <table id="example2" class="table table-bordered table-hover">
          <thead>
          <tr>
            <th>Nama Lengkap</th>
            <th>Username</th>
            <th>Email</th>
            <th>Lihat Data</th>
            <th>Perbaharui Data</th>
          </tr>
          </thead>
          <tbody>
            @foreach($data as $a)
            <tr>
              <td>{{$a->name}}</td>
              <td>{{$a->username}}</td>
              <td>{{$a->email}}</td>
              <td>
                <form action="{{url('rincianpemilik/'.$a->id)}}">
                  <input type="submit" value="Lihat" class="btn btn-info">
                </form>
              </td>
              <td>
                <form action="{{url('ownerr/'.$a->id)}}">
                  <input type="submit" value="Perbaharui" class="btn btn-warning">
                </form>
              </td>
              <!-- <td>  <a href="{{url('ownerprofil/'.$a->id)}}" class="btn btn-primary"><i class="glyphicon glyphicon-edit"></i> </a></td> -->
            </tr>
            @endforeach
          </tbody>

        </table>
  </div>
</div>

<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": false,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>

<script type="text/javascript">
$(function () {
  $("#table").DataTable();
  $('#table1').DataTable({
    "paging": true,
    "lengthChange": false,
    "searching": false,
    "ordering": true,
    "info": true,
    "autoWidth": false
  });
});
</script>
@endsection
