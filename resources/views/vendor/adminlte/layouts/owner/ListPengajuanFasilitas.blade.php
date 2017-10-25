@extends('adminlte::layouts.app')

@section('htmlheader_title')
{{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')
<div class="box box-warning">
  <div class="box-header with-border">
    <h3 class="box-title"> DAFTAR PENGAJUAN FASILITAS </h3>
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
    <!-- <div class="col-md-4 col-sm-6 col-xs-12">
    </div> -->

    <table id="example2" class="table table-bordered table-hover">
      <thead>
      <tr>
        <th>Judul</th>
        <th >Keterangan</th>
        <th>Gambar</th>
        <th>Status</th>
        <th>Alasan</th>
        <th></th>
      </tr>
      </thead>
      <tbody>
      @foreach($data as $a)
      <tr>
        <td>{{$a->nama_request_fasilitas}}</td>
        <td style="max-width:200px;">{{$a->deskripsi}}</td>
        <td>
          @if($a->gambar==null)
          Tidak ada gambar
          @else

          <a href="img/{{$a->gambar}}" alt="Bukti Pembayaran" data-lightbox="roadtrip"><img src="img/{{$a->gambar}}" style="width: 250px;height: 120px"></a>
          @endif
        </td>
        <td>@if($a->status==0)  Sedang Menunggu
          @elseif($a->status==1)  Diterima
          @elseif($a->status==2)  Ditolak
          @endif
        </td>
        <td>
          {{$a->pesan}}
        </td>
        <td>
          @if($a->notif==1)
            <form action="{{url('asread/'.$a->id)}}" method="post">
              {{csrf_field()}}
              <input type="hidden" name="_method" value="PUT">
              <button type="submit" class="btn btn-info"><i class="fa fa-check"> Sudah Dibaca</i></button>

            </form>
          @elseif($a->notif == 2) Sudah Dibaca
          @endif
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
