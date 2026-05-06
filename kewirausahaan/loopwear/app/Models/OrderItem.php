<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'barang_id',
        'nama_barang',
        'harga',
        'qty'
    ];

    public function mbarang()
    {
        return $this->belongsTo(Mbarang::class, 'barang_id');
    }
}
