<?php

namespace App\Http\Controllers;

use App\Homestay;
use App\ListBook;
use App\RequestFasilitas;
use App\RequestHomestay;
use App\Room;
use App\Transaksi;
use Illuminate\Http\Request;
use App\User;
use App\Owner;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use PDF;

class OwnerController extends Controller
{


    public function __construct(){
        $this->middleware('auth');
        $this->middleware('owner');
    }

    public function batalkan(Request $request){

        //dd('masuk');
        $data = Transaksi::find($request['requestID']);

        DB::table('daftar_book')->where('tanggal_mulai', '=', $data->tanggal_mulai)->delete();

        $data->pesan = $request['pesan'];

        $data->status = 2;

        $data->update();


    }

    public function Report(Request $request){

        //dd('masuk',$request['tahun']);

        if($request['tahun']==null){
            return redirect()->action('OwnerController@dfindReport', ['id' => $request['bulan']]);
        }else{
            return redirect()->action('OwnerController@findReport',['id' => $request['bulan'] , 'tahun' => $request['tahun']]);
        }

        //return redirect()->action('OwnerController@findReport', ['id' => $request['bulan']]);
        //return redirect('report/{id}',$request['bulan']);
        //dd($dataHomestay,$request['bulan'],$dataPesanan,$penghasilan);
    }


    public function findReport($id,$tahun){
        //dd('masuk');
        $dataHomestay = DB::table('homestay')
            ->join('pemilikhomestay','homestay.id_pemilik','=','pemilikhomestay.id')
            ->where('pemilikhomestay.id_akun','=',Auth::user()->id)
            ->select('homestay.id')
            ->get();

        $dataPesanan = DB::table('daftar_book')
            ->where('daftar_book.homestay','=',$dataHomestay[0]->id)
            ->whereMonth('daftar_book.tanggal_mulai','=',$id)
            ->whereYear('daftar_book.tanggal_mulai', $tahun)
            ->get();

        $penghasilan = 0;
        $jumlah_tamu = 0;
        foreach ($dataPesanan as $a){
            $penghasilan += $a->total_harga;
            $jumlah_tamu += $a->jumlah_tamu;
        }

        return view('adminlte::layouts.owner.Report')->with('data',$dataPesanan)->with('penghasilan',$penghasilan)->with('jumlahTamu',$jumlah_tamu);

    }


    public function printReport(Request $request){

        dd('masuk',$request['bulan']);

        $dataHomestay = DB::table('homestay')
            ->join('pemilikhomestay','homestay.id_pemilik','=','pemilikhomestay.id')
            ->where('pemilikhomestay.id_akun','=',Auth::user()->id)
            ->select('homestay.id','homestay.nama_homestay')
            ->get();

        $dataPesanan = DB::table('daftar_book')
            ->where('daftar_book.homestay','=',$dataHomestay[0]->id)
            ->whereMonth('daftar_book.tanggal_mulai','=',$request['bulan'])
            ->get();

        $penghasilan = 0;
        $jumlah_tamu = 0;
        foreach ($dataPesanan as $a){
            $penghasilan += $a->total_harga;
            $jumlah_tamu += $a->jumlah_tamu;
        }


        $pdf = PDF::loadView('pdf.reportOwner',['data' => $dataPesanan],['tamu'=>$jumlah_tamu,'penghasilan'=>$penghasilan,'bulan'=>$request['bulan'],'namaHomestay'=>$dataHomestay[0]->nama_homestay]);
        $pdf->stream('reportOwner.pdf');
    }

