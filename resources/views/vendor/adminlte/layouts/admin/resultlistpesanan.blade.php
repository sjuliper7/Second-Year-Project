@extends('adminlte::layouts.app')

@section('htmlheader_title')
{{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')
<div class="box box-warning">
  <div class="box-header with-border">

    <h3 class="box-title"> DATA PEMESANAN </h3>

    <form action="{{url('caripesanan')}}">
      <div class="form-group" align="left">
        <label>Bulan</label>
        <input type="number" min="1" max="12" name="bulan">
        <label>Tahun</label>
        <input type="number" min="1" max="12" name="bulan">
        <label>Nama Homestay</label>
        <!-- <input type="text" name="nama_homestay"> -->
        <select class="" name="nama_homestay">
          @foreach($homestay as $h)
            <option value="{{$h->nama_homestay}}">{{$h->nama_homestay}}</option>
          @endforeach
        </select>
        <input type="submit" class="btn btn-warning"  value="Cari" >
      </div>

    </form>
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
    <!-- <form action="{{url('caripesanan')}}">
      <div class="form-group" align="right">
        <input type="submit" class="btn btn-warning" value="Print">
      </div>
    </form> -->

      <table id="example2" class="table table-bordered table-hover">
      <thead>
        <tr>
        <th>Nama Homestay</th>
        <th>Nama Pemilik Homestay</th>
        <th>Nama Pemesan</th>
        <th>Tanggal Mulai</th>
        <th>Tanggal Berakhir</th>
        <th>Jumlah Kamar yang dipesan</th>
        <th>Total Harga</th>
        </tr>
        </thead>
          <tbody>
        @foreach($data as $a)
      <tr>
        <td>{{$a->nama_homestay}}</td>
        <td>{{$a->owner}}</td>
        <td>{{$a->nama_pemesan}}</td>
        <td>{{$a->tanggal_mulai}}</td>
        <td>{{$a->tanggal_berakhir}}</td>
        <td>{{$a->jumlah_kamar}}</td>
        <td>{{$a->total_harga}}</td>
      </tr>
      @endforeach
        </tbody>
        <tbody>
        @foreach($data2 as $c)
          <tr>
            <td>{{$c->nama_homestay}}</td>
            <td>{{$c->owner}}</td>
            <td>{{$c->nama_pemesan}}</td>
            <td>{{$c->tanggal_mulai}}</td>
            <td>{{$c->tanggal_berakhir}}</td>
            <td>{{$c->jumlah_kamar}}</td>
            <td>{{$c->total_harga}}</td>
          </tr>
        @endforeach
        </tbody>
        <tr>
          <td>Total</td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td>{{$penghasilan}}</td>
        </tr>

    </table>


  </div>
</div>

<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
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
