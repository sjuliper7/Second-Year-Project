@extends('adminlte::layouts.master')

@section('main-content')
<div class="cuisines agileits w3layouts" style="padding-top: 50px; margin-top: 80px; margin-bottom: 100px;">
	<div class="container">
    <div class="col-md-5 col-sm-5  cuisines-grids agileits w3layouts" style="background-color: #f9f9f9;padding: 40px;border-radius: 9px;">
      <h3>Rincian Pemesanan Homestay</h3>
        <table class="table-condensed" style="font-size: 16px; margin-left: -3px; color: #777; margin-top:5px;">
          <tr>
            <td>Nama </td>
            <td>:</td>
            <td>{{$data->nama}} Malam</td>
          </tr>
          <tr>
            <td>Nama Homestay</td>
            <td>:</td>
            <td>{{$data->nama_homestay}}</td>
          </tr>
          <tr>
            <td>Tanggal Check-in</td>
            <td>:</td>
            <td>{{$data->tanggal_mulai}}</td>
          </tr>
          <tr>
            <td>Durasi</td>
            <td>:</td>
            <td>{{$data->lama_menginap}} Malam</td>
          </tr>
          <tr>
            <td>Tanggal Check-out</td>
            <td>:</td>
            <td>{{$data->tanggal_berakhir}}</td>
          </tr>
          <tr>
            <td>Total Pembayaran</td>
            <td>:</td>
            <td>Rp {{number_format($data->total_pembayaran)}}</td>
          </tr>
<tr>
  <td>  <a href="{{url('rincianHistoryPrint/'.$data->id)}}" class="btn btn-warning"><i class="glyphicon glyphicon-print"></i> print </a></td>
</tr>
        </table>
	</div>
    <div class="col-md-5 col-sm-5  cuisines-grids agileits w3layouts" style="padding: 40px;border-radius: 9px;">
      <h3>Bukti Pembayaran</h3><br>
      <a href="/img/{{ $data->bukti_pembayaran }}" alt="Bukti Pembayaran"
        data-lightbox="roadtrip"><img src="/img/{{ $data->bukti_pembayaran }}" style="max-height: 250px;
        width: auto;">
      </a>
      @if($data->status==1)



      @endif
    </div>
</div>
</div>


<script src="{{asset('js/jquery-ui.js')}}"></script>

@endsection
