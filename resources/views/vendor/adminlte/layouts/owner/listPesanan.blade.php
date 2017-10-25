@extends('adminlte::layouts.app')

@section('htmlheader_title')
{{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')

<div class="box box-warning">
  <div class="box-header with-border">
    <h3 class="box-title">DAFTAR PESANAN BARU</h3>
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
  </div>

  <div class="box-body">
    <div class="col-md-4 col-sm-6 col-xs-12">

      <!-- /.info-box -->
    </div>

    <table id="example2" class="table table-bordered table-hover">
      <thead>
      <tr>
        <th>Nama Pelanggan</th>
        <th>Tanggal Check-in</th>
        <th>Tanggal Check-out</th>
        <th>Bukti Pembayaran</th>
        <th>Download Bukti Pembayaran</th>
        <th style="position: center;">Status</th>
        <th>Lihat Detail</th>
      </tr>
      </thead>
      <tbody>
      @foreach($data as $a)
      <tr>
        <td>{{$a->nama}}</td>
        <td>{{$a->tanggal_mulai}}</td>
        <td>{{$a->tanggal_berakhir}}</td>
        <td>
          @if($a->bukti_pembayaran==null)
          Bukti pembayaran tidak ada
          @else
            <a href="/img/{{ $a->bukti_pembayaran }}" alt="Bukti Pembayaran" data-lightbox="roadtrip"><img src="/img/{{ $a->bukti_pembayaran }}" style="max-height: 150px; width:200px;"></a>
          @endif
        </td>

        <td>
          @if($a->bukti_pembayaran==null)
          Bukti pembayaran tidak ada
          @else
            <!-- <a id="download" href="/img/{{ $a->bukti_pembayaran }}" download="/img/{{ $a->bukti_pembayaran }}">Download</a> -->
            <a id="download" href="/img/{{ $a->bukti_pembayaran }}" download="/img/{{ $a->bukti_pembayaran }}" class="btn btn-danger"><i class="fa fa-download"></i>Download Bukti</a>
          @endif
        </td>
        <td>
          @if($a->status==0)
            Menunggu Konfirmasi
            @elseif($a->status==1) Diterima
            @elseif($a->status==2)  Ditolak
            @endif
          </td>
        <td>

          <a href="{{url('detailpesanan/'.$a->id)}}" class="btn btn-primary"><i class="fa fa-eye"></i> </a>

        </td>
        </td>
        </tr>
        @endforeach
      </tbody>
      </table>
        {!! $data->render() !!}
</div>
</div>


  <script type="text/javascript">
    document.getElementById("download").setAttribute("download", "bukti pembayarans.jpg")
  </script>

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
