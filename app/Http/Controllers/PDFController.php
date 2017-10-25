<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PDF;
use App\Homestay;
use App\ListBook;
use App\Room;
use App\User;
use App\Owner;
use DB;

class PDFController extends Controller
{
    public function showPDF($id){
      $dataTrans = DB::table('transaksi')
          ->join('pelanggan','transaksi.id_pelanggan','=','pelanggan.id')
          ->select('transaksi.tanggal_mulai','transaksi.tanggal_berakhir','transaksi.jumlah_kamar','transaksi.lama_menginap','pelanggan.nama','pelanggan.no_telepon')
          ->where('transaksi.id','=',$id)
          ->get();

          $pdf = PDF::loadView('pdf.detailpesanan',['data' => $dataTrans[0]]);
          return $pdf->stream('detailpesanan.pdf');
          //return $pdf->download('detailpesanan.pdf');
    }

    public function printFasilitas($id){
      $dataFasilitas = DB::table('pemilikhomestay')
          ->join('requestfasilitas','pemilikhomestay.id','=','requestfasilitas.id_pemilik_homestay')
          ->join('homestay','pemilikhomestay.id','=','homestay.id_pemilik')
          ->select('pemilikhomestay.nama','pemilikhomestay.no_telepon','requestfasilitas.*','homestay.nama_homestay')
          ->where('requestfasilitas.id','=',$id)
          ->get();

          $pdf = PDF::loadView('pdf.adminfasilitas',['data'=>$dataFasilitas[0]]);
          return $pdf->stream('adminfasilitas.pdf');
    }

    public function rincianHistory($id){
      $rincianHistory = DB::table('transaksi')
          ->join('pelanggan','transaksi.id_pelanggan','=','pelanggan.id')
          ->join('homestay','transaksi.id_homestay','=','homestay.id')
          ->join('pemilikhomestay','homestay.id_pemilik','=','pemilikhomestay.id')
          ->select('transaksi.status','transaksi.total_pembayaran','transaksi.bukti_pembayaran','transaksi.tanggal_mulai','transaksi.id','transaksi.tanggal_berakhir','transaksi.jumlah_kamar','transaksi.lama_menginap','pelanggan.nama','pelanggan.no_telepon','pemilikhomestay.no_rekening','homestay.nama_homestay')
          ->where('transaksi.id','=',$id)
          ->get();

          $pdf = PDF::loadView('pdf.rincianHistory',['data'=>$rincianHistory[0]]);
          return $pdf->stream('rincianHistory');
    }

    public function printReportOwner($id){
      $dataHomestay = DB::table('homestay')
                      ->join('pemilikhomestay','homestay.id_pemilik','=','pemilikhomestay.id')
                      ->where('pemilikhomestay.id_akun','=',Auth::user()->id)
                      ->select('homestay.id')
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



      $pdf = PDF::loadView('pdf.reportOwner',['data' => $dataPesanan[0]],['penghasilan'=>$penghasilan],['tamu'=>$jumlah_tamu]);
      return $pdf->stream('reportOwner.pdf');
    }
}