    public function dfindReport($id){
        //dd('disini aja');
        $dataHomestay = DB::table('homestay')
            ->join('pemilikhomestay','homestay.id_pemilik','=','pemilikhomestay.id')
            ->where('pemilikhomestay.id_akun','=',Auth::user()->id)
            ->select('homestay.id')
            ->get();

        $dataPesanan = DB::table('daftar_book')
            ->where('daftar_book.homestay','=',$dataHomestay[0]->id)
            ->whereMonth('daftar_book.tanggal_mulai','=',$id)
            ->get();

        $penghasilan = 0;
        $jumlah_tamu = 0;
        foreach ($dataPesanan as $a){
            $penghasilan += $a->total_harga;
            $jumlah_tamu += $a->jumlah_tamu;
        }

        return view('adminlte::layouts.owner.Report')->with('data',$dataPesanan)->with('penghasilan',$penghasilan)->with('jumlahTamu',$jumlah_tamu);

    }

    public function printReportOwner(Request $request){

        //$//path = window.location.pathname;

        //dd($request['bulan'],$request['tahun']);

      $dataHomestay = DB::table('homestay')
                      ->join('pemilikhomestay','homestay.id_pemilik','=','pemilikhomestay.id')
                      ->where('pemilikhomestay.id_akun','=',Auth::user()->id)
                      ->select('homestay.id','homestay.nama_homestay')
                      ->get();
//dd($dataHomestay[0]->nama_homestay);

      if($request['tahun'==null]){
          $dataPesanan = DB::table('daftar_book')
              ->where('daftar_book.homestay','=',$dataHomestay[0]->id)
              ->whereMonth('daftar_book.tanggal_mulai','=',$request['bulan'])
              ->get();
      }else{
          $dataPesanan = DB::table('daftar_book')
              ->where('daftar_book.homestay','=',$dataHomestay[0]->id)
              ->whereMonth('daftar_book.tanggal_mulai','=',$request['bulan'])
              ->whereYear('daftar_book.tanggal_mulai','=',$request['bulan'])
              ->get();
      }


      $penghasilan = 0;
      $jumlah_tamu = 0;
      foreach ($dataPesanan as $a){
          $penghasilan += $a->total_harga;
          $jumlah_tamu += $a->jumlah_tamu;
      }

      //dd($jumlah_tamu);

      $pdf = PDF::loadView('pdf.reportOwner',['data' => $dataPesanan],['tamu'=>$jumlah_tamu,'penghasilan'=>$penghasilan,'bulan'=>$request['bulan'],'namaHomestay'=>$dataHomestay[0]->nama_homestay]);
      return $pdf->stream('reportOwner.pdf');

    }



    public function Record(){

        $homestay = Homestay::all();

        $data = null;
        return view('adminlte::layouts.owner.Report')->with('data',$data)->with('homestay',$homestay);
    }



    public function Asread(Request $request,$id){
        $req = RequestFasilitas::find($id);
        $req->notif = 2;
        $req->update();

        return redirect('listPengajuanFasilitas');
    }

    public function pesanan($id){
      $dataTrans = DB::table('transaksi')
          ->join('pelanggan','transaksi.id_pelanggan','=','pelanggan.id')
          ->join('homestay','transaksi.id_homestay','=','homestay.id')
          ->select('transaksi.*','pelanggan.nama','pelanggan.no_telepon','homestay.nama_homestay','homestay.alamat')
          ->where('transaksi.id','=',$id)
          ->get();

          $pdf = PDF::loadView('pdf.detailpesanan',['data' => $dataTrans[0]]);
          return $pdf->stream('detailpesanan.pdf');
    }

    public function detailpesanan($id){

      //dd($id);

      $dataTrans = DB::table('transaksi')
          ->join('pelanggan','transaksi.id_pelanggan','=','pelanggan.id')
          ->select('transaksi.status','transaksi.total_pembayaran','transaksi.bukti_pembayaran','transaksi.tanggal_mulai','transaksi.id','transaksi.tanggal_berakhir','transaksi.jumlah_kamar','transaksi.lama_menginap','pelanggan.nama','pelanggan.no_telepon')
          ->where('transaksi.id','=',$id)
          ->get();

    //dd($dataTrans);
      return view('adminlte::layouts.owner.detailpesanan')->with('data',$dataTrans[0]);
    }


