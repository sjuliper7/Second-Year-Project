<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table = "feedback";

    protected $fillable = [
        'id_pemilikHomestay', 'feedback', 'idPelanggan',
    ];
}
