<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\Messages\NexmoMessage;
use SimpleSoftwareIO\SMS\Drivers\NexmoSMS;
use Nexmo;
use App\Feedback;
use App\Homestay;
use App\ListBook;
use App\Room;
use App\Transaksi;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Customer;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Auth\Guard;
use DateTime;
use PhpParser\Node\Stmt\Const_;
use Psy\Command\ListCommand\ConstantEnumerator;
use Validator;


class GuestController extends Controller
{
    public function route(){

        Nexmo::message()->send([
            'to' => '6282272194654',
            'from' => 'ASDASD',
            'text' => 'Hi ini hanya sebuah test no more'
        ]);

        return view('welcome');
    }


    public function booking(Request $request){

        $dataPelanggan = DB::table('users')
            ->join('pelanggan','users.id','=','pelanggan.id_akun')
            ->select('pelanggan.id','pelanggan.nama')
            ->where('users.id','=',Auth::user()->id)
            ->get();

        $dataPemilik = DB::table('homestay')
                       ->join('pemilikhomestay','homestay.id_pemilik','=','pemilikhomestay.id')
                       ->where('homestay.id','=',$request['id_homestay'])
                       ->get();

        //dd($dataPemilik[0]);

        $trans = new Transaksi();

        $trans->id_pelanggan = $dataPelanggan[0]->id ;
        $trans->id_homestay = $request['id_homestay'];
        $trans->tanggal_mulai = $request['tanggal_mulai'];
        $trans->tanggal_berakhir = $request['tanggal_selesai'];
        $trans->jumlah_kamar = $request['jumlah_kamar'];
        $trans->jumlah_tamu = $request['jumlah_tamu'];
        $trans->lama_menginap = $request['lama_menginap'];
        if ($request['extrabed']==null){
            $trans->extrabed = 0;
        }else{
            $trans->extrabed = $request['extrabed'];
        }
        $trans->permintaan_khusus = $request['permintaan_khusus'];
		
		//dd('masuk agan');
		
		if($request['extrabed']== null){
			$trans->total_pembayaran = $request['total_harga'];
		}else{
			$trans->total_pembayaran = $request['total_harga'] + ($request['extrabed'] * 30000);
		}
		
        $trans->status = 0;

        $trans->save();

        $dataTrans = DB::table('transaksi')
            ->select('transaksi.id')
            ->where('transaksi.tanggal_mulai','=',$request['tanggal_mulai'])
            ->where('transaksi.tanggal_berakhir','=',$request['tanggal_selesai'])
            ->where('transaksi.total_pembayaran','=',$request['total_harga'] + ($request['extrabed'] * 30000))
            ->where('transaksi.jumlah_kamar','=',$request['jumlah_kamar'])
            ->where('transaksi.jumlah_tamu','=', $request['jumlah_tamu'])
            ->where('transaksi.lama_menginap','=', $request['lama_menginap'])
            ->get();

        //dd($dataTrans);

        $lb = new ListBook();

        $lb->homestay = $request['id_homestay'];
        $lb->id_transaksi = $dataTrans[0]->id;
        $lb->nama_pemesan = $request['nama'];
        if($request['extrabed'] == null){
            $lb->extrabed = 0;
        }else{
            $lb->extrabed = $request['extrabed'];
        }
        $lb->total_harga  = $request['total_harga']+ ($request['extrabed'] * 30000);
        $lb->permintaan_khusus = $request['permintaan_khusus'];
        $lb->jumlah_kamar = $request['jumlah_kamar'];
        $lb->jumlah_tamu = $request['jumlah_tamu'];
        $lb->tanggal_mulai = $request['tanggal_mulai'] ;
        $lb->lama_menginap = $request['lama_menginap'];
        $lb->tanggal_berakhir = $request['tanggal_selesai'];
        $lb->status = 0;

        $lb->save();

        $text = "Ada Pesanan Kamar dari Sdr/i : ";
        $pesan =  $text . ' ' .$dataPelanggan[0]->nama;
        $newPesan = $pesan . ' '. "Silahkan Cek Sistem Informasi";

        Nexmo::message()->send([
            'to' => $dataPemilik[0]->no_telepon,
            'from' => 'ASDASD',
            'text' => $newPesan
        ]);

        return redirect('customerHistory');

        //dd($request);
    }

