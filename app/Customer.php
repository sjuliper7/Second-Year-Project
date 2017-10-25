<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = "pelanggan";

    protected $fillable = [
        'id_Akun', 'nama','alamat','noTelepon','pekerjaan',
    ];
}
