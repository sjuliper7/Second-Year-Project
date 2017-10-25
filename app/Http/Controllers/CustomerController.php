<?php

namespace App\Http\Controllers;

use App\Feedback;
use App\Homestay;
use App\ListBook;
use App\RequestHomestay;
use App\Room;
use App\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Customer;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Auth\Guard;
use DateTime;
use PhpParser\Node\Stmt\Const_;
use Psy\Command\ListCommand\ConstantEnumerator;
use PDF;


class CustomerController extends Controller
{
    public function __construct(){
        $this->middleware('customer');
    }

    //Pembatalan Pemesanan/Pembookingan Homestay
    public function cancelPemesanan($id){

        $dataTrsaksi = Transaksi::find($id);

        $dataTrsaksi->status = 3;


        $dataTrsaksi->update();


        //$dataTrsaksi->delete();

        DB::table('daftar_book')->where('id_transaksi', '=', $id)->delete();

        return redirect('customerHistory');
    }

    //Memperbaharui pesanan
    public function updatePesanan($id){
        $data = Transaksi::find($id);
        //$time = explode('-', $request['tanggal']);
        $tanggalMulai = explode('-',$data->tanggal_mulai);

        $tanggalBerakhir = explode('-',$data->tanggal_berakhir);

        $lamaMenginap = $tanggalBerakhir[2] - $tanggalMulai[2];

        //dd($lamaMenginap);



        return view('adminlte::layouts.customers.UpdatePemesanan')->with('data',$data)->with('lama_menginap',$lamaMenginap);
    }

