<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = "transaksi";

    protected $fillable = [
       'pesan','extrabed','tanggal_konfirmasi','jumlah_tamu','permintaan_khusus','id_pelanggan', 'tanggal_mulai', 'tanggal_berakhir','lama_menginap','total_pembayaran','tanggal_konfirmasi','status',
    ];

    public $timestamps = false;
}
