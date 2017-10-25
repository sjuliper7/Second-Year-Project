@extends('adminlte::layouts.app')

@section('htmlheader_title')
    {{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title"> Laporan  </h3>
  </div>

  <div class="box-body">
    <form action="{{url('report')}}">
        <label>Bulan</label>
        <input type="number" min="1" onchange="updateVal(this)" max="12" name="bulan" required>
        <label>Tahun</label>
        <input type="number" min="2010" onchange="updateVal(this)" name="tahun" required>
        <input type="submit" value="Cari" class="btn-btn info">
    </form>

      {{--<a class="btn btn-warning" onclick="cancelRequest()"> <i class="fa fa-print"></i> Print </a>--}}

    <form action="{{url('printReportOwner')}}" enctype="multipart/form-data" style="float:right;">
      <div class="form-group" align="right">
        <input type="number" hidden value="{{Request::segment(2)}}" min="1" max="12" name="bulan" display="none" required >
          <input type="number" hidden value="{{Request::segment(3)}}" min="2010" name="tahun" display="none" required >
        <input type="submit" class="btn btn-warning" value="Print">
      </div>
    </form>



    @if($data==null)
    <H2>Data Tidak Ada</H2>
    @else

          <table id="example2" class="table table-bordered table-hover">
            <thead>
            <tr>
                <th></th>
                <th>Nama Pemesan</th>
                <th>Jumlah Kamar</th>
                <th>Jumlah Tamu</th>
                <th>Lama Menginap</th>
                <th>Extrabed</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Berakhir</th>
                <th>Total Harga</th>
            </tr>
            </thead>
              <tbody>
            @foreach($data as $a)
                <tr>
                    <td></td>
                    <td>{{$a->nama_pemesan}}</td>
                    <td>{{$a->jumlah_kamar}}</td>
                    <td>{{$a->jumlah_tamu}}</td>
                    <td>{{$a->lama_menginap}}</td>
                    <td>{{$a->extrabed}}</td>
                    <td>{{$a->tanggal_mulai}}</td>
                    <td>{{$a->tanggal_berakhir}}</td>
                    <td><Rp></Rp> {{number_format($a->total_harga,0)}}</td>
                </tr>
            @endforeach
              </tbody>
            <tr>
                <td>Total</td>
                <td></td>
                <td></td>
                <td>{{$jumlahTamu}}</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>Rp {{number_format($penghasilan)}}</td>
            </tr>
        </table>
    @endif
  </div>
</div>

{{--<script>--}}
    {{--function updateVal(object) {--}}

        {{--var field = document.getElementById('print');--}}
        {{--field.value = parseInt(object.value);--}}

    {{--}--}}
{{--</script>--}}

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

<script>
    function cancelRequest() {
                $.ajax({
                    data: {
                        bulan: '{{ Request::segment(2) }}',
                        _token: '{{ csrf_token() }}',
                    },
                    url: '{{ url('printreport') }}',
                    type: 'POST',

                });
    }
</script>

@endsection
