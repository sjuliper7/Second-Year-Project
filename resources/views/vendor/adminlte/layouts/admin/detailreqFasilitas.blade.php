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



  <div class="col-md-10 box-body">
      @include('adminlte::layouts.pages.confirmdelete')
    <table class="table table-user-information ">
      <tr>
        <th>Nama Pengaju</th>
        <td>: </td>
        <td>{{$data->nama}}</td>
      </tr>
      <tr>
        <th>Judul Request</th>
        <td>: </td>
        <td>{{$data->nama_request_fasilitas}}</td>
      </tr>
      <tr>
        <th>Keterangan</th>
        <td>: </td>
        <td>{{$data->deskripsi}}</td>
      </tr>
      <tr>
        <th>Status</th>
        <td>: </td>
        <td>
            @if($data->status==1)
            <span class="label label-success">Di Terima </span>

            @elseif($data->status==2)
              <span class="label label-danger">Ditolak </span>
            @endif
        </td>
      </tr>
      <tr>
        <th>Gambar</th>
        <td>: </td>
        <td>  <a href="/img/{{$data->gambar}}" alt="Bukti Pembayaran" data-lightbox="roadtrip"><img src="/img/{{$data->gambar}}" style="max-height:200px;"></a></td>
      </tr>

      <tr>
        <th>Kirim Pesan </th>
        <td>: </td>
        <td>  <form class="" action="index.html" method="post">
          <div class="form-group">
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-newspaper-o"></i>
              </div>
              <textarea class="form-control" placeholder="Deskripsi"  id="pesan" style="height:200px;"  name="deskripsi"> </textarea>
            </div>
            <span id="errfn2" style="color: red"></span>
          </div>
        </form>
      </tr>
      <tr>@if($data->status==1)
      @elseif($data->status==2)
      @elseif($data->status==0)
        <th>Aksi</th>
        <td> </td>


          <td>
            <form action="{{url('requestFasilitas/'.$data->id)}}" method="post">
              {{csrf_field()}}
              <input type="hidden" name="_method" value="PUT">
              <button type="submit" class="btn btn-info"><i class="fa fa-check"> Terima</i></button>

            </form>
            </td>
            <td>
                  <!--  -->
            {{--<form action="{{url('requestFasilitass/'.$data->id)}}" method="post" style="display:inline">--}}
              {{--{{csrf_field()}}--}}
              {{--<input type="hidden" name="_method" value="PUT">--}}
              {{--<button type="submit" class="btn btn-danger" >--}}
                {{--<i class="fa fa-close" > Tolak</i>--}}
              {{--</button>--}}
            {{--</form>--}}

              <a class="btn btn-danger" onclick="cancelRequest()"> <i class="fa fa-close"></i>Tolak </a>

          </td>
            @endif
      </tr>
    </table><br>
  </div>

  <div class="box-footer">
    <form action="{{url('printFasilitas/'.$data->id)}}" enctype="multipart/form-data">
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
          url: '{{ url('/cancelrequest') }}',
          type: 'POST',
          success: function (data) {
            window.location.reload(true);
          }
        });
      }
    }

  }
</script>


<div id="form" class="modal fade" role="dialog">
  <div class="modal-dialog" id="form">

    <!-- Modal content-->
    <div class="modal-content" >
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">User Information</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" role="form" action="/manage_accounts/{{ $user->id }}" novalidate>
          <input type="hidden" name="_method" value="PUT">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="form-group">
            <label class="control-label col-sm-3" for="name">Username:</label>
            <div class="col-sm-5 @if ($errors->has('name')) has-error @endif">
              <input type="text" class="form-control" type="hidden" id="name" name="name" placeholder="Enter username">
              @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

  <script>
    $('#myModal').on('shown.bs.modal', function () {
      $('#myInput').focus()
    })
  </script>

@endsection
