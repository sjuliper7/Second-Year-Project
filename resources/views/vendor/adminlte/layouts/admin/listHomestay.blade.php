@extends('adminlte::layouts.app')

@section('htmlheader_title')
{{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')
<div class="box box-warning">
  <div class="box-header with-border">
    <h3 class="box-title"> DAFTAR HOMESTAY </h3>
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
        <table id="example2" class="table table-bordered table-hover">
          <thead>
          <tr>
            <th>Nama Homestay</th>
            <th>Alamat</th>
            <th>Jumlah Kamar</th>
            <th>Nama Pemilik</th>

          </tr>
          </thead>
          <tbody>
            @foreach($data as $a)
            <tr>
              <td>{{$a->nama_homestay }}</td>
              <td>{{$a->alamat}}</td>
              <td>{{$a->jumlah_kamar}}</td>
              <td>{{$a->owner}}</td>
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

@endsection
