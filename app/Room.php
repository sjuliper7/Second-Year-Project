<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $table = "kamar";

    protected $fillable = [
        'idHomestay', 'jumlah_bed', 'fasilitas','nomor_kamar','id_transaksi','tamu_per_kamar',
    ];

    public $timestamps = false;
}
