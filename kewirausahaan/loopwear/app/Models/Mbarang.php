<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mbarang extends Model
{
    use HasFactory;

    protected $table = 'mbarangs';
    protected $primaryKey = 'id_barang';
    protected $fillable = ['nama_barang', 'kategori', 'harga', 'stok', 'deskripsi', 'gambar'];
}
