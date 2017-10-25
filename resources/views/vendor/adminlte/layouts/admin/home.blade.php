@extends('adminlte::layouts.app')

@section('htmlheader_title')
    {{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')
<section class="content">
  <!-- Small boxes (Stat box) -->
  <div class="row">

    <a href="/listowner" class="small-box-footer">
    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-aqua">
        <div class="inner">
          <h3>{{$count}}</h3><br><br>
          <p>Data Pemilik Homestay <i class="fa fa-arrow-circle-right"></i></p>
        </div>
        <div class="icon">
          <i class="fa fa-users"></i>
        </div>
      </div>
    </div>
    </a>

    <a href="/listhomestay" class="small-box-footer">
    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-green">
        <div class="inner">
          <h3>{{$countH}}</h3><br><br>
          <p>Data Homestay <i class="fa fa-arrow-circle-right"></i></p>
        </div>
        <div class="icon">
          <i class="fa fa-home"></i>
        </div>
      </div>
    </div>
    </a>


    <a href="/requestFasilitas" class="small-box-footer">
    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-yellow">
        <div class="inner">
          <h3>{{$countF}}</h3><br><br>
          <p>Permintaan Fasilitas <i class="fa fa-arrow-circle-right"></i></p>
        </div>
        <div class="icon">
          <i class="fa fa-cubes"></i>
        </div>
      </div>
    </div>
    </a>


    <a href="/listPemesanan" class="small-box-footer">
    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-red">
        <div class="inner">
          <h3>{{$countPesan}}</h3><br><br>
          <p>Data Pemesanan <i class="fa fa-arrow-circle-right"></i></p>
        </div>
        <div class="icon">
          <i class="fa fa-mail-reply"></i>
        </div>
      </div>
    </div>
    </a>

    <a href="/Allfeedback" class="small-box-footer">
    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-blue">
        <div class="inner">
          <h4>Feedback</h4><br><br>
          <p>Feedback Pengunjung <i class="fa fa-arrow-circle-right"></i></p>
        </div>
        <div class="icon">
          <i class="fa fa-comment"></i>
        </div>
        <!-- <a href="/Allfeedback" class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a> -->
      </div>
    </div>
    </a>

  </div>


  <!-- /.row (main row) -->

</section>
@endsection
