@extends('adminlte::layouts.master')

@section('main-content')
<div class="cuisines agileits w3layouts" style="padding-top: 50px; margin-top: 80px; margin-bottom: 100px;">
	<div class="container">
		<table class="table  table-striped">
			<thead>
				<tr>
					<th> No. Rekening </th>
					<th> Nama Pemilik Homestay </th>
					<th> Total Pembayaran </th>
					<th> Tanggal Mulai </th>
					<th> Tanggal Berakhir </th>
					<th> Bukti Pembayaran </th>
					<th> Status Pemesanan</th>
					<th></th>
					<th></th>
					<th colspan="2">Rincian Pemesanan</th>
				</tr>
			</thead>
			<tbody>
				@foreach($data as $a)
					<tr>
						<td>{{$a->no_rekening}}</td>
						<td>{{$a->nama}}</td>
						<td>Rp {{number_format($a->total_pembayaran)}}</td>
						<td>{{$a->tanggal_mulai}}</td>
						<td>{{$a->tanggal_berakhir}}</td>
						<td>
							@if($a->bukti_pembayaran==null)
								Belum ada bukti transfer
							@else
								<!-- <img alt="User Pic" src="{{ url('/img/'.$a	->bukti_pembayaran) }}" class="img-responsive" > -->
								<a href="/img/{{ $a->bukti_pembayaran }}" alt="Bukti Pembayaran"
									data-lightbox="roadtrip"><img src="/img/{{ $a->bukti_pembayaran }}" style="max-height: 100px;
    							width: auto;">
								</a>
							@endif
						</td>
						<td>
							@if($a->status==0)	<span class="label label-warning"> Belum Dikonfirmasi </span>
								<td>
									<a href="{{url('buktipembayaran/'.$a->id)}}" class="btn btn-primary">Upload Bukti</a>
								</td>
							@elseif($a->status==1)
								<td colspan="3"><span class="label label-success"> Diterima </span></td>

							@elseif($a->status==2)
								<td colspan="3"><span class="label label-danger"> Ditolak </span> </td>
							@endif
						</td>
						<td>
								@if($a->status==1)
								<a href="{{url('rincianHistory/'.$a->id)}}" class="btn btn-primary"><i class="glyphicon glyphicon-eye-open"></i> </a>
								@endif
						</td>
					</tr>

				@endforeach
			</tbody>
		</table>
	</div>
</div>


<script src="{{asset('js/jquery-ui.js')}}"></script>

@endsection
