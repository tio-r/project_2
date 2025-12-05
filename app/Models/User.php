<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'users';
    protected $primaryKey = 'id_user';   // FIX PENTING!
    public $timestamps = false;

    protected $fillable = [
        'nama',
        'email',
        'nomor_hp',
        'tanggal_daftar'
    ];
}