    public function index()
    {
      $dataPemilik = DB::table('pemilikhomestay')
          ->select('pemilikhomestay.id')
          ->where('pemilikhomestay.id_akun','=',Auth::user()->id)
          ->get();


      $dataHomestay = DB::table('homestay')
                      ->join('pemilikhomestay','homestay.id_pemilik','pemilikhomestay.id')
                      ->select('homestay.id')
                      ->where('pemilikhomestay.id','=',$dataPemilik[0]->id)
                      ->get();

      $dataListOfBook = DB::table('daftar_book')
                        ->join('transaksi','daftar_book.id_transaksi','=','transaksi.id')
                        ->select('daftar_book.*')
                        ->where('transaksi.status','=',0)
                        ->where('daftar_book.homestay','=',$dataHomestay[0]->id)
                        ->get();

      $dataFeedback = DB::table('feedback')
                      ->join('pelanggan','feedback.id_pelanggan','pelanggan.id')
                      ->select('feedback.*','pelanggan.nama')
                      ->where('feedback.id_pemilik_homestay','=',$dataPemilik[0]->id)
                      ->get();

       $HasdataRequest = DB::table('requestfasilitas')
                        ->where('requestfasilitas.notif','=',1)
                        //->where()
                        ->get();

        //dd($HasdataRequest);

      $datakamar = DB::table('homestay')
              ->join('pemilikhomestay','homestay.id_pemilik','pemilikhomestay.id')
              ->join('kamar','homestay.id','=','kamar.id_homestay')
              ->select('kamar.*')
              ->where('pemilikhomestay.id','=',$dataPemilik[0]->id)
              ->get();





          return view('adminlte::layouts.owner.home')->with('dataF',$dataFeedback)->with('countF',$dataFeedback->count())->with('dataB',$dataListOfBook)->with('countB',$dataListOfBook->count())->with('dataK',$datakamar)->with('countK',$datakamar->count())->with('countHas',$HasdataRequest->count());
      //  return view('adminlte::layouts.owner.listPesanan')->with('count',$data->count())->with('count1',$dataListOfBook->count())->with('count2',$dataFeedback->count())->with('dataF',$dataFeedback);
    }

    public function Checkout($id){
        $dataPesanan = ListBook::find($id);

        $dataPesanan->status = 0;

        $dataPesanan->update();

        return redirect('daftarBooking');

    }


    //Menyimpan Data untuk di update
    public function updateProfil(Request $request,$id){
        $owner = Owner::where('id',$id)->first();
        $user = User::where('name',$owner->nama)->first();
        //dd($owner->id_akun);
        if($request['nama']==""){
            $user->name = $owner->nama;
        }else{
            $user->name = $request['nama'];
        }

        $owner->nama = $request['nama'];
        $owner->alamat = $request['alamat'];
        $owner->pekerjaan = $request['pekerjaan'];
        $owner->no_telepon = $request['noTelepon'];
        $owner->no_rekening = $request['noRekening'];

        if($request->file('picture')==null){
            $owner->foto = $owner->foto;
            $user->foto = $user->foto;
        }else{
            $file = $request->file('picture');
            $fileName = $file->getClientOriginalName();
            $request->file('picture')->move("img/",$fileName);
            $owner->foto = $fileName;
            $user->foto = $fileName;
        }

        $user->update();
        $owner->update();

        return redirect('profile');
    }


    //Mengakses Halaman untuk Melakukan edit Profile
    public function profileEdit($id){
        $data = Owner::find($id);

        return view('adminlte::layouts.owner.updateProfil')->with('data',$data);
    }


    //Mengakses Halaman profile
    public function profile(){

        $users = User::find(Auth::user()->id);
        $data = DB::table('pemilikhomestay')->where('nama', $users->name)->first();

        return view('adminlte::layouts.owner.profil')->with('data',$data);
    }


