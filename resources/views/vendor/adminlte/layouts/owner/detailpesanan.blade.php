@extends('adminlte::layouts.app')

@section('htmlheader_title')
{{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')
<div class="box box-info">
  <div class="box-header with-border">
    <h3 class="box-title"> DETAIL PEMESANAN  </h3>
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
  <div class="col-md-11 box-body">
    <table class="table table-user-information ">
      <tr>
        <th>Nama Pemesan</th>
        <td>: </td>
        <td>{{$data->nama}}</td>
      </tr>
      <tr>
        <th>No Telepon</th>
        <td>: </td>
        <td>{{$data->no_telepon}}</td>
      </tr>
      <tr>
        <th>Tanggal Check-in</th>
        <td>: </td>
        <td>{{$data->tanggal_mulai}}</td>
      </tr>
      <tr>
        <th>Lama Menginap</th>
        <td>: </td>
        <td>{{$data->lama_menginap}} malam </td>
      </tr>
      <tr>
        <th>Tanggal Check-out</th>
        <td>: </td>
        <td>{{$data->tanggal_mulai}}</td>
      </tr>
      <tr>
        <th>No Telepon</th>
        <td>: </td>
        <td>{{$data->no_telepon}}</td>
      </tr>
      <tr>
        <th>Bukti Pembayaran</th>
        <td>: </td>
        <td>
          @if($data->bukti_pembayaran==null)
            Bukti pembayaran tidak ada
          @else
            <a href="/img/{{ $data->bukti_pembayaran }}" alt="Bukti Pembayaran" data-lightbox="roadtrip"><img src="/img/{{ $data->bukti_pembayaran }}" style="max-height: 150px; width:200px;"></a>
          @endif
        </td>
      </tr>
      <tr>
        <th>Pesan</th>
        <td>:</td>
        <td><textarea class="form-control" placeholder="Pesan harap diisi"  id="pesan" style="height:200px;"  name="deskripsi"> </textarea></td>
      </tr>
      <tr>
        <th>Status</th>
        <td> : </td>
        <td> @if($data->status==0)
          <td>
            <form action="{{url('konfirmasiPemesanan/'.$data->id)}}" method="post">
              {{csrf_field()}}
              <input type="hidden" name="_method" value="PUT">
              <input type="hidden" name="konfirmasi" value="1">
              <button type="submit" class="btn btn-info"><i class="fa fa-check"> Terima</i></button>
            </form>
          </td>
        <td>
            {{--<form action="{{url('konfirmasiPemesanan/'.$data->id)}}" method="post">--}}
              {{--{{csrf_field()}}--}}
              {{--<input type="hidden" name="_method" value="PUT">--}}
              {{--<input type="hidden" name="konfirmasi" value="2">--}}
              {{--<button type="submit" class="btn btn-danger"><i class="glyphicon glyphicon-trash"> Tolak</i></button>--}}
            {{--</form>--}}
          <a class="btn btn-danger" onclick="cancelRequest()"> <i class="fa fa-close"></i>Tolak </a>
          </td>
        @elseif($data->status==1) Diterima
        @elseif($data->status==2)  Ditolak
          @endif
        </td>
      </tr>

    </table>
  </div>
  <div class="box-footer">
    <form action="{{url('pesanan/'.$data->id)}}" enctype="multipart/form-data">
      <div class="form-group" align="right">
        <input type="submit" class="btn btn-warning" value="Print">
      </div>
    </form>
  </div>
</div>


<script>
  function cancelRequest() {
    var check = confirm("Apakah anda yakin untuk menolak nya??");

    var fiedl = document.getElementById('pesan');

    if(fiedl.value == ' ' || fiedl.value == null || fiedl.value == '  '){
      alert('Pesan Harus di isi');
    }else {
      if(check) {
        $.ajax({
          data: {
            pesan : fiedl.value,
            requestID: '{{$data->id}}',
            _token: '{{ csrf_token() }}',
          },
          url: '{{ url('batalkan') }}',
          type: 'POST',
          success: function (data) {
            window.location.reload(true);
          }
        });
      }
    }

  }
</script>

@endsection
