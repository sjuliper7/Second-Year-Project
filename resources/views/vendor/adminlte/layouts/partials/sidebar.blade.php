  <!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">

    <!-- Sidebar user panel (optional) -->


    <!-- Sidebar Menu -->
    <ul class="sidebar-menu">
      @if(Auth::user()->role =="DinasPariwisata")
      <!-- Optionally, you can add icons to the links -->

      <li class="treeview "><a href="#"><i class='fa fa-list'></i> <span> Daftar Request  </span> </a>
        <ul class="treeview-menu" style="display: none;">
          <li><a href="{{url('requestFasilitas')}}"><i class='fa fa-television'></i> <span>Acc Request Fasilitas</span></a></li>
        </ul>
      </li>
      <li class="treeview"><a href="#"><i class='fa fa-users'></i> <span> Pemilik Homestay </span></a>
        <ul class="treeview-menu" style="display : none;">
          <li><a href="{{url('admin/create')}}"><i class='fa fa-plus'></i> <span>Tambah Pemilik Homestay</span></a></li>
          <li><a href="{{url('listowner')}}"><i class='fa fa-list'></i> <span>Daftar Pemilik Homestay</span></a></li>
        </ul>
      </li>

      <li><a href="{{url('listPemesanan')}}"><i class='fa fa-check-square'></i> <span> Data Pemesanan</span></a></li>

      @elseif(Auth::user()->role=="Owner")
      <li class="treeview"><a href="#"><i class='fa fa-television'></i> <span> FASILITAS </span><span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span></a>
        <ul class="treeview-menu" style="display : none;">
          <li><a href="{{url('reqFasilitas')}}"><i class='fa fa-external-link-square'></i> <span>Tambah Permintaan Fasilitas</span></a></li>
          <li><a href="{{url('listPengajuanFasilitas')}}"><i class='fa fa-list'></i> <span>Daftar Pengajuan Fasilitas</span></a></li>
        </ul>
      </li>

      <li class="treeview"><a href="#"><i class='fa fa-bed'></i> <span> HOMESTAY </span><span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span></a>
        <ul class="treeview-menu" style="display : none;">
          <li><a href="{{url('daftarKamar')}}"><i class='fa fa-list'></i> <span>Daftar Kamar</span></a></li>
          <li><a href="{{url('listFeedback')}}"><i class='fa fa-list'></i> <span> Komentar Pelanggan </span></a></li>
          <li><a href="{{url('updateHomestay')}}"><i class='fa fa-edit'></i> <span>Perbaharui Homestay</span></a></li>
        </ul>
      </li>

      <li class="treeview"><a href="#"><i class='fa fa-inbox'></i> <span> PESANAN </span><span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span></a>
        <ul class="treeview-menu" style="display : none;">
          <li><a href="{{url('pesanan')}}"><i class='fa fa-list'></i> <span>Daftar Transaksi</span></a></li>
          <li><a href="{{url('daftarBooking')}}"><i class='fa fa-list'></i> <span>Daftar Pelanggan</span></a></li>
          <li><a href="{{url('AddBook')}}"><i class='fa fa-plus'></i> <span>Tambah Pesanan Manual</span></a></li>
        </ul>
      </li>
          <li><a href="{{url('record')}}"><i class='fa fa-plus'></i> <span>LAPORAN</span></a></li>
      @endif
    </ul><!-- /.sidebar-menu -->
  </section>
  <!-- /.sidebar -->
</aside>
