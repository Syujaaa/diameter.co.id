<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class produk extends Model
{
    use HasFactory;
    protected $table = 'produk';
    protected $primaryKey = 'id_produk';

    protected $fillable = [
        'toko',
        'nama_produk',
        'deskripsi',
        'foto_1',
        'foto_2',
        'foto_3',
        'id_kategori',
        'harga',
        'ukuran'
    ];

    public function toko()
    {
        return $this->belongsTo(toko::class);
    }
}
