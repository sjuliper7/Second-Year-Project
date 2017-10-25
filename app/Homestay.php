<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Homestay extends Model
{
    protected $table = "homestay";

    protected $fillable = [
        'idPemilik', 'namaHomestay', 'owner','alamat','jumlahKamar','harga','status',
    ];

}
