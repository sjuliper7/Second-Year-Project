@extends('adminlte::layouts.app')

@section('htmlheader_title')
    {{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')
<section class="content">
  <!-- Small boxes (Stat box) -->
  <div class="row">
<a href="/daftarKamar" class="small-box-footer">
    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-aqua">
        <div class="inner">
          <h3>{{$countK}}</h3>
          <p>Jumlah Kamar <i class="fa fa-arrow-circle-right"></i></p>
        </div>
        <div class="icon">
          <i class="fa fa-bed"></i>
        </div>
      </div>
    </div>
  </a>


    <!-- ./col -->
    <a href="/pesanan" class="small-box-footer">
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-green">
        <div class="inner">
          <h3>{{$countB}}</h3>
          <p>Pemesanan baru <i class="fa fa-arrow-circle-right"></i></p>
        </div>
        <div class="icon">
          <i class="fa fa-list"></i>
        </div>
      </div>
    </div>
    </a>


    <!-- ./col -->
    <a href="/listFeedback" class="small-box-footer">
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-yellow">
        <div class="inner">
          <h3>{{$countF}}</h3>
          <p>Feedback <i class="fa fa-arrow-circle-right"></i></p>
        </div>
        <div class="icon">
          <i class="fa fa-edit"></i>
        </div>
      </div>
    </div>
</a>

    <a href="/listPengajuanFasilitas" class="small-box-footer">
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
          <div class="inner">
            <h3>{{$countHas}}</h3>
            <p>Request Fasilitas Notif <i class="fa fa-arrow-circle-right"></i></p>
          </div>
          <div class="icon">
            <i class="fa fa-edit"></i>
          </div>
        </div>
      </div>
    </a>


  </div>


  <!-- /.row (main row) -->

</section>
@endsection
