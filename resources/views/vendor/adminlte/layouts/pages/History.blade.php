@extends('adminlte::layouts.master')

@section('main-content')
<div class="cuisines agileits w3layouts" style="padding-top: 50px; margin-top: 80px; margin-bottom: 100px;">
	<div class="container">
		<table class="table  table-striped">
			<thead>
				<tr>
					<th> No. </th>
					<th> No. Rekening </th>
					<th> Atas Nama </th>
					<th> Total Pembayaran </th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>1</td>
					<td>456141923</td>
					<td>Palti Sinaga</td>
					<td>2.400.000</td>
				</tr>
				<tr class="success">
					<td>2</td>
					<td>09179287213</td>
					<td>Lestari Siregar</td>
					<td>2.123.091</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
@endsection
