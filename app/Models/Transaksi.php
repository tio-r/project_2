<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class transaksi extends Authenticatable
{
    protected $table = 'transaksi';
    protected $primaryKey = 'id_transaksi';   // FIX PENTING!
    public $timestamps = false;

    protected $fillable = [
        'id_transaksi',
        'id_user',
        'nama',
        'total_harga',
        'metode_pembayran',
        'status_pembayaran',
        'tanggal_transaksi'
    ];
}
