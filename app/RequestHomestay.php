<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestHomestay extends Model
{
    protected $table = "pengajuan_homestay";

    protected $fillable = [
        'idPengajuan', 'idPemilikHomestay', 'idPgwDinasPariwisata','nama','jumlahKamar','status',
    ];

    public $timestamps = false;
}