    //Menimpan pesanan yang baru
    public function perbaharui(Request $request,$id){

        $dataTransaksi = DB::table('transaksi')
                         ->select('transaksi.*')
                         ->where('transaksi.id','=',$id)
                         ->get();

        $dataHomestay = DB::table('homestay')
            ->join('kamar','homestay.id','=','kamar.id_homestay')
            ->select('kamar.*','homestay.harga','homestay.jumlah_kamar')
            ->where('homestay.id','=',$dataTransaksi[0]->id_homestay)
            ->get();

        $dataPemilik = DB::table('homestay')
            ->join('pemilikhomestay','homestay.id_pemilik','pemilikhomestay.id')
            ->select('pemilikhomestay.no_telepon')
            ->where('homestay.id','=',$dataTransaksi[0]->id_homestay)
            ->get();

        $homestayJumlahKamar = DB::table('homestay')
            ->select('homestay.jumlah_kamar')
            ->where('homestay.id','=',$dataTransaksi[0]->id_homestay)
            ->get();

        $dataBookingMulai = DB::table('daftar_book')
            ->select('daftar_book.*')
            ->where('daftar_book.tanggal_mulai','=',$request['tanggal'])
            ->get();

        //dd($dataBookingMulai,$request['tanggal']);
        $tanggal_baru = explode('-', $request['tanggal']);
        //$tanggal_baru = explode('-',request(['tanggal']));
        $tanggal_baru[2] +=$request['lama_menginap'];



        $tanggal = join('-',$tanggal_baru);

        //dd($tanggal);

        $dataBookingBerakhir = DB::table('daftar_book')
            ->select('daftar_book.*')
            ->where('daftar_book.tanggal_berakhir','=',$tanggal)
            ->get();



        //dd($dataTransaksi[0],$dataHomestay[0],$dataPemilik[0],$homestayJumlahKamar[0],$dataBookingBerakhir[0],$dataBookingMulai[0]);

        if($dataHomestay[0]->jumlah_kamar < $request['jumlah_kamar']){
            return redirect('updatepesanan/',$id)->with('message','Maaf Jumalh kamar tidak  sesuai');
        }else {
            if ($dataBookingMulai->count() > 0) {
                $currentJumlahKamar = $homestayJumlahKamar[0]->jumlah_kamar - $dataBookingMulai[0]->jumlah_kamar;

                if ($currentJumlahKamar < $request['jumlah_kamar']) {
                    return redirect()->action('GuestController@detailhomestay', ['id' => $request['id']])->with('message', 'Maaf Anda Tidak Bisa Melakukan Pembookingan di karenakan kamar yang tersisa tidak sesuai dengan permintaan anda!');
                }

            } else {
                if ($dataBookingBerakhir->count() > 0) {
                    $currentJumlahKamar2 = $homestayJumlahKamar[0]->jumlah_kamar - $dataBookingBerakhir[0]->jumlah_kamar;
                    if ($currentJumlahKamar2 < $request['jumlah_kamar']) {
                        return redirect()->action('GuestController@detailhomestay', ['id' => $request['id']])->with('message', 'Maaf Anda Tidak Bisa Melakukan Pembookingan di karenakan kamar yang tersisa tidak sesuai dengan permintaan anda!');
                    }
                }
            }

            $time = explode('-', $request['tanggal']);

            if ($time[1] == 2) {
                $time[2] += $request['lama_menginap'];
                if ($time[2] > 28) {
                    $time[2] = 0;
                    $time[2] += $request['lama_menginap'];
                    $time[2] -= 1;
                    $time[1] += 1;
                    if ($time[1] > 12) {
                        $time[1] = 1;
                    }
                }
            } else {
                if ($time[1] % 2 == 1) {
                    $time[2] += $request['lama_menginap'];
                    if ($time[2] > 31) {
                        if ($request['lama_menginap'] != 1) {
                            $time[2] = 0;
                            $time[2] += $request['lama_menginap'];
                            $time[1] += 1;
                        }
                    }
                    //$time[2] -=1;
                } else {
                    $time[2] += $request['lama_menginap'];
                    if ($time[2] > 30) {
                        if ($request['lama_menginap'] != 1) {
                            $time[2] = 0;
                            $time[2] += $request['lama_menginap'];
                            $time[1] += 1;
                        }
                        //$time[2] -=1;
                    }
                }
                $baru = join('-', $time);

                $transaksi = Transaksi::find($id);
                $transaksi->tanggal_mulai = $request['tanggal'];
                $transaksi->tanggal_berakhir = $baru;
                $transaksi->jumlah_kamar =  $request['jumlah_kamar'];
				$transaksi->total_pembayaran = $request['jumlah_kamar'] * $dataHomestay[0]->harga ;
				//dd($transaksi->total_pembayaran,$dataHomestay[0]->harga);

                $df = DB::table('daftar_book')
                           ->where('daftar_book.id_transaksi','=',$id)
                           ->get();


                $dafBook = ListBook::find($df[0]->id);

                $dafBook->jumlah_kamar = $request['jumlah_kamar'];
                $dafBook->tanggal_mulai = $request['tanggal'];
                $dafBook->tanggal_berakhir = $baru;

                //dd($dafBook[0]);

                $transaksi->update();
                $dafBook->update();

                return redirect('customerHistory');
            }
        }
    }

    //Pemberian/Pengiriman Feedback
    public function sendFeedback(Request $request, $id){
   /*     if(Auth::guest()){
            dd("maaf nggak bisa bang");
        }
*/
        $dataPelanggan = DB::table('pelanggan')
                         ->select('pelanggan.id')
                         ->where('pelanggan.id_akun','=',Auth::user()->id)
                         ->get();

        $dataPemilik = DB::table('homestay')
                       ->select('homestay.id_pemilik')
                       ->where('homestay.id','=',$id)
                       ->get();

        $feed = new Feedback();
        $feed->id_pemilik_homestay = $dataPemilik[0]->id_pemilik;
        $feed->id_pelanggan = $dataPelanggan[0]->id;
        $feed->feedback = $request['feedback'];

        $feed->save();

        return redirect()->action('GuestController@detailhomestay', ['id' => $id]);
    }

