<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListBook extends Model
{
    protected $table = "daftar_book";

    protected $fillable = [
        'extrabed','jumlah_tamu','total_harga','permintaan_khusus','nama_pemesan','tanggal_mulai','tanggal_berakhir','homestay','jumlah_kamar'
    ];

    public $timestamps = false;
}

