@extends('adminlte::layouts.app')

@section('htmlheader_title')
{{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')
<div class="box box-warning">
  <div class="box-header with-border">
    <h3 class="box-title"> LIST PERMINTAAN FASILITAS </h3>
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
        <th>Pengaju</th>
        <th>Nama Request Fasilitas</th>
        <th>Gambar</th>
        <th>Status</th>
        <th>Lihat</th>
      </tr>
      </thead>
      <tbody>
      @foreach($data as $a)
      <tr>
        <td>{{$a->nama}}</td>
        <td>{{$a->nama_request_fasilitas}}</td>
        <td>@if($a->gambar==null)
            Tidak ada gambar
            @else
                  <a href="img/{{$a->gambar}}" alt="Bukti Pembayaran" data-lightbox="roadtrip"><img src="img/{{$a->gambar}}" style="width: 250px;height: 120px"></a>
            @endif
        </td>
        <td>
          @if($a->status == 0)  Sedang Menunggu
          @elseif($a->status == 1)  Diterima
          @elseif($a->status == 2)  Ditolak
          @endif
        </td>
        <td>
          <a href="{{url('detailreqFasilitas/'.$a->id)}}" class="btn btn-primary"><i class="fa fa-eye"></i> </a></td>
        </td>
        </tr>
        @endforeach
      </tbody>
      </table>
        {!! $data->render() !!}
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