    //Upload Bukti Pembayaran
    public function upload(Request $request,$id)
    {
        $data = Transaksi::find($id);

        if($request->file('bukti_pembayaran')==null){
            $data->bukti_pembayaran = $data->bukti_pembayaran;
        }else{
            $file = $request->file('bukti_pembayaran');
            $fileName = $file->getClientOriginalName();
            $request->file('bukti_pembayaran')->move("img/",$fileName);
            $data->bukti_pembayaran = $fileName;
        }

        $data->update();

        return redirect('customerHistory');
    }

    //Mengakses Halaman untuk mengupload Bukti Pembayaran
    public function bukti($id){
        $data = Transaksi::find($id);

        return view('adminlte::layouts.customers.Upload')->with('data',$data);
    }

    //Mengakses Halaman daftar Pemesanan Pelanggan
    public function history(){
        $data = DB::table('pelanggan')
            ->select('pelanggan.*')
            ->where('pelanggan.id_akun','=',Auth::user()->id)
            ->get();

       $dataTrans = DB::table('homestay')
                    ->join('transaksi','homestay.id','=','transaksi.id_homestay')
                    ->join('pemilikhomestay','homestay.id_pemilik','=','pemilikhomestay.id')
                    ->select('transaksi.*','pemilikhomestay.nama','pemilikhomestay.no_rekening')
                    ->where('transaksi.id_pelanggan','=',$data[0]->id)
                    ->orderBy('transaksi.id', 'desc')
                    ->get();

        return view('adminlte::layouts.customers.History')->with('data',$dataTrans);
    }

    //Mengkases Halaman Rincian History Pelanggan
    public function rincianHistory($id){
      $rincianHistory = DB::table('transaksi')
          ->join('pelanggan','transaksi.id_pelanggan','=','pelanggan.id')
          ->join('homestay','transaksi.id_homestay','=','homestay.id')
          ->join('pemilikhomestay','homestay.id_pemilik','=','pemilikhomestay.id')
          ->select('transaksi.status','transaksi.total_pembayaran','transaksi.bukti_pembayaran','transaksi.tanggal_mulai','transaksi.id','transaksi.tanggal_berakhir','transaksi.jumlah_kamar','transaksi.lama_menginap','pelanggan.nama','pelanggan.no_telepon','pemilikhomestay.no_rekening','homestay.nama_homestay')
          ->where('transaksi.id','=',$id)
          ->get();

     //dd($rincianHistory);

      return view('adminlte::layouts.customers.rincianHistory')->with('data',$rincianHistory[0]);
    }

    public function rincianHistoryPrint($id){
      $rincianHistory = DB::table('transaksi')
          ->join('pelanggan','transaksi.id_pelanggan','=','pelanggan.id')
          ->join('homestay','transaksi.id_homestay','=','homestay.id')
          ->join('pemilikhomestay','homestay.id_pemilik','=','pemilikhomestay.id')
          ->select('transaksi.status','transaksi.total_pembayaran','transaksi.bukti_pembayaran','transaksi.tanggal_mulai','transaksi.id','transaksi.tanggal_berakhir','transaksi.jumlah_kamar','transaksi.lama_menginap','pelanggan.nama','pelanggan.no_telepon','pemilikhomestay.no_rekening','homestay.nama_homestay')
          ->where('transaksi.id','=',$id)
          ->get();

          $pdf = PDF::loadView('pdf.rincianHistory',['data' => $rincianHistory[0]]);
          return $pdf->stream('rincianHistory.pdf');
    }

    //Mengakses Profile Pelanggan
    public function profile(){
        $data = DB::table('pelanggan')
            ->select('pelanggan.*')
            ->where('pelanggan.id_akun','=',Auth::user()->id)
            ->get();

        return view('adminlte::layouts.customers.profiles')->with('data',$data[0]);
    }

    //Mengakses Halaman untuk mengedit/mengubah profile
    public function editProfile($id){
        $data = Customer::find($id);

        return view('adminlte::layouts.customers.editprofiles')->with('data',$data);
    }

