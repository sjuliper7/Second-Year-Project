<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestFasilitas extends Model
{
    protected $table = "requestfasilitas";

    protected $fillable = [
        'id','id_pemilik_homestay', 'id_kategori_fasiltas', 'nama_request_fasilitas','deskripsi','jumlah','gambar','status','pesan','notif'
    ];

    public $timestamps = false;
}
