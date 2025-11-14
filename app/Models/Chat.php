<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $table = 'chat'; // sesuaikan dengan nama table
    protected $primaryKey = 'id_chat'; // sesuai dengan primary key
    public $timestamps = false; // jika tidak pakai timestamps

    protected $fillable = [
        'id_chat', 'id_user', 'nama_user', 'id_apoteker', 'nama_apoteker', 'pesan', 'waktu'
    ];
}