    public function rincianpemesanan(Request $request, $id){

        if(Auth::guest()){
            return redirect('login')->with('message','Anda Harus Login dulu');
        }else{
            $dataUser = DB::table('pelanggan')
                        ->where('pelanggan.id_Akun','=',Auth::user()->id)
                        ->get();
        }

        $data = DB::table('homestay')
                ->where('homestay.id','=',$id)
                ->get();

        $TotalHarga = $request->lama_menginap * ($request->jumlah_kamar * $data[0]->harga);

        return view('adminlte::layouts.customers.rincianpemesanan')->with('data',$data[0])->with('request',$request)->with('totalHarga',$TotalHarga)->with('dataUser',$dataUser[0])->with('id',$id);
    }

    public function sendFeedback(Request $request, $id){
        if(Auth::guest()){
            return redirect()->action('GuestController@detailhomestay', ['id' => $id])->with('message','Anda Harus Login Dulu');
            //dd("maaf nggak bisa bang");
        }

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

    public function homestay($id,$tm,$lm,$ts,$jt,$jk){

        $data = DB::table('homestay')
            ->join('pemilikhomestay','homestay.id_pemilik','=','pemilikhomestay.id')
            ->select('pemilikhomestay.*','homestay.*')
            ->where('homestay.id','=',$id)
            ->get();

        //dd($data);

        $dataKamar = DB::table('kamar')
                     ->where('kamar.id_homestay','=',$id)
                     ->get();

        $dataFeedback = DB::table('feedback')
                        ->join('pelanggan','feedback.id_pelanggan','pelanggan.id')
                        ->select('feedback.*','pelanggan.nama')
                        ->where('feedback.id_pemilik_homestay','=',$data[0]->id_pemilik)
                        ->orderBy('feedback.id', 'desc')
                        ->get();

         //dd($dataFeedback);

        return view('adminlte::layouts.pages.detilSHomestay')->with('id',$id)->with('data',$data[0])->with('tm',$tm)->with('lm',$lm)->with('ts',$ts)->with('jt',$jt)->with('jk',$jk)->with('dataKamar',$dataKamar)->with('feedback',$dataFeedback);
    }

    public function cari(Request $request){

        $data =  Homestay::all();

        $dataBook = ListBook::all();

        $tanggal_mulai = $request['tanggal_mulai'];
        $jumlah_hari = $request['jumlah_hari'];
        $tanggal_selesai = $request['tanggal_selesai'];
        $jumlah_Tamu = $request['jumlah_Tamu'];
        $jumlah_kamar =  $request['jumlah_kamar'];

        $dataHomestay[] =  null;
        $i = 0;
        $exbed = 0;
        $biaya = 0;
        $temp = 0;
        if($jumlah_kamar <= $jumlah_Tamu){
            //Melakukan Looping pengecekan Homestay yang avilable
            foreach ($data as $a){

                $tm = explode('-',$request['tanggal_mulai']);
                $ts = explode('-',$request['tanggal_selesai']);
                $counter = 0;
                $j=0;



                //Mencocokkan data pesanan untuk mendapat current room avilable
                foreach ($dataBook as $db){

                    $ldbm = explode('-',$db->tanggal_mulai);
                    $ldbs = explode('-',$db->tanggal_berakhir);
                    //dd($tm,$ts);
                    if($tm[1]==$ts[1]){

                        if($tm[1] == $ldbm[1] && $ts[1] == $ldbs[1]){
                            if(($tm[2] >= $ldbm[2]  && $tm[2] <= $ldbs[2] ) && ($ts[2] >= $ldbm[2] && $ts[2]<= $ldbs[2]) ){
                                //dd('beriirisan total');
                                $dataCurrent[$j] = $db->id;
                                $counter +=1;
                                $j++;
                                // echo 'beririsan';
                            }
                            else if(($tm[2] < $ldbm[2]  && $tm[2] <= $ldbs[2] ) && ($ts[2] >= $ldbm[2] && $ts[2]<= $ldbs[2])){
                                $dataCurrent[$j] = $db->id;
                                $counter +=1;
                                $j++;
                                // echo 'beririsan sebagian batas atas';
                                //dd('beririsan sebagian batas atas');
                            }else if(($tm[2] >= $ldbm[2]  && $tm[2] <= $ldbs[2] ) && ($ts[2] >= $ldbm[2] && $ts[2] > $ldbs[2])){
                                $dataCurrent[$j] = $db->id;
                                $counter +=1;
                                $j++;
                                //   echo 'beririsan sebagian batas bawah';
                                //dd('beririsan sebagian batas bawah');
                            }
                        }
                    }else if($tm[1] < $ts[1]){
                        if(($tm[2] >= $ldbm[2]  && $tm[2] <= $ldbs[2] ) && ($ts[2] >= $ldbm[2] && $ts[2]<= $ldbs[2]) ){
                            //dd('beriirisan total');
                            $dataCurrent[$j] = $db->id;
                            $counter +=1;
                            $j++;
                            // echo 'beririsan';
                        }
                        else if(($tm[2] < $ldbm[2]  && $tm[2] <= $ldbs[2] ) && ($ts[2] >= $ldbm[2] && $ts[2]<= $ldbs[2])){
                            $dataCurrent[$j] = $db->id;
                            $counter +=1;
                            $j++;
                            //echo 'beririsan sebagian batas atas';
                            //dd('beririsan sebagian batas atas');
                        }else if(($tm[2] >= $ldbm[2]  && $tm[2] <= $ldbs[2] ) && ($ts[2] >= $ldbm[2] && $ts[2] > $ldbs[2])){
                            $dataCurrent[$j] = $db->id;
                            $counter +=1;
                            $j++;
                            // echo 'beririsan sebagian batas bawah';
                            //dd('beririsan sebagian batas bawah');
                        }
                    }

                }

                //dd('masuk');

                if($counter==0){
                    if($request['jumlah_kamar'] <= $a->jumlah_kamar){
                        if($request['jumlah_Tamu'] <= ($request['jumlah_kamar']*2)){
                            $dataHomestay[$i] = DB::table('homestay')
                                ->where('homestay.id','=',$a->id)
                                ->get();
                        }
                    }
                }else{

                    $currentKamar = null;

                    //$dataKamarHomestay = ListBook::find(14);
                    //dd($dataKamarHomestay);
                    //dd($dataCurrent,$counter);

                    for ($l = 0; $l<$counter;$l++){
                        // echo $dataCurrent[$l];
                        $dataKamarHomestay[$l] = DB::table('daftar_book')
                            ->where('daftar_book.id','=',$dataCurrent[$l])
                            ->get();

                        if ($dataKamarHomestay[$l][0]->homestay == $a->id){
                            $currentKamar = ($a->jumlah_kamar - $dataKamarHomestay[$l][0]->jumlah_kamar) - $currentKamar;
                        }else{
                            $currentKamar = $a->jumlah_kamar;
                        }
                    }

                    //dd($currentKamar);

                    if($request['jumlah_kamar'] <= $currentKamar){
                        if($request['jumlah_Tamu'] <= ($request['jumlah_kamar']*2)){
                            $dataHomestay[$i] = DB::table('homestay')
                                ->where('homestay.id','=',$a->id)
                                ->get();

                            //dd($request['jumlah_tamu']);
                            /*if($request['jumlah_Tamu'] <= $request['jumlah_kamar'] * 2){
                                $exbed = 0;
                                $biaya = ($request['jumlah_kamar'] * 150000) * $request['jumlah_hari'];
                                // echo 'masuk di if nya';
                                // echo '<br>';
                            }else{
                                $temp = (($request['jumlah_kamar']*2)*2);
                                $temp -= $request['jumlah_Tamu'];

                                $biaya = ($request['jumlah_kamar'] * 150000) * $request['jumlah_hari'];

                               f
                                //     echo 'masuk di else';
                                //   echo '<br>';
                            }*/
                        }

                        //echo $exbed;
                        //echo ' ';
                        // echo $biaya + ($exbed*50000);
                        //echo $request['jumlah_kamar'];
                        //echo '<br>';
                    }
                }
                $i++;
            }

            //dd($currentKamar);

            //dd($dataHomestay,$dataCurrent,$currentKamar);
        }else{
            return redirect('')->with('message','Jumlah Kamar tidak mencukupi');
        }


        if($dataHomestay == null){
            dd('salah');
            return redirect('')->with('message','Jumlah Kamar tidak mencukupi');
        }
        if($dataHomestay[0] == null){
            return redirect('')->with('message','Jumlah Kamar tidak mencukupi');
            dd('salah');
        }

        $totalHarga = ($biaya) + ($exbed*50000);
        //dd('benar');

        return view('searchhomestay')->with('data',$dataHomestay)
                                     ->with('tm',$tanggal_mulai)
                                     ->with('lm',$jumlah_hari)
                                     ->with('ts',$tanggal_selesai)
                                     ->with('jt',$jumlah_Tamu)
                                     ->with('jk',$jumlah_kamar)
                                     ->with('th',$totalHarga);
        //dd($i,$book_start[0],$book_start[1],$book_start[2],$book_finish[0],$book_finish[1],$book_finish[2]);
        //dd($request['tanggal_mulai'],$request['jumlah_hari'],$request['tanggal_selesai'],$request['jumlah_Tamu'],$request['jumlah_kamar']);
    }

    //Menyimpan data Pelanggan disaat melakukan Pendaftaran
    public function registerStore(Request $data){

      $validator = Validator::make($data->all(), [
          'name' => 'required',
          'username' => 'required',
          'email' => 'required|email',
          'password' => 'required',
      ], [
          'name.required' => 'Silahkan Masukkan Nama Lengkap!',
          'username.required' => 'Silahkan Masukkan Username!',
          'email.required' => 'Silahkan Masukkan Email!',
          'password.required' => 'Silahkan Masukkan Password!'
      ]);

      if ($validator->fails()) {
          return redirect('/daftar')->withErrors($validator->errors());
}else{
        $user = new User();
        $user->name  = $data['name'];
        $user->username = $data['username'];
        $user->email = $data['email'];
        $user->password = bcrypt($data['password']);
        $user->role = "Customer";
        $user->foto = "gravatar.png";

        $user->save();
        $dataPel = DB::table('users')
            ->select('users.id')
            ->where('users.username','=',$data['username'])
            ->get();

        $cus = new Customer();
        $cus->id_akun = $dataPel[0]->id;
        $cus->nama = $data['name'] ;
        $cus->alamat = "---";
        $cus->no_telepon = "---";
        $cus->pekerjaan = "---";

        $cus->save();

        $dataUser = DB::table('users')
                    ->where('users.username','=',$data['username'])
                    ->where('users.email','=',$data['email'])
                    ->get();
        //dd($dataUser[0]);

        Auth::login($user);

        return redirect('/');

//          if (Auth::attempt(['username' => $dataUser[0]->username, 'password' => $dataUser[0]->password])) {
//              return redirect('/');
//          }else{
//
//          }

         // return redirect('login')->with('mesaage','anda sudah terdaftar silahkan login');
      }
    }

    public function register(){
        return view('adminlte::auth.register');
    }

    public function detailhomestay($id){
        $data = DB::table('homestay')
            ->join('pemilikhomestay','homestay.id_pemilik','=','pemilikhomestay.id')
            ->select('pemilikhomestay.*','homestay.*')
            ->where('homestay.id','=',$id)
            ->get();



        $daftarBook = DB::table('daftar_book')
            ->select('daftar_book.*')
            ->where('daftar_book.homestay','=',$id)
            ->where('daftar_book.status','=',1)
            ->get();



        $dataFeedback  = DB::table('feedback')
            ->join('pelanggan','feedback.id_pelanggan','pelanggan.id')
            ->select('feedback.*','pelanggan.nama')
            ->where('feedback.id_pemilik_homestay','=',$data[0]->id_pemilik)
            ->orderBy('feedback.id', 'desc')
            ->paginate(5);
/*
        $dataFeedback = DB::table('feedback')
                        ->where('feedback.id_pemilik_homestay','=',$data[0]->id_pemilik)
                        ->get();*/


        //dd($dataFeedback);



        $now = new DateTime();
        $nowCurrent = $now->format('Y-m-d');

        $dataJumlahKamar = ListBook::all()->where('tanggal_mulai',$nowCurrent);

        $avilableRoom = 0;

       /* if($dataJumlahKamar->count() == null){
            $avilableRoom = $data[0]->jumlah_kamar;
            dd($data[0]->id_pemilik);
        }else{
            $avilableRoom = $dataJumlahKamar[0]->jumlah_kamar;
        }

*/

        $dataKamar = DB::table('kamar')
            ->select('kamar.*')
            ->where('kamar.id_homestay','=',$id)
            ->get();



        return view('adminlte::layouts.pages.Homestay')->with('data',$data[0])->with('daftarBook',$daftarBook)->with('dataKamar',$dataKamar)->with('avilable',$avilableRoom)->with('feedback',$dataFeedback);
    }
}