    //Mengakses Halaman daftar Feedback
    public function feddback(){
        $dataPemilik = DB::table('pemilikhomestay')
            ->select('pemilikhomestay.id')
            ->where('pemilikhomestay.id_akun','=',Auth::user()->id)
            ->get();

        $dataFeedback = DB::table('feedback')
                        ->join('pelanggan','feedback.id_pelanggan','pelanggan.id')
                        ->select('feedback.*','pelanggan.nama')
                        ->where('feedback.id_pemilik_homestay','=',$dataPemilik[0]->id)
                        ->paginate(5);

        return view('adminlte::layouts.owner.listfeedback')->with('data',$dataFeedback);
    }


    //Menyimpan Data Update Homestay
    public function updateHomestay(Request $request,$id){
        $this->validate($request,[
            'namaUpdate' => 'required|string',
            'alamatUpdate' => 'required|string',
            'hargaUpdate' => 'required|numeric',
        ],[
            'namaUpdate.required' => ' Nama Homestay Harus di isi',
            'alamatUpdate.required' => 'Alamat Harus Diisi',
            'hargaUpdate.required' => ' Harga Harus di isi',
            'hargaUpdate.numeric' => ' Harga Harus Berupa Angka',
        ]);


        $updateHomestay = Homestay::find($id);

        $updateHomestay->nama_homestay = $request['namaUpdate'];
        $updateHomestay->alamat = $request['alamatUpdate'];
        $updateHomestay->harga = $request['hargaUpdate'];



        if ($updateHomestay->fasilitas == null){
            $updateHomestay->fasilitas = $request['fasilitasUpdate'];
        }else{
            $updateHomestay->fasilitas = $request['fasilitasUpdate'];
        }

        if($request->file('gambar')==null){
            $updateHomestay->gambar = $updateHomestay->gambar;
        }else{
            $file = $request->file('gambar');
            $fileName = $file->getClientOriginalName();
            $request->file('gambar')->move("img/",$fileName);
            $updateHomestay->gambar = $fileName;
        }

        $updateHomestay->update();

        return redirect('updateHomestay');
    }


    //Mengakses Halaman Update Homestay
    public function update(){
        $dataPemilik = DB::table('pemilikhomestay')
                       ->select('pemilikhomestay.id')
                       ->where('pemilikhomestay.id_akun','=',Auth::user()->id)
                       ->get();

        $dataHomestay = DB::table('homestay')
                        ->select('homestay.*')
                        ->where('homestay.id_pemilik','=',$dataPemilik[0]->id)
                        ->get();
        //dd($dataHomestay[0]);
        return view('adminlte::layouts.owner.UpdateHomestay')->with('data',$dataHomestay[0]);
    }

    //Melakukan Konfirmasi Pemesanan
    public function konfirmasiPemesanan(Request $request,$id){

        $data = Transaksi::find($id);

        if($request['konfirmasi']==1){
            $data->status = $request['konfirmasi'];
        }else{
            DB::table('daftar_book')->where('tanggal_mulai', '=', $data->tanggal_mulai)->delete();

            $data->status=$request['konfirmasi'];
            $data->pesan = $request['pesan'];
        }

        $data->update();

        return redirect('pesanan');
    }

    //Mengakses Daftar Booking Homestay
    public function listOfBook(){

        $dataPemilik = DB::table('pemilikhomestay')
            ->select('pemilikhomestay.id')
            ->where('pemilikhomestay.id_akun','=',Auth::user()->id)
            ->get();


        $dataHomestay = DB::table('homestay')
                        ->join('pemilikhomestay','homestay.id_pemilik','pemilikhomestay.id')
                        ->select('homestay.id')
                        ->where('pemilikhomestay.id','=',$dataPemilik[0]->id)
                        ->get();

        //dd($dataHomestay);

        $dataListOfBook = DB::table('daftar_book')
                          ->select('daftar_book.*')
                          ->where('daftar_book.homestay','=',$dataHomestay[0]->id)
                          ->get();

       // dd($dataListOfBook);

        return view('adminlte::layouts.owner.ListBooking')->with('data',$dataListOfBook)->with('count',$dataListOfBook->count());
    }

