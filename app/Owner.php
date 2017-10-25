<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    protected $table = "pemilikhomestay";

    protected $fillable = [
        'nama', 'alamat', 'pekerjaan','noTelepon','noRekening','foto',
    ];

}
