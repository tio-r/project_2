<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Login;

class User extends Login
{
    protected $table = 'user'; // sesuai nama tabel

    public $timestamps = false; // karena tabel tidak pakai created_at/updated_at

    protected $primaryKey = 'id_user';

    protected $fillable = ['id_user', 'nama', 'email', 'password', 'nomor_hp', 'tanggal_daftar'];
}