    //Melakukan Penambahan Boking secara Manual
    public function addBookManual(Request $request){

        $lb = new ListBook();

        $this->validate($request,[
            'nama' => 'required|string',
            'jumlah_kamar' => 'required|numeric',
            'tanggal_mulai' => 'required',
            'lama_menginap' => 'required|numeric',

        ],[
            'nama.required' => 'Nama Harus di isi',
            'jumlah_kamar.required' => ' Jumlah Kamar Harus di isi',
            'jumlah_kamar.numeric' => ' Jumlah Bed harus berupa Angka',
            'tanggal_mulai.required' => ' Jumlah Bed harus Diis',
            'lama_menginap.required' => ' Lama menginap harus Diisi',
            'lama_menginap.numeric' => ' Lama menginap harus berupa Angka',
        ]);

        $dataPemilik = DB::table('pemilikhomestay')
                       ->select('pemilikhomestay.id')
                       ->where('pemilikhomestay.id_Akun','=',Auth::user()->id)
                       ->get();

        $dataHomestay = DB::table('homestay')
                        ->join('pemilikhomestay','homestay.id_pemilik','pemilikhomestay.id')
                        ->select('homestay.id','homestay.jumlah_kamar')
                        ->where('homestay.id_pemilik','=',$dataPemilik[0]->id)
                        ->get();

        if($dataHomestay[0]->jumlah_kamar < $request['jumlah_kamar']){
            return redirect('AddBook')->with('message','Maaf jumlah kamar tidak mencukupi');
        }else{
            $lb->homestay = $dataHomestay[0]->id;
            $lb->nama_pemesan = $request['nama'];
            $lb->jumlah_kamar = $request['jumlah_kamar'];
            $lb->tanggal_mulai = $request['tanggal_mulai'];
            $lb->jumlah_tamu = $request['jumlah_tamu'];
            if($request['extrabed'] == null){
                $lb->extrabed = $request['extrabed'];
            }else{
                $lb->extrabed = $request['extrabed'];
            }
            $datam = $request['extrabed'] * 30000;
            $tohar = ((($request['jumlah_kamar'] * 150000)) * $request['lama_menginap']);
            $lb->lama_menginap = $request['lama_menginap'];
            $lb->total_harga = $tohar + $datam;

            $time = explode('-', $request['tanggal_mulai']);


            if ($time[1]==2){
                $time[2] += $request['lama_menginap'];
                if ($time[2]>28){
                    $time[2] = 0;
                    $time[2] += $request['lama_menginap'];
                    $time[2] -=1;
                    $time[1] +=1;
                    if($time[1]>12){
                        $time[1] = 1;
                    }
                }
            }else{
                if($time[1]%2==1){
                    $time[2] += $request['lama_menginap'];
                    if($time[2]>31){
                        if($request['lama_menginap']!=1){
                            $time[2] = 0;
                            $time[2] += $request['lama_menginap'];
                            $time[1] +=1;
                        }
                    }
                    //$time[2] -=1;
                }else{
                    $time[2] += $request['lama_menginap'];
                    if($time[2]>30){
                        if($request['lama_menginap']!=1){
                            $time[2] = 0;
                            $time[2] += $request['lama_menginap'];
                            $time[1] +=1;
                        }
                    }
                    //$time[2] -=1;
                }
            }


            //$time[2] += $request['lama_menginap'];

            $baru = join('-',$time);

           // dd($time,$request['tanggal_mulai'],$baru,$request['lama_menginap']);

            $lb->tanggal_berakhir = $baru;

            $lb->save();

            return redirect('daftarBooking');
        }
    }

