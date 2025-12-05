<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MapUser extends Model
{
    use HasFactory;

    protected $table = 'maps_user';
    protected $primaryKey = 'id_map';
    public $timestamps = false;
    
    protected $fillable = [
        'id_user',
        'nama_user',
        'alamat',
        'koordinat_lat',
        'koordinat_long'
    ];

    // Relasi ke tabel user
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}