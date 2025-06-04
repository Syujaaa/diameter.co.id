<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class toko extends Model
{
    use HasFactory;
    protected $table = 'toko';
    protected $primaryKey = 'id_toko';
    protected $fillable = [
        'nama_toko',
        'foto_toko',
        'telp',
        'kepemilikan',
        'alamat',
        'deskripsi_toko',
        'pesan'
    ];

    public function produk()
    {
        return $this->hasMany(produk::class);
    }
}