    //Melakukan Update Kamar
    public function updateRoom(Request $request, $id){
        $this->validate($request,[
            'jumlah_bed' => 'required|numeric',
        ],[
            'jumlah_bed.required' => ' Jumlah Bed Harus di isi',
            'jumlah_bed.numeric' => ' Jumlah Bed harus berupa Angka',
        ]);

        $dataKamar = Room::find($id);

        $dataKamar->jumlah_bed = $request['jumlah_bed'];
        $dataKamar->fasilitas = $request['fasilitas'];

        if($request->file('foto')==null){
            $dataKamar->gambar = $dataKamar->gambar;
        }else{
            $file = $request->file('foto');
            $fileName = $file->getClientOriginalName();
            $request->file('foto')->move("img/",$fileName);
            $dataKamar->gambar = $fileName;
        }

        $dataKamar->update();

        return redirect('daftarKamar')->with('message', 'Update Kamar Sukses!');
    }

    //Mengakses Halaman Edit Room
    public function editRoom($id){
        $dataKamar = Room::find($id);

        return view('adminlte::layouts.owner.EditRoom')->with('data',$dataKamar);
    }

    //Mengakses Halaman Daftar Kamar
    public function daftarKamar(){

        $dataPemilik = DB::table('pemilikhomestay')
                ->select('pemilikhomestay.*')
                ->where('pemilikhomestay.id_akun','=',Auth::user()->id)
                ->get();

        $data = DB::table('homestay')
                ->join('pemilikhomestay','homestay.id_pemilik','pemilikhomestay.id')
                ->join('kamar','homestay.id','=','kamar.id_homestay')
                ->select('kamar.*')
                ->where('pemilikhomestay.id','=',$dataPemilik[0]->id)
                ->get();

        return view('adminlte::layouts.owner.listRoom')->with('data',$data)->with('count',$data->count());
    }

    //Mengakses Halaman Daftar Transaksi
    public function listTransaction(){

        $dataPel = DB::table('pemilikhomestay')
            ->select('pemilikhomestay.*')
            ->where('pemilikhomestay.id_akun','=',Auth::user()->id)
            ->get();

        $data  = DB::table('homestay')
                ->join('pemilikhomestay','homestay.id_pemilik','=','pemilikhomestay.id')
                ->join('transaksi','homestay.id','=','transaksi.id_homestay')
                ->join('pelanggan','transaksi.id_pelanggan','=','pelanggan.id')
                ->select('transaksi.*','pelanggan.nama','pelanggan.alamat','pelanggan.no_telepon')
                ->where('homestay.id_pemilik','=',$dataPel[0]->id)
                ->orderBy('transaksi.id','desc')
                ->paginate(5);



        return view('adminlte::layouts.owner.listPesanan')->with('data',$data)->with('count',$data->count());
    }


    //Mengakses Halaman untuk melakukan Request Fasilitas
    public function requestFasilitas(){
        return view('adminlte::layouts.owner.RequestFasilitas')->with('message', 'Request Fasilitas Berhasil Dikirim!');
    }


    //Menyimpan Data Request Fasilitas
    public function storeRequest(Request $request){
        $this->validate($request,[
            'namaRequestFasilitas' => 'required|string',
            'deskripsi' => 'required|string',
            'jumlah' => 'required|numeric',
        ],[
            'namaRequestFasilitas.required' => ' Nama Fasilitas Harus di isi',
            'deskripsi.required' => 'Deskripsi Harus Diisi',
            'jumlah.required' => ' Jumlah Harus di isi',
            'jumlah.numeric' => ' Harus Angka',
        ]);

        $idPemilik = DB::table('users')
                    ->join('pemilikhomestay','users.id','=','pemilikhomestay.id_akun')
                    ->select('pemilikhomestay.id')
                    ->where('users.id', '=', Auth::user()->id)
                    ->get();

        //dd($request['namaRequestFasilitas']);

        $data = new RequestFasilitas();

        $data->id_pemilik_homestay = $idPemilik[0]->id;
        $data->id_kategori_fasiltas = $request['id_kategoriFasiltas'];
        $data->nama_request_fasilitas = $request['namaRequestFasilitas'];
        $data->deskripsi = $request['deskripsi'];
        $data->jumlah = $request['jumlah'];
        $data->status = 0;
        $data->notif = 0;

        if($request->file('gambar')==null){
            $data->gambar = $data->gambar;
        }else{
            $file = $request->file('gambar');
            $fileName = $file->getClientOriginalName();
            $request->file('gambar')->move("img/",$fileName);
            $data->gambar = $fileName;
        }

        $data->save();

        return redirect('listPengajuanFasilitas')->with('message', 'Permintaan Fasilitas Telah Dikirim');

    }


