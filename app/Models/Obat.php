<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    protected $table = 'produk'; // sesuai nama tabel

    public $timestamps = false; // karena tabel tidak pakai created_at/updated_at

    protected $primaryKey = 'id';

    protected $fillable = ['id', 'id_produk', 'nama_kategori', 'jenis', 'stok', 'harga', 'dosis', 'tanggal_kadaluarsa'];
}
