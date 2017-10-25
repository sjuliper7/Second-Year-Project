<?php

namespace App\Http\Controllers;

use App\Homestay;
use App\Transaksi;
use App\ListBook;
use App\RequestHomestay;
use App\Room;
use Illuminate\Http\Request;
use App\User;
use League\Flysystem\Exception;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Owner;
use Illuminate\Support\Facades\DB;
use App\RequestFasilitas;
use Illuminate\Support\Facades\Auth;
use PDF;

class AdminController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
        $this->middleware('dinaspariwisata');
    }

    public function Home(){
      $count = User::all()->where('role',"Owner")->count();
      $data = User::all()->where('role',"Owner");
          //dd($data);

          $dataF = DB::table('pemilikhomestay')
              ->join('requestfasilitas','pemilikhomestay.id','=','requestfasilitas.id_pemilik_homestay')
              ->select('pemilikhomestay.nama','requestfasilitas.*')
              ->orderBy('requestfasilitas.id','desc')
              ->where('requestfasilitas.status','=',0)
              ->get();

        $dataH = DB::table('homestay')
                      ->get();

        $dataPesan = DB::table('homestay')
                                  ->join('daftar_book','homestay.id','=','daftar_book.homestay')
                                  ->select('daftar_book.*','homestay.nama_homestay','homestay.owner')
                                  ->get();





      return view('adminlte::layouts.admin.home')->with('data',$data)->with('count',$count)->with('dataF',$dataF)->with('countF',$dataF->count())
                                                 ->with('dataH',$dataH)->with('countH',$dataH->count())
                                                 ->with('dataPesan',$dataPesan)->with('countPesan',$dataPesan->count());
    }

    public function listhomestay()
    {
      $data = DB::table('homestay')
      ->get();
      return view('adminlte::layouts.admin.listhomestay')->with('data',$data);
    }

    public function cariPesanan(Request $request){
        $dataHomestay = Homestay::where('nama_homestay',$request['nama_homestay'])->get();
        $homestay = DB::table('homestay')->get();
        //dd($homestay);
        if($request['bulan']== null){
            $dataHos = DB::table('daftar_book')
                ->join('transaksi','daftar_book.id_transaksi','=','transaksi.id')
                ->join('homestay','daftar_book.homestay','=','homestay.id')
                ->where('daftar_book.homestay','=',$dataHomestay[0]->id)
                ->select('homestay.nama_homestay','homestay.owner','transaksi.total_pembayaran','transaksi.jumlah_kamar','daftar_book.*')
                ->get();

            $dataHos2 = DB::table('daftar_book')
                ->join('homestay','daftar_book.homestay','=','homestay.id')
                ->where('daftar_book.homestay','=',$dataHomestay[0]->id)
                ->where('daftar_book.id_transaksi','=',null)
                ->select('homestay.nama_homestay','homestay.owner','daftar_book.*')
                ->get();
        //dd('masuk');
            $penghasilan = 0;
            foreach ($dataHos as $a){
                $penghasilan += $a->total_pembayaran;
                //$i++;
            }

            foreach ($dataHos2 as $b){
                $biaya = ($b->jumlah_kamar * 150000) * $b->lama_menginap;
                $penghasilan += $biaya;
            }


            return view('adminlte::layouts.admin.resultlistpesanan')->with('data',$dataHos)->with('data2',$dataHos2 )
                ->with('penghasilan',$penghasilan)->with('homestay',$homestay);

        }else{
            $data = DB::table('daftar_book')
                ->join('transaksi','daftar_book.id_transaksi','=','transaksi.id')
                ->join('homestay','daftar_book.homestay','=','homestay.id')
                ->where('daftar_book.homestay','=',$dataHomestay[0]->id)
                ->whereMonth('daftar_book.tanggal_mulai','=',$request['bulan'])
                ->select('homestay.nama_homestay','homestay.owner','transaksi.total_pembayaran','transaksi.jumlah_kamar','daftar_book.*')
                ->get();

            $data2 = DB::table('daftar_book')
                ->where('daftar_book.homestay','=',$dataHomestay[0]->id)
                ->join('homestay','daftar_book.homestay','=','homestay.id')
                ->where('daftar_book.id_transaksi','=',null)
                ->whereMonth('daftar_book.tanggal_mulai','=',$request['bulan'])
                ->select('homestay.nama_homestay','homestay.owner','daftar_book.*')
                ->get();

            //$i=0;
            $penghasilan = 0;
            foreach ($data as $a){
                $penghasilan += $a->total_pembayaran;
                //$i++;
            }

            foreach ($data2 as $b){
                $biaya = ($b->jumlah_kamar * 150000) * $b->lama_menginap;
                $penghasilan += $biaya;
            }

            //dd($data,$data2,$penghasilan);
            //dd($homestay);
            //dd($data2);
            return view('adminlte::layouts.admin.resultlistpesanan')->with('data',$data)->with('data2',$data2)
                ->with('penghasilan',$penghasilan)->with('homestay',$homestay);
        }

    }



    public function Allfeedback(){
      $data = DB::table('homestay')
              ->get();

      $dataF = DB::table('pemilikhomestay')
              ->join('homestay','pemilikhomestay.id','=','homestay.id_pemilik')
              ->select('pemilikhomestay.nama','pemilikhomestay.id','homestay.owner','homestay.nama_homestay','homestay.alamat')
              ->get();


              //dd($dataF);

      return view('adminlte::layouts.admin.Allfeedback')->with('dataF',$dataF);
    }

    public function feedback($id){


          $dataFeedback = DB::table('feedback')
              ->join('pemilikhomestay','feedback.id_pemilik_homestay','=','pemilikhomestay.id')
              ->join('pelanggan','feedback.id_pelanggan','=','pelanggan.id')
              ->select('pemilikhomestay.id','feedback.feedback','pelanggan.nama','feedback.created_at','feedback.id')
              ->where('pemilikhomestay.id','=',$id)
              ->paginate(10);
    //dd($dataFeedback);

      return view('adminlte::layouts.admin.feedback')->with('data',$dataFeedback);
      }


    public function index()
    {
      $count = User::all()->where('role',"Owner")->count();
      $data = User::all()->where('role',"Owner");
          //dd($data);

      return view('adminlte::layouts.admin.listOwner')->with('data',$data)->with('count',$count);
    }

    public function owner($id){

        $data = Owner::where('id_akun',$id)
                ->join('users','pemilikhomestay.id_akun','=','users.id')
                ->select('users.username','pemilikhomestay.*')
                ->get();

       // dd($data[0]);
        return view('adminlte::layouts.admin.updateOwner')->with('data',$data[0]);
    }

    public function rincian($id){
        $dataPem = DB::table('pemilikhomestay')
                   ->where('pemilikhomestay.id_akun','=',$id)
                   ->get();

        $data = Owner::find($dataPem[0]->id);

        return view('adminlte::layouts.admin.profil')->with('data',$data);
    }

    public function updateOwner(Request $request, $id){

        $dataOw = Owner::find($id);

        $dataOw->nama ;
        $dataOw->alamat;
        $dataOw->pekerjaan;
        $dataOw->no_telepon;
        $dataOw->no_rekening;


        //dd('aman',$request['username']);

        $dataUs = User::find($dataOw->id_akun);

        if($request['password'] == null || $request['password'] == ' '){
            $dataUs->password = $dataUs->password;
        }else{
            $dataUs->password =  bcrypt($request['password']);
        }





        //dd($dataUs);

        $dataUs->update();

        return redirect('listowner');
        //dd($dataOw->id);
    }

    //Mengakses Daftar Pemesanan
    public function listPesanan(){

        $data = DB::table('homestay')
                ->join('daftar_book','homestay.id','=','daftar_book.homestay')
                ->select('daftar_book.*','homestay.nama_homestay','homestay.owner')
                ->paginate(10);

        $homestay = Homestay::all();

        return view('adminlte::layouts.admin.dataPemesanan')->with('data',$data)->with('homestay',$homestay);
    }

    //Mengakses Daftar Owner
    public function listOwner(){
        $count = User::all()->where('role',"Owner")->count();
        $data = User::all()->where('role',"Owner");

        return view('adminlte::layouts.admin.listOwner')->with('data',$data)->with('count',$count);
    }

    //Menambah owner
    public function create()
    {
        return view('adminlte::layouts.admin.addOwner');
    }

    //Meyimpan Data Owner
    public function store(Request $request)
    {

        $this->validate($request,[
            'name' => 'required|min:5|max:35',
            'username' => 'required|min:5|max:35',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|max:20',
            'password_confirmation' => 'required|min:3|max:20|same:password',
        ],[
            'name.required' => ' Nama Harus di isi',
            'name.min' => ' Nama minimal 5 characters.',
            'name.max' => ' Nama maksimal 35 characters.',
            'username.required' => ' Username Harus di isi',
            'username.min' => ' Usename minimal 5 characters.',
            'username.max' => ' Username maksimal 35 characters.',
            'password.required' => 'Password Harus di isi',
            'password_confirmation.required' => 'Password Confirmasi Harus di isi',
        ]);

        $data = $request->all();
        $user = new User();
        $user->name = $data['name'];
        $user->username = $data['username'];
        $user->email = $data['email'];
        $user->password = bcrypt($data['password']);
        $user->role = 'Owner';
        $user->foto = 'gravatar.png';
        $user->save();

        $dataPemilik = DB::table('users')
                       ->select('users.id')
                       ->where('username','=',$data['username'])
                       ->get();

        //dd($dataPemilik->id);

        $owner = new Owner();
        $owner->nama = $data['name'];
        $owner->id_akun = $dataPemilik[0]->id;
        $owner->alamat = '--';
        $owner->pekerjaan = '--';
        $owner->no_telepon = '--';
        $owner->no_rekening = '--';
        $owner->foto = 'gravatar.png';

        $owner->save();

        $dataOnwer = DB::table('pemilikhomestay')
                    ->select('pemilikhomestay.id')
                    ->where('pemilikhomestay.id_akun','=',$dataPemilik[0]->id)
                    ->get();

        $homestay = new Homestay();
        $homestay->id_pemilik = $dataOnwer[0]->id;
        $homestay->nama_homestay = $data['nama_homestay'];
        $homestay->owner = $data['name'];
        $homestay->alamat = "---";
        $homestay->jumlah_kamar = $data['jumlah_kamar'];
        $homestay->harga = 150000;
        $homestay->fasilitas = "---";
        $homestay->gambar = "---";
        $homestay->status = "---";

        $homestay->save();


        $idHts = DB::table('homestay')
            ->select('homestay.*')
            ->where('homestay.id_pemilik','=',$dataOnwer[0]->id)
            ->get();

        for ($i = 1;$i<=$data['jumlah_kamar'];$i++){
            $km = new Room();
            $km->id_homestay = $idHts[0]->id;
            $km->nomor_kamar = $i;
            $km->jumlah_bed = 2;
            $km->save();
        }


        return redirect('listowner')->with('message', 'User berhasil ditambah');
    }

    //Menampilkan Daftar RequestHomestay
    public function RequestHomestay(){

        $data = DB::table('pemilikhomestay')
            ->join('pengajuan_homestay','pemilikhomestay.id','=','pengajuan_homestay.id_pemilik_homestay')
            ->select('pemilikhomestay.nama','pengajuan_homestay.*')
            ->orderBy('pengajuan_homestay.id','desc')
            ->get();

        $count = $data->count();

        return view('adminlte::layouts.admin.listPengajuan')->with('data',$data)
                                                           ->with('count',$count);
    }

    //Melakuan Aksi Untuk memproses Permintaan Admin
    public function UpdateRequestFasilitass($id){
        //$data = DB::table('requestfasilitas')->where('id', $id)->first();

        $RF = RequestFasilitas::find($id);

        if($RF == null){
            dd('nggak boleh gan');
        }else{
            $RF->status = 2;

            $RF->update();

            return redirect('requestFasilitas');
        }
    }

    public function UpdateRequestFasilitas($id){
        $RF = RequestFasilitas::find($id);
        $RF->status = 1;
        $RF->notif = 1;
        $RF->update();

        return redirect('requestFasilitas');
    }

    //Mengakses Daftar Request Fasilitas
    public function RequestFasilitas(){

        $data = DB::table('pemilikhomestay')
            ->join('requestfasilitas','pemilikhomestay.id','=','requestfasilitas.id_pemilik_homestay')
            ->select('pemilikhomestay.nama','requestfasilitas.*')
            ->orderBy('requestfasilitas.id','desc')
            ->paginate(4);

        $count = $data->count();

        return view('adminlte::layouts.admin.listRequestFasilitas')->with('data',$data)->with('count',$count);
    }

    //DEtail REq Fasilitas
    public function detailreqFasilitas($id){
      $data = DB::table('pemilikhomestay')
          ->join('requestfasilitas','pemilikhomestay.id','=','requestfasilitas.id_pemilik_homestay')
          ->select('pemilikhomestay.nama','requestfasilitas.*')
          ->where('requestfasilitas.id','=',$id)
          ->get();

          //dd($data);
      $count = $data->count();

      return view('adminlte::layouts.admin.detailreqFasilitas')->with('data',$data[0])->with('count',$count);
    }

    public function printFasilitas($id){
      $data = DB::table('pemilikhomestay')
          ->join('requestfasilitas','pemilikhomestay.id','=','requestfasilitas.id_pemilik_homestay')
          ->join('homestay','pemilikhomestay.id','=','homestay.id_pemilik')
          ->select('pemilikhomestay.nama','pemilikhomestay.no_telepon','requestfasilitas.*','homestay.nama_homestay','homestay.alamat')
          ->where('requestfasilitas.id','=',$id)
          ->get();

          $pdf = PDF::loadView('pdf.adminfasilitas',['data' => $data[0]]);
          return $pdf->stream('adminfasilitas.pdf');
    }



    //Menolak pengajuan homestay
    public function RejectPengajuanHomestay($id){
        //dd($id,"masuk agan");
        $RH = RequestHomestay::find($id);
        $RH->status = 2;
        $RH->update();

        return redirect('requestHomestay');
    }


    //Penyetujuan Pengajuan Homestay
    public function AccPengajuanHomestay($id){
        $RH = RequestHomestay::find($id);
        $RH->status = 1;

        $data = DB::table('pengajuan_homestay')
                ->join('pemilikhomestay','pemilikhomestay.id','=','pengajuan_homestay.id_pemilik_homestay')
                ->select('pemilikhomestay.nama','pemilikhomestay.alamat')
                ->where('pemilikhomestay.id','=',$RH->id_pemilik_homestay)
                ->get();
        //dd($data);
        $hs = new Homestay();
        $hs->id_pemilik = $RH->id_pemilik_homestay;
        $hs->nama_homestay = $RH->nama_homestay;
        $hs->owner = $data[0]->nama ;
        $hs->alamat = $data[0]->alamat;
        $hs->jumlah_kamar = $RH->jumlah_kamar;
        $hs->harga = 150000;
        $hs->status='----';

        $hs->save();

        $idHts = DB::table('homestay')
                ->select('homestay.*')
                ->where('homestay.owner','=',$data[0]->nama)
                ->get();

        for ($i = 1;$i<=$RH->jumlah_kamar;$i++){
            $km = new Room();
            $km->id_homestay = $idHts[0]->id;
            $km->nomor_kamar = $i;
            $km->jumlah_bed = 2;
            $km->save();
        }
        $RH->update();
        return redirect('requestHomestay');
    }

    //akses halaman detail profile owner
    public function profileowner($id){

        $data = Owner::find($id);
        return view('adminlte::layouts.admin.ownerprofil')->with('data',$data);
    }

    public function cancelRequest(Request $request){
        $req = RequestFasilitas::find($request->requestID);
        $req->status = 2;
        $req->notif = 1;
        $req->pesan = $request->pesan;

        $req->update();
    }

}