    //update Profile
    public function updateProfile(Request $request,$id){
        $cus = Customer::find($id);
        $dataUs = User::find(Auth::user()->id);
        if($request['nama']==""){
            $cus->nama = $cus->nama;
            $dataUs->name = $dataUs->name;
        }else{
            $cus->nama = $request['nama'];
            $dataUs->name=$request['nama'];
        }

        $cus->alamat = $request['alamat'];
        $cus->pekerjaan = $request['pekerjaan'];
        $cus->no_telepon = $request['noTelepon'];

        if($request->file('foto')==null){
            $dataUs->foto = $dataUs->foto;
        }else{
            $file = $request->file('foto');
            $fileName = $file->getClientOriginalName();
            $request->file('foto')->move("img/",$fileName);
            $dataUs->foto = $fileName;
        }

        $cus->update();
        $dataUs->update();

        return redirect('customerProfile');
    }

    //Melakukan Pembookingan Homestay
    public function booking(Request $request){


        $this->validate($request,[
            'tanggal' => 'required',
            'jumlah_hari' => 'required|numeric',
            'jumlah_kamar' => 'required|numeric',

        ],[
            'tanggal.required' => 'Tanggal Harus di isi',
            'jumlah_kamar.required' => ' Jumlah Kamar Harus di isi',
            'jumlah_kamar.numeric' => ' Jumlah Kamr harus berupa Angka',
            'jumlah_hari.required' => ' Lama menginap harus Diisi',
            'jumlah_hari.numeric' => ' Lama menginap harus berupa Angka',
        ]);

        if(Auth::guest()){
            return view('adminlte::errors.Account');
        }

        $lb = new ListBook();

        $dataPelanggan = DB::table('users')
            ->join('pelanggan','users.id','=','pelanggan.id_akun')
            ->select('pelanggan.id','pelanggan.nama')
            ->where('users.id','=',Auth::user()->id)
            ->get();

        $dataHasilValidPelanggan = $this->dataValidation($dataPelanggan[0]->id);

        if($dataHasilValidPelanggan > 0 ){
            //dd($dataHasilValidPelanggan,'nggak boleh');
            return redirect('customerProfile')->with('message','Lengkkapi data diri anda!!');
        }

        $dataHomestay = DB::table('homestay')
            ->join('kamar','homestay.id','=','kamar.id_homestay')
            ->select('kamar.*','homestay.harga','homestay.jumlah_kamar')
            ->where('homestay.id','=',$request['id'])
            ->get();

        $dataPemilik = DB::table('homestay')
            ->join('pemilikhomestay','homestay.id_pemilik','pemilikhomestay.id')
            ->select('pemilikhomestay.no_telepon')
            ->where('homestay.id','=',$request['id'])
            ->get();

        $homestayJumlahKamar = DB::table('homestay')
                            ->select('homestay.jumlah_kamar')
                            ->where('homestay.id','=',$request['id'])
                            ->get();

        $dataBookingMulai = DB::table('daftar_book')
                       ->select('daftar_book.*')
                       ->where('daftar_book.tanggal_mulai','=',$request['tanggal'])
                       ->get();

        $dataBookingBerakhir = DB::table('daftar_book')
            ->select('daftar_book.*')
            ->where('daftar_book.tanggal_berakhir','=',$request['tanggal'])
            ->get();

        //dd($dataHomestay[0]->jumlah_kamar,$request['jumlah_kamar']);

        if($dataHomestay[0]->jumlah_kamar < $request['jumlah_kamar']){
            return redirect('detailhomestay/',$dataHomestay[0]->id)->with('message','Maaf Jumalh kamar tidak  sesuai');
        }else{
            if($dataBookingMulai->count() > 0){
                $currentJumlahKamar = $homestayJumlahKamar[0]->jumlah_kamar - $dataBookingMulai[0]->jumlah_kamar;
                if($currentJumlahKamar < $request['jumlah_kamar']){
                    return redirect()->action('GuestController@detailhomestay',['id'=>$request['id']])->with('message', 'Maaf Anda Tidak Bisa Melakukan Pembookingan di karenakan kamar yang tersisa tidak sesuai dengan permintaan anda!');
                }
            }else{
                if($dataBookingBerakhir->count() > 0){
                    $currentJumlahKamar2 = $homestayJumlahKamar[0]->jumlah_kamar - $dataBookingBerakhir[0]->jumlah_kamar;
                    if($currentJumlahKamar2 < $request['jumlah_kamar']){
                        return redirect()->action('GuestController@detailhomestay',['id'=>$request['id']])->with('message', 'Maaf Anda Tidak Bisa Melakukan Pembookingan di karenakan kamar yang tersisa tidak sesuai dengan permintaan anda!');
                    }
                }
            }

            $time = explode('-', $request['tanggal']);

            if ($time[1]==2){
                $time[2] += $request['jumlah_hari'];
                if ($time[2]>28){
                    $time[2] = 0;
                    $time[2] += $request['jumlah_hari'];
                    $time[2] -=1;
                    $time[1] +=1;
                    if($time[1]>12){
                        $time[1] = 1;
                    }
                }
            }else{
                if($time[1]%2==1){
                    $time[2] += $request['jumlah_hari'];
                    if($time[2]>31){
                        if($request['jumlah_hari']!=1){
                            $time[2] = 0;
                            $time[2] += $request['jumlah_hari'];
                            $time[1] +=1;
                        }
                    }
                    //$time[2] -=1;
                }else{
                    $time[2] += $request['jumlah_hari'];
                    if($time[2]>30){
                        if($request['jumlah_hari']!=1){
                            $time[2] = 0;
                            $time[2] += $request['jumlah_hari'];
                            $time[1] +=1;
                        }
                    }
                    //$time[2] -=1;
                }
            }
            $baru = join('-',$time);

            $trans = new Transaksi();
            $trans->id_pelanggan  = $dataPelanggan[0]->id;
            $trans->id_homestay = $request['id'];
            $trans->tanggal_mulai = $request['tanggal'];
            $trans->tanggal_berakhir = $baru;
            $trans->jumlah_kamar =$request['jumlah_kamar'];
            $trans->permintaan_khusus = $request['permintaan_khusus'];
            $trans->lama_menginap = $request['jumlah_hari'];
            $trans->total_pembayaran = $request['jumlah_kamar'] * $dataHomestay[0]->harga;
            $trans->status = 0;

            $trans->save();

            $dataTrans = DB::table('transaksi')
                ->select('transaksi.id')
                ->where('transaksi.tanggal_mulai','=',$request['tanggal'])
                ->where('transaksi.tanggal_berakhir','=',$baru)
                ->get();


            //Insert Table Daftar Booking
            $lb->homestay = $request['id'];
            $lb->id_transaksi = $dataTrans[0]->id;
            $lb->nama_pemesan = $request['nama'];
            $lb->jumlah_kamar = $request['jumlah_kamar'];
            $lb->tanggal_mulai = $request['tanggal'] ;
            $lb->tanggal_berakhir = $baru;

            //Save
            $lb->save();

            $text = "Ada Pesanan Kamar dari Sdr/i : ";
            $pesan =  $text . ' ' .$dataPelanggan[0]->nama;
            $newPesan = $pesan . ' '. "Silahkan Cek Sistem Informasi";

            /*Nexmo::message()->send([
                'to' => $dataPemilik[0]->no_telepon,
                'from' => 'ASDASD',
                'text' => $newPesan
            ]);*/

            return redirect('customerHistory');
        }
    }

    public function dataValidation($id){

        $dataPelanggan = DB::table('pelanggan')
                        ->select('pelanggan.*')
                        ->where('pelanggan.id','=',$id)
                        ->get();

        $counter = 0;

        if($dataPelanggan[0]->nama == "---"){
            $counter +=1;
        }
        if($dataPelanggan[0]->alamat =="---"){
            $counter +=1;
        }
        if($dataPelanggan[0]->no_telepon =="---"){
            $counter +=1;
        }
        if($dataPelanggan[0]->pekerjaan == "---"){
            $counter +=1;
        }

        return $counter;

    }

}