    //Mengakses Halaman untuk melakukan Pengajuan
    public function pengajuan(){
        return view('adminlte::layouts.owner.PengajuanHomestay');
    }


    //Menyimpan Data Pengajuan
    public function storePengajuan(Request $request){

        $this->validate($request,[
            'namaHomestay' => 'required',
            'jumlahKamar' => 'required|numeric',
        ],[
            'namaHomestay.required' => ' Nama Homestay Harus Diisi Harus di isi',
            'jumlahKamar.required' => ' Jumlah Kamar harus di isi.',
            'jumlahKamar.numeric' => ' Jumlah Kamar Harus Berupa angka',
        ]);

        $idPemilik = DB::table('users')
            ->join('pemilikhomestay','users.id','=','pemilikhomestay.id_akun')
            ->select('pemilikhomestay.id')
            ->where('users.id', '=', Auth::user()->id)
            ->get();

        $data = new RequestHomestay();

        $data->id_pemilik_homestay  = $idPemilik[0]->id;
        $data->nama_homestay = $request['namaHomestay'];
        $data->jumlah_kamar = $request['jumlahKamar'];
        $data->status = 0;

        $data->save();

        return redirect('listPengajuan');
    }


    //Melihat Daftar Pengajuan Homestay
    public function listPengajuan(){

        $idPemilik = DB::table('users')
            ->join('pemilikhomestay','users.id','=','pemilikhomestay.id_akun')
            ->select('pemilikhomestay.id')
            ->where('users.id', '=', Auth::user()->id)
            ->get();
        //dd($idPemilik,Auth::user()->id);
        $data = DB::table('pengajuan_homestay')
                ->join('pemilikhomestay','pengajuan_homestay.id_pemilik_homestay','=','pemilikhomestay.id')
                ->select('pemilikhomestay.nama','pengajuan_homestay.*')
                ->where('pengajuan_homestay.id_pemilik_homestay','=',$idPemilik[0]->id)
                ->orderBy('pengajuan_homestay.id','desc')
                ->get();
        //dd('masuk');
        $count = $data->count();

        return view('adminlte::layouts.owner.ListPengajuanHomestay')->with('data',$data)->with('count',$count);
    }


    //Melihat Daftar Pengajuan Fasilitas
    public function listPengajuanFasilitas(){
        $idPemilik = DB::table('users')
            ->join('pemilikhomestay','users.id','=','pemilikhomestay.id_akun')
            ->select('pemilikhomestay.id')
            ->where('users.id', '=', Auth::user()->id)
            ->get();

        $data = DB::table('requestfasilitas')
            ->join('pemilikhomestay','requestfasilitas.id_pemilik_homestay','=','pemilikhomestay.id')
            ->select('pemilikhomestay.nama','requestfasilitas.*')
            ->where('requestfasilitas.id_pemilik_homestay','=',$idPemilik[0]->id)
            ->orderBy('requestfasilitas.id','desc')
            ->paginate(4);

        $count = $data->count();


        return view('adminlte::layouts.owner.ListPengajuanFasilitas')->with('data',$data)->with('count',$count);
    }

